$(document).ready(function(){

    // adding new blocks for previous employment
    $('#add-previous-options').click(function(){
       $('div.add-block').append($('div.original').clone().removeClass('original').show());

    })

    $('button.remove-block').on('click', function(){
        var parent = $(this).parent('div.new-block');
        ($('div.new-block').length > 1)? parent.remove(): parent.hide();
    })

})