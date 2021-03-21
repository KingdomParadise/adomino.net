@extends('layouts.base')

@section('content')
    @include('static.' . LaravelLocalization::getCurrentLocale() . '.imprint')
@endsection
