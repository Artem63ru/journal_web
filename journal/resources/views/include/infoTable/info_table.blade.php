
{{--<table id="itemInfoTable" class="itemInfoTable">--}}
{{--    <thead>--}}
{{--        <tr>--}}
{{--            <th data-drop-down="false"><h4>Объект</h4></th>--}}
{{--            <th data-drop-down="false"><h4>Пояснение</h4></th>--}}
{{--            <th data-drop-down="true" data-param="testParam" data-used="false"><h4>Параметр</h4></th>--}}
{{--        </tr>--}}
{{--    </thead>--}}
{{--    <tbody>--}}
{{--        <tr data-table="" data-id="">--}}
{{--            <td data-param=""><span class="changeable_td" contenteditable="true" spellcheck="false">Ямсовей</span></td>--}}
{{--            <td data-param=""><span class="changeable_td" contenteditable="true" spellcheck="false">ЭТО ЯМСОВЕЙ</span></td>--}}
{{--            <td data-param=""><span class="changeable_td" contenteditable="true" spellcheck="false">P</span></td>--}}
{{--        </tr>--}}
{{--        <tr data-table="" data-id="">--}}
{{--            <td data-param=""><span class="changeable_td" contenteditable="true" spellcheck="false">Медвежка</span></td>--}}
{{--            <td data-param=""><span class="changeable_td" contenteditable="true" spellcheck="false">ЭТО МЕДВЕЖКА</span></td>--}}
{{--            <td data-param=""><span class="changeable_td" contenteditable="true" spellcheck="false">M</span></td>--}}
{{--        </tr>--}}
{{--    </tbody>--}}
{{--    </tbody>--}}
{{--</table>--}}
@push('scripts')
    <script src="{{asset('assets/js/moment-with-locales.min.js')}}"></script>
    <script src="{{asset('assets/libs/changeable_td.js')}}"></script>
    <script src="{{asset('assets/libs/tooltip/popper.min.js')}}"></script>
    <script src="{{asset('assets/libs/tooltip/tippy-bundle.umd.min.js')}}"></script>
@endpush

@push('styles')
    <link rel="stylesheet" href="{{asset('assets/css/table.css')}}">
    <link rel="stylesheet" href="{{asset('assets/libs/tooltip/tooltip.css')}}">
@endpush

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

<span id="main_link_li_tooltip_content">YOYOYOYOYOY</span>


<script>
    $(document).ready(function (){
        var text=null;


        $('.changeable_td').blur(function() {
            $(this).text(text);
            text=null;
        });

        $('.changeable_td').focus(function(event){
            text=event.target.textContent;
        });

        $('.changeable_td').keydown(function (event){
            if (event.keyCode === 13) {
                // if (!event.shiftKey){
                //     text=event.target.textContent;
                //     event.target.blur();
                // }
                text=event.target.textContent;
                event.target.blur();
            }
        });

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
                    // $(new_th).mousedown(function(event){
                    //     event.preventDefault();
                    //     if(event.button == 0){
                    //         alert('Вы кликнули левой клавишей');
                    //     } else if(event.button == 1){
                    //         alert('Вы кликнули левой колесиком');
                    //     } else if(event.button == 2){
                    //         alert('Вы кликнули правой клавишей');
                    //     }
                    // })
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
    const template = document.getElementById('main_link_li_tooltip_content');
    template.style.display = 'block';
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
                for(var row of result){
                    var tr=document.createElement('tr')
                    tr.setAttribute('data-id', row['id'])
                    tr.innerHTML+=`<td>${row['hfrpok']}</td>`
                    tr.innerHTML+=`<td>${row['namepar1']}</td>`
                    tr.innerHTML+=`<td>${row['inout']}</td>`
                    tr.innerHTML+=`<td>${row['name_str']}</td>`
                    tr.innerHTML+=`<td>${row['shortname']}</td>`

                    var id=1;
                    for (var time of row['time_vals']){
                        tr.innerHTML+=`<td data-time-id="${id}" class="hour-value-${row['id']}">${time['hour_val']}</td>`
                        id++;
                    }
                    tr.innerHTML+=`<td>${row['sut_val']}</td>`
                    table_body.appendChild(tr);

                    tippy.createSingleton(tippy(`.hour-value-${row['id']}`, {
                        content: template,
                    }), {
                        interactive: true,
                        allowHTML: true,
                        delay: 500, // ms
                    });
                }



            }
        })
    }



</script>
