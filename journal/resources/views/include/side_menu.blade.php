
{{--<div class="logo_block">--}}
{{--    <a class="navbar-brand" href="{{ url('/') }}">--}}
{{--        <img alt="Логотип" src="{{ asset('assets/images/logo.svg') }}" class="side_menu_logo">--}}
{{--    </a>--}}
{{--</div>--}}
{{--<div class="links_block">--}}
{{--    <ul>--}}
{{--        <li ><a href="/"><img alt="Главная" src="{{asset('assets/images/icons/home.svg')}}" class="links_block_icon"></a></li>--}}
{{--        <li ><a href="{{asset('/opo/1')}}"><img alt="Настройки" src="{{asset('assets/images/icons/settings.svg')}}" class="links_block_icon"></a></li>--}}
{{--        <li ><a href="{{ url('/docs/rtn') }}"><img alt="Документация" src="{{asset('assets/images/icons/docs.svg')}}" class="links_block_icon"></a></li>--}}
{{--    </ul>--}}
{{--</div>--}}
{{--<div class="info_block">--}}
{{--    <ul>--}}
{{--        <li class=""><a href="{{ url('/docs/glossary') }}"><img alt="Справка" src="{{asset('assets/images/icons/info.svg')}}" class="side_menu_faq"></a></li>--}}
{{--    </ul>--}}
{{--</div>--}}

{{--<script>--}}
{{--    $(document).ready(function() {--}}

{{--        $('.links_block ul a').each(function () {--}}

{{--            //console.log(this.href.split('/'), location.href.split('/'))--}}

{{--            if (this.href.split('/')[3] == location.href.split('/')[3]) $(this).parent().addClass('active');--}}
{{--        });--}}

{{--        $( '.links_block ul a' ).on( 'click', function () {--}}
{{--            $( '.links_block ul' ).find( 'li.active' ).removeClass( 'active' );--}}
{{--            $( this ).parent( 'li' ).addClass( 'active' );--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}
<DIV CLASS="side_menu" id="side_menu"></DIV>

<script>
    var click_side_menu_func=null;



    $(document).ready(function (){

        var tableItems=[];

        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/getsidetree',
            method: 'GET',
            dataType: 'html',
            success: function(data){
                var side_tree=document.createElement('div');
                side_tree.className='side_tree';
                side_tree.innerHTML=data;
                document.getElementById('side_menu').appendChild(side_tree);
                tableItems=$('.tableItem').click(ItemClick);
                tableItems[0].className+=' choiced'

                var content_header=document.getElementById('content-header');
                // content_header.innerText+=target.textContent;
                content_header.innerHTML=`<h3>${header_content} ${tableItems[0].textContent}</h3>`

                // var content_header=document.getElementById('content-header');
                // console.log(content_header)
                // content_header.innerHTML=`<h3>Временные показатели для ${tableItems[0].textContent}</h3>`

            }
        })



        function ItemClick (event){
            var target=null;
            if (event.target.className==='treePlusIcon'){
                if (event.target.style.webkitTransform===''){
                    event.target.style.webkitTransform = "rotate(45deg)";
                    event.target.style.transform="rotate(45deg)";
                }
                else{
                    event.target.style.webkitTransform='';
                    event.target.style.transform=''
                }
                // console.log(typeof(event.target.style.webkitTransform))

                let childrenContainer = event.target.parentNode.parentNode.querySelector('ul');
                if (childrenContainer)
                    childrenContainer.hidden=!childrenContainer.hidden;
                target=event.target.parentNode;
            }
            else{
                target=event.target;
            }

            tableItems=$('.tableItem').removeClass('choiced');

            target.className+=' choiced';
            // console.log($('#table_date').val())

            click_side_menu_func(this.getAttribute('data-id'))
            // get_table_data(this.getAttribute('data-id'));


            var content_header=document.getElementById('content-header');
            // content_header.innerText+=target.textContent;
            content_header.innerHTML=`<h3>${header_content} ${target.textContent}</h3>`

        }

    })


</script>

<style>
    .side_tree {
        margin-left: -30px;
        height: 100%;
        overflow-y: auto;

    }


    .side_tree ul {
        list-style-position: inside;
        transition: all 0.5s;
        -webkit-transition: all 0.5s;
        -moz-transition: all 0.5s;
    }

    .side_tree li {
        list-style-type: none;
        position: relative;
        padding: 5px 5px 0 5px;

        transition: all 0.5s;
        -webkit-transition: all 0.5s;
        -moz-transition: all 0.5s;
    }

    .side_tree li::after{
        content: '';
        position: absolute; top: 0;

        width: 3%; height: 50px;
        right: auto; left: -2.5%;

        /*border-bottom: 1px solid #ccc;*/
        /*border-left: 1px solid #ccc;*/
        /*border-radius: 0 0 0 5px;*/
        /*-webkit-border-radius: 0 0 0 5px;*/
        /*-moz-border-radius: 0 0 0 5px;*/
    }

    .tableItem{
        border: 1px solid #ccc;
        padding: 5px 10px;
        text-decoration: none;
        color: #666;
        font-family: arial, verdana, tahoma;
        font-size: 11px;
        display: inline-block;
        width: 90%; height: 20px;
        background-color: white;
        border-radius: 5px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;

        transition: all 0.5s;
        -webkit-transition: all 0.5s;
        -moz-transition: all 0.5s;
    }

    .tableItem:hover, .tableItem:hover+ul li .tableItem
    {
        background: #c8e4f8; color: #000; border: 1px solid #94a0b4;
    }
    /*.treePlusIcon:hover, .treePlusIcon:hover+ul li, .treePlusIcon{*/
    /*    background: #c8e4f8;*/
    /*}*/
    /*!*Connector styles on hover*!*/
    /*.side_tree li a:hover+ul li::after,*/
    /*.side_tree li a:hover+ul li::before,*/
    /*.side_tree li a:hover+ul::before,*/
    /*.side_tree li a:hover+ul ul::before{*/
    /*    border-color:  #94a0b4;*/
    /*}*/
    .choiced{
        background-color: #c8e4f8;
    }

    .treePlusIcon{
        width:16px;
        height:16px;
        display:inline-block;
        vertical-align:bottom;
        float: right;
        background-color: rgba(0,0,0,0);
        -webkit-transition: all 0.2s; transition: all 0.2s;
    }

    /*.iconRotate45 { -webkit-transform: rotate(45deg); transform: rotate(45deg); }*/


</style>
