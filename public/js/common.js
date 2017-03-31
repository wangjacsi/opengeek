var alertStr ='';
var regAlertStr = /__CONT__/g;
function makeAlert(type){
    if(type==0) {
        alertStr = '<div class="alert alert-success alert-dismissable">';
        alertStr += '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>';
        alertStr += '__CONT__ </div>';
    } else if(type==1){
        alertStr = '<div class="alert alert-danger alert-dismissable">';
        alertStr += '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>';
        alertStr += '__CONT__ </div>';
    }else {
        alertStr = '<div class="alert alert-warning alert-dismissable">';
        alertStr += '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>';
        alertStr += '__CONT__ </div>';
    }
}

function basicFormValid(el, type = 'init', msg = ''){
    if($.isArray(el)) {
        $.each( el, function( index, value ) {
            if(type == 'init'){
                $('#'+value).removeClass('has-error');
                $('#'+value+' span.help-block-error').remove();
            } else if(type=="error"){
                $('#'+value).addClass('has-error');
                $('#'+value+' div').first().append('<span class="help-block help-block-error"><strong>'+msg+'</strong></span>');
            }
        });
    } else {
        if(type == 'init'){
            $('#'+el).removeClass('has-error');
            $('#'+el+' span.help-block-error').remove();
        } else if(type=="error"){
            $('#'+el).addClass('has-error');
            $('#'+el+' div').first().append('<span class="help-block help-block-error"><strong>'+msg+'</strong></span>');
        }
    }
}



function AjaxRun(ajaxUrl, ajaxType, ajaxData, message, callback){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': window.Laravel.csrfToken
        }
    });
    $.ajax(ajaxUrl, {
          method: ajaxType,
          data: ajaxData,
          processData: false,
          contentType: false,
          success: function (resp) {
                if(resp.result == 'success'){
                    callback('success', resp);
                    if(message.length > 0){
                        if(success in message){
                            console.log(message.success);
                        }
                    }
                } else {
                    callback(resp.result, resp);
                    console.log(resp.result);
                }
          },
          error: function (resp) {
                if(message.length > 0){
                    if(error in message){
                        console.log(message.error);
                    }
                }
                callback('fail', resp);
          }
    });
}
