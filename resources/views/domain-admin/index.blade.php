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
                        <h3 class="card-title">{{ __('admin-domain.title') }}</h3>
                        <a href="{{route('add-new-domain')}}" class="btn btn-primary float-right btn-sm">
                            {{ __('admin-domain.addNewDomainButton') }}</a>
                    </div>
                    <div class="card-body">
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group has-search input-group">
                                    <span class="fa fa-search form-control-feedback"></span>
                                    <input type="text" class="form-control" id="yajraSearch" placeholder="Suche">
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-primary yajraBtnSearch">Suchen</button>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <button data-href="{{route('get-filter-domain-modal')}}"
                                        data-id=""
                                        data-name="get-filter-domain-modal"
                                        class="btn btn-default float-right OpenModal"><i
                                            class="fa fa-filter"></i>
                                </button>
                                <label data-href="{{route('get-delete-domain-modal')}}"
                                       data-id=""
                                       data-name="get-multi-option-modal" style="cursor: pointer"
                                       class="btn btn-default float-right invisible filterButton OpenModal">
                                    <i class="fa fa-trash"></i></label>
                            </div>
                        </div>
                        <input type="hidden" name="info_de" value="">
                        <input type="hidden" name="info_en" value="">
                        <input type="hidden" name="title" value="">
                        <input type="hidden" name="is_deleted" value="">

                        <table class="table table-striped table-bordered data_table_yajra"
                               data-url="{{route('get-all-domains-json')}}"
                               data-length="{{(isset($_REQUEST['per_page']) && !empty($_REQUEST['per_page']))?$_REQUEST['per_page']:$page_length}}"
                               data-table-name="domain-table"
                               style="display:none;width:100%">
                            <thead>
                            <tr>
                                @foreach($columns as $column_key=>$column_val)
                                    <th data-column="{{$column_key}}"
                                        data-sort="{{$column_val['sort']}}">{!! $column_val['name'] !!}</th>
                                @endforeach
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection