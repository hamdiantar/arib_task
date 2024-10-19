@extends('layouts.app')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-users mr-2"></i>{{__('Employees')}}</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item"><i class="fa fa-users fa-lg"></i></li>
                <li class="breadcrumb-item">{{__('Employees')}}</li>
                <li class="breadcrumb-item active"><a href="#">{{__('List')}}</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="row">
                        <div class="col-md-8">
                            <h6 class="tile-title">{{__('Employees List')}}</h6>
                        </div>
                        <div class="col-md-4">
                            <a class="btn btn-primary float-right btn-sm" href="{{route('employees.create')}}">
                                <i class="fa fa-plus"></i> Add
                            </a>
                        </div>
                    </div>
                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th>{{__('ID')}}</th>
                                <th>{{__('Image')}}</th>
                                <th>{{__('Name')}}</th>
                                <th>{{__('E-Mail')}}</th>
                                <th>{{__('Phone')}}</th>
                                <th>{{__('Salary')}}</th>
                                <th>{{__('Actions')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($employees as $employee)
                                <tr>
                                    <td>{{$employee->id}}</td>
                                    <td>
                                        <img style="height: 100px;" src="{{$employee->image_path}}" class="img-thumbnail" height="100px">
                                    </td>
                                    <td>{{$employee->full_name}}</td>
                                    <td>{{optional($employee->user)->email}}</td>
                                    <td>{{optional($employee->user)->phone}}</td>
                                    <td>{{$employee->salary}}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#employeeModal{{$employee->id}}">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                        <a href="{{route('employees.edit', $employee->id)}}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        @if(getAuthUser()->id != $employee->id)
                                            <a onclick="confirmation('trash{{$employee->id}}', 'delete')" class="btn btn-danger btn-sm" href="#">
                                                <i class="fa fa-trash-o mr-0"></i>
                                            </a>
                                            <form id="trash{{$employee->id}}" method="post" action="{{route('employees.destroy', $employee->id)}}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endif

                                        <!-- Modal -->
                                        <div class="modal fade" id="employeeModal{{$employee->id}}" tabindex="-1" role="dialog" aria-labelledby="employeeModalLabel{{$employee->id}}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="employeeModalLabel{{$employee->id}}">Employee Details</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <img src="{{$employee->image_path}}" alt="{{$employee->full_name}}" class="img-fluid img-thumbnail mb-3" style="max-height: 150px;">
                                                        <table class="w-100 table table-bordered">
                                                            <tr>
                                                                <td><strong>Name:</strong></td>
                                                                <td>{{$employee->full_name}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Email:</strong></td>
                                                                <td>{{optional($employee->user)->email}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Phone:</strong></td>
                                                                <td>{{optional($employee->user)->phone}}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Salary:</strong></td>
                                                                <td>{{$employee->salary}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Manager:</strong></td>
                                                                <td>{{ $employee->manager ? $employee->manager->first_name . ' ' . $employee->manager->last_name : 'None' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Department:</strong></td>
                                                                <td>{{ $employee->department->name ?? 'Not assigned' }}</td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
