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
                        @if(session()->has('created_at') && session()->has('expired_at'))
                            <div class="alert alert-success">
                                <p>Domain was registered successfully</p>
                                <p>Creation: {{ session()->get('created_at') }}</p>
                                <p>Expiration: {{ session()->get('expired_at') }}</p>
                            </div>
                        @endif
                        <form action="{{route('register-domain')}}" method="post">
                            @csrf
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