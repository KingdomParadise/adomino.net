@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">

            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            {{ __('admin-users.title') }}
                        </h3>
                        <a href="{{route('add-new-user-page')}}"
                           class="btn btn-primary float-right btn-sm">{{ __('admin-users.addUserButton') }}</a>
                    </div>
                    <div class="card-body">
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        {{--<div class="row">--}}
                        {{--<div class="col-md-3">--}}
                        {{--<div class="form-group has-search">--}}
                        {{--<span class="fa fa-search form-control-feedback"></span>--}}
                        {{--<input type="text" class="form-control" id="yajraSearch" placeholder="Suche">--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-9">--}}
                        {{--<button data-href="{{route('get-filter-user-modal')}}"--}}
                        {{--data-id=""--}}
                        {{--data-name="get-filter-user-modal"--}}
                        {{--class="btn btn-default float-right OpenModal"><i--}}
                        {{--class="fa fa-filter"></i>--}}
                        {{--</button>--}}
                        {{--<label data-href="{{route('get-delete-user-modal')}}"--}}
                        {{--data-id=""--}}
                        {{--data-name="get-multi-option-modal" style="cursor: pointer"--}}
                        {{--class="btn btn-default float-right invisible filterButton OpenModal">--}}
                        {{--<i class="fa fa-trash"></i></label>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        <table class="table table-striped table-bordered data_table_yajra_manual"
                               style="width:100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th class="no-sort">Aktion</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        <a href="{{route('get-edit-user-page', [$user->id])}}"
                                           style="cursor: pointer;color: black"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                        <label data-href="{{route('get-delete-user-modal')}}"
                                               data-id="{{$user->id}}"
                                               data-name="get-delete-user-modal" style="cursor: pointer"
                                               class="OpenModal"><i class="fa fa-trash"></i></label>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection