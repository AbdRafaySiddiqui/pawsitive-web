$(document).ready(function(){
    var maxAnzReNrs = 5;
    var anz = 1;
    var seperator = ';';
    var reFeld = $('#rechnungsNummerFeld');
    var reCont = $('#rechnungsNummerContainer');
    var addButton=$('#addButton');
    var remButton=$('#remButton');
    var hiddenField = $('#rechnungsnummer');
    var handleButtons=function(){
        if(anz>1){
            remButton.data('aktiv',1);
        }
        if(anz==1){
            remButton.data('aktiv',0);
        }
        if(anz<5){
            addButton.data('aktiv',1);
        }else{
            addButton.data('aktiv',0);
        }
    };
    var initRechnungsnummern=function(){
        var nummernString = hiddenField.val();
        var nummern = nummernString.split(seperator);
        for(var i=0; i < nummern.length;i++){
            if(i==0){
                $('#rnr_1').val(nummern[i]);
            }else{
                var neuFeld = reFeld.clone();
                neuFeld.find('input').attr('disabled',true).attr('id','rnr_'+ (i+1)).val(nummern[i]);
                neuFeld.appendTo(reCont);
                neuFeld.find('input').focus();
                anz=i+1;
            }
        }
        if(nummern.length > 2){
            $('#rnr_1').attr('disabled',true);
        }
        $('#rnr_'+anz).attr('disabled',false);
        handleButtons();
    };
    var fillHiddenField = function(){
        var aktuellesFeld = $('#rnr_'+anz);
        var aktuellerWert = aktuellesFeld.val();
        var wert='';
        for(var i=0; i < anz ;i++){
            var neu =  $( '#rnr_' + (i+1)).val();
            if(neu.replace(/\s+/g, '') !=''){
                wert = wert + neu;
                if( i < anz-1 ){
                    wert = wert + seperator;
                }
            }
        }
        console.log(wert);
        hiddenField.val(wert);
    };
    addButton.click(function(){
        if($(this).data('aktiv')==1){
            var aktuellesFeld = $('#rnr_'+anz);
            if(anz<maxAnzReNrs &&  aktuellesFeld.val().replace(/\s+/g, '')!=''){
                aktuellesFeld.attr('disabled',true);
                anz++;
                var neuFeld = reFeld.clone();
                neuFeld.find('input').attr('id','rnr_'+anz).attr('disabled',false).val('');
                neuFeld.appendTo(reCont);
                neuFeld.find('input').focus();
            }else{
                aktuellesFeld.focus();
            }
            handleButtons();
        }

    });
    remButton.click(function(){
        if($(this).data('aktiv')==1) {
            $('#rnr_' + anz).parent().parent().remove();
            anz = anz - 1;
            $('#rnr_' + anz).attr('disabled', false);
            handleButtons();
            fillHiddenField();
        }else{
            $('#rnr_'+anz).focus();
        }
    });
    $(document).on('change','.rnr',function(){fillHiddenField();});
    initRechnungsnummern();
});