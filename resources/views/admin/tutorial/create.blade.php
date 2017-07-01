@extends('admin.layouts.app')

@section('title', 'Profile')

@section('styles')
<!-- Chosen -->
<link href="{{ URL::asset('plugins/chosen_v1.6.2/chosen.min.css') }}" rel="stylesheet">
<!-- tags -->
<link href="{{ URL::asset('plugins/bootstrap-tagsinput-latest/dist/bootstrap-tagsinput.css') }}" rel="stylesheet">
<!-- Froala Editor -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css">
<link href="{{ URL::asset('plugins/froala_editor_2.5.1/css/froala_editor.pkgd.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('plugins/froala_editor_2.5.1/css/froala_style.min.css') }}" rel="stylesheet">
<!-- Check box -->
<link href="{{ URL::asset('plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}" rel="stylesheet">
<!-- Cropper -->
<link href="{{ URL::asset('plugins/cropper-master/cropper.min.css') }}" rel="stylesheet">

@stop

@section('content')
  @component('admin.components.breadcrumb')
    @slot('title')
        강좌 올리기
    @endslot
    <li><a href="index.html">Home</a></li>
    <li><a>Extra Pages</a></li>
    <li class="active"><strong>New Tutorial</strong></li>
  @endcomponent

  <div class="wrapper wrapper-content">
      <div class="row animated fadeInRight">

          <div class="col-lg-12">
              <div class="ibox float-e-margins">
                  <div class="ibox-title">
                      <h5>새로운 강좌 올리기 <small>아래의 양식을 작성하여 주세요.</small></h5>
                      <div class="ibox-tools">
                          <a class="collapse-link">
                              <i class="fa fa-chevron-up"></i>
                          </a>
                          <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                              <i class="fa fa-wrench"></i>
                          </a>
                          <ul class="dropdown-menu dropdown-user">
                              <li><a href="#">Config option 1</a>
                              </li>
                              <li><a href="#">Config option 2</a>
                              </li>
                          </ul>
                          <a class="close-link">
                              <i class="fa fa-times"></i>
                          </a>
                      </div>
                  </div>
                  <div class="ibox-content">
                      <form class="form-horizontal">
                          <div class="form-group" id="fg-tutorial-title">
                              <label class="col-sm-2 control-label">제목</label>
                              <div class="col-sm-10"><input type="text" class="form-control"></div>
                          </div>
                          <div class="hr-line-dashed"></div>
                          <div class="form-group" id="fg-tutorial-link">
                              <label class="col-sm-2 control-label">강좌 동영상 링크</label>
                              <div class="col-sm-10"><input type="text" class="form-control"> <span class="help-block m-b-none">동영상 링크를 넣어주세요.(예: )</span>
                              </div>
                          </div>
                          <div class="hr-line-dashed"></div>
                          <div class="form-group">
                              <label class="col-sm-2 control-label">강좌 리스트 선택</label>
                              <div class="col-sm-5">
                                <select id="tutorial-tc-level1" data-placeholder="강좌를 선택해 주세요..." class="chosen-select"  tabindex="2">
                                      <option value="">강좌 선택</option>
                                      <option>라라벨 프레임워크 5.4</option>
                                      <option>Python으로 웹 개발까지</option>
                                      <option>PHP 기초 시작하기</option>
                                      <option>Ruby on rails 끝장내기</option>
                                  </select>
                                  <span class="help-block m-b-none">대분류 <a href="#tutorial-list-group"> 강좌 리스트 추가하기</a></span>
                              </div>
                          </div>
                          <div class="hr-line-dashed"></div>

                          <div class="form-group" id="fg-tutorial-photo">
                              <label class="col-sm-2 control-label">대표 이미지 등록</label>
                              <div class="col-sm-10">
                                  <div class="row m-b" id="tutorial-crop-view" style="display:none;">
                                        <div class="col-md-6">
                                          <div class="image-crop">
                                              <img >
                                          </div>
                                        </div>
                                        <div class="col-md-6">
                                          <h4>미리 보기</h4>
                                          <div class="img-preview img-preview-sm tutorial-img"></div>
                                        </div>
                                  </div>

                                  <div class="row">
                                      <div class="col-md-6">
                                          <label title="Upload image file" for="tlist-image" class="btn btn-primary">
                                              <input type="file" accept="image/*" name="file" id="tlist-image" class="hide">
                                              새이미지
                                          </label>

                                          <button class="btn btn-warning" id="setDrag" type="button">다시</button>
                                          <button class="btn btn-white" id="imageClear" type="button">클리어</button>
                                      </div>
                                  </div>

                              </div>
                          </div>
                          <div class="hr-line-dashed"></div>

                          <div class="form-group">
                              <label class="col-sm-2 control-label">태그</label>
                              <div class="col-sm-10">
                                  <input class="tagsinput form-control" type="text" id="tutorial-tags" value="amazon,aws,ruby,Amsterdam,Washington"/>
                              </div>
                          </div>
                          <div class="hr-line-dashed"></div>

                          <div class="form-group">
                              <label class="col-sm-2 control-label">강좌 설명</label>
                              <div class="col-sm-10">
                                  <textarea id="tutorial-desc" class="form-control" placeholder=""></textarea>
                              </div>
                          </div>
                          <div class="hr-line-dashed"></div>

                          <div class="form-group">
                              <div class="col-sm-4 col-sm-offset-2">
                                  <button class="btn btn-primary" type="submit">강좌 올리기</button>
                                  <button class="btn btn-white" type="submit">임시저장</button>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>

      </div>

  </div>
