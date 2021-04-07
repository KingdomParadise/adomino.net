@extends('layouts.modal-layout')
@section('content')
    <form id="filterStatisticsForm" method="post">
        <div class="modal-body">
            <div class="form-group row">
                <label>Filtern nach Datumsbereich</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control float-right" id="dateRangePicker">
                </div>
            </div>
            <div class="form-group row">
                <label>Pro Seite</label>
                <select class="form-control" name="per_page">
                    <option>10</option>
                    <option>25</option>
                    <option>50</option>
                    <option>100</option>
                    <option value="-1">All</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default btn-sm"
                    data-dismiss="modal">{{ __('admin-statistics.no') }}</button>
            <button type="button" class="btn btn-primary btn-sm"
                    id="filterStatisticsButton">
                {{ __('admin-statistics.filterStatisticsButton') }}
            </button>
        </div>
    </form>
@endsection
