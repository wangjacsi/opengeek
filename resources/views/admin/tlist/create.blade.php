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
<!-- rangeSlider -->
<link href="{{ URL::asset('plugins/ion.rangeSlider-master/css/ion.rangeSlider.css') }}" rel="stylesheet">
<link href="{{ URL::asset('plugins/ion.rangeSlider-master/css/ion.rangeSlider.skinFlat.css') }}" rel="stylesheet">
<!-- Check box -->
<link href="{{ URL::asset('plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}" rel="stylesheet">
<!-- Cropper -->
<link href="{{ URL::asset('plugins/cropper-master/cropper.min.css') }}" rel="stylesheet">

@stop

@section('content')
  @component('admin.components.breadcrumb')
    @slot('title')
        강좌 리스트 관리 페이지
    @endslot
    <li><a href="index.html">Home</a></li>
    <li><a>Extra Pages</a></li>
    <li class="active"><strong>Tutorial List</strong></li>
  @endcomponent

  <div class="row">
      <div class="col-lg-12">
          <div class="wrapper wrapper-content animated fadeInUp">
              <div class="ibox">
                  <div class="ibox-title">
                      <h5>강좌 리스트 관리</h5>
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
                      <div class="ibox-content ibox-heading">
                        <h3><i class="fa fa-university"></i> 총 {{ $myTlists->total() }}개의 강좌 리스트가 있습니다</h3>
                        <small><i class="fa fa-tim"></i> 수정을 원하시면 리스트 오른쪽 수정버튼을 누르세요</small>
                    </div>
                      <div class="row m-b-sm m-t-sm">
                          <div class="col-md-1">
                              <button type="button" id="search-reset-btn" class="btn btn-white btn-sm" ><i class="fa fa-refresh"></i> Reset</button>
                          </div>
                          <div class="col-md-11">
                              <div class="input-group"><input type="text" id="tlist-search" placeholder="Search" class="input-sm form-control"> <span class="input-group-btn">
                                  <button type="button" id="tlist-search-btn" class="btn btn-sm btn-primary"> Go!</button> </span>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-md-12">
                              <div class="project-list">
                                  @include('admin.tlist.tlistTable')
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-12">
                              <form class="form-horizontal" action="#">
                                  <div class="form-group" id="fg-tlist-title">
                                      <label class="col-sm-2 control-label">제목</label>
                                      <div class="col-sm-10">
                                          <input id="tlist-title" type="text" class="form-control" maxlength="255">
                                      </div>
                                  </div>
                                  <div class="hr-line-dashed"></div>
                                  <div class="form-group" id="fg-tlist-link">
                                      <label class="col-sm-2 control-label">강좌 동영상 링크</label>
                                      <div class="col-sm-10">
                                          <input id="tlist-link" type="text" class="form-control" maxlength="255">
                                          <span class="help-block m-b-none">동영상 링크를 넣어주세요.(예: )</span>
                                      </div>
                                  </div>
                                  <div class="hr-line-dashed"></div>
                                  <div class="form-group" id="fg-tlist-category">
                                      <label class="col-sm-2 control-label">강좌 카테고리 선택</label>
                                      @if(count($tcategories) == 0)
                                      <div class="col-sm-5">
                                          선택할 수 있는 카테고리가 없습니다.
                                      </div>
                                      @else
                                      <div class="col-sm-5">
                                        <select id="tlist-category" data-placeholder="카테고리를 선택해 주세요..." class="chosen-select"  tabindex="2">
                                            <option value="">카테고리 선택</option>
                                            @foreach ($tcategories as $tcategory1)
                                                @foreach ($tcategory1->children as $tcategory2)
                                                    @if ($loop->first)
                                                        <optgroup label="{{$tcategory1->name}}">
                                                    @endif
                                                    <option value="{{$tcategory2->id}}">{{$tcategory2->name}}</option>
                                                    @if($loop->last)
                                                        </optgroup>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                          </select>
                                          <span class="help-block m-b-none"><a href="#">해당하는 카테고리가 없을 시 문의주세요</a></span>
                                      </div>
                                    @endif
                                  </div>
                                  <div class="hr-line-dashed"></div>

                                  <div class="form-group" id="fg-tlist-photo">
                                      <label class="col-sm-2 control-label">대표 이미지 등록</label>
                                      <div class="col-sm-10">
                                          <div class="row m-b" id="tlist-crop-view" style="display:none;">
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

                                  <div class="form-group" id="fg-tlist-status">
                                      <label class="col-sm-2 control-label">강좌 상태</label>
                                      <div class="col-sm-10" id="tlist-status">
                                          <div class="radio radio-info radio-inline">
                                              <input type="radio" class="tlist-status-check" value="1" name="radioInline" checked="">
                                              <label for="inlineRadio1"> 진행중 </label>
                                          </div>
                                          <div class="radio radio-success radio-inline">
                                              <input type="radio" class="tlist-status-check" value="2" name="radioInline">
                                              <label for="inlineRadio2"> 완료 </label>
                                          </div>
                                          <div class="radio radio-danger radio-inline">
                                              <input type="radio" class="tlist-status-check" value="3" name="radioInline">
                                              <label for="inlineRadio2"> 휴강 </label>
                                          </div>
                                          <div class="radio radio-warning radio-inline">
                                              <input type="radio" class="tlist-status-check" value="4" name="radioInline">
                                              <label for="inlineRadio2"> 비공개 </label>
                                          </div>
                                     </div>
                                  </div>
                                  <div class="hr-line-dashed"></div>
                                  <div class="form-group" id="fg-tlist-range">
                                       <label class="col-sm-2 control-label">강좌 진행률</label>
                                       <div class="col-sm-10">
                                           <input type="text" id="tlist-range" name="tutorial_range" value="" />
                                       </div>
                                  </div>
                                  <div class="hr-line-dashed"></div>
                                  <div class="form-group" id="fg-tlist-desc">
                                      <label class="col-sm-2 control-label">강좌 설명</label>
                                      <div class="col-sm-10">
                                          <textarea id="tlist-desc" class="form-control" placeholder=""></textarea>
                                      </div>
                                  </div>
                                  <div class="hr-line-dashed"></div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">태그</label>
                                      <div class="col-sm-10">
                                          <input class="tagsinput form-control" id="tlist-tags" type="text" value="amazon,aws,ruby,laravel,django"/>
                                          <span class="help-block m-b-none">최대 10개 까지 등록 가능</span>
                                      </div>
                                  </div>
                                  <div class="hr-line-dashed"></div>
                                  <div class="form-group" id="tutorial-list-group">
                                      <div class="spinner-content">
                                          @component('admin.components.spinner')
                                              @slot('type')
                                                  cube-grid
                                              @endslot
                                          @endcomponent

                                          <div class="col-sm-4 col-sm-offset-2">
                                              <button class="btn btn-primary" type="button" id="tlist-add">추가하기</button>
                                              <button class="btn btn-white" type="button" id="tlist-reset">초기화</button>
                                          </div>
                                          <div class="col-sm-10 col-sm-offset-2 m-t" id="tlist-result"></div>
                                      </div>
                                  </div>
                              </form>
                          </div>
                      </div>
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
<!-- IonRangeSlider -->
<script src="{{ URL::asset('plugins/ion.rangeSlider-master/js/ion.rangeSlider.min.js') }}"></script>
<!-- Image cropper -->
<script src="{{ URL::asset('plugins/cropper-master/cropper.min.js') }}"></script>
<!-- Q -->
<script src="{{ URL::asset('plugins/q-master/q.js') }}"></script>
<!-- Common Function -->
<script src="{{ URL::asset('js/common.js') }}"></script>
<script>
$(document).ready(function(){
    var slider;
    // tlist image crop
    initCropper('.image-crop > img', '#tlist-image', 1.35, {'initView':'#tlist-crop-view'});
    $('#imageClear').on('click' , function(){
        cropperClear('.image-crop > img', '#tlist-image');
    });
    // search
    var search = '';
    var btn = $('#search-reset-btn');
    function tlistSearchQuery(){
        search = _.trim($('#tlist-search').val());
        simpleLoad(btn, true, ' Loading');
        getTlists(1);
    }

    $('#tlist-search').keypress(function(event) {
        if ( event.which == 13 ) {
            tlistSearchQuery();
            event.preventDefault();
        }
    });

    $('#search-reset-btn').click(function () {
        simpleLoad(btn, true, ' Loading');
        $('#tlist-search').val('');
        search = '';
        getTlists(1);

    });

    $('#tlist-search-btn').on('click', function(){
        tlistSearchQuery();
    });

    // get the tutorial list data
    $(window).on('hashchange', function() {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            } else {
                getTlists(page);
            }
        }
    });
    $(document).ready(function() {
        $(document).on('click', '.pagination a', function (e) {
            getTlists($(this).attr('href').split('page=')[1]);
            e.preventDefault();
        });
    });
    function getTlists(page) {
        var url = '/tlist/getMyTlists/page?page=' + page;
        if(search != '')
            url+= '&search='+search;
        $.ajax({
            url : url,//'/tlist/getTlists/page?page=' + page,
            dataType: 'json',
        }).done(function (data) {
            $('.project-list').html(data);
            simpleLoad(btn, false, ' Reset', 500);
            location.hash = page;
        }).fail(function () {
            alert('Tutorial lists could not be loaded.');
        });
    }

    // tutorial list update
    /*var tlist_status = {!!json_encode($tlistStatus)!!};
    //var tlist_status = {'1':'진행중', '2':'완료', '3':'휴강', '4':'비공개'};
    //var tlist_status_label = {'1':'primary', '2':'success', '3':'danger', '4':'warning'};
    function appendTlist(resp){
        var html = '<tr>';
            html += '<td class="project-status">';
            html += '<span class="label label-'+tlist_status[resp.data.status]['css']+'">'+tlist_status[resp.data.status]['status']+'</span>';
            html += '</td><td class="project-title">';
            html += '<a href="">'+resp.data.title+'</a>';
            html += '<br/><small>Created '+resp.created_at+'</small></td>';
            html += '<td class="project-completion">';
            html += '<small>Completion with: '+resp.data.progress+'%</small>';
            html += '<div class="progress progress-mini">';
            html += '<div style="width: '+resp.data.progress+'%;" class="progress-bar"></div>';
            html += '</div></td>';
            html += '<td class="project-people">';
            html += '<a href=""><img alt="image" class="img-circle" src="'+resp.avatar_s+'"></a>';
            html += '</td><td class="project-actions">';
            html += '<a href="#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> View </a>';
            html += '<a href="#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </a></td></tr>';
        $('#tlist-table').append(html);
    }*/

    function tlistAjaxCallback(type, resp){
        // spinner for upload data
        $('#tutorial-list-group').children('.spinner-content').toggleClass('sk-loading');
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
            // spinner for upload data
            $('#tutorial-list-group').children('.spinner-content').toggleClass('sk-loading');
        });
    });

    // reset button : clear form data
    $('#tlist-reset').on('click', function() {
        clearEveryFormData();
    });

    function clearEveryFormData(){
        basicFormValid(['fg-tlist-title','fg-tlist-category','fg-tlist-link', 'fg-tlist-desc', 'fg-tlist-status','fg-tlist-range', 'fg-tlist-photo'], 'init', '');
        basicFormClear(['#tlist-title','#tlist-link']);
        radioInputClear('.tlist-status-check', 1);
        pluginClear('chosen', '#tlist-category');
        pluginClear('ionRangeSlider', slider);
        pluginClear('froala', '#tlist-desc');
        pluginClear('tagsinput', '#tlist-tags', ['amazon', 'aws','ruby','laravel','django']);
        cropperClear('.image-crop > img', '#tlist-image');
        $('#tlist-result').html('');
    }

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


    // Range Slider
    $("#tlist-range").ionRangeSlider({
        min: 0,
        max: 100,
        from: 5
    });
    slider = $("#tlist-range").data("ionRangeSlider");


    // Froala Editor
    $('#tutorial-desc, #tlist-desc').froalaEditor({
        toolbarButtons: ['bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'fontFamily', 'fontSize', '|', 'specialCharacters', 'color', 'emoticons', 'inlineStyle', 'paragraphStyle', '|', 'paragraphFormat', 'align', 'formatOL', 'formatUL', 'outdent', 'indent', '|', 'quote', 'insertHR', 'insertLink', 'insertImage', 'insertVideo', 'insertFile', 'insertTable', '|', 'undo', 'redo', 'clearFormatting', 'selectAll', 'html', 'applyFormat', 'removeFormat', 'fullscreen', 'print', 'help'],
        heightMin: 200,
        heightMax: 400
    });

    // Chosen
    $('#tutorial-tc-level1').chosen({width:"100%"});
    $('#tlist-category').chosen({width:"100%"});


    // Tags
    $('.tagsinput').tagsinput({
        typeahead: {
            afterSelect: function(val) { this.$element.val(""); },
            delay : 2,
            minLength: 3,
            items: 10,
            scrollHeight: 20,
            source: function(query) {
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
