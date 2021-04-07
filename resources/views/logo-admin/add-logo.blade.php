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
                        <h3 class="card-title">@if(isset($logo))
                                {{ __('admin-logo.editLogoTitle') }} @else
                                {{ __('admin-logo.addLogoTitle') }}
                            @endif</h3>
                        <a href="{{route('logo')}}" class="btn btn-primary float-right btn-sm"><i
                                    class="fa fa-reply"></i>&nbsp;&nbsp;{{ __('admin-logo.backButton') }}</a>
                    </div>
                    <form method="post"
                          enctype="multipart/form-data"
                          action="@if(isset($logo)){{route('update-logo-process')}}@else{{route('add-new-logo-process')}}@endif">
                        @csrf
                        <div class="card-body">
                            @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                            @endif
                            @if(isset($logo))
                                <input type="hidden" name="id" value="{{$logo->id}}">
                            @endif
                            <div class="form-group row">
                                <label for="{{ __('admin-logo.createNewLogoActiveInput') }}"
                                       class="col-sm-2 col-form-label">{{ __('admin-logo.createNewLogoActiveInput') }}</label>
                                <div class="col-sm-6">
                                    <input type="checkbox" name="active"
                                           @if(old('active'))
                                           checked
                                           @elseif(isset($logo->active) && $logo->active =='1')
                                           checked
                                            @endif/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="{{ __('admin-logo.createNewLogoInput') }}"
                                       class="col-sm-2 col-form-label">{{ __('admin-logo.createNewLogoInput') }}</label>
                                <div class="col-sm-6">
                                    <input type="file" id="logoFile" accept="image/*"
                                           class="form-control invisible @error('logo') is-invalid @enderror"
                                           name="logo"/>
                                    <div style="margin-top: -40px;">
                                        @if(isset($logo->logo) && !empty($logo->logo))
                                            <div id="preview_logo">
                                                <div class="card relative card relative border border-lg border-50 overflow-hidden px-0 py-0"
                                                     style="max-width: 80px;">
                                                    <img src="{{Storage::url($logo->logo)}}"
                                                         class="block w-full">
                                                </div>
                                                <div style="margin-bottom: 10px;cursor: pointer;" id="deleteLogoButton">
                                                    <i class="fa fa-trash"></i>&nbsp;
                                                    &nbsp;{{ __('admin-logo.deleteLogoButton') }}
                                                </div>
                                                <input type="hidden" name="logo_input" value="{{$logo->logo}}">
                                            </div>
                                        @endif
                                        <button type="button"
                                                class="btn btn-primary btn-sm chooseFileButton">{{ __('admin-logo.chooseFileButton') }}</button>
                                        &nbsp;&nbsp;&nbsp;<span id="file_name">No file selected</span>
                                    </div>
                                    @error('logo')
                                    <span class="invalid-feedback error" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="{{ __('admin-logo.createNewLogoPurchasedDomainInput') }}"
                                       class="col-sm-2 col-form-label">{{ __('admin-logo.createNewLogoPurchasedDomainInput') }}</label>
                                <div class="col-sm-6">
                                    <input class="form-control @error('domain') is-invalid @enderror"
                                           name="domain"
                                           @if(old('domain'))
                                           value="{{old('domain')}}"
                                           @elseif(isset($logo->purchased_domain))
                                           value="{{$logo->purchased_domain}}"
                                           @endif
                                           placeholder="{{ __('admin-logo.createNewLogoPurchasedDomainInput') }}"/>
                                    @error('domain')
                                    <span class="invalid-feedback error" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm float-right">
                                    @if(isset($domain))
                                        {{ __('admin-logo.updateLogoButton') }}
                                    @else
                                        {{ __('admin-logo.createLogoButton') }}
                                    @endif
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection