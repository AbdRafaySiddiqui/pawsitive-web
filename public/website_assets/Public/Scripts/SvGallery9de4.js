$(document).ready(function () {
    var svGalleryTarget = $('#svGalleryTarget');
    $('.sv-gallery-chocolat').Chocolat({'fullscreen':true,'loop':true});
    if(svGalleryTarget.data('forwarded')==='n'){
        $('html, body').animate({ scrollTop: svGalleryTarget.offset().top -100}, 1);
    }
});