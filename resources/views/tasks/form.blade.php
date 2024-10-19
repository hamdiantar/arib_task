<form action="{{ isset($task) ? route('tasks.update', $task->id) : route('tasks.store') }}" method="POST">
    @csrf
    @if(isset($task))
        @method('PUT')
    @endif
    <div class="row">
        <div class="form-group col-md-6">
            <label for="title">{{ __('Title') }}</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $task->title ?? '') }}" required>
            @if($errors->has('title'))
                <span class="text-danger">{{ $errors->first('title') }}</span>
            @endif
        </div>
        <div class="form-group col-md-6">
            <label for="employee_id">{{ __('Assign to Employee') }}</label>
            <select name="employee_id" id="employee_id" class="form-control">
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}" {{ old('employee_id', $task->employee_id ?? '') == $employee->id ? 'selected' : '' }}>
                        {{ $employee->full_name }}
                    </option>
                @endforeach
            </select>
            @if($errors->has('employee_id'))
                <span class="text-danger">{{ $errors->first('employee_id') }}</span>
            @endif
        </div>
        <div class="form-group col-md-12">
            <label for="description">{{ __('Description') }}</label>
            <textarea name="description" id="description" class="form-control">{{ old('description', $task->description ?? '') }}</textarea>
        </div>



        <div class="form-group">
            <button type="submit" class="btn btn-primary">{{ isset($task) ? __('Update') : __('Create') }}</button>
        </div>
    </div>
</form>
