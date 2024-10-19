<?php

namespace App\Services;

use App\Models\Department;
use App\Repositories\DepartmentRepository;
use App\Traits\LoggerError;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DepartmentService
{
    use LoggerError;
    protected DepartmentRepository $departmentRepository;

    public function __construct(DepartmentRepository $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    public function all(): Collection
    {
        return $this->departmentRepository->findAll();
    }

    public function find(int $id): Model
    {
        return $this->departmentRepository->find($id);
    }

    public function createDepartment(array $data): Model
    {
        DB::beginTransaction();
        try {
            $department = $this->departmentRepository->create($data);
            DB::commit();
            return $department;
        } catch (Exception $e) {
            DB::rollBack();
            $this->logErrors($e);
            throw new Exception('Failed to create department.');
        }
    }

    public function updateDepartment(Department $department, array $data): Model
    {
        DB::beginTransaction();
        try {
            $this->departmentRepository->update($data, $department->id);
            DB::commit();
            return $department;
        } catch (Exception $e) {
            DB::rollBack();
            $this->logErrors($e);
            throw new Exception('Failed to update department.');
        }
    }

    public function deleteDepartment(Department $department): void
    {
        DB::beginTransaction();
        try {
            if ($this->hasEmployees($department)) {
                throw new Exception('Cannot delete department with assigned employees.');
            }
            $this->departmentRepository->delete($department);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $this->logErrors($e);
            throw new Exception($e->getMessage());
        }
    }

    protected function hasEmployees(Department $department): bool
    {
        return $department->employees()->count() > 0;
    }
}
