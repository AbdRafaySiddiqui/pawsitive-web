$(document).ready(function(){
    $('#pruefung_sortierung').change(function(){
        var url = $('#pruefung_sortierung').val();
        location.href = url;
    });
});