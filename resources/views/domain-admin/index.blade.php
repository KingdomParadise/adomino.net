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
                                    <input type="text" class="form-control"
                                           @if(isset($_REQUEST['search_params']))value="{{$_REQUEST['search_params']}}"
                                           @endif id="yajraSearch" placeholder="Suche">
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
                        <input type="hidden" name="info_de"
                               @if(isset($_REQUEST['info_de']))value="{{$_REQUEST['info_de']}}"@endif>
                        <input type="hidden" name="info_en"
                               @if(isset($_REQUEST['info_en']))value="{{$_REQUEST['info_en']}}"@endif>
                        <input type="hidden" name="title"
                               @if(isset($_REQUEST['title']))value="{{$_REQUEST['title']}}"@endif>
                        <input type="hidden" name="is_deleted"
                               @if(isset($_REQUEST['is_deleted']))value="{{$_REQUEST['is_deleted']}}"@endif>
                        @if(isset($domains))
                            <table class="table table-striped table-bordered data_table_yajra_manual"
                                   style="width:100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Info</th>
                                    <th>Domain</th>
                                    <th>Titel</th>
                                    <th>Landingpage-Modus</th>
                                    <th>Brandable</th>
                                    <th class="no-sort">Aktion</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($domains as $domain)
                                    <tr>
                                        <td style="text-align: right">{{ $loop->index+1 }}</td>
                                        <td style="text-align: right">{{$domain->adomino_com_id}}</td>
                                        <td>
                                            @php($info="")
                                            @if (!empty($domain->getTranslation('info', 'de')))
                                                @php($info.="d")
                                            @endif
                                            @if (!empty($domain->getTranslation('info', 'en')))
                                                @php($info.="e")
                                            @endif
                                            {{$info}}
                                        </td>
                                        <td>{{$domain->domain}}</td>
                                        <td>{{$domain->title}}</td>
                                        <td>{{\App\Domain::getLandingPageMode()[$domain->landingpage_mode]}}</td>
                                        <td>
                                            @if($domain->brandable)
                                                <i class="fa fa-check-circle"
                                                   style="font-size: 20px;color: #0cbb0cb3;"></i>
                                            @else
                                                <i class="fa fa-times-circle"
                                                   style="font-size: 20px;color: #ff0000b5;"></i>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('edit-domain', [$domain->id])}}"
                                               style="cursor: pointer;color: black"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                            <label data-href="{{route('get-delete-domain-modal')}}"
                                                   data-id="{{$domain->id}}"
                                                   data-name="get-delete-inquiry-modal" style="cursor: pointer"
                                                   class="OpenModal"><i class="fa fa-trash"></i></label>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                        {{--<table class="table table-striped table-bordered data_table_yajra"--}}
                        {{--data-url="{{route('get-all-domains-json')}}"--}}
                        {{--data-length="{{(isset($_REQUEST['per_page']) && !empty($_REQUEST['per_page']))?$_REQUEST['per_page']:$page_length}}"--}}
                        {{--data-table-name="domain-table"--}}
                        {{--style="display:none;width:100%">--}}
                        {{--<thead>--}}
                        {{--<tr>--}}
                        {{--@foreach($columns as $column_key=>$column_val)--}}
                        {{--<th data-column="{{$column_key}}"--}}
                        {{--data-sort="{{$column_val['sort']}}">{!! $column_val['name'] !!}</th>--}}
                        {{--@endforeach--}}
                        {{--</tr>--}}
                        {{--</thead>--}}
                        {{--<tbody>--}}
                        {{--</tbody>--}}
                        {{--</table>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection