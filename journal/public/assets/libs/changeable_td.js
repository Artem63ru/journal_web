function link_to_changeable() {
    var text = null;


    $('.changeable_td').blur(function () {
        $(this).text(text);
        text = null;
    });

    $('.changeable_td').focus(function (event) {
        text = event.target.textContent;
    });

    $('.changeable_td').keydown(function (event) {
        if (event.keyCode === 13) {
            var data={
                'id':$(event.target.parentNode.parentNode).attr('data-id'),
                'column':$(event.target).attr('data-column'),
                'value':$(event.target).text()
            }
            console.log(data)
            $.ajax({
                url:'/changetable',
                type:'POST',
                data: data,
                success:(data)=>{
                    if (data[0]===true){
                        text = event.target.textContent;
                        event.target.blur();
                    }
                    else{
                        ///Известить об ошибке
                    }
                }
            })
            // if (!event.shiftKey){
            //     text=event.target.textContent;
            //     event.target.blur();
            // }

        }
    })
}


