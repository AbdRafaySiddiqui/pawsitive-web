$(document).ready(function(){
    var txSvmodulesTerminSchutzAntrag = function(){
        //////////////////////////
        // Vars
        //////////////////////////
        var lgnrElem = $('#lgnr');
        var typElem = $('#typ');
        var ortsgruppenElem = $('#ortsgruppen');
        var stufenElem = $('#stufen');
        var veranstalterElem = $('#veranstalter');
        var sidBeauftragterElem=$('#sidBeauftragter');
        var veranstaltungsleiterElem=$('#veranstaltungsLeiter');
        var vlUebernehmenElem = $('#vlUebernehmen');
        var artenElem = $('#arten');
        var ortElem = $('#ort');
        var ortsgruppenDropDowns = [];
        var artenDropDowns = [];
        var stufenAreas = [];
        var aenderungsantragElem = $('#aenderungsantragDiv');
        var neuantragElem = $('#neuantragDiv');
        var terminschutzForm = $('#terminschutzForm');
        var hiddenStufenElem = $('#hiddenStufen');
        var stufeSonstigeDivElem = $('#stufeSonstigeDiv');
        var stufeSonstigeElem = $('#stufeSonstige');
        var stufeSonstigeCheckElem = $('#stufeSonstigeCheck');
        var artSonstigeDivElem = $('#artSonstigeDiv');
        var artSonstigeElem = $('#artSonstige');
        var richterSection = $('#richterSection');
        var richterAdd = $('#richterAdd');
        var richterEditPanel = $('#richterEditPanel');
        var richterEditFertig = $('#richterEditFertig');
        var richterEditAbbrechen = $('#richterEditAbbrechen');
        var richterAnzahlElem = $('#richterAnzahl');
        var richterElem = $('#richter');
        var richterEditPanelHeader = $('#richterEditPanelHeader');
        var richterNr = $('#richterNr');
        var richterVorname = $('#richterVorname');
        var richterNachname = $('#richterNachname');
        var richterOrt = $('#richterOrt');
        var richterVerband = $('#richterVerband');
        var isAenderungsElems = $('.is-aenderung');
        var metaNeuElems = $('.meta-neu');
        var metaAenderungElems = $('.meta-aenderung');
        var metaHeadline = $('#metaHeadline');
        var metaContent = $('#metaContent');
        var editState = 0;
        var maxRichters = 6;
        var richterEditMode = '';
        var richterAnzahl;
        var richterAktElem = $('#richterAkt');
        var richterAkt = -1;
        var errorOutElem=$('#errorOut');
        var richterAbtl = {0:'1',1:'2',2:'3',3:'4',4:'5',5:'6',6:'7'};
        var vonTagElem = $('#vonTag');
        var vonMonatElem = $('#vonMonat');
        var vonJahrElem = $('#vonJahr');
        var bisTagElem = $('#bisTag');
        var bisMonatElem = $('#bisMonat');
        var bisJahrElem = $('#bisJahr');
        var datumBisSection = $('#datumBisSection');
        var datumBisDummySection = $('#datumBisDummySection');
        var datumBisDummyDay = $('#datumBisDummyDay');
        var datumBisDummyMonth = $('#datumBisDummyMonth');
        var datumBisDummyYear = $('#datumBisDummyYear');
        var datumVonLabel = $('#datumVonLabel');
        var dummy = '';
        //////////////////////////
        // Functions
        //////////////////////////
        var executeDatum = function () {
            var typ = typElem.val();
            if(typ == 'P'){
                datumBisDummySection.html('')
                datumBisSection.show();
                datumVonLabel.html(svTranslate('terminschutzantrag.datum_von'))
            }else{
                datumVonLabel.html(svTranslate('terminschutzantrag.datum'));
                datumBisDummySection.html(dummy);
                datumBisDummySection.find('#datumBisDummyDay').first().val('99');
                datumBisDummySection.find('#datumBisDummyMonth').first().val('99');
                datumBisDummySection.find('#datumBisDummyYear').first().val('9999');
                datumBisSection.hide();
            }
        }
        var handleIpoFH = function(){
            var vonTag = vonTagElem.val();
            var vonMonat = vonMonatElem.val();
            var vonJahr = vonJahrElem.val();
            var bisTag = bisTagElem.val();
            var bisMonat = bisMonatElem.val();
            var bisJahr = bisJahrElem.val();
            var ipoFhElem = $('#P_6');
            if(vonTag==bisTag && vonMonat==bisMonat && vonJahr==bisJahr && vonTag>0 && vonMonat>0 && vonJahr>0){
                ipoFhElem.removeAttr('checked').attr('disabled','disabled').attr('title','IGP-FH kann nicht an einem Tag stattfinden !');
            }else{
                ipoFhElem.removeAttr('disabled').removeAttr('title');
            }
            fillHiddenStufenElem();
        };
        var handleIsAenderung = function(elem){
            if($('#aenderung_0').prop('checked')==true){
                neuantragElem.slideDown();
                aenderungsantragElem.slideUp();
                metaNeuElems.slideDown();
                metaAenderungElems.slideUp();
                metaHeadline.html('');
                metaContent.html('Anträge, die unter 10 Tage vor Beginn der Veranstaltung der Hauptgeschäftsstelle des SV vorliegen, haben automatisch die Ablehnung wegen Fristunterschreitung zur Folge. Ausnahmen werden grundsätzlich nicht gewährt.');
            }else{
                if(editState==1){
                    richterEditAbbrechen.trigger('click');
            }
                aenderungsantragElem.slideDown();
                neuantragElem.slideUp();
                metaNeuElems.slideUp();
                metaAenderungElems.slideDown();
                metaHeadline.html('Daten des ursprünglichen Terminschutzantrags:');
                metaContent.html('Jede Änderung muss unverzüglich und schriftlich mitgeteilt werden, da diese erneut bestätigt werden müssen.');
            }
        };
        var initRichter = function(){
            richterElem.html('');
            richterAnzahl = richterAnzahlElem.val();
            var line = '<strong>Bisher sind noch keine Richter erfasst!</strong>';
            if(richterAnzahl>0){
                line = '<div class="table-condensed">';
                line+= '<table class="table text-nowrap">';
                line+= '<thead><tr>';
                line+= '<th>Pos.</th><th>Vor-, Nachname</th><th>Ort</th><th>Verband</th><th class="text-right">&nbsp;</th><th class="text-right">&nbsp;</th>';
                line+= '</tr></thead>';
                line+= '<tbody>';
                for(var i=0;i<richterAnzahl;i++){
                    var key = i+1;
                    var upButton = '<span style="cursor:pointer;" title="Richter ' + $('#richter'+key+'Vorname').val() + ' ' + $('#richter'+key+'Nachname').val() + ' auf Position ' + richterAbtl[i-1] + ' verschieben." class="richter-sort glyphicon glyphicon-triangle-top" data-akt="' + key + '" data-mode="up"></span>';
                    var downButton = '<span style="cursor:pointer;" title="Richter ' + $('#richter'+key+'Vorname').val() + ' ' + $('#richter'+key+'Nachname').val() + ' auf Position ' + richterAbtl[key] + ' verschieben."  class="richter-sort glyphicon glyphicon-triangle-bottom" data-akt="' + key + '" data-mode="down"></span>';
                    if(key==1){
                        upButton = '<span class="text-muted glyphicon glyphicon-triangle-top"></span>';
                    }
                    if(key==richterAnzahl){
                        downButton = '<span class="text-muted glyphicon glyphicon-triangle-bottom"></span>';
                    }
                    var sorter = '<table class="sorter"><tr><td>' + upButton + '</td></tr><tr><td>' + downButton + '</td></tr></table></span>';
                    var vorname = $('#richter'+key+'Vorname').val();
                    var nachname = $('#richter'+key+'Nachname').val();
                    var ort = $('#richter'+key+'Ort').val();
                    var verband = $('#richter'+key+'Verband').val();
                    line+= '<tr>';
                    line+= '<td style="vertical-align: middle;"><strong>' + richterAbtl[i] + '</strong></td>';
                    line+= '<td style="vertical-align: middle;">' + vorname + ' ' + nachname + '</td>';
                    line+= '<td style="vertical-align: middle;">' + ort + '</td>';
                    line+= '<td style="vertical-align: middle;">' + verband + '</td>';
                    line+= '<td style="vertical-align: middle;" class="text-right">';
                    line+= '<button title="Richter bearbeiten" type="button" class="richter-edit-button btn btn-small btn-green" data-akt="' + key + '"><span class="glyphicon glyphicon-pencil"></span></button>&nbsp;';
                    line+= '<button title="Richter löschen" type="button" class="richter-delete-button btn btn-small btn-danger" data-akt="' + key + '"><span class="glyphicon glyphicon-remove"></span></button>';
                    line+= '<td style="vertical-align: middle;">' + sorter + '</td>';
                    line+= '</td>';
                    line+= '</tr>';
                }
                line+= '</tbody>';
                line+= '</table>';
                line+= '</div>';
            }
            richterElem.append(line);
            if(richterAnzahl==maxRichters){
                richterAdd.hide();
            }else{
                richterAdd.show();
            }
        };
        var readOrtsgruppen = function(){
            $('.ortsgruppen').each(function(){
                ortsgruppenDropDowns[$(this).prop('id')] = $(this);
                ortsgruppenDropDowns[$(this).prop('id')].removeClass('hidden').removeClass('bs-select-hidden');
                $(this).remove();
            });
        };
        var readStufen = function(){
            $('.stufen').each(function(){
                stufenAreas[$(this).prop('id')] = $(this);
                stufenAreas[$(this).prop('id')].removeClass('hidden');
                $(this).remove();
            });
        };
        var readArten = function(){
            $('.arten').each(function(){
                artenDropDowns[$(this).prop('id')] = $(this);
                artenDropDowns[$(this).prop('id')].removeClass('hidden');
                $(this).remove();
            });
        };
        var executeLgnr = function(){
            var lgnr = lgnrElem.val();
            if(lgnr==''){
                lgnr = 0;
            }
            $('.ortsgruppen').each(function(){
                $(this).remove();
            });
            ortsgruppenElem.append(ortsgruppenDropDowns['ognr_'+lgnr]);
            $('#ognr_'+lgnr).selectpicker('refresh');
        };
        var executeArten = function(){
            var typ = typElem.val();
            var veranstalter = veranstalterElem.val();
            if( veranstalter == '' ){ veranstalter = 0; }
            if( typ == '' ){ typ = 0; }
            if(veranstalter==0 || typ==0){
                veranstalter=0;
                typ=0;
            }
            $('.arten').each(function(){
                $(this).remove();
            });
            artenElem.append(artenDropDowns['art_'+veranstalter+'_'+typ]);
            $('#art_'+veranstalter+'_'+typ).selectpicker('refresh');
        };
        var executeStufen = function(){
            var stufe = typElem.val();
            $('.stufen').each(function(){
                $(this).remove();
            });
            stufenElem.append(stufenAreas['stufen_'+stufe]);
            if(stufe!=''){
                // stufeSonstigeDivElem.removeClass('hidden');
            }
            fillHiddenStufenElem();
        };
        var executeOrt = function(ort){
            if(ort.val().trim()==''){
                ort.val('OG-Gelände');
            }
        };
        var fillHiddenStufenElem = function(){
            var content = '';
            $('.stufe-chk').each(function(){
                if(this.checked){
                    content = content + $(this).val() + '|';
                }
            });
            hiddenStufenElem.val(content.substr(0,content.length-1));
        };
        var executeStufeSonstige = function(){
            if(stufeSonstigeElem.val()!=''){
                stufeSonstigeCheckElem.prop('checked',true);
            }else{
                stufeSonstigeCheckElem.prop('checked',false);
            }
        };
        var executeArtSonstige = function(){
            var wert='';
            if(veranstalterElem.val()==1 && typElem.val()!=''){
                artSonstigeDivElem.removeClass('hidden');
                wert = $('.arten').find('option:selected').first().html();
                if(wert!=' '){
                    artSonstigeElem.prop('disabled',false).val(wert).focus();
                }else{
                    artSonstigeElem.prop('disabled',true);
                }
            }else{
                artSonstigeElem.val('');
                artSonstigeDivElem.addClass('hidden');
            }
        };
        var labelStufeSonstige = function(){
            stufeSonstigeElem.prop('placeholder','Sonstige Stufe');
        };
        var initiateRichterEdit = function(akt){
            editState=1;
            richterEditPanelHeader.html('Richter bearbeiten');
            richterAktElem.val(akt);
            $('.richter-edit-button').hide();
            $('.richter-delete-button').hide();
            $('.sorter').hide();
            richterAdd.slideUp();
            richterEditPanel.slideDown().removeClass('hidden');
            var richterAuswahlAkt = $('.richter-auswahl-'+typElem.val()).first();
            var editNrValue = $('#richter'+akt+'Nr').val();

            if(editNrValue=='0'){
                richterVorname.prop('disabled',false);
                richterNachname.prop('disabled',false);
                richterOrt.prop('disabled',false);
                richterVerband.prop('disabled',false);
            }else{
                richterVorname.prop('disabled',true);
                richterNachname.prop('disabled',true);
                richterOrt.prop('disabled',true);
                richterVerband.prop('disabled',true);
            }


            richterAuswahlAkt.val(editNrValue).selectpicker('refresh');
            richterNr.val(editNrValue);
            richterVorname.val($('#richter'+akt+'Vorname').val());
            richterNachname.val($('#richter'+akt+'Nachname').val());
            richterOrt.val($('#richter'+akt+'Ort').val());
            richterVerband.val($('#richter'+akt+'Verband').val());
        };
        var flushRichterEdit=function(){
            $('.richter-auswahl-'+typElem.val()).val('').selectpicker('refresh').parent().removeClass('has-error');
            $('#richterNr').val('');
            $('#richterVorname').val('').parent().removeClass('has-error');
            $('#richterNachname').val('').parent().removeClass('has-error');
            $('#richterVerband').val('').parent().removeClass('has-error');
            $('#richterOrt').val('');
            $('#richterLg').val('').selectpicker('refresh');
            errorOutElem.find('div').first().slideUp();
        };
        var deleteRichter = function(akt){
            $('#richter'+akt+'Nr').val('');
            $('#richter'+akt+'Vorname').val('');
            $('#richter'+akt+'Nachname').val('');
            $('#richter'+akt+'Ort').val('');
            $('#richter'+akt+'Verband').val('');
            if(akt<richterAnzahl){
                for(var i=akt+1;i<=richterAnzahl;i++){
                    var to=i-1;
                    $('#richter'+to+'Nr').val($('#richter'+i+'Nr').val());
                    $('#richter'+to+'Vorname').val($('#richter'+i+'Vorname').val());
                    $('#richter'+to+'Nachname').val($('#richter'+i+'Nachname').val());
                    $('#richter'+to+'Ort').val($('#richter'+i+'Ort').val());
                    $('#richter'+to+'Verband').val($('#richter'+i+'Verband').val());
                }
            }
            $('#richter'+richterAnzahl+'Nr').val('');
            $('#richter'+richterAnzahl+'Vorname').val('');
            $('#richter'+richterAnzahl+'Nachname').val('');
            $('#richter'+richterAnzahl+'Ort').val('');
            $('#richter'+richterAnzahl+'Verband').val('');
            richterAnzahl--;
            richterAnzahlElem.val(richterAnzahl);
            initRichter();

        };
        var sortRichter = function(akt,mode){
            var target;
            if(mode=='up'){
                target = akt-1;
            }else{
                target = akt+1;
            }
            var storage = {
                0:$('#richter'+target+'Nr').val(),
                1:$('#richter'+target+'Vorname').val(),
                2:$('#richter'+target+'Nachname').val(),
                3:$('#richter'+target+'Ort').val(),
                4:$('#richter'+target+'Verband').val()
            };
            $('#richter'+target+'Nr').val($('#richter'+akt+'Nr').val());
            $('#richter'+target+'Vorname').val($('#richter'+akt+'Vorname').val());
            $('#richter'+target+'Nachname').val($('#richter'+akt+'Nachname').val());
            $('#richter'+target+'Ort').val($('#richter'+akt+'Ort').val());
            $('#richter'+target+'Verband').val($('#richter'+akt+'Verband').val());
            $('#richter'+akt+'Nr').val(storage[0]);
            $('#richter'+akt+'Vorname').val(storage[1]);
            $('#richter'+akt+'Nachname').val(storage[2]);
            $('#richter'+akt+'Ort').val(storage[3]);
            $('#richter'+akt+'Verband').val(storage[4]);
            initRichter();
        };
        var validateRichter = function(){
            var typ = typElem.val();
            var richterAuswahlElem = $('.richter-auswahl-'+typ).first();
            var errors = [];
            var i=0;
            errorOutElem.html('');

            if( richterAuswahlElem.val()=='' || richterAuswahlElem.val()==null ){
                errors[i++]='Bitte Richter auswählen.';
                richterAuswahlElem.parent().addClass('has-error');
            }else{
                if(richterVorname.val()==''){
                    errors[i++]='Bitte Vorname des Richters eingeben.';
                    richterVorname.parent().addClass('has-error');
                }
                if(richterNachname.val()==''){
                    errors[i++]='Bitte Nachname des Richters eingeben.';
                    richterNachname.parent().addClass('has-error');
                }
                if(richterVerband.val()==''){
                    errors[i++]='Bitte Verband des Richters eingeben.';
                    richterVerband.parent().addClass('has-error');
                }
            }
            if(errors.length>0){
                var content='';
                for(var j in errors){
                    content += errors[j] + '<br>';
                }
                var out = '<div style="display:none;" id="errorOutContent" class="col-xs-12 alert alert-danger">'+content+'</div>';
                errorOutElem.prepend(out);
                $('#errorOutContent').slideDown();
            }
            return errors;
        };
        var checkLatestRichter = function(){
            if(
                $('#richter'+richterAnzahl+'Vorname').val()=='' &&
                $('#richter'+richterAnzahl+'Nachname').val()=='' &&
                $('#richter'+richterAnzahl+'Verband').val()==''
            ){
                richterAnzahl--;
                richterAnzahlElem.val(richterAnzahl);
                initRichter();
            }
        };
        var executeVeranstalter = function(veranstalter){
            if(typElem.val()=='P'){
                sidBeauftragterElem.slideDown();
                $('#sidBeauftragterLand').val('DE').selectpicker('refresh');
            }else{
                $('#sidBeauftragterNr').val('');
                $('#sidBeauftragterVorname').val('');
                $('#sidBeauftragterNachname').val('');
                $('#sidBeauftragterStrasse').val('');
                $('#sidBeauftragterHausnummer').val('');
                $('#sidBeauftragterPlz').val('');
                $('#sidBeauftragterOrt').val('');
                $('#sidBeauftragterLand').val('').selectpicker('refresh');
                $('#sidBeauftragterTel').val('');
                $('#sidBeauftragterFax').val('');
                $('#sidBeauftragterEmail').val('');
                sidBeauftragterElem.slideUp();
            }
        };
        var initRichterAuswahl = function(){
            var typ = typElem.val();
            $('.richter-auswahl').each(function(){
                $(this).find('option').each(function(){
                    $(this).prop('disabled',false);
                });
                $(this).val('').selectpicker('refresh').hide();
            });
            if(typ!=''){
                var richterAuswahlElem = $('.richter-auswahl-'+typ);
                richterSection.show();
                richterAuswahlElem.find('option').each(function(){
                    for(var i=1;i<=maxRichters+1;i++){
                        if($(this).val()!='0' && $(this).val()==$('#richter'+i+'Nr').val()){
                            $(this).prop('disabled',true);
                        }
                    }
                });
                richterAuswahlElem.selectpicker('refresh');
                richterAuswahlElem.show();
            }else{
                richterSection.hide();
            }
        };
        var executeRichterAuswahl = function(opt){
            if(opt.val()==0){
                richterNr.val('0');
                richterVorname.val('').prop('disabled',false);
                richterNachname.val('').prop('disabled',false);
                richterOrt.val('').prop('disabled',false);
                richterVerband.val('').prop('disabled',false);
            }else{
                richterNr.val(opt.val()).prop('disabled',true);
                richterVorname.val(opt.data('vorname')).prop('disabled',true);
                richterNachname.val(opt.data('nachname')).prop('disabled',true);
                richterOrt.val(opt.data('ort')).prop('disabled',true);
                richterVerband.val('SV').prop('disabled',true);
            }
        };
        var resetRichter = function(){
            for(var i=0;i<=maxRichters;i++){
                $('#richter'+i+'Nr').val('');
                $('#richter'+i+'Vorname').val('');
                $('#richter'+i+'Nachname').val('');
                $('#richter'+i+'Ort').val('');
                $('#richter'+i+'Verband').val('');
            }
            if(editState==1){
                richterEditAbbrechen.trigger('click');
            }
            richterAkt = 1;
            richterAnzahl = 0;
            richterAktElem.val(richterAkt);
            richterAnzahlElem.val(richterAnzahl);


            initRichter();
        };
        //////////////////////////
        // Events
        //////////////////////////
        $('.date-selector').on('change',function(){
            handleIpoFH();
        });
        isAenderungsElems.on('change',function(){
            handleIsAenderung();
        });
        terminschutzForm.on('submit',function(e){
            if(editState==1){
                if(
                    $('#richterVorname').is(":focus")||
                    $('#richterNachname').is(":focus")||
                    $('#richterOrt').is(":focus")||
                    $('#richterVerband').is(":focus")||
                    $('#richterLg').is(":focus")||
                    richterEditFertig.is(":focus")
                ){
                    richterEditFertig.trigger('click');
                }else{
                    $('html, body').animate({
                        scrollTop: richterEditPanel.offset().top-80
                    }, 800);
                    var out = '<div style="display:none;" id="errorOutContent" class="col-xs-12 alert alert-danger">Vor dem Absenden des Antrags muss dieser Dialog geschlossen werden!</div>';
                    errorOutElem.html(out);
                    $('#errorOutContent').slideDown();
                    richterEditFertig.focus();
                }
                return false;
            }else{
                $(this).submit();
            }
        });
        lgnrElem.on('change',function(){
            executeLgnr();
        });
        typElem.on('change',function(){
            executeDatum();
            executeStufen();
            executeArten();
            executeVeranstalter(veranstalterElem);
            initRichterAuswahl();
            flushRichterEdit();
            resetRichter();
            handleIpoFH();
        });
        ortElem.on('change',function(){
            executeOrt($(this));
        });
        stufenElem.on('click', '.stufe-chk', function(){
            fillHiddenStufenElem();
        });
        veranstalterElem.on('change',function(){
            executeVeranstalter($(this));
            executeArten();
            executeArtSonstige();
        });
        stufeSonstigeElem.on('blur',function(){
            executeStufeSonstige();
        });
        stufeSonstigeCheckElem.on('click',function(){
            if($(this).prop('checked')!=true){
                stufeSonstigeElem.val('');
            }
            stufeSonstigeElem.focus();
        });
        artenElem.on('change','.arten',function(){
            executeArtSonstige();
        });
        richterAdd.on('click',function(){
            richterEditMode = 'add';
            flushRichterEdit();
            initRichterAuswahl();
            richterEditPanelHeader.html('Richter hinzufügen');
            richterAkt = parseInt(richterAnzahl)+1;
            richterAktElem.val(richterAkt);
            richterAnzahl=richterAkt;
            richterAnzahlElem.val(richterAnzahl);
            richterEditPanel.slideDown().removeClass('hidden');
            editState = 1
            $(this).slideUp();
            $('.richter-edit-button').hide();
            $('.richter-delete-button').hide();
            $('.sorter').hide();
        });
        richterEditFertig.on('click',function(){
            var errors = validateRichter();
            if(errors.length<=0){
                richterAkt = richterAktElem.val();
                $('#richter'+richterAkt+'Nr').val(richterNr.val()).val();
                $('#richter'+richterAkt+'Vorname').val(richterVorname.val()).val();
                $('#richter'+richterAkt+'Nachname').val(richterNachname.val()).val();
                $('#richter'+richterAkt+'Ort').val(richterOrt.val()).val();
                $('#richter'+richterAkt+'Verband').val(richterVerband.val()).val();
                richterEditPanel.slideUp().removeClass('hidden');
                editState = 0;
                richterAdd.slideDown();
                $('.richter-edit-button').show();
                $('.richter-delete-button').show();
                initRichter();
            }
        });
        richterEditAbbrechen.on('click',function(){
            if(richterEditMode=='add'){
                richterAnzahl = parseInt(richterAnzahl)-1;
                richterAnzahlElem.val(richterAnzahl);
            }
            flushRichterEdit();
            editState=0;
            richterEditPanel.slideUp().removeClass('hidden');
            if(richterAnzahl < maxRichters){
                richterAdd.slideDown();
            }
            $('.richter-edit-button').show();
            $('.richter-delete-button').show();
            $('.sorter').show();
        });
        richterElem.on('click','.richter-edit-button',function(){
            richterEditMode='edit';
            initRichterAuswahl();
            initiateRichterEdit($(this).data('akt'));
        });
        richterElem.on('click','.richter-delete-button',function(){
            var akt = $(this).data('akt');
            var name = $('#richter'+akt+'Vorname').val() + ' ' + $('#richter'+akt+'Nachname').val();
            if(confirm('Wollen Sie den Richter ' + name + ' wirklich entfernen?')){
                deleteRichter(akt);
            }
        });
        richterElem.on('click','.richter-sort',function(){
            var akt = $(this).data('akt');
            var mode = $(this).data('mode');
            sortRichter(akt,mode);
        });
        vlUebernehmenElem.on('click',function(){
            $('#sidBeauftragterNr').val($('#veranstaltungsLeiterNr').val());
            $('#sidBeauftragterVorname').val($('#veranstaltungsLeiterVorname').val());
            $('#sidBeauftragterNachname').val($('#veranstaltungsLeiterNachname').val());
            $('#sidBeauftragterStrasse').val($('#veranstaltungsLeiterStrasse').val());
            $('#sidBeauftragterHausnummer').val($('#veranstaltungsLeiterHausnummer').val());
            $('#sidBeauftragterPlz').val($('#veranstaltungsLeiterPlz').val());
            $('#sidBeauftragterOrt').val($('#veranstaltungsLeiterOrt').val());
            $('#sidBeauftragterLand').val($('#veranstaltungsLeiterLand').val()).selectpicker('refresh');
            $('#sidBeauftragterTel').val($('#veranstaltungsLeiterTel').val());
            $('#sidBeauftragterFax').val($('#veranstaltungsLeiterFax').val());
            $('#sidBeauftragterEmail').val($('#veranstaltungsLeiterEmail').val());
        });
        richterEditPanel.on('change','.richter-auswahl',function(){
            var opt = $(this).find('option:selected').first();
            executeRichterAuswahl($(opt));
        });
        //////////////////////////
        // Inital Executions
        //////////////////////////
        dummy = datumBisDummySection.html();
        datumBisDummySection.html('');
        executeDatum();
        readOrtsgruppen();
        readStufen();
        readArten();
        executeLgnr();
        executeStufen();
        executeArten();
        executeVeranstalter(veranstalterElem);
        fillHiddenStufenElem();
        labelStufeSonstige();
        initRichter();
        checkLatestRichter();
        handleIsAenderung();
        initRichterAuswahl();
        handleIpoFH();
    };
    txSvmodulesTerminSchutzAntrag();
});