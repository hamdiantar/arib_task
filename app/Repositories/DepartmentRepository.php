<?php

namespace App\Repositories;

use App\Models\Department;

class DepartmentRepository extends Repository
{
    public function model(): string
    {
        return Department::class;
    }

    public function count(): int
    {
        return $this->model->count();
    }
}
