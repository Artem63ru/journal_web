function link_to_changeable(url_link) {
    var text = null;


    $('.changeable_td').blur(function () {
        $(this).text(text);
        text = null;
    });

    $('.changeable_td').focus(function (event) {
        text = event.target.textContent;
    });

    $('.changeable_td').keypress(function (event) {
        console.log(event.keyCode)
        var x = event.charCode || event.keyCode;

        if (event.keyCode === 13) {
            var data={
                'id':$(event.target.parentNode.parentNode).attr('data-id'),
                'column':$(event.target).attr('data-column'),
                'value':$(event.target).text()
            }
            console.log(data)
            $.ajax({
                url:url_link,
                type:'POST',
                data: data,
                success:(data)=>{
                    if (data[0]===true){
                        text = event.target.textContent;
                    }
                    else{
                        ///Известить об ошибке
                    }
                }
            })
            event.target.blur();
        }
        else{
            if (isNaN(String.fromCharCode(event.which)) && (String.fromCharCode(event.which) !='.') || x===32 || (String.fromCharCode(event.which) ==='.' && event.currentTarget.innerText.includes('.'))) {
                event.preventDefault();
            }
        }

    })
}


