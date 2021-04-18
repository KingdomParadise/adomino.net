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
                        <h3 class="card-title">@if(isset($inquiry)) {{ __('admin-inquiry.editInquiryTitle') }} @else {{ __('admin-inquiry.newInquiryTitle') }} @endif </h3>
                    </div>
                    <form method="post"
                          action="@if(isset($inquiry)){{route('update-inquiry-process')}}@else{{route('add-new-inquiry-process')}}@endif">
                        @csrf
                        @if(isset($inquiry))
                            <input type="hidden" name="id" value="{{$inquiry->id}}">
                        @endif
                        <div class="card-body">
                            @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                            @endif
                            @if(session()->has('error'))
                                <div class="alert alert-warning">
                                    {{ session()->get('error') }}
                                </div>
                            @endif
                            <div class="form-group row">
                                <label for="name"
                                       class="col-sm-2 col-form-label">{{ __('admin-inquiry.inquiryCreatedInputField') }}
                                    <code>*</code></label>
                                <div class="col-sm-4">
                                    {{--<input type="text" class="form-control datetimepicker-input"--}}
                                    {{--id="dateTimePicker"--}}
                                    {{--data-toggle="datetimepicker" data-target="#dateTimePicker"--}}
                                    {{--@if(isset($inquiry))--}}
                                    {{--value="{{date('m.d.Y H:i',strtotime($inquiry->created_at))}}"--}}
                                    {{--@else value="{{date('m.d.Y H:i')}}" @endif--}}
                                    {{--name="created_at" required/>--}}
                                    {{--<input type="date" class="form-control">--}}
                                    <input type="text" id="datemask" class="form-control"
                                           @if(isset($inquiry))
                                           value="{{date('Y-m-d H:i',strtotime($inquiry->created_at))}}"
                                           @else value="{{date('Y-m-d H:i')}}" @endif
                                           name="created_at"
                                           data-inputmask-alias="datetime"
                                           data-inputmask-inputformat="yyyy-mm-dd HH:mm" data-mask></div>
                                <div class="col-sm-1 mt-1">
                                    <span>(MEZ)</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name"
                                       class="col-sm-2 col-form-label">{{ __('admin-inquiry.domainInputField') }} <code>*</code></label>
                                <div class="col-sm-4">
                                    <input  required
                                            oninvalid="this.setCustomValidity('Bitte geben Sie in das Feld etwas ein')"
                                            @if(old('domain'))
                                            value="{{old('domain')}}"
                                            @elseif(isset($inquiry->domain->domain))
                                            value="{{$inquiry->domain->domain}}"
                                            @endif
                                            name="domain"
                                            class="form-control @error('domain') is-invalid @enderror">
                                    {{--<input type="hidden" id="select2_id" name="domain_id"--}}
                                    {{--@if(old('domain_id'))--}}
                                    {{--value='{{old('domain_id')}}'--}}
                                    {{--@elseif(isset($inquiry->domain_id))--}}
                                    {{--value='{{$inquiry->domain_id}}'--}}
                                    {{--@endif>--}}
                                    {{--<input type="hidden" id="select2_text" name="domain_text"--}}
                                    {{--@if(old('domain_text'))--}}
                                    {{--value='{{old('domain_text')}}'--}}
                                    {{--@elseif(isset($inquiry->domain->domain))--}}
                                    {{--value='{{$inquiry->domain->domain}}'--}}
                                    {{--@endif>--}}
                                    {{--<select class="js-select2-ajax form-control @error('domain_id') is-invalid @enderror"--}}
                                    {{--required--}}
                                    {{--data-url="{{route('get-all-domains')}}"></select>--}}
                                    @error('domain')
                                    <span class="invalid-feedback error" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name"
                                       class="col-sm-2 col-form-label">{{ __('admin-inquiry.genderInputField') }} <code>*</code></label>
                                <div class="col-sm-4">
                                    <select name="gender" required
                                            class="form-control @error('gender') is-invalid @enderror">
                                        {{--<option value="" selected="selected" disabled="disabled">--}}
                                        {{--{{ __('admin-inquiry.genderSelectOptionField') }}--}}
                                        {{--</option>--}}
                                        <option @if(old('gender') && old('gender') == 'm')
                                                selected
                                                @elseif(isset($inquiry->gender) && 'm' == $inquiry->gender)
                                                selected
                                                @endif  value="m">
                                            {{ __('admin-inquiry.mrOptionField') }}
                                        </option>
                                        <option @if(old('gender') && old('gender') == 'f')
                                                selected
                                                @elseif(isset($inquiry->gender) && 'f' == $inquiry->gender)
                                                selected
                                                @endif value="f">
                                            {{ __('admin-inquiry.mrsOptionField') }}
                                        </option>
                                    </select>
                                    @error('gender')
                                    <span class="invalid-feedback error" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name"
                                       class="col-sm-2 col-form-label">{{ __('admin-inquiry.firstNameInputField') }}</label>
                                <div class="col-sm-4">
                                    <input
                                            @if(old('prename'))
                                            value="{{old('prename')}}"
                                            @elseif(isset($inquiry->prename))
                                            value="{{$inquiry->prename}}"
                                            @endif
                                            name="prename"
                                            class="form-control @error('prename') is-invalid @enderror">
                                    @error('prename')
                                    <span class="invalid-feedback error" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name"
                                       class="col-sm-2 col-form-label">{{ __('admin-inquiry.LastNameInputField') }}
                                    <code>*</code></label>
                                <div class="col-sm-4">
                                    <input required
                                           oninvalid="this.setCustomValidity('Bitte geben Sie in das Feld etwas ein')"
                                           @if(old('surname'))
                                           value="{{old('surname')}}"
                                           @elseif(isset($inquiry->surname))
                                           value="{{$inquiry->surname}}"
                                           @endif
                                           name="surname"
                                           class="form-control @error('surname') is-invalid @enderror">
                                    @error('surname')
                                    <span class="invalid-feedback error" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name"
                                       class="col-sm-2 col-form-label">{{ __('admin-inquiry.websiteLanguageInputField') }}
                                    <code>*</code></label>
                                <div class="col-sm-4">
                                    <select class="form-control @error('website_language') is-invalid @enderror"
                                            required name="website_language">
                                        <option value="de"
                                                @if(old('website_language') && old('website_language') == 'de') selected
                                                @elseif(isset($inquiry->website_language) && $inquiry->website_language == 'de') selected @endif>
                                            Deutsch
                                        </option>
                                        <option value="en"
                                                @if(old('website_language') && old('website_language') == 'en"') selected
                                                @elseif(isset($inquiry->website_language) && $inquiry->website_language == 'en') selected @endif>
                                            Englisch
                                        </option>
                                    </select>
                                    @error('website_language')
                                    <span class="invalid-feedback error" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name"
                                       class="col-sm-2 col-form-label">{{ __('admin-inquiry.browserLanguageInputField') }}</label>
                                <div class="col-sm-4">
                                    <input
                                            @if(old('browser_language'))
                                            value="{{old('browser_language')}}"
                                            @elseif(isset($inquiry->browser_language))
                                            value="{{$inquiry->browser_language}}"
                                            @endif
                                            name="browser_language"
                                            class="form-control @error('browser_language') is-invalid @enderror">
                                    @error('browser_language')
                                    <span class="invalid-feedback error" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name"
                                       class="col-sm-2 col-form-label">{{ __('admin-inquiry.emailInputField') }}
                                    <code>*</code></label>
                                <div class="col-sm-4">
                                    <input required
                                           oninvalid="this.setCustomValidity('Bitte geben Sie in das Feld etwas ein')"
                                           @if(old('email'))
                                           value="{{old('email')}}"
                                           @elseif(isset($inquiry->email))
                                           value="{{$inquiry->email}}"
                                           @endif
                                           name="email"
                                           type="email"
                                           class="form-control @error('email') is-invalid @enderror">
                                    @error('email')
                                    <span class="invalid-feedback error" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name"
                                       class="col-sm-2 col-form-label">{{ __('admin-inquiry.ipInputField') }}</label>
                                <div class="col-sm-4">
                                    <input
                                            @if(old('ip'))
                                            value="{{old('ip')}}"
                                            @elseif(isset($inquiry->ip))
                                            value="{{$inquiry->ip}}"
                                            @endif
                                            name="ip"
                                            class="form-control @error('ip') is-invalid @enderror">
                                    @error('ip')
                                    <span class="invalid-feedback error" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm float-right">
                                @if(isset($inquiry)) {{ __('admin-inquiry.updateInquiryButton') }} @else {{ __('admin-inquiry.createNewInquiryButton') }}@endif
                            </button>
                            <a href="{{route('inquiry')}}" type="submit"
                               class="btn btn-secondary btn-sm float-right filterButton">
                                Abbrechen
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection