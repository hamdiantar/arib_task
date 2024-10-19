<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($method == 'PUT')
        @method('PUT')
    @endif

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $employee->first_name ?? '') }}" required>
                @error('first_name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Last Name -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $employee->last_name ?? '') }}" required>
                @error('last_name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Salary -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="salary">Salary</label>
                <input type="number" name="salary" class="form-control" value="{{ old('salary', $employee->salary ?? '') }}" required>
                @error('salary')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <!-- Department -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="department_id">Department</label>
                <select name="department_id" class="form-control" required>
                    <option value="">Select Department</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}" {{ old('department_id', $employee->department_id ?? '') == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                    @endforeach
                </select>
                @error('department_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="image">Image (png, jpeg, jpg, svg)</label>
                <input type="file" name="image" class="form-control" accept="image/png, image/jpeg, image/jpg, image/svg" onchange="previewImage(event)">
                @error('image')
                <div class="text-danger">{{ $message }}</div>
                @enderror
                <img id="imagePreview" src="{{ isset($employee) && $employee->image ? $employee->image_path : '' }}"
                     alt="Image Preview" class="mt-2" width="100" style="{{ isset($employee) && $employee->image ? '' : 'display:none' }}"/>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $employee->user->email ?? '') }}" required>
                @error('email')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone', $employee->user->phone ?? '') }}" required>
                <small class="form-text text-muted">Phone number must start with 011, 010, or 015 followed by 8 digits.</small>
                @error('phone')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control">
                <small class="form-text text-muted">Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.</small>
                @error('password')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control">
                @error('password_confirmation')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="is_manager" name="is_manager" value="1" {{ old('is_manager', $employee->is_manager ?? 0) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_manager">Is Manager</label>
            </div>
        </div>
        <div class="col-md-12 mt-4">
            <button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
        </div>

    </div>

</form>
@push('js')
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function(){
                const output = document.getElementById('imagePreview');
                output.src = reader.result;
                output.style.display = 'block';
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endpush
