<div class="modal fade" id="editTaskModal{{ $task->id }}" tabindex="-1" role="dialog" aria-labelledby="editTaskModalLabel{{ $task->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTaskModalLabel{{ $task->id }}">{{ __('Edit Task') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editTaskForm{{ $task->id }}">
                    @csrf
                    <input type="hidden" name="employee_id" value="{{ auth()->id() }}">
                    <input type="hidden" name="task_id" value="{{ $task->id }}">

                    <div class="form-group">
                        <label for="title">{{ __('Title') }}</label>
                        <input type="text" name="title" class="form-control" value="{{ $task->title }}" required>
                    </div>

                    <div class="form-group">
                        <label for="description">{{ __('Description') }}</label>
                        <textarea name="description" class="form-control" required>{{ $task->description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="status">{{ __('Status') }}</label>
                        <select name="status" class="form-control" required>
                            <option value="pending" {{ $task->status->value === 'pending' ? 'selected' : '' }}>
                                {{ __('Pending') }}
                            </option>
                            <option value="in_progress" {{ $task->status->value === 'in_progress' ? 'selected' : '' }}>
                                {{ __('In Progress') }}
                            </option>
                            <option value="completed" {{ $task->status->value === 'completed' ? 'selected' : '' }}>
                                {{ __('Completed') }}
                            </option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                <button type="button" class="btn btn-primary" onclick="updateTask({{ $task->id }})">{{ __('Save changes') }}</button>
            </div>
        </div>
    </div>
</div>
