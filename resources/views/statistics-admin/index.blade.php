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
                        <h3 class="card-title">{{ __('admin-statistics.title') }}</h3>
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
                                    <input type="text" class="form-control"
                                           @if(isset($_REQUEST['search']) && !empty(trim($_REQUEST['search'])))
                                           value="{{trim($_REQUEST['search'])}}"
                                           @endif id="yajraSearch"
                                           placeholder="Suche">
                                    {{--<span class="input-group-append">--}}
                                    {{--<button type="button" class="btn btn-primary yajraBtnSearch">Suchen</button>--}}
                                    {{--</span>--}}
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="number" class="form-control"
                                           @if(isset($_REQUEST['no_of_days']) && !empty(trim($_REQUEST['no_of_days'])))
                                           value="{{trim($_REQUEST['no_of_days'])}}"
                                           @endif placeholder="Nein des Tages" name="no_of_days" min="1">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-primary" id="filterStatisticsButton">Suchen
                                </button>
                            </div>
                            <div class="col-md-5">
                                {{--<button data-href="{{route('get-filter-statistics-modal')}}"--}}
                                {{--data-id=""--}}
                                {{--data-name="get-filter-statistics-modal"--}}
                                {{--class="btn btn-default float-right OpenModal"><i--}}
                                {{--class="fa fa-filter"></i>--}}
                                {{--</button>--}}
                            </div>
                        </div>
                        <table class="table table-striped table-bordered data_table_yajra"
                               data-url="{{route('get-all-statistics-json')}}"
                               data-length="{{(isset($_REQUEST['per_page']) && !empty($_REQUEST['per_page']))?$_REQUEST['per_page']:$page_length}}"
                               data-custom-order="0"
                               data-filter='@if(isset($_REQUEST['no_of_days'])){"no_of_days":{{$_REQUEST['no_of_days']}}}@endif'
                               data-custom-sort-type="asc"
                               data-table-name="statistics-table"
                               style="width:100%;display: none">
                            <thead>
                            <tr>
                                @foreach($columns as $column_key=>$column_val)
                                    <th data-column="{{$column_key}}"
                                        @if(isset($column_val['width']))
                                        data-width="{{$column_val['width']}}"
                                        @endif
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