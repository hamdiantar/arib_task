<?php

namespace App\Services;

use App\Models\Task;
use App\Repositories\TaskRepository;
use App\Traits\LoggerError;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TaskService
{
    protected TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function getAllTasksWithRelations(): Collection|array
    {
        return $this->taskRepository->allWithRelations();
    }

    public function find(int $id): Model
    {
        return $this->taskRepository->find($id);
    }

    public function createTask(array $data): Model
    {
        $data['created_by'] = Auth::user()->id;
        return $this->taskRepository->create($data);
    }

    public function updateTask(Task $task, array $data): bool|int
    {
        return $this->taskRepository->update($data, $task->id);
    }

    public function deleteTask(Task $task): int
    {
        return $this->taskRepository->delete($task);
    }

    public function getEmployeeTasks(int $employeeId): array
    {
        return [
            'pending' => $this->taskRepository->getTasksByEmployeeAndStatus($employeeId, 'pending'),
            'in_progress' => $this->taskRepository->getTasksByEmployeeAndStatus($employeeId, 'in_progress'),
            'completed' => $this->taskRepository->getTasksByEmployeeAndStatus($employeeId, 'completed'),
        ];
    }

    public function updateTaskStatus(int $taskID, string $status): bool|int
    {
        return $this->taskRepository->update(['status' => $status], $taskID);
    }
}
