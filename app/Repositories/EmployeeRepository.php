<?php

namespace App\Repositories;

use App\Models\Employee;

class EmployeeRepository extends Repository
{
    public function model(): string
    {
        return Employee::class;
    }

    public function countManagers(): int
    {
        return $this->model->whereNull('manager_id')->count();
    }

    public function countEmployees(): int
    {
        return $this->model->whereNotNull('manager_id')->count();
    }

    public function getEmployeesWithTaskCounts(): array
    {
        return $this->model->withCount('tasks')
            ->get()
            ->pluck('tasks_count', 'full_name')
            ->toArray();
    }
}
