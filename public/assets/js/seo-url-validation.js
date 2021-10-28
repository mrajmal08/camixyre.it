// Url Validation
$(document).ready(function(){

    $('.slug').on("cut copy paste",function(e) {
        e.preventDefault();
    });

    if($('#url_en').val().length <= 0){
        $('#url_it').prop('disabled', true);
    }
    if($('#url_it').val().length <= 0){
        $('#url_fr').prop('disabled', true);
    }
    if($('#url_fr').val().length <= 0){
        $('#url_es').prop('disabled', true);
    }
    if($('#url_es').val().length <= 0){
        $('#url_de').prop('disabled', true);
    }

    $('#url_en').on('input', function(){
        $('#url_it').prop('disabled', false);
        urlEnValue = $(this).val();
    });

    $("#url_en").keyup(function(){
        urlItValue = $(this).val();
        if(urlEnValue == ""){
            $('#urLMsg').html("<p class='text-danger'>Error Urls Are Matching Or Empty</p>");
            $('.submit-add-btn').attr('disabled', true);
            $('#url_it').prop('disabled', true);
            return false;
        }else{
            $('#urLMsg').html("");
            $('#url_it').prop('disabled', false);
            $('.submit-add-btn').attr('disabled', false);
        }
    });

    $("#url_it").keyup(function(){
        urlItValue = $(this).val();
        if(urlItValue == urlEnValue || urlItValue == ""){
            $('#urLMsg').html("<p class='text-danger'>Error Urls Are Matching Or Empty</p>");
            $('.submit-add-btn').attr('disabled', true);
            $('#url_fr').prop('disabled', true);
            return false;
        }else{
            $('#urLMsg').html("");
            $('#url_fr').prop('disabled', false);
            $('.submit-add-btn').attr('disabled', false);
        }
    });

    $("#url_fr").keyup(function(){
        urlFrValue = $(this).val();
        if(urlFrValue == urlEnValue || urlFrValue == urlItValue || urlFrValue == ""){
            $('#urLMsg').html("<p class='text-danger'>Error Urls Are Matching Or Empty</p>");
            $('.submit-add-btn').attr('disabled', true);
            $('#url_es').prop('disabled', true);
            return false;
        }else{
            $('#urLMsg').html("");
            $('#url_es').prop('disabled', false);
            $('.submit-add-btn').attr('disabled', false);
        }
    });

    $("#url_es").keyup(function(){
        urlEsValue = $(this).val();
        if(urlEsValue == urlEnValue || urlEsValue == urlItValue || urlEsValue == urlFrValue || urlEsValue == ""){
            $('#urLMsg').html("<p class='text-danger'>Error Urls Are Matching Or Empty</p>");
            $('.submit-add-btn').attr('disabled', true);
            $('#url_de').prop('disabled', true);
            return false;
        }else{
            $('#urLMsg').html("");
            $('#url_de').prop('disabled', false);
            $('.submit-add-btn').attr('disabled', false);
        }
    });

    $("#url_de").keyup(function(){
        urlDeValue = $(this).val();
        if(urlDeValue == urlEnValue || urlDeValue == urlItValue || urlDeValue == urlFrValue || urlDeValue == urlEsValue || urlDeValue == ""){
            $('#urLMsg').html("<p class='text-danger'>Error Urls Are Matching Or Empty</p>");
            $('.submit-add-btn').attr('disabled', true);
            return false;
        }else{
            $('#urLMsg').html("<p class='text-success'>All Urls Are Unique And Ready</p>");
            $('.submit-add-btn').attr('disabled', false);
            return true;
        }
    });

});