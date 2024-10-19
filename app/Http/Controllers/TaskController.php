<?php
namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Http\Requests\UpdateTaskStatusRequest;
use App\Models\Task;
use App\Services\EmployeeService;
use App\Services\TaskService;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TaskController extends Controller
{
    protected TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index(): View
    {
        $tasks = $this->taskService->getAllTasksWithRelations();
        return view('tasks.index', compact('tasks'));
    }

    public function create(): View
    {
        $employeeService = app(EmployeeService::class);
        $employees = $employeeService->all();
        return view('tasks.create', compact('employees'));
    }

    public function store(TaskRequest $request): RedirectResponse
    {
        $this->taskService->createTask($request->validated());
        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function edit(Task $task): View
    {
        $employeeService = app(EmployeeService::class);
        $employees = $employeeService->all();
        return view('tasks.edit', compact('task', 'employees'));
    }

    public function update(TaskRequest $request, Task $task): RedirectResponse
    {
        $this->taskService->updateTask($task, $request->validated());
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $this->taskService->deleteTask($task);
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }

    public function getMyTasks(): View
    {
        $employeeId = auth()->user()->id;
        $tasks = $this->taskService->getEmployeeTasks($employeeId);
        return view('tasks.my_tasks', [
            'pendingTasks' => $tasks['pending'],
            'inProgressTasks' => $tasks['in_progress'],
            'completedTasks' => $tasks['completed'],
        ]);
    }

    public function updateTaskStatus(UpdateTaskStatusRequest $request): JsonResponse
    {
        $this->taskService->updateTaskStatus($request->task_id, $request->status);
        return response()->json(['success' => true, 'message' => 'Task status updated successfully.']);
    }

    public function updateTask(TaskRequest $request): JsonResponse
    {
        $task = $this->taskService->find($request->task_id);
        $this->taskService->updateTask($task, $request->validated());
        return response()->json(['success' => true, 'message' => 'Task updated successfully.']);
    }
}
