@extends('layouts.base')

@section('bodyClass', 'bg-white')

@section('content')
    @include('static.' . LaravelLocalization::getCurrentLocale() . '.home')
@endsection
