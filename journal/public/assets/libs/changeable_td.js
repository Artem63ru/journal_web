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
            // if (!event.shiftKey){
            //     text=event.target.textContent;
            //     event.target.blur();
            // }
            text = event.target.textContent;
            event.target.blur();
        }
    })
}


