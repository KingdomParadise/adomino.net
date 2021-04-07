@extends('layouts.modal-layout')
@section('content')
    <form action="{{route('delete-not-found-domain-process')}}" method="post">
        @csrf
        <div class="modal-body">
            <p>{{ __('admin-nfdomain.domainDeleteConfirmationMessage') }}</p>
            <input type="hidden" name="id" value="{{$id}}">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default btn-sm"
                    data-dismiss="modal">{{ __('admin-nfdomain.no') }}</button>
            <button type="submit" class="btn btn-danger btn-sm">
                {{ __('admin-nfdomain.deleteButton') }}
            </button>
        </div>
    </form>
@endsection
