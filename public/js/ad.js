$('#add-image').click(function(){
    //Getting the index for the div
    //const index = $('#advertisement_images div.form-group').length;
    const index = +$('#widgets-counter').val();
    console.log(index);

    //Getting the prototype (code used to generate the html): template
    const tmpl = $('#advertisement_images').data('prototype').replace(/__name__/g , index);
    //Injection of the new code
    $('#advertisement_images').append(tmpl);

    //Add 1 to the index
    $('#widgets-counter').val(index+1);

    handleDeleteButtons();
})

function updateCounter(){
    const count = $('#advertisement_images div.form-group').length;
    $('#widgets-counter').val(count);
}

function handleDeleteButtons(){
    $('button[data-action="delete"]').click(function(){
        const target = this.dataset.target;
        //e.g. target → "#block_advertisement_images_0"
        //this remove the whole div.
        $(target).remove();
    })
}
updateCounter();
handleDeleteButtons();