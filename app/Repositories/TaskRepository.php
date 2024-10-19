<?php
namespace App\Repositories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class TaskRepository extends Repository
{
    public function model(): string
    {
       return Task::class;
    }

    public function allWithRelations(): Collection|array
    {
        return $this->model->with('employee', 'creator')->get();
    }

    public function getTasksByEmployeeAndStatus(int $employeeId, string $status)
    {
        return $this->model->where('employee_id', $employeeId)
            ->where('status', $status)
            ->get();
    }

    public function getTaskStatusData(): array
    {
        return $this->model->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();
    }

    public function count(): int
    {
        return $this->model->count();
    }
}
