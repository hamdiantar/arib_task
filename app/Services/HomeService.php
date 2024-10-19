<?php
namespace App\Services;

use App\Repositories\TaskRepository;
use App\Repositories\EmployeeRepository;
use App\Repositories\DepartmentRepository;

class HomeService
{
    protected TaskRepository $taskRepository;
    protected EmployeeRepository $employeeRepository;
    protected DepartmentRepository $departmentRepository;

    public function __construct(
        TaskRepository $taskRepository,
        EmployeeRepository $employeeRepository,
        DepartmentRepository $departmentRepository
    ) {
        $this->taskRepository = $taskRepository;
        $this->employeeRepository = $employeeRepository;
        $this->departmentRepository = $departmentRepository;
    }

    public function getDashboardData(): array
    {
        return [
            'managerCount' => $this->employeeRepository->countManagers(),
            'employeeCount' => $this->employeeRepository->countEmployees(),
            'taskCount' => $this->taskRepository->count(),
            'departmentCount' => $this->departmentRepository->count(),
            'employeesWithTasks' => $this->employeeRepository->getEmployeesWithTaskCounts(),
            'taskStatusData' => $this->taskRepository->getTaskStatusData(),
        ];
    }
}
