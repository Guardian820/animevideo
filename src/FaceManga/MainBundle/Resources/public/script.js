$(document).ready(function() {
    $('#create_anime_button').tooltip({});
    
    $('.number-spinner').each(function() {
        $(this).TouchSpin({
            min: $(this).attr('min'),
            max: $(this).attr('max'),
            step: 1
        });
    });
    
    $('.x-editable').each(function() {
        $(this).editable();
    });
});