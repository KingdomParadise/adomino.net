@extends('layouts.admin')
@section('content')
    <style>
        .row {
            margin-bottom: 20px;
        }
    </style>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">

            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="margin-top: 5px;">{{session('selected_domain')}}</h3>
                    </div>
                    <div class="card-body">
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        <form action="{{route('transfer-domain')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-2">
                                    <label>Auth code for transfer:</label>
                                </div>
                                <div class="col-md-4">
                                    <input class="form-control" required name="code">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label>Registrant:</label>
                                </div>
                                <div class="col-md-4">
                                    <input class="form-control" value="DAYINV-HOLDER" required name="handle">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label>Tech contact:</label>
                                </div>
                                <div class="col-md-4">
                                    <input class="form-control" value="DAYINV-TECH-C" required name="tech">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label>Nameserver #1:</label>
                                </div>
                                <div class="col-md-4">
                                    <input class="form-control" value="ns1.day.biz" required name="dns1">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label>Nameserver #2:</label>
                                </div>
                                <div class="col-md-4">
                                    <input class="form-control" value="ns2.day.biz" required name="dns2">
                                </div>
                            </div>
                            <div class="row">
                                <button type="submit" class="btn btn-primary btn-sm">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection