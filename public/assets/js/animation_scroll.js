$(function(){

//Counter

$('.tmcounter').each(function(){
    $(this).appear(function(){
        $(this).countTo();
    })
});

//Progress Bar

$('.progress-bar').each(function(){
    $(this).appear(function(){

        $(this).css({
            width: $(this).data('percent') + "%"
        })

    });
})

});