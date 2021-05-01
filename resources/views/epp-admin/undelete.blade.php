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
                    <div class="card-body">
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        <form action="{{route('undelete-confirm')}}" method="post">
                            @csrf
                            <textarea class="form-control" name="names" required
                                      placeholder="Enter domains to undelete" rows="10"></textarea>
                            <button type="submit" class="btn btn-secondary btn-sm poll-button">Next</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection