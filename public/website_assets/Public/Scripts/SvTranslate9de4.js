var svTranslate = function(id,arguments,pack){
    var i18n;
    if( typeof id == 'undefined'){
        console.log('translate id missing!!');
        return '';
    }else if(id==''){
        console.log('translate id missing!!');
        return '';
    }
    if(typeof pack === 'undefined' || pack === 'svmodules' || pack === '') {
        try{
            i18n = i18nsvmodules;
        }catch(error){
            console.log(error)
            return id;
        }
    }else{
        console.log('Die translation-source fehlt');
        return;
    }
    if(typeof i18n[id] === 'undefined'){
        console.log('no translation found for id: ' + id);
        return id;
    }else{
        var translated = i18n[id];
        if(typeof arguments === 'undefined'){
            return translated;
        }else{
            for(var i in arguments){
                var myRegExp = new RegExp('{'+i+'}','i');
                translated = translated.replace(myRegExp,arguments[i]);
            }
            return translated;
        }
    }
};