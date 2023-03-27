$(document).ready(function(){
    var landElement = $('#land');
    var isExMitglied = $('.is-ex-mitglied');
    var anrede = $('#anrede');
    var beitragsgruppe = $('.beitragsgruppe');
    var formErrors = $('#formErrors');
    var lieferungZeitung = $('#lieferungZeitung');
    var lieferungZeitungDropDown = $('#lieferungZeitungDropDown');
    var lieferungZeitungArt = $('#lieferungZeitungArt');
    var lieferungZeitungArt1 = $('#lieferungZeitungArt1');
    var lieferungZeitungArt2 = $('#lieferungZeitungArt2');
    var aufmerksamDurchDropdown = $('#aufmerksam_durch_dropdown');
    var aufmerksamDurch = $('#aufmerksam_durch');
    handleAufmerksamDurch();
    closeLastschriftDetails();
    setLieferungZeitung(landElement);
    setZahlartZeitung(landElement);
    landElement.change(function(){
        setLieferungZeitung($(this));
        setZahlartZeitung($(this));
    });
    $('.lieferungzeitungart').change(function(){
        if($(this).val()===1){
            lieferungZeitungDropDown.slideDown();
        }else{
            lieferungZeitungDropDown.slideUp();
        }
    });
    $('#zahlart').change(function(){
        if($(this).val()==='lastschrift'){
            $('#lastschriftDetails').slideDown();
        }else{
            $('#lastschriftDetails').slideUp();
            $('#kontoinhaber').val('');
            $('#iban').val('');
            $('#bic').val('');
        }
    });
    isExMitglied.change(function(){
        var ja = $('#is_ex_mitglied_1');
        var exMitglied = $('.exMitglied');
        if(ja.is(':checked')){
            exMitglied.slideDown();
        }else{
            exMitglied.slideUp();
            $('#ex_mitglied_zusatz').val('');
        }
    });
    isExMitglied.change();
    anrede.change(function(){
        var institutField = $('.institut-field');
        if(anrede.val()===9){
            institutField.slideDown();
        }else{
            institutField.slideUp();
        }
    });
    anrede.change();
    beitragsgruppe.click(function(){
        handleBeitragsgruppe();
    });
    handleBeitragsgruppe();
    function handleBeitragsgruppe(){
        var dokumentBeitragsGruppen = ['03','15','16','02','04/0','04/1','08','12'];
        var beitragInfo = $('.beitrag-info');
        var value = null;
        var lfzField = $('#lieferungZeitungField');
        var dokumentField = $('#dokumentField');
        var zahlartField = $('#zahlartField');
        dokumentField.hide();
        beitragInfo.slideUp();
        beitragsgruppe.each(function(){
            if($(this).is(':checked')){
                $(this).parent().parent().find(beitragInfo).first().slideDown();
                value = $(this).val();
            }
        });

        if(value==='17'){
            zahlartField.slideUp();
            $('#zahlart').val('').selectpicker('refresh');
            $('#kontoinhaber').val('');
            $('#iban').val('');
            $('#bic').val('');
            $('#lastschriftDetails').hide();
        }else{
            zahlartField.slideDown();
        }
        if(value==='05' || value==='04/0' || value==='17'){
            lfzField.slideUp();
        }else{
            lfzField.slideDown();
        }
        if(value !== '05'){
            $('#nr_vollmitglied').val('');
        }
        if(value !== '17'){
            $('#nrVater').val('');
            $('#nrMutter').val('');
            $('#nrGeschwister').val('');
        }
        for(var i in dokumentBeitragsGruppen){
            if(dokumentBeitragsGruppen[i] === value){
                dokumentField.show();
            }
        }
    }
    function setLieferungZeitung(land) {
        if (land.val() === 'DE') {
            lieferungZeitungArt.slideUp();
            lieferungZeitungDropDown.slideDown();
            lieferungZeitung.empty();
            lieferungZeitung.append($('#lieferungZeitungOptionsDE').children().clone());
            lieferungZeitung.selectpicker('refresh');
            lieferungZeitung.val('0');
        } else {
            lieferungZeitungArt.slideDown();
            if(lieferungZeitungArt1.prop('checked')===false && lieferungZeitungArt2.prop('checked')===false){
                lieferungZeitungDropDown.slideUp();
            }else{
                if(lieferungZeitungArt1.prop('checked')===true){
                    lieferungZeitungDropDown.slideDown();
                }else{
                    lieferungZeitungDropDown.slideUp();
                }
            }
            lieferungZeitung.empty();
            lieferungZeitung.append($('#lieferungZeitungOptionsAny').children().clone());
            lieferungZeitung.selectpicker('refresh');
            if (lieferungZeitung.val() === '0' || lieferungZeitung.val() === '') {
                lieferungZeitung.val('1');
            }
        }
        lieferungZeitung.selectpicker('refresh');
    }
    function setZahlartZeitung(land){
        var separaum = ['BE','BG','DK','DE','EE','FI','FR','GR','GB','IE','IS','IT','HR','LV','LI','LT','LU','MT','MC',
            'NL','NO','AT','PL','PT','RO','SM','SE','CH','SK','SI','ES','CZ','HU','CY'];
        var zahlart = $('#zahlart');
        var sparFuchsVorteil=$('#sparFuchsVorteil');
        var zahlartValue = zahlart.val();
        if($.inArray(land.val(),separaum) > -1){
            zahlart.empty();
            zahlart.append($('#zahlartOptionsEuro').children().clone());
            sparFuchsVorteil.slideDown();
        }else{
            zahlart.empty();
            zahlart.append($('#zahlartOptionsAny').children().clone());
            zahlart.selectpicker('refresh');
            if(zahlart.val()==='0' || zahlart.val()===''){
                zahlart.val('1');
            }
            sparFuchsVorteil.slideUp();
        }
        zahlart.selectpicker('refresh').val(zahlartValue).selectpicker('refresh');
    }
    function closeLastschriftDetails(){
        if($('#zahlart').val()!=="lastschrift"){
            $('#lastschriftDetails').hide();
        }
    }
    function handleAufmerksamDurch(){
        var out = [];
        aufmerksamDurchDropdown.find('option:selected').each(function(){
            out.push($(this).val());
        });
        aufmerksamDurch.val(out.join('|'));
    }
    aufmerksamDurchDropdown.on('change',function(){
        handleAufmerksamDurch();
    });
    $('#admin_autofill').click(function(){
        if(confirm('Formular aufüllen?')){
            $('input').each(function(){
                if( $(this).is( "[type=text]" ) ){
                    var email=$(this).prop('id').substr(-5,5);
                    var punkte=$(this).prop('id').substr(-7,6);
                    if(email==='email'){
                        $(this).val('svepw24@schaeferhunde.de');
                    }else if(punkte==='punkte'){
                        $(this).val(88);
                    }else{
                        $(this).val($(this).attr('id'));
                    }
                }
            });
            $('select').each(function(){
                $(this).find('option').last().attr('selected',true);
            });
        }
    });
});