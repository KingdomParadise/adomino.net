@extends('layouts.base')

@section('content')
    @include('static.' . LaravelLocalization::getCurrentLocale() . '.data_privacy')
@endsection
