$(document).ready(function(){
    var uploadEamilAttachmentFileFields = [] ;
    var uploadEamilAttachmentRemoveButtons = $('.uploadEamilAttachmentRemoveButton');
    var fielFieldDummyButtons = $('.fielFieldDummyButton');
    var emailAttachmentFileFields = $('emailAttachmentFileField');
    fielFieldDummyButtons.click(function(){
        var targetId = $(this).data('targetid');
        // $('#emailAttachmentFileField_'+targetId).click();
    });
    $('.fileFieldDummyContainer').click(function(){
        var targetId = $(this).data('targetid');
        $('#emailAttachmentFileField_'+targetId).click();
    });

    $(document).on('change','.emailAttachmentFileField',function(){
        var targetId = $(this).data('targetid');
        var fileName = $(this).val();
        $('#fileDummyPrev_'+targetId).html(fileName);
    });
    uploadEamilAttachmentRemoveButtons.each(function(i){
        var attachmentId = $(this).data('attachmentid');
        $('#fileFieldDummyContainer_'+attachmentId).hide();
        var tmpObj = $('#emailAttachmentFileField_'+attachmentId);
        uploadEamilAttachmentFileFields[i] = {'attachmentId':attachmentId,'obj':tmpObj};
        tmpObj.remove();
    });
    uploadEamilAttachmentRemoveButtons.click(function(){
        var attachmentId = $(this).data('attachmentid');
        var fileDummyContainer = $('#fileFieldDummyContainer_'+attachmentId);
        var noFile = fileDummyContainer.data('nofile');
        $('#fileDummyPrev_'+attachmentId).html(noFile);
        fileDummyContainer.show();
        $('#previewName_'+attachmentId).remove();
        $(this).remove();
        for(var i in uploadEamilAttachmentFileFields){
            if(uploadEamilAttachmentFileFields[i].attachmentId == attachmentId){
                $('#uploadEmailAttachmentContainer_'+ attachmentId).append(uploadEamilAttachmentFileFields[i].obj);
            }
        }
    });
});