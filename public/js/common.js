/* Plugin functions */
// Cropper
var imagePreview = ".img-preview";
function initCropper(imageCrop, imageEl, ratio, option){
    var $imageCrop = $(imageCrop);
    $($imageCrop).cropper({
        aspectRatio: ratio,
        checkCrossOrigin: false, // S3 setting: <AllowedHeader>Authorization</AllowedHeader>
        //checkImageOrigin: false,
        maxContainerHeight: 100,
        preview: imagePreview,
        done: function(data) {}
    });

    var $inputImage = $(imageEl);
    if (window.FileReader) {
        $inputImage.change(function() {
            var fileReader = new FileReader(),
                    files = this.files,
                    file;
            if (!files.length) {
                cropperOptionChk(option, 'none');
                return;
            }
            file = files[0];
            if (/^image\/\w+$/.test(file.type)) {
                fileReader.readAsDataURL(file);
                fileReader.onload = function () {
                    $inputImage.val("");
                    cropperOptionChk(option, 'block');
                    $imageCrop.cropper("reset", true).cropper("replace", this.result);
                };
            } else {
                cropperOptionChk(option, 'none');
                alert("Please choose an image file.");
            }
        });
    } else {
        cropperOptionChk(option, 'none');
        $inputImage.addClass("hide");
    }
    $("#zoomIn").click(function() {$imageCrop.cropper("zoom", 0.1);});
    $("#zoomOut").click(function() {$imageCrop.cropper("zoom", -0.1);});
    $("#rotateLeft").click(function() {$imageCrop.cropper("rotate", 45);});
    $("#rotateRight").click(function() {$imageCrop.cropper("rotate", -45);});
    $("#setDrag").click(function() {$imageCrop.cropper("reset", true).cropper("replace", this.result);});
}
function cropperOptionChk(option, action){
    if(option != ''){
        $.each( option, function( key, value ) {
          if(key == 'initView'){
              $(value).css('display', action);
          }
        });
    }
}

function getImageCropBlob(imageCrop){
    var $imageCrop = $(imageCrop);
    var $getCroppedCanvas = $imageCrop.cropper('getCroppedCanvas');
    if($getCroppedCanvas){
        $getCroppedCanvas.toBlob(function (blob) {
            return blob;
        });
    } else {
        return false;
    }
}
function cropperClear(imageCrop, inputImage){
    $(inputImage).val('').trigger('change');
    $(imageCrop).cropper('clear');
}

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

function simpleLoad(btn, state, word, time = 2000) {
    if (state) {
        btn.children().addClass('fa-spin');
        if(word != '')
            btn.contents().last().replaceWith(word);
        else
            btn.contents().last().replaceWith(" Loading");
    } else {
        setTimeout(function () {
            btn.children().removeClass('fa-spin');
            if(word != '')
                btn.contents().last().replaceWith(word);
            else
                btn.contents().last().replaceWith(" Refresh");
        }, time);
    }
}

function pluginClear(plugin, el, option){
    if(plugin == 'chosen'){
        if(option == 'first-child'){
            $(el).find('option:first-child').prop('selected', true)
            .end().trigger('chosen:updated');
        } else {
            $(el).val('').trigger('chosen:updated');
        }
    } else if(plugin == 'ionRangeSlider'){
        el.reset();
    } else if(plugin == 'froala'){
        $(el).froalaEditor('html.set', '');
    } else if(plugin == 'tagsinput'){
        $(el).tagsinput('removeAll');
        $.each( option, function( index, value ) {
            $(el).tagsinput('add', value);
        });
    }
}

function radioInputClear(el, val){
    if(val == ''){
        $(el).prop( "checked", false );
    } else {
        $(el+'[value='+val+']').prop('checked', true);
    }
}

function basicFormClear(el){
    if($.isArray(el)) {
        $.each( el, function( index, value ) {
            var type = $(value).prop("type")//.attr('type');
            if( type == 'text' || type == 'textarea'){
                $(value).val('');
            } else if(type=="checkbox"){
                $(value).prop( "checked", false );
            } else if(type=="radio"){
                $(value).prop( "checked", false );
            } else if(type=="select"){
                $(value).val('');
            }
        });
    } else {
        var type = $(el).attr('type');
        if( type == 'text' || type == 'textarea'){
            $(el).val('');
        } else if(type=="checkbox"){
            $(el).prop( "checked", false );
        } else if(type=="radio"){
            $(el).prop( "checked", false );
        } else if(type=="select"){
            $(el).val('');
        }
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
