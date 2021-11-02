@extends('layouts.app')
@section('title')
    Временные показатели
@endsection

@section('side_menu')
    @include('include.side_menu')
@endsection



@section('content')

@push('scripts')
    <script src="{{asset('assets/js/moment-with-locales.min.js')}}"></script>
    <script src="{{asset('assets/libs/changeable_td.js')}}"></script>
    <script src="{{asset('assets/libs/tooltip/popper.min.js')}}"></script>
    <script src="{{asset('assets/libs/tooltip/tippy-bundle.umd.min.js')}}"></script>

    <script src="{{asset('assets/libs/apexcharts.js')}}"></script>

@endpush

@push('styles')
    <link rel="stylesheet" href="{{asset('assets/css/table.css')}}">
    <link rel="stylesheet" href="{{asset('assets/libs/tooltip/tooltip.css')}}">
@endpush


@include('include.choice_date')
<div id="content-header"></div>


<div id="tableDiv">
    <table id="itemInfoTable" class="itemInfoTable">
        <thead>
            <tr>
                <th class="objCell"><h4>Код показателя</h4></th>
                <th class="objCell"><h4>Имя объекта</h4></th>
                <th class="objCell"><h4>Тип объекта</h4></th>
                <th class="objCell"><h4>Наименование показателя</h4></th>
                <th class="objCell"><h4>Обозначение показателя</h4></th>
                <th data-drop-down="true" class="timeCell" data-time="09:00" data-time-id="1"><h4>09:00</h4></th>
                <th data-drop-down="true" class="timeCell" data-time="10:00" data-time-id="2"><h4>10:00</h4></th>
                <th data-drop-down="true" class="timeCell" data-time="11:00" data-time-id="3"><h4>11:00</h4></th>
                <th data-drop-down="true" class="timeCell" data-time="12:00" data-time-id="4"><h4>12:00</h4></th>
                <th data-drop-down="true" class="timeCell" data-time="13:00" data-time-id="5"><h4>13:00</h4></th>
                <th data-drop-down="true" class="timeCell" data-time="14:00" data-time-id="6"><h4>14:00</h4></th>
                <th data-drop-down="true" class="timeCell" data-time="15:00" data-time-id="7"><h4>15:00</h4></th>
                <th data-drop-down="true" class="timeCell" data-time="16:00" data-time-id="8"><h4>16:00</h4></th>
                <th data-drop-down="true" class="timeCell" data-time="17:00" data-time-id="9"><h4>17:00</h4></th>
                <th data-drop-down="true" class="timeCell" data-time="18:00" data-time-id="10"><h4>18:00</h4></th>
                <th data-drop-down="true" class="timeCell" data-time="19:00" data-time-id="11"><h4>19:00</h4></th>
                <th data-drop-down="true" class="timeCell" data-time="20:00" data-time-id="12"><h4>20:00</h4></th>
                <th data-drop-down="false" class="sutCell"><h4>Суточный</h4></th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>


<style>
    .content{
        width: calc(100% - 40px);
    }
</style>

