@extends('layouts.modal-layout')
@section('content')
    <form id="filterStatisticsForm" onsubmit="return false;" method="post">
        <div class="modal-body">
            {{--<div class="form-group row">--}}
                {{--<label>Nein des Tages</label>--}}
                {{--<input type="number" class="form-control" name="no_of_days" min="1">--}}
            {{--</div>--}}
            <div class="form-group row">
                <label>Filtern nach Datumsbereich</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control singleDatePicker">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                    </div>
                </div>
            </div>
            {{--<div class="form-group row">--}}
            {{--<label>Filtern nach Datumsbereich</label>--}}
            {{--<div class="input-group">--}}
            {{--<div class="input-group-prepend">--}}
            {{--<span class="input-group-text">--}}
            {{--<i class="far fa-calendar-alt"></i>--}}
            {{--</span>--}}
            {{--</div>--}}
            {{--<input type="text" class="form-control float-right" id="dateRangePicker">--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<div class="form-group row">--}}
            {{--<label>Pro Seite</label>--}}
            {{--<select class="form-control" name="per_page">--}}
            {{--<option>10</option>--}}
            {{--<option>25</option>--}}
            {{--<option>50</option>--}}
            {{--<option>100</option>--}}
            {{--<option value="-1">All</option>--}}
            {{--</select>--}}
            {{--</div>--}}
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default btn-sm"
                    data-dismiss="modal">Abbrechen
            </button>
            <button type="button" class="btn btn-primary btn-sm"
                    id="filterStatisticsButton">
                Anwenden
            </button>
        </div>
    </form>
@endsection
