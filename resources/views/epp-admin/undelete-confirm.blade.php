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
                        @foreach($names as $name)
                            <div class="row">
                                <div class="col-md-6">Domain #{{($loop->index+1)}}</div>
                                <div class="col-md-6">{{$name}}</div>
                            </div>
                        @endforeach
                        <form action="{{route('undelete-confirm-process')}}" method="post">
                            @csrf
                            <input type="hidden" name="names" value="{{$names_json}}">
                            <button type="submit" class="btn btn-secondary btn-sm poll-button">Undelete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection