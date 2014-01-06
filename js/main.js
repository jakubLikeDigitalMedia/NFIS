$(document).ready(function(){

    // adding new blocks for previous employment
    $('#add-previous-options').click(function(){
        var newBlock = $('div.new-block');
        var newBlockContainer = $('div.add-block');
        (newBlock.is(':visible'))? newBlockContainer.append(newBlock.clone().show()): newBlock.show();
    })

    $('button.remove-block').on('click', function(){
        var parent = $(this).parent('div.new-block');
        ($('div.new-block').length > 1)? parent.remove(): parent.hide();
    })

})