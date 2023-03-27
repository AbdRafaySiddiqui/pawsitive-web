$(document).ready(function(){
    var pwdToggle = $('.sv-pwd-toggle');
    pwdToggle.click(function(){
        var icon = $(this).find('span').first();
        var pwdField = $(this).parent().parent().find('input').first();
        var textHide=$(this).data('hide');
        var textShow=$(this).data('show');
        if(icon.hasClass('glyphicon-eye-open')){
            $(this).prop('title',textHide);
            icon.removeClass('glyphicon-eye-open').addClass('glyphicon-eye-close');
            pwdField.prop('type','text');
        }else{
            $(this).prop('title',textShow);
            icon.removeClass('glyphicon-eye-close').addClass('glyphicon-eye-open');
            pwdField.prop('type','password');
        }
    });
});