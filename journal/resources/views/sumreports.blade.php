@extends('layouts.app')
@section('title')
    Сводный отчет
@endsection

@section('content')
    @push('scripts')
        <script src="{{asset('assets/js/moment-with-locales.min.js')}}"></script>
        <script src="{{asset('assets/libs/changeable_td.js')}}"></script>

    @endpush

    @push('styles')
        <link rel="stylesheet" href="{{asset('assets/css/table.css')}}">
    @endpush

    @include('include.choice_date')
    <div id="content-header"><h3>Сводный отчет</h3></div>

    <style>
        .content{
            width: calc(100% - 40px);
        }
    </style>

{{--    <button id="test_btn">ТЕСТ</button>--}}

    <div id="tableDiv">
        <table id="itemInfoTable" class="itemInfoTable">
            <thead>
                <tr>
                    <th class="objCell"><h4>Номер</h4></th>
                    <th class="objCell"><h4>Дата формирования</h4></th>
                    <th class="objCell"><h4>Время формирования</h4></th>
                    <th class="objCell"><h4>УКПГ-НТС P вых</h4></th>
                    <th class="objCell"><h4>УКПГ-НТС Q</h4></th>
                    <th class="objCell"><h4>Ямсовей (сеноман) P вых</h4></th>
                    <th class="objCell"><h4>Ямсовей (сеноман) Q</h4></th>
                    <th class="objCell"><h4>Q ННГДУ</h4></th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function () {

            var today = new Date();

            $('#table_date').val(today.toISOString().substring(0, 10))
            document.getElementById("table_date").setAttribute("max", today.toISOString().substring(0, 10));

            getTableData();

            $('#table_date').change(function(){
                getTableData();
            })

            // $('#test_btn').click(getTableData)
        });

        function getTableData(){
            $.ajax({
                url:'/getsumreportstable',
                data:{
                    date: $('#table_date').val()
                },
                type:'GET',
                success: (data)=>{
                    var result = Object.keys(data).map((key) => data[key]);
                    var table_body=document.getElementById('itemInfoTable').getElementsByTagName('tbody')[0]
                    table_body.innerText=''
                    for(var row of result){
                        var tr=document.createElement('tr')
                        tr.setAttribute('data-id', row['id'])

                        tr.innerHTML+=`<td><span>${row['id']}</span></td>`
                        tr.innerHTML+=`<td><span oncopy="return false" oncut="return false" onpaste="return false" data-column="date" class="changeable_td" contenteditable="true" spellcheck="false">${row['date']}</span></td>`
                        tr.innerHTML+=`<td><span oncopy="return false" oncut="return false" onpaste="return false" data-column="hour" class="changeable_td" contenteditable="true" spellcheck="false">${row['hour']}</span></td>`
                        tr.innerHTML+=`<td><span oncopy="return false" oncut="return false" onpaste="return false" data-column="p_out_nts" class="changeable_td" contenteditable="true" spellcheck="false">${row['p_out_nts']}</span></td>`
                        tr.innerHTML+=`<td><span oncopy="return false" oncut="return false" onpaste="return false" data-column="q_nts" class="changeable_td" contenteditable="true" spellcheck="false">${row['q_nts']}</span></td>`
                        tr.innerHTML+=`<td><span oncopy="return false" oncut="return false" onpaste="return false" data-column="p_out_yms" class="changeable_td" contenteditable="true" spellcheck="false">${row['p_out_yms']}</span></td>`
                        tr.innerHTML+=`<td><span oncopy="return false" oncut="return false" onpaste="return false" data-column="q_yms" class="changeable_td" contenteditable="true" spellcheck="false">${row['q_yms']}</span></td>`
                        tr.innerHTML+=`<td><span oncopy="return false" oncut="return false" onpaste="return false" data-column="q_full" class="changeable_td" contenteditable="true" spellcheck="false">${row['q_full']}</span></td>`
                        table_body.appendChild(tr);
                    }
                    link_to_changeable('/changesumreports');
                }
            })
        }
    </script>
@endsection
