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
                        <h3 class="card-title">@if(isset($user))
                                {{ __('admin-users.edituserTitle') }} @else
                                {{ __('admin-users.adduserTitle') }}
                            @endif</h3>
                    </div>
                    <form method="post"
                          action="@if(isset($user)){{route('update-user-process')}}@else{{route('add-new-user-process')}}@endif">
                        @csrf
                        <div class="card-body">
                            @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                            @endif
                            @if(isset($user))
                                <input type="hidden" name="id" value="{{$user->id}}">
                            @endif
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Name <code>*</code></label>
                                <div class="col-sm-4">
                                    <input required class="form-control @error('name') is-invalid @enderror" name="name"
                                           @if(old('name'))
                                           value="{{old('name')}}"
                                           @elseif(isset($user->name))
                                           value="{{$user->name}}"
                                           @endif>
                                    @error('name')
                                    <span class="invalid-feedback error" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">E-Mail <code>*</code></label>
                                <div class="col-sm-4">
                                    <input type="email" required
                                           @if(old('email'))
                                           value="{{old('email')}}"
                                           @elseif(isset($user->email))
                                           value="{{$user->email}}"
                                           @endif
                                           name="email"
                                           class="form-control @error('email') is-invalid @enderror">
                                    @error('email')
                                    <span class="invalid-feedback error" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-2 col-form-label">Passwort <code>*</code></label>
                                <div class="col-sm-4">
                                    <input type="password" @if(!isset($user)) required @endif name="password"
                                           class="form-control @error('password') is-invalid @enderror">
                                    @error('password')
                                    <span class="invalid-feedback error" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm float-right">
                                @if(isset($user))
                                    {{ __('admin-users.updateUserButton') }}
                                @else
                                    {{ __('admin-users.createUserButton') }}
                                @endif
                            </button>
                            <a href="{{url()->previous()}}"
                               class="btn btn-default btn-sm float-right filterButton" style="border-color: #ddd">
                                Abbrechen
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection