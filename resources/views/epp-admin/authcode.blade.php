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
                        <h3 class="card-title" style="margin-top: 5px;">{{session('selected_domain')}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="info">
                            @if(session()->has('auth_code'))
                                The auth code has been set to: <tt>adsasd</tt>
                            @else
                                ⚠ SWITCH does not allow reading of the currently-set auth code.
                            @endif
                        </div>
                        <form action="{{route('update-auth-code')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <label>New auth code:</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <input class="form-control" placeholder="auth code" name="code">
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                        <div style="margin-top: 50px">
                            <form action="{{route('generate-random-code')}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        Generate random auth code:
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary">
                                            Random
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection