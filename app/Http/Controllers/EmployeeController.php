<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Employee;
use App\Services\DepartmentService;
use App\Services\EmployeeService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    protected EmployeeService $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function index(): View
    {
        $employees = $this->employeeService->all();
        return view('employees.index', compact('employees'));
    }

    public function create(): View
    {
        $departmentService = app(DepartmentService::class);
        $departments = $departmentService->all();
        return view('employees.create', compact('departments'));
    }

    public function store(StoreEmployeeRequest $request): RedirectResponse
    {
        try {
            $this->employeeService->createEmployee($request->validated(), $request);
            return redirect()->route('employees.index')->with('success', 'Employee and user account created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function edit(Employee $employee): View
    {
        $departmentService = app(DepartmentService::class);
        $departments = $departmentService->all();
        return view('employees.edit', compact('departments', 'employee'));
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee): RedirectResponse
    {
        try {
            $this->employeeService->updateEmployee($employee, $request);
            return redirect()->route('employees.index')->with('success', 'Employee and user account updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function destroy($id): RedirectResponse
    {
        try {
            $this->employeeService->deleteEmployee($id);
            return redirect()->route('employees.index')->with('success', 'Employee and user account deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
