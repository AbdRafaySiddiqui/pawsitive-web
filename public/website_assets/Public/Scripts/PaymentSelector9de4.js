function ccClientInfo(str,severity){
    var errorOutputField = $('#ccErrorOutputField');
    errorOutputField.removeClass('alert-danger alert-success');
    if(severity === 'error'){
        errorOutputField.addClass('alert-danger').html(str).slideDown();
    }else if(severity === 'success'){
        errorOutputField.addClass('alert-success').html(str).show();
    }
    // setTimeout(function(){errorOutputField.removeClass('alert-success alert-danger').hide().html('');},3500);
}
function ccSpecialFieldsAreValid(){
    var firstname = $('#firstname');
    var lastname = $('#lastname');
    if(firstname.val()===''){
        ccClientInfo(svTranslate('payment.creditcard.error.data_missing.firstname',[],'svmodules'),'error');
        return false;
    }else if(lastname.val()===''){
        ccClientInfo(svTranslate('payment.creditcard.error.data_missing.lastname',[],'svmodules'),'error');
        return false;
    }else{
        return true;
    }
}
var paymentSelector = function(){
    ///////////////////////////////////////////////////
    // PaymentSelector
    ///////////////////////////////////////////////////
    var zahlart = $('#zahlart');
    var lastschriftdetails =$('#lastschriftdetails');
    var kreditkartendetails =$('#kreditkartendetails');
    var submitbutton = $('#order-submit');
    var confTag = $('#bsPayOneConf');
    var bankcountries = $('#bankcountries');
    var giroPayDetails = $('#giroPayDetails');
    var paysystem = $('#paysystem');
    var shippingDetails = $('#shippingDetails');
    var request, config;
    config = {
        fields: {
            cardpan: {
                selector: "cardpan",
                type: "text",
                style: "font-size: 1em; border: 1px solid #888;height:33px;padding-left: 10px;",
                iframe: {
                    width: "220px"
                }
            },
            cardcvc2: {
                selector: "cardcvc2",
                type: "text",
                style: "font-size: 1em; border: 1px solid #888;height:33px;padding-left: 10px;",
                size: "3",
                maxlength: "3",
                length: { "V": 3, "M": 3 , "O": 3 }

            },
            cardexpiremonth: {
                selector: "cardexpiremonth",
                type: "select",
                size: "2",
                maxlength: "2",
                style: "font-size: 1em; border: 1px solid #888;height:33px;",
                iframe: {
                    width: "50px"
                }
            },
            cardexpireyear: {
                selector: "cardexpireyear",
                type: "select",
                style: "font-size: 1em; border: 1px solid #888;height:33px;",
                iframe: {
                    width: "80px"
                }
            }
        },
        defaultStyle: {
            input: "font-size: 1em; border: 1px solid #888; width: 200px;",
            select: "font-size: 1em; border: 1px solid #888;",
            iframe: {
                height: "33px",
                width: "220px"
            }
        },
        language: confTag.data('language') === 'de' ? Payone.ClientApi.Language.de : Payone.ClientApi.Language.en
    };
    request = {
        mode: confTag.data('ccmode'),
        mid: confTag.data('mid'),
        aid: confTag.data('aid'),
        portalid: confTag.data('portalid'),
        request: 'creditcardcheck',
        responsetype: 'JSON',
        encoding: confTag.data('encoding'),
        storecarddata: 'yes',
        hash: confTag.data('hash')
    };
    var iframes = new Payone.ClientApi.HostedIFrames(config, request);
    submitbutton.on('click',function(e){
        if(zahlart.val()==='2'){
            e.preventDefault();
            return checkCreditCard();
        }
    });
    $('#cardtype').on('change',function(){
        iframes.setCardType(this.value);
    });
    function checkCreditCard() {
        if (iframes.isComplete()) {
            if(ccSpecialFieldsAreValid()){
                iframes.creditCardCheck('checkCallback');
            }
        } else {
            if(iframes.isCardTypeComplete() === false){
                ccClientInfo(svTranslate('payment.creditcard.error.data_missing.cardtype',[],'svmodules'),'error');
            }else if(iframes.isCardpanComplete() === false){
                ccClientInfo(svTranslate('payment.creditcard.error.data_missing.cardpan',[],'svmodules'),'error');
            }else if(iframes.isCvcComplete() === false){
                ccClientInfo(svTranslate('payment.creditcard.error.data_missing.cvc',[],'svmodules'),'error');
            }else if(iframes.isExpireMonthComplete() === false){
                ccClientInfo(svTranslate('payment.creditcard.error.data_missing.expire_month',[],'svmodules'),'error');
            }else if(iframes.isExpireYearComplete() === false){
                ccClientInfo(svTranslate('payment.creditcard.error.data_missing.expire_year',[],'svmodules'),'error');
            }else{
                ccClientInfo(svTranslate('payment.creditcard.error.data_missing',[],'svmodules'),'error');
            }
        }
    }
    lastschriftdetails.hide();
    kreditkartendetails.hide();
    giroPayDetails.hide();

    zahlart.change(function(){
        var transPaySystem = ['','paypal','saferpay','lastschrift','paydirect','sofort','giropay'];
        paysystem.val(transPaySystem[parseInt($(this).val())]);
        $('.payment-image').hide();

        $('#paymentPreviewImage'+$(this).val()).show();


        if($(this).val()==='5') {
            bankcountries.slideDown();
        }else{
            bankcountries.hide();
        }

        if($(this).val()==='4'){
            shippingDetails.slideDown();
        }else{
            shippingDetails.hide();
        }

        if($(this).val()==='6') {
            giroPayDetails.slideDown();
        }else{
            giroPayDetails.hide();
        }

        if($(this).val()==='3'){
            kreditkartendetails.hide();
            lastschriftdetails.slideDown();
        }else if($(this).val()==='2'){
            lastschriftdetails.hide();
            kreditkartendetails.slideDown();
        }else{
            lastschriftdetails.hide();
            kreditkartendetails.hide();
        }
    });
    zahlart.change();
};
var checkCallback = function(response) {
    if (response.status === "VALID") {
        ccClientInfo(svTranslate('payment.creditcard.success.info',[],'svmodules'),'success');
        document.getElementById("pseudocardpan").value = response.pseudocardpan;
        document.getElementById("truncatedcardpan").value = response.truncatedcardpan;
        document.getElementById('bezahlvorgang').submit();
    }else if(response.status === "INVALID"){
        ccClientInfo(response.errormessage,'error');
    }else if(response.status === 'ERROR'){
        ccClientInfo(response.errormessage,'error');
    }
}
$(document).ready(function(){
    paymentSelector();
});