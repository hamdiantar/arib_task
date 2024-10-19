@extends('layouts.app')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-users mr-2"></i>{{__('Employees')}}</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item"><i class="fa fa-users  fa-lg"></i></li>
                <li class="breadcrumb-item" ><a href="{{route('employees.index')}}">{{__('Employees')}}</a></li>
                <li class="breadcrumb-item active"><a href="#">{{__('Create')}}</a></li>
            </ul>
        </div>
        <div class="tile">
             <div class="row">
                 <div class="col-md-8">
                     <h6 class="tile-title">{{__('Add New Employee')}}</h6>
                 </div>
                 <div class="col-md-4">
                     <a href="{{route('employees.index')}}" class="btn float-right btn-danger btn-sm"><i class="fa fa-arrow-right"></i></a>
                 </div>
             </div>
        @include('employees.form', ['action' => route('employees.store'), 'method' => 'POST', 'buttonText' => 'Create Employee'])
        </div>
    </main>
@endsection
