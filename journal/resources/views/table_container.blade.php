@extends('layouts.app')
@section('title')
    Временные показатели
@endsection

@section('content')
{{--    <div id="date_div">--}}
{{--        <input type="date" id="table_date" required onkeydown="return false">--}}
{{--        <label for="table_date" id="table_date_label">Дата</label>--}}
{{--    </div>--}}

    @include('include.choice_date')
    <div id="content-header"></div>
    @include('include.infoTable.info_table')

@endsection
