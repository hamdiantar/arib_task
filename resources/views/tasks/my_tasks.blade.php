@extends('layouts.app')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-tasks"></i> {{ __('My Tasks') }}</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">{{ __('My Tasks') }}</a></li>
            </ul>
        </div>

        <div class="row">
            <!-- Pending Tasks Card -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-warning text-white">
                        <h4>{{ __('Pending Tasks') }}</h4>
                    </div>
                    <div class="card-body taskScroll">
                        @forelse($pendingTasks as $task)
                            <div class="task-item mb-3 taskBorder">
                                <p><strong>{{ $task->title }}</strong></p>
                                <p>{{ $task->description }}</p>
                                <button class="btn btn-sm btn-info" onclick="updateTaskStatus('{{ $task->id }}', 'in_progress')">
                                    {{ __('Mark In Progress') }}
                                </button>
                                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editTaskModal{{ $task->id }}">
                                    {{ __('Edit') }}
                                </button>
                                <!-- Edit Task Modal -->
                                @include('tasks.edit_modal', ['task' => $task])
                            </div>
                        @empty
                            <p>{{ __('No pending tasks.') }}</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- In Progress Tasks Card -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h4>{{ __('Tasks In Progress') }}</h4>
                    </div>
                    <div class="card-body taskScroll">
                        @forelse($inProgressTasks as $task)
                            <div class="task-item mb-3 taskBorder">
                                <p><strong>{{ $task->title }}</strong></p>
                                <p>{{ $task->description }}</p>
                                <button class="btn btn-sm btn-success" onclick="updateTaskStatus('{{ $task->id }}', 'completed')">
                                    {{ __('Mark Completed') }}
                                </button>
                                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editTaskModal{{ $task->id }}">
                                    {{ __('Edit') }}
                                </button>
                                <!-- Edit Task Modal -->
                                @include('tasks.edit_modal', ['task' => $task])
                            </div>
                        @empty
                            <p>{{ __('No tasks in progress.') }}</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Completed Tasks Card -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h4>{{ __('Completed Tasks') }}</h4>
                    </div>
                    <div class="card-body taskScroll">
                        @forelse($completedTasks as $task)
                            <div class="task-item mb-3 taskBorder">
                                <p><strong>{{ $task->title }}</strong></p>
                                <p>{{ $task->description }}</p>
                                <button class="btn btn-sm btn-secondary" disabled>{{ __('Completed') }}</button>

                            </div>
                        @empty
                            <p>{{ __('No completed tasks.') }}</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('js')
    <script>
        function updateTaskStatus(taskId, status) {
            if (confirm('Are you sure you want to change the task status?')) {
                $.ajax({
                    url: "{{ route('my_tasks.update.status') }}", // Define your route for updating status
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        task_id: taskId,
                        status: status,
                    },
                    success: function(response) {
                        location.reload(); // Reload page on success
                    },
                    error: function(xhr) {
                        alert('Failed to update status. Please try again.');
                    }
                });
            }
        }

        function updateTask(taskId) {
            let formData = $('#editTaskForm' + taskId).serialize();
            $.ajax({
                url: "{{ route('my_tasks.update') }}", // Define your route for updating the task
                type: "POST",
                data: formData,
                success: function(response) {
                    location.reload(); // Reload the page on success
                },
                error: function(xhr) {
                    alert('Failed to update task. Please try again.');
                }
            });
        }
    </script>
@endpush
