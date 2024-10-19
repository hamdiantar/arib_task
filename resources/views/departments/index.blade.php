@extends('layouts.app')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-sitemap mr-2"></i>{{__('Departments')}}</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item"><i class="fa fa-users fa-lg"></i></li>
                <li class="breadcrumb-item">{{__('Departments')}}</li>
                <li class="breadcrumb-item active"><a href="#">{{__('List')}}</a></li>
            </ul>

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="row">
                        <div class="col-md-8">
                            <h6 class="tile-title">{{__('Departments List')}}</h6>
                        </div>
                        <div class="col-md-4">
                            <a class="btn btn-primary float-right btn-sm" href="{{route('departments.create')}}" >
                                <i class="fa fa-plus"></i> Add
                            </a>
                        </div>
                    </div>
                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th>{{__('ID')}}</th>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Employee Count')}}</th>
                                <th>{{__('Total Salary')}}</th>
                                <th>{{__('Created At')}}</th>
                                <th>{{__('Actions')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($departments as $department)
                                <tr>
                                    <td>{{$department->id}}</td>
                                    <td>{{$department->name}}</td>
                                    <td><span class="badge badge-success">{{count($department->employees)}}</span></td> <!-- Employee Count -->
                                    <td>{{number_format($department->employees()->sum('salary'), 2)}}</td> <!-- Total Salary -->
                                    <td>{{date('Y-m-d H:s A', strtotime($department->created_at))}}</td>
                                    <td>
                                        <a href="{{route('departments.edit', $department->id)}}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        @if(count($department->employees) == 0)
                                            <a onclick="confirmation('trash{{$department->id}}', 'delete')" class="btn btn-danger btn-sm" href="#">
                                                <i class="fa fa-trash-o mr-0"></i>
                                            </a>
                                            <form id="trash{{$department->id}}" method="post" action="{{route('departments.destroy', $department->id)}}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @else
                                            <button class="btn btn-danger btn-sm" disabled><i class="fa fa-trash-o mr-0"></i></button>
                                        @endif
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