@endsection

@section('scripts')
<!-- Chosen -->
<script src="{{ URL::asset('plugins/chosen_v1.6.2/chosen.jquery.js') }}" type="text/javascript"></script>
<!-- Tags Input -->
<script src="{{ URL::asset('plugins/bootstrap-tagsinput-latest/dist/bootstrap-tagsinput.js') }}" type="text/javascript"></script>
<!-- https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/examples/ -->
<!-- Typeahead -->
<script src="{{ URL::asset('plugins/Bootstrap-3-Typeahead-master/bootstrap3-typeahead.min.js') }}" type="text/javascript"></script>
<!-- https://github.com/bassjobsen/Bootstrap-3-Typeahead -->
<!-- Froala Editor -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/mode/xml/xml.min.js"></script>
<script src="{{ URL::asset('plugins/froala_editor_2.5.1/js/froala_editor.pkgd.min.js') }}" type="text/javascript"></script>
<!-- Image cropper -->
<script src="{{ URL::asset('plugins/cropper-master/cropper.min.js') }}"></script>
<!-- Q -->
<script src="{{ URL::asset('plugins/q-master/q.js') }}"></script>
<!-- Common Function -->
<script src="{{ URL::asset('js/common.js') }}"></script>
<script>
$(document).ready(function(){
    // tlist image crop
    /*initCropper('.image-crop > img', '#tlist-image', 1.35, {'initView':'#tlist-crop-view'});
    $('#imageClear').on('click' , function(){
        cropperClear('.image-crop > img', '#tlist-image');
    });*/

    function tlistAjaxCallback(type, resp){
        //console.log(resp);
        if(type== 'validerror'){
            $.each( resp.errors, function( key, value ) {
                basicFormValid('fg-tlist-'+key, 'error', value);
            });
        } else if(type== 'success'){
            getTlists(1);
            basicFormClear(['#tlist-title','#tlist-link']);
            radioInputClear('.tlist-status-check', 1);
            pluginClear('chosen', '#tlist-category');
            pluginClear('ionRangeSlider', slider);
            pluginClear('froala', '#tlist-desc');
            pluginClear('tagsinput', '#tlist-tags', ['amazon', 'aws','ruby','laravel','django']);
            cropperClear('.image-crop > img', '#tlist-image');
            makeAlert(0);
            alertStr = alertStr.replace(regAlertStr, '강좌 리스트 생성 성공');
            $('#tlist-result').html(alertStr);
        } else {
            makeAlert(1);
            alertStr = alertStr.replace(regAlertStr, '강좌 리스트 생성 실패');
            $('#tlist-result').html(alertStr);
        }
    }

    //var $getBlob;
    $('#tlist-add').on('click', function (){
        basicFormValid(['fg-tlist-title','fg-tlist-category','fg-tlist-link', 'fg-tlist-desc', 'fg-tlist-status','fg-tlist-range', 'fg-tlist-photo'], 'init', '');
        getFormData().then(function(result){
            AjaxRun('/tlist', 'POST', result, {'success':'강좌 리스트 추가 성공',
                    'error':'강좌 리스트 추가 실패'}, tlistAjaxCallback);
        });
    });

    function getFormData(){
        var deferred = Q.defer();
        var formData = new FormData();
        formData.append('title', $('#tlist-title').val());
        formData.append('video_link', $('#tlist-link').val());
        formData.append('category', $('#tlist-category').val());
        formData.append('desc', $("#tlist-desc").val());
        formData.append('status', $('#tlist-status .tlist-status-check:checked').val());
        formData.append('progress', $("#tlist-range").prop("value"));
        formData.append('tags', $("#tlist-tags").val());
        var $getCroppedCanvas = $(".image-crop > img").cropper('getCroppedCanvas');
        if($getCroppedCanvas){
            $getCroppedCanvas.toBlob(function (blob) {
                formData.append('photo', blob);
                deferred.resolve(formData);
            });
        } else {
            deferred.resolve(formData);
        }
        return deferred.promise;
    }

    // Froala Editor
    $('#tutorial-desc, #tlist-desc').froalaEditor({
        toolbarButtons: ['bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'fontFamily', 'fontSize', '|', 'specialCharacters', 'color', 'emoticons', 'inlineStyle', 'paragraphStyle', '|', 'paragraphFormat', 'align', 'formatOL', 'formatUL', 'outdent', 'indent', '|', 'quote', 'insertHR', 'insertLink', 'insertImage', 'insertVideo', 'insertFile', 'insertTable', '|', 'undo', 'redo', 'clearFormatting', 'selectAll', 'html', 'applyFormat', 'removeFormat', 'fullscreen', 'print', 'help'],
        heightMin: 200,
        heightMax: 400
    });

    // Chosen
    $('#tutorial-tc-level1').chosen({width:"100%"});

    // Tags
    $('.tagsinput').tagsinput({
        typeahead: {
            afterSelect: function(val) { this.$element.val(""); },
            delay : 2,
            minLength: 3,
            items: 10,
            scrollHeight: 20,
            source: function(query) {
                //var formData = new FormData();
                //formData.append('query', query);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': window.Laravel.csrfToken
                    }
                });
                return $.ajax('/tag/findGet/'+query, {
                      method: "POST",
                      dataType: "json",
                      data: [],
                      processData: false,
                      contentType: false,
                      success: function (resp) {
                          return resp;
                      }
                  });
            }
        },
        freeInput: true,
        trimValue: true,
        maxTags: 10
    });


});
</script>
@endsection
