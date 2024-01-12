function updateCheckBox() {
    $('.sessionCheckbox').each(function() {
        $(this).hide();
        
        if ($(this).prop('checked')) {
            $(this).val(`${$(this).val()}:true`);
        } else {
            $(this).prop('checked', true);
            $(this).val(`${$(this).val()}:false`);
        }
    });
    
    return true;
}