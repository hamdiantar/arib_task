
@extends('layouts.app')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-sitemap mr-2"></i>{{__('Departments')}}</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item"><i class="fa fa-users  fa-lg"></i></li>
                <li class="breadcrumb-item" ><a href="{{route('departments.index')}}">{{__('Departments')}}</a></li>
                <li class="breadcrumb-item active"><a href="#">{{__('Edit')}}</a></li>
            </ul>
        </div>
        <div class="tile">
            <div class="row">
                <div class="col-md-8">
                    <h6 class="tile-title">Edit Employee | {{$department->full_name}}</h6>
                </div>
                <div class="col-md-4">
                    <a href="{{route('departments.index')}}" class="btn float-right btn-danger btn-sm"><i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
            @include('departments.form', ['action' => route('departments.update', $department->id), 'method' => 'PUT', 'buttonText' => 'Update Department', 'department' => $department])
        </div>
    </main>
@endsection