<script>
    var header_content='Временные показатели для ';


    $(document).ready(function (){
        var today  = new Date();

        click_side_menu_func=get_table_data;

        $('#table_date').val(today.toISOString().substring(0, 10))
        document.getElementById("table_date").setAttribute("max", today.toISOString().substring(0, 10));

        $('#table_date').change(function(){
            var choiced=$('.choiced')[0]
            click_side_menu_func(choiced.getAttribute('data-id'));
        })

        $('[data-drop-down="true"]').click(function (){
            if (this.getAttribute('data-used')==='true'){
                hide_mins_columns();
            }
            else{
                this.setAttribute('data-used', true)
                var datetime=$('#table_date').val()+' '+this.getAttribute('data-time')
                var id=$('.choiced')[0].getAttribute('data-id')

                var time_buff=moment(datetime);
                time_buff.add(1, 'hour');
                for (var i=11; i>=1; i--){
                    var new_th=document.createElement('th')
                    new_th.className='timeCell mins-columns';
                    $(new_th).hide();
                    $(this).after(new_th);
                    $(new_th).show('fast')
                    time_buff.subtract(5, 'minutes');
                    $(new_th).text(time_buff.format('HH:mm'))

                }
                $.ajax({
                    url:'/get_mins_params',
                    data:{'date':datetime,
                            'id':id},
                    type:'GET',
                    success: (res)=>{
                        var result = Object.keys(res).map((key) => res[key]);
                        var table_body=document.getElementById('itemInfoTable').getElementsByTagName('tbody')[0]
                        var trs=table_body.getElementsByTagName('tr')
                        for (tr of trs){
                            var td=tr.querySelector(`[data-time-id="${this.getAttribute('data-time-id')}"]`)
                            var row=null;
                            for (var r of result){
                                if (`${r['id']}`===$(tr).attr('data-id')){
                                    row=r;
                                }
                            }
                            var time_buff=moment(datetime);
                            time_buff.add(1, 'hour');
                            for (var i=10; i>=0; i--){
                                var new_td=document.createElement('td');
                                // new_th.setAttribute('data-time-id', id);
                                // new_td.className='timeCell mins-columns';

                                $(new_td).hide();
                                $(td).after(new_td);
                                $(new_td).show('fast');
                                time_buff.subtract(5, 'minutes');
                                $(new_td).attr('data-time', time_buff.format('hh:mm'))
                                if (row!==null){
                                    $(new_td).text(row['time_vals'][time_buff.format('HH:mm')]);
                                }
                                else{
                                    new_td.innerText='...';
                                }
                            }
                        }
                    }
                })
            }
        })
    })

    function hide_mins_columns(){
        $('.mins-columns').hide('fast', ()=>{
                $('.mins-columns').remove()
            }
        )
        $('[data-drop-down="true"]').attr('data-used', 'false')
    }
    // const template = document.getElementById('main_link_li_tooltip_content');
    // template.style.display = 'block';
    function get_table_data(data_id){
        hide_mins_columns()

        $.ajax({
            url:'/gettabledata',
            method: 'GET',
            data: {
                'id':data_id,
                'date':$('#table_date').val()
            },
            success: function (data){
                var result = Object.keys(data).map((key) => data[key]);
                var table_body=document.getElementById('itemInfoTable').getElementsByTagName('tbody')[0]
                table_body.innerText=''
                var charts={}
                for(var row of result){
                    // console.log(row['id'])
                    var tr=document.createElement('tr')
                    tr.setAttribute('data-id', row['id'])
                    tr.innerHTML+=`<td>${row['hfrpok']}</td>`
                    tr.innerHTML+=`<td>${row['namepar1']}</td>`
                    tr.innerHTML+=`<td>${row['inout']}</td>`
                    tr.innerHTML+=`<td>${row['name_str']}</td>`
                    tr.innerHTML+=`<td>${row['shortname']}</td>`

                    var id=1;
                    var data = [];
                    var xaxis=[];
                    for (var time of row['time_vals']){
                        // console.log(time['time'])
                        tr.innerHTML+=`<td data-time-id="${id}" class="hour-value-${row['id']}">${time['hour_val']}</td>`
                        xaxis.push(moment(time['time']).format('HH:mm'))
                        data.push(parseFloat(time['hour_val']))
                        id++;
                    }
                    tr.innerHTML+=`<td>${row['sut_val']}</td>`
                    table_body.appendChild(tr);

                    charts[row['id']]=document.createElement('div');
                    charts[row['id']].setAttribute('id', `chart${row['id']}`);
                    charts[row['id']].setAttribute('class', 'tableItemInfoChart')
                    document.body.appendChild(charts[row['id']]);


                    var options = {
                        series: [{
                            name: row['name_str'],
                            data: data
                        }],
                        xaxis: {
                            categories: xaxis
                        },
                        chart: {
                            type: 'line',
                            height: 350
                        },
                        stroke: {
                            curve: 'stepline',
                        },
                        dataLabels: {
                            enabled: false
                        },
                        title: {
                            text: `Показатель ${row['hfrpok']}`,
                            align: 'left'
                        },
                        markers: {
                            hover: {
                                sizeOffset: 4
                            }
                        },
                        tooltip: {
                            custom: function ({series, seriesIndex, dataPointIndex, w}) {
                                // console.log(yo)
                                return (
                                    '<div class="arrow_box">' +
                                    "<span>" +
                                    w.globals.seriesNames[seriesIndex] +
                                    ": " +
                                    series[seriesIndex][dataPointIndex] +
                                    "</span>" +
                                    "</div>"
                                );
                            }
                        }
                    };

                    var chart = new ApexCharts(document.getElementById(`chart${row['id']}`), options);

                    chart.render();

                    // console.log(document.getElementById(`chart${row['id']}`))



                    tippy.createSingleton(tippy(`.hour-value-${row['id']}`, {
                        content: charts[row['id']]
                    }), {
                        maxWidth:650,
                        interactive: true,
                        allowHTML: true,
                        delay: 500, // ms
                    });
                }



            }
        })
    }



</script>



@endsection
