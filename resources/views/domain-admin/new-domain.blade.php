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
                        <h3 class="card-title">@if(isset($domain))
                                {{ __('admin-domain.editdomainTitle') }} @else
                                {{ __('admin-domain.adddomainTitle') }}
                            @endif</h3>
                        <a href="{{route('domain')}}" class="btn btn-primary float-right btn-sm"><i
                                    class="fa fa-reply"></i>&nbsp;&nbsp;{{ __('admin-domain.backButton') }}</a>
                    </div>
                    <form method="post"
                          action="@if(isset($domain)){{route('update-domain-process')}}@else{{route('add-new-domain-process')}}@endif">
                        @csrf
                        <div class="card-body">
                            @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                            @endif
                            @if(isset($domain))
                                <input type="hidden" name="id" value="{{$domain->id}}">
                            @endif
                            <div class="form-group row">
                                <label for="{{ __('admin-domain.createNewDomainInput') }}"
                                       class="col-sm-2 col-form-label">{{ __('admin-domain.createNewDomainInput') }}
                                    <code>*</code></label>
                                <div class="col-sm-6">
                                    <input required class="form-control @error('domain') is-invalid @enderror"
                                           data-value="{{$domain->domain}}"
                                           name="domain"
                                           @if(old('domain'))
                                           value="{{old('domain')}}"
                                           @elseif(isset($domain->domain))
                                           value="{{$domain->domain}}"
                                           @endif
                                           placeholder="{{ __('admin-domain.createNewDomainInput') }}">
                                    @error('domain')
                                    <span class="invalid-feedback error" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="{{ __('admin-domain.createNewDomainTitleInput') }}"
                                       class="col-sm-2 col-form-label">{{ __('admin-domain.createNewDomainTitleInput') }}</label>
                                <div class="col-sm-6">
                                    <input class="form-control @error('title') is-invalid @enderror"
                                           name="title"
                                           @if(old('title'))
                                           value="{{old('title')}}"
                                           @elseif(isset($domain->title))
                                           value="{{$domain->title}}"
                                           @endif
                                           placeholder="{{ __('admin-domain.createNewDomainTitleInput') }}">
                                    @error('title')
                                    <span class="invalid-feedback error" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="{{ __('admin-domain.createNewDomainAdominoComIdInput') }}"
                                       class="col-sm-2 col-form-label">{{ __('admin-domain.createNewDomainAdominoComIdInput') }}</label>
                                <div class="col-sm-6">
                                    <input class="form-control @error('adomino_com_id') is-invalid @enderror"
                                           name="adomino_com_id"
                                           @if(old('adomino_com_id'))
                                           value="{{old('adomino_com_id')}}"
                                           @elseif(isset($domain->adomino_com_id))
                                           value="{{$domain->adomino_com_id}}"
                                           @endif
                                           placeholder="{{ __('admin-domain.createNewDomainAdominoComIdInput') }}">
                                    @error('adomino_com_id')
                                    <span class="invalid-feedback error" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="{{ __('admin-domain.createNewDomainLandingPageModeInput') }}"
                                       class="col-sm-2 col-form-label">{{ __('admin-domain.createNewDomainLandingPageModeInput') }}</label>
                                <div class="col-sm-6">
                                    <select class="form-control @error('landingpage_mode') is-invalid @enderror"
                                            name="landingpage_mode">
                                        <option disabled=""
                                                value="">{{ __('admin-domain.createNewDomainSelectLandingPageModeInput') }}</option>
                                        @foreach($landingpage_mode as $key=>$landingMode)
                                            <option @if(old('landingpage_mode') && old('landingpage_mode') == $key)
                                                    selected
                                                    @elseif(isset($domain->landingpage_mode) && $key == $domain->landingpage_mode)
                                                    selected
                                                    @elseif($key == 'request_offer')
                                                    selected
                                                    @endif value="{{$key}}">{{$landingMode}}</option>
                                        @endforeach
                                    </select>
                                    @error('landingpage_mode')
                                    <span class="invalid-feedback error" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="{{ __('admin-domain.createNewDomainInfoInput') }}"
                                       class="col-sm-2 col-form-label">{{ __('admin-domain.createNewDomainInfoInput') }}</label>
                                <div class="col-sm-6">
                                    <textarea name="info"
                                              placeholder="{{ __('admin-domain.createNewDomainInfoInput') }}"
                                              class="form-control @error('info') is-invalid @enderror">@if(old('info')){{old('info')}}@elseif(isset($domain->info)){{$domain->info}}@endif</textarea>
                                    @error('info')
                                    <span class="invalid-feedback error" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{--<div class="form-group row">--}}
                                {{--<label for="{{ __('admin-domain.createNewDomainInfoEnInput') }}"--}}
                                       {{--class="col-sm-2 col-form-label">{{ __('admin-domain.createNewDomainInfoEnInput') }}</label>--}}
                                {{--<div class="col-sm-6">--}}
                                    {{--<textarea name="info_en"--}}
                                              {{--placeholder="{{ __('admin-domain.createNewDomainInfoEnInput') }}"--}}
                                              {{--class="form-control @error('info_en') is-invalid @enderror">@if(old('info_en')){{old('info_en')}}@elseif(isset($domain->info_en)){{$domain->info_en}}@endif</textarea>--}}
                                    {{--@error('info_en')--}}
                                    {{--<span class="invalid-feedback error" role="alert">--}}
                                            {{--<strong>{{ $message }}</strong>--}}
                                        {{--</span>--}}
                                    {{--@enderror--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            <div class="form-group row">
                                <label for="{{ __('admin-domain.createNewDomainBrandableInput') }}"
                                       class="col-sm-2 col-form-label">{{ __('admin-domain.createNewDomainBrandableInput') }}</label>
                                <div class="col-sm-6">
                                    <input type="checkbox" name="brandable"
                                           @if(old('brandable'))
                                           checked
                                           @elseif(isset($domain->brandable) && $domain->brandable)
                                           checked
                                            @endif>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm float-right">
                                    @if(isset($domain))
                                        {{ __('admin-domain.updateDomainButton') }}
                                    @else
                                        {{ __('admin-domain.createDomainButton') }}
                                    @endif
                                </button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection