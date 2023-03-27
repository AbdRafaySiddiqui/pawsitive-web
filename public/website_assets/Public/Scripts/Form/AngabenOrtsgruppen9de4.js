var AngabenOrtsgruppen = function(){
    var ogForm = $('#angaben_ortsgruppe_de');
    var boxes = {
        montag : $('#angaben_ortsgruppe_de-zeiten_montag'),
        dienstag : $('#angaben_ortsgruppe_de-zeiten_dienstag'),
        mittwoch : $('#angaben_ortsgruppe_de-zeiten_mittwoch'),
        donnerstag : $('#angaben_ortsgruppe_de-zeiten_donnerstag'),
        freitag : $('#angaben_ortsgruppe_de-zeiten_freitag'),
        samstag : $('#angaben_ortsgruppe_de-zeiten_samstag'),
        sonntag : $('#angaben_ortsgruppe_de-zeiten_sonntag')
    }
    var frames = {};
    var von = {};
    var bis = {};
    for(var i in boxes){
        boxes[i].addClass('chk-boxes');
        boxes[i].data('tag',i);
        frames[i] = boxes[i].parent().parent().parent().parent().next();
        von[i] = $('#angaben_ortsgruppe_de-'+i+'_von');
        von[i].data('tag',i);
        von[i].addClass('og-tag-uhrzeit');
        bis[i] = $('#angaben_ortsgruppe_de-'+i+'_bis');
        bis[i].data('tag',i);
        bis[i].addClass('og-tag-uhrzeit');
    }
    $(document).on('change','.og-tag-uhrzeit',function(){
        var i = $(this).data('tag');
        if(von[i].val()!=='' && bis[i].val()!==''){
            boxes[i].prop('checked',true);
        }else{
            boxes[i].prop('checked',false);
        }
    });
    $(document).on('click','.chk-boxes',function(){
        if($(this).prop('checked')===false){
            var i = $(this).data('tag');
            von[i].val('');
            bis[i].val('');
        }

    });
    $(document).on('submit','#angaben_ortsgruppe_de',function(e){
        execForm();
    });
    var execForm = function(){
        for(var i in boxes){
            if(von[i].val()==='' || bis[i].val()===''){
                von[i].val('');
                bis[i].val('');
                boxes[i].prop('checked',false);
            }else{
                boxes[i].prop('checked',true);
            }
        }
    }
}
$(document).ready(function(){
    AngabenOrtsgruppen();
});