<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($method == 'PUT')
        @method('PUT')
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="first_name">Department Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $department->name ?? '') }}" required>
                @error('name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-12 mt-4">
            <button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
        </div>

    </div>

</form>
