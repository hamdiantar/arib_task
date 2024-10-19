@extends('layouts.app')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-tasks mr-2"></i>{{ __('Create Task') }}</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item"><i class="fa fa-tasks fa-lg"></i></li>
                <li class="breadcrumb-item">{{ __('Tasks') }}</li>
                <li class="breadcrumb-item active"><a href="#">{{ __('Create') }}</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    @include('tasks.form', ['task' => null])
                </div>
            </div>
        </div>
    </main>
@endsection
