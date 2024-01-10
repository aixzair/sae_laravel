function updateCheckBox() {
    $('.roleCheck').each(function() {
        if (!$(this).prop('checked')) {
            $(this).prop('checked', true);
            $(this).attr('check', false);
            console.log("cochée");
        } else {
            $(this).attr('check', true)
        }
    });

    
    return true;
}