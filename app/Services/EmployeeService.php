<?php

namespace App\Services;

use App\Models\Employee;
use App\Repositories\EmployeeRepository;
use App\Models\User;
use App\Traits\LoggerError;
use App\Traits\UploadFile;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class EmployeeService
{
    use UploadFile,LoggerError;

    protected EmployeeRepository $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function all(): Collection
    {
        return $this->employeeRepository->findAll();
    }

    public function createEmployee(array $validated, $request): Model
    {
        DB::beginTransaction();
        try {
            $validated['manager_id'] = $request->is_manager ? null : Auth::user()->id;
            if ($request->hasFile('image')) {
                $validated['image'] = $this->upload($request->image);
            }
            $employee = $this->employeeRepository->create($validated);
            $this->createUserAccount($employee, $request);
            DB::commit();
            return $employee;
        } catch (Exception $e) {
            DB::rollBack();
            $this->logErrors($e);
            throw new Exception('Failed to create employee and user account.');
        }
    }

    public function updateEmployee(Employee $employee, Request $request): Employee
    {
        DB::beginTransaction();
        try {
            $data = $request->only(['first_name', 'last_name', 'salary', 'department_id', 'manager_id']);
            $data['manager_id'] = $request->is_manager ? null : Auth::user()->id;
            if ($request->hasFile('image')) {
                $this->deleteOldImage($employee);
                $data['image'] = $this->upload($request->image);
            }
            $this->employeeRepository->update($data, $employee->id);
            $this->updateUserAccount($employee, $request);
            DB::commit();
            return $employee;
        } catch (Exception $e) {
            DB::rollBack();
            $this->logErrors($e);
            throw new Exception('Failed to update employee and user account.');
        }
    }

    public function deleteEmployee(Employee $employee): void
    {
        DB::beginTransaction();
        try {
            $this->deleteOldImage($employee);
            $employee->user->delete();
            $this->employeeRepository->delete($employee->id);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $this->logErrors($e);
            throw new Exception('Failed to delete employee and user account.');
        }
    }

    private function createUserAccount(Employee $employee, Request $request): void
    {
        User::create([
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'employee_id' => $employee->id,
        ]);
    }

    private function updateUserAccount(Employee $employee, Request $request): void
    {
        $employee->user->update([
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password ? Hash::make($request->password) : optional($employee->user)->password,
        ]);
    }

    private function deleteOldImage($employee): void
    {
        if ($employee->image && File::exists(public_path('uploads/' . $employee->image))) {
            File::delete(public_path('uploads/' . $employee->image));
        }
    }
}
