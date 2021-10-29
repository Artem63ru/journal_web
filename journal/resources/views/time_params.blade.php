@extends('layouts.app')
@section('title')
    Временные показатели
@endsection

@section('content')
    <div id="date_div">
        <input type="date" id="table_date" required onkeydown="return false">
        <label for="table_date" id="table_date_label">Дата</label>
    </div>
    <div id="content-header"></div>
    @include('include.infoTable.info_table')

    <script>
        var header_content='Временные показатели для ';
        $(document).ready(function(){
            var today  = new Date();

            click_side_menu_func=get_table_data;

            $('#table_date').val(today.toISOString().substring(0, 10))
            document.getElementById("table_date").setAttribute("max", today.toISOString().substring(0, 10));

            $('#table_date').change(function(){
                var choiced=$('.choiced')[0]
                get_table_data(choiced.getAttribute('data-id'));
            })
        })


    </script>

    <style>
        #date_div {
            position: relative;
            padding: 15px 0 0;
            margin-top: 10px;
            width: 50%;
        }
        #table_date{
            font-family: inherit;
            width: 100%;
            border: 0;
            border-bottom: 2px solid #9b9b9b;
            outline: 0;
            font-size: 1.3rem;
            color: black;
            padding: 7px 0;
            background: transparent;
            transition: border-color 0.2s;
        }

        input[type=date]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            display: none;
        }
        input[type=date]::-webkit-clear-button {
            -webkit-appearance: none;
            display: none;
        }



        #table_date::placeholder {
            color: transparent;
        }
        #table_date:placeholder-shown ~ .form__label {
            font-size: 1.3rem;
            cursor: text;
            top: 20px;
        }

        #table_date_label {
            position: absolute;
            top: 0;
            display: block;
            transition: 0.2s;
            font-size: 1rem;
            color: #9b9b9b;
        }
        #table_date:focus {
            padding-bottom: 6px;
            font-weight: 700;
            border-width: 3px;
            border-image: linear-gradient(to right, black, gray);
            border-image-slice: 1;
        }
        #table_date:focus ~ #table_date_label {
            position: absolute;
            top: 0;
            display: block;
            transition: 0.2s;
            font-size: 1rem;
            color: black;
            font-weight: 700;
        }

    </style>
@endsection
