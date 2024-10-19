@extends('layouts.app')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-tasks mr-2"></i>{{ __('Tasks') }}</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item"><i class="fa fa-tasks fa-lg"></i></li>
                <li class="breadcrumb-item">{{ __('Tasks') }}</li>
                <li class="breadcrumb-item active"><a href="#">{{ __('List') }}</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="row">
                        <div class="col-md-8">
                            <h6 class="tile-title">{{ __('Tasks List') }}</h6>
                        </div>
                        <div class="col-md-4">
                            <a class="btn btn-primary float-right btn-sm" href="{{ route('tasks.create') }}">
                                <i class="fa fa-plus"></i> {{ __('Add') }}
                            </a>
                        </div>
                    </div>
                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Assigned To') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{__('Assigned At')}}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tasks as $task)
                                <tr>
                                    <td>{{ $task->id }}</td>
                                    <td>{{ $task->title }}</td>
                                    <td>{{ optional($task->employee)->full_name }}</td>
                                    <td>
                                        @if($task->status->value === 'pending')
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif($task->status->value === 'in_progress')
                                            <span class="badge badge-info">In Progress</span>
                                        @elseif($task->status->value === 'completed')
                                            <span class="badge badge-success">Completed</span>
                                        @endif
                                    </td>
                                    <td>{{date('Y-m-d H:s A', strtotime($task->created_at))}}</td>
                                    <td>
                                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a onclick="confirmation('trash{{$task->id}}', 'delete')" class="btn btn-danger btn-sm" href="#">
                                            <i class="fa fa-trash-o mr-0"></i>
                                        </a>
                                        <form id="trash{{$task->id}}" method="post" action="{{route('tasks.destroy', $task->id)}}">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
