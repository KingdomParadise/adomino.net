<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('app.name')}}</title>

        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/favicon.ico') }}">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body class="@yield('bodyClass')">

        <nav class="px-5 navbar flex-column flex-sm-row justify-content-center justify-content-sm-between">
            @if(Cookie::get('domain_hash'))
                <a href="{{route('landingpage.domain', [ 'hash' => Cookie::get('domain_hash')], false )}}" class="text-decoration-none">
            @else
                <a href="{{config('app.url')}}" class="text-decoration-none">
            @endif
                <img src="{{asset('img/logo.png')}}" class="img-fluid" alt="{{config('app.name')}} Logo" width="200" />
                <div class="text-dark site-slogan">{{__('messages.site_slogan')}}</div>
            </a>
            @if (Route::currentRouteName() !== 'landingpage.send')
                <div class="dropdown mt-2 mt-sm-0">
                    <button class="btn dropdown-toggle" type="button" id="language" data-toggle="dropdown" aria-expanded="false">
                        <img src="/img/{{LaravelLocalization::getCurrentLocale()}}.png" alt="Flag" width="25">
                        <strong>{{__('messages.' . LaravelLocalization::getCurrentLocale())}}</strong>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="language">
                        <a class="dropdown-item" href="{{ LaravelLocalization::getLocalizedURL('de') }}">
                            <img src="/img/de.png" alt="Flag" width="20">
                            {{__('messages.de')}}
                        </a>
                        <a class="dropdown-item" href="{{ LaravelLocalization::getLocalizedURL('en') }}">
                            <img src="/img/en.png" alt="Flag" width="20">
                            {{__('messages.en')}}
                        </a>
                    </div>
                </div>
            @endif
        </nav>
        <div class="subheader">
            @foreach ($logos as $logo)
                @if ($logo->active)
                    <div class="text-center" data-toggle="tooltip" data-sort="{{$logo->sort}}" data-placement="top" title="{{$logo->purchased_domain}}">
                        <img src="{{Storage::disk('public')->url($logo->logo)}}" class="img-fluid d-inline-block" alt="{{$logo->purchased_domain}}" width="80" height="40"/>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="container-sm py-5 mt-3">
            @yield('content')
        </div>

        <footer class="footer px-5 text-white">
            <div class="col-md">
                {!! __('messages.copyright') !!}
            </div>
            <div class="col-auto">
                <a class="text-light" href="#cookieSettings">{{__('messages.cookie_settings')}}</a>
                <a class="ml-2 text-light" href="{{route('static.dataprivacy')}}">{{__('messages.data_privacy')}}</a>
                <a class="ml-2 text-light" href="{{route('static.imagelicences')}}">{{__('messages.image_licences')}}</a>
                <a class="ml-2 text-light" href="{{route('static.imprint')}}">{{__('messages.imprint')}}</a>
            </div>
        </footer>

        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
        @include('common.cookie')
        @stack('scripts')
        <script>
            $(document).ready(function(){
                $('.subheader').slick({
                    autoplay: true,
                    infinite: true,
                    slidesToShow: 13,
                    responsive: [
                        {
                            breakpoint: 1200,
                            settings: {
                                slidesToShow: 8,
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 6,
                            }
                        },
                        {
                            breakpoint: 576,
                            settings: {
                                slidesToShow: 4,
                            }
                        }
                    ]
                });
            });

            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            });
        </script>
    </body>
</html>
