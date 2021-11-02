@extends('layouts.app')
@section('title')
    Главная таблица показателей
@endsection

@section('side_menu')
    @include('include.side_menu')
@endsection



@push('styles')
    <link rel="stylesheet" href="{{asset('assets/css/table.css')}}">
@endpush

@push('scripts')
    <script src="{{asset('assets/libs/changeable_td.js')}}"></script>
@endpush

@section('content')
    <div id="content-header"></div>
    <div id="tableDiv">
        <table id="itemInfoTable" class="itemInfoTable" data-table-type="main-table">
            <thead>
                <tr>
                    <th><h4>Код показателя</h4></th>
                    <th><h4>Имя объекта</h4></th>
                    <th><h4>Тип подъобъекта</h4></th>
                    <th><h4>Обозначение</h4></th>
                    <th><h4>Краткое наименование</h4></th>
                </tr>
            </thead>
                <tbody>

                </tbody>
        </table>
    </div>

    <script>
        var header_content='Главная таблица показателей: ';
        $(document).ready(function(){
            click_side_menu_func=get_main_table_data;
        })

        function get_main_table_data(data_id){
            $.ajax({
                url:'/getmaintable',
                method: 'GET',
                data: {
                    'id':data_id
                },
                success: function (data){
                    var result = Object.keys(data).map((key) => data[key]);
                    var table_body=document.getElementById('itemInfoTable').getElementsByTagName('tbody')[0]
                    table_body.innerText=''
                    for(var row of result){
                        var tr=document.createElement('tr')
                        for (var key in row){
                            if (key==='id'){
                                tr.setAttribute('data-id', row['id'])
                            }
                            else{
                                if (row[key]==null){
                                    var value=''
                                }
                                else{
                                    value=row[key]
                                }
                                tr.innerHTML+=`<td><span data-column="${key}" class="changeable_td" contenteditable="true" spellcheck="false">${value}</span></td>`
                            }
                        }
                        table_body.appendChild(tr);
                        // tr.innerHTML+=`<td><span data-column="hfrpok" class="changeable_td" contenteditable="true" spellcheck="false">${row['hfrpok']}</span></td>`
                        // tr.innerHTML+=`<td><span data-column="namepar1" class="changeable_td" contenteditable="true" spellcheck="false">${row['namepar1']}</span></td>`
                        // tr.innerHTML+=`<td><span data-column="inout" spellcheck="false">${row['inout']}</span></td>`
                        // tr.innerHTML+=`<td><span data-column="name_str" class="changeable_td" contenteditable="true" spellcheck="false">${row['name_str']}</span></td>`
                        // tr.innerHTML+=`<td><span data-column="shortname" class="changeable_td" contenteditable="true" spellcheck="false">${row['shortname']}</span></td>`
                        // table_body.appendChild(tr);
                    }
                    link_to_changeable('/changetable');
                }
            })
        }


    </script>
@endsection
