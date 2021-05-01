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
                        <div class="row col-md-12">
                            <span id="selectedInfoSpan"
                                  style="margin-top: -10px; margin-bottom: 10px; font-size: 12px;"></span>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group has-search input-group" style="margin-bottom: 5px;">
                                    <span class="fa fa-search form-control-feedback"></span>
                                    <input type="text" class="form-control"
                                           @if(isset($_REQUEST['search']) && !empty(trim($_REQUEST['search'])))
                                           value="{{trim($_REQUEST['search'])}}"
                                           @endif id="yajraSearch"
                                           placeholder="Suchen">
                                    <!-- <button type="button" class="btn btn-primary" id="filterStatisticsButton">Suchen
                                	</button> -->
                                    <span class="input-group-append">
                                    	<button type="button" class="btn btn-primary"
                                                id="filterStatisticsButton">Suchen</button>
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <button data-href="{{route('get-filter-statistics-modal')}}"
                                        data-id=""
                                        data-name="get-filter-statistics-modal"
                                        class="btn btn-default float-right OpenModal">
                                    <i class="fa fa-filter"></i>
                                </button>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 5px;">
                            <div class="col-md-1">
                                <div class="form-group" style="padding-right: 35px; margin-bottom: 0px;">
                                    <input type="text" class="form-control"
                                           @if(isset($_REQUEST['no_of_days']) && !empty(trim($_REQUEST['no_of_days'])))
                                           value="{{trim($_REQUEST['no_of_days'])}}"
                                           @endif placeholder="10" name="no_of_days" min="1" max="10">
                                </div>
                            </div>
                            <div class="col-md-1" style="padding-left: 0px; margin-top: 6px; margin-left: -40px;">
                                <p style="font-size: 10px; margin-bottom:10px; margin-top:6px;">Tage</p>
                            </div>
                        </div>
                        {{--<table class="table table-striped table-bordered data_table_yajra"--}}
                        {{--data-url="{{route('get-all-statistics-json')}}"--}}
                        {{--data-length="{{(isset($_REQUEST['per_page']) && !empty($_REQUEST['per_page']))?$_REQUEST['per_page']:$page_length}}"--}}
                        {{--data-custom-order="0"--}}
                        {{--data-filter='@if(isset($_REQUEST['no_of_days'])){"no_of_days":{{$_REQUEST['no_of_days']}}}@endif'--}}
                        {{--data-custom-sort-type="asc"--}}
                        {{--data-table-name="statistics-table"--}}
                        {{--style="width:100%;display: none">--}}
                        {{--<thead>--}}
                        {{--<tr>--}}
                        {{--@foreach($columns as $column_key=>$column_val)--}}
                        {{--<th data-column="{{$column_key}}"--}}
                        {{--@if(isset($column_val['width']))--}}
                        {{--data-width="{{$column_val['width']}}"--}}
                        {{--@endif--}}
                        {{--@if($column_val['name']=='Domain')--}}
                        {{--style="text-align: left; !important" --}}
                        {{--@endif--}}
                        {{--data-sort="{{$column_val['sort']}}"--}}
                        {{--style="text-align: right">{!! $column_val['name'] !!}</th>--}}
                        {{--@endforeach--}}
                        {{--</tr>--}}
                        {{--</thead>--}}
                        {{--<tbody>--}}
                        {{--</tbody>--}}
                        {{--</table>--}}
                        <div id="statisticLoader" style="display: none">
                            <center><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></center>
                        </div>
                        @if(isset($datas) && !empty($datas))
                            <style>
                                .wrapper {
                                    width: min-content;
                                    min-width: 100%;
                                }

                            </style>
                        @endif
                        <table class="table table-striped table-bordered data_table_yajra_manual"
                               data-total-count="<?=$total_count?>"
                               {{--data-url="{{route('get-all-statistics-json')}}"--}}
                               {{--data-length="{{(isset($_REQUEST['per_page']) && !empty($_REQUEST['per_page']))?$_REQUEST['per_page']:$page_length}}"--}}
                               data-custom-order="1"
                               {{--data-filter='@if(isset($_REQUEST['no_of_days'])){"no_of_days":{{$_REQUEST['no_of_days']}}}@endif'--}}
                               data-custom-sort-type="asc"
                               data-table-name="statistics-table"
                               @if(isset($_REQUEST['from_date']) && !empty($_REQUEST['from_date']) && (bool)strtotime($_REQUEST['from_date']))
                               data-from-date="{{$_REQUEST['from_date']}}"
                               @endif
                               data-summen="{{json_encode($summary_table_columns)}}"
                               style="width:100%;@if(!isset($_REQUEST['no_of_days'])) display: none @endif">
                            <thead>
                            <tr>
                                @foreach($columns as $column_key=>$column_val)
                                    <th data-column="{{$column_key}}"
                                        {{--@if(isset($column_val['width']))--}}
                                        {{--data-width="{{$column_val['width']}}"--}}
                                        {{--@endif--}}
                                        @if($column_val['name']=='Domain')
                                        style="text-align: left; !important; @if(isset($column_val['width'])) width: {{$column_val['width']}} @endif"
                                        @else
                                        style="text-align: right;padding-right: 8px; @if(isset($column_val['width'])) width: {{$column_val['width']}} @endif"
                                        @endif
                                        data-sort="{{$column_val['sort']}}"
                                        @if(!$column_val['sort']) class="no-sort" @endif
                                    >{!! $column_val['name'] !!}</th>
                                @endforeach
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($datas as $statistic)
                                <tr>
                                    <td><p style="text-align: right;margin: 0px">{{($loop->index+1)}}</p></td>
                                    <td><p style="text-align: right;margin: 0px">{{$statistic->adominId}}</p></td>
                                    <td>{!! \App\Domain::displayDomain($statistic->domain_name, $statistic->domain_id) !!}</td>
                                    <td>
                                        <p style="text-align: right;margin: 0px">
                                            @php
                                                try {
                                                $statisticDetails = \App\statistic::getStatisticCount($table_columns, $start_date, $end_date, $statistic);
                                                echo number_format(($statisticDetails[1] / $statisticDetails[0]), 1, '.', ',') ;
                                                } catch (\Exception $exception) {
                                                echo 0;
                                                }
                                            @endphp
                                        </p>
                                    </td>
                                    <td>
                                        <p style="text-align: right;margin: 0px; font-weight: 700;">
                                            @php
                                                $statisticDetails = \App\statistic::getStatisticCount($table_columns, $start_date, $end_date, $statistic);
                                                echo $statisticDetails[1];
                                            @endphp
                                        </p>
                                    </td>
                                    @php
                                        foreach ($custom_columns as $custom_column) {
                                            echo '<td><p style="text-align: right;margin: 0px">' . $statistic->$custom_column . '</p></td>';
                                        }
                                    @endphp
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection