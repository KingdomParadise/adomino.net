@extends('layouts.base')

@section('content')

<div class="row">
    @if ($domain->landingpage_mode && $domain->landingpage_mode == 'review')
        <h2 class="col font-weight-light text-center">
            {{ __('messages.lp_headline_top') }} {{ $domain->title ?? $domain->domain }} {{ __('messages.lp_headline_bottom_review') }}
        </h2>
    @elseif ($domain->landingpage_mode && $domain->landingpage_mode == 'sold')
        <h2 class="col font-weight-light text-center">
            {{ __('messages.lp_headline_top') }} {{ $domain->title ?? $domain->domain }} {{ __('messages.lp_headline_bottom_sold') }}
        </h2>
    @else
        <div class="col-md-6 px-4 pb-4">
            <h2 class="font-weight-light lp-first-headline">{{ __('messages.lp_headline_top') }}</h2>
            <h2 class="text-warning font-weight-bold line-break-anyware">{{ $domain->title ?? $domain->domain }}</h2>
            <h2 class="font-weight-light">{{ __('messages.lp_headline_bottom') }}</h2>

            <p class="lp-first-p">{!! __('messages.lp_instruction_1') !!}</p>
            @if ($domain->info)
                <p class="lp-first-p">{{$domain->info}}</p>
            @endif
            <p class="lp-first-p">{!! __('messages.lp_instruction_2') !!}</p>
        </div>
    @endif

    @if ($domain->landingpage_mode && $domain->landingpage_mode == 'request_offer')
        <div class="col-md-6 col-lg-5 offset-lg-1 col-xl-4 offset-xl-2">
            <div class="card">
                <div class="card-body">
                    {!! Form::open(['route' => 'landingpage.send']) !!}
                        {!! Form::hidden('domain', $domain->domain) !!}

                        <div class="row">
                            <div class="form-group col-6">
                                {!! Form::select('gender', ['m' => __('messages.mr'), 'f' => __('messages.ms')], null, ['placeholder' => '-', 'class' => 'form-control w-auto' . ($errors->has('gender') ? ' is-invalid' : '')]) !!}
                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::text('prename', null, ['placeholder' => __('messages.prename'), 'class' => 'form-control' . ($errors->has('prename') ? ' is-invalid' : '')]) !!}
                            @error('prename')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            {!! Form::text('surname', null, ['placeholder' => __('messages.surname'), 'class' => 'form-control' . ($errors->has('surname') ? ' is-invalid' : '')]) !!}
                            @error('surname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            {!! Form::email('email', null, ['placeholder' => __('messages.email'), 'class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : '')]) !!}
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="g-recaptcha {{ $errors->has('g-recaptcha-response') ? 'is-invalid' : '' }}" data-sitekey="{{config('recaptcha.api_site_key')}}"></div>
                            @error('g-recaptcha-response')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button class="btn btn-primary btn-block mt-2 font-weight-bold" type="submit">{{ __('messages.request_offer_button') }}</button>

                        <div class="text-center">
                            <img src="{{asset('img/ssl-logo2.jpeg')}}" class="img-fluid mt-3 mr-5" width="100" />
                            @if (App::isLocale('de'))
                                <img src="{{asset('img/dsgvo.jpeg')}}" class="img-fluid mt-3" height="36" />
                            @else
                                <img src="{{asset('img/gdpr.jpeg')}}" class="img-fluid mt-3" height="36" />
                            @endif
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>


            <div class="px-4 pt-3 text-center line-sm">
                <small class="text-muted">{!! __('messages.gdpr_hint') !!}</small>
            </div>

        </div>
    @endif
</div>

@endsection

@push('scripts')
    @include('common.recaptcha')
@endpush
