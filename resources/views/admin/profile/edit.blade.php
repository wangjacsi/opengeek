@extends('admin.layouts.app')

@section('title', 'Profile')

@section('styles')
<!-- Steps -->
<link href="{{ URL::asset('plugins/steps/jquery.steps.css') }}" rel="stylesheet">
<!-- Cropper -->
<link href="{{ URL::asset('plugins/cropper-master/cropper.min.css') }}" rel="stylesheet">
<!-- Nation Flag Selecting -->
<link href="{{ URL::asset('plugins/flagstrap/css/flags.css') }}" rel="stylesheet">
<!-- Select 2 -->
<link href="{{ URL::asset('plugins/select2/select2.min.css') }}" rel="stylesheet">
<!-- Social Icon -->
<link href="{{ URL::asset('plugins/bootstrapSocial/bootstrap-social.css') }}" rel="stylesheet">
@stop

@section('content')

  @component('admin.components.breadcrumb')
    @slot('title')
        Profile Edit
    @endslot
    <li><a href="index.html">Home</a></li>
    <li><a>Extra Pages</a></li>
    <li class="active"><strong>Profile Edit</strong></li>
  @endcomponent

  <div class="wrapper wrapper-content animated fadeInRight">
      <div class="row animated fadeInRight">
          <div class="row">
              <div class="col-lg-12">
                  <div class="ibox">
                      <div class="ibox-title">
                          <h5>{{ $user->name }} 프로필</h5>
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
                        <h2>
                            프로필 수정
                        </h2>
                        <p>
                            프로필 내용을 수정해주세요.
                        </p>

                        <form id="form" action="#" class="wizard-big">
                            <h1>대표 사진</h1>
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                          <div class="col-md-6">
                                            <div class="image-crop">
                                                <img id="avatar" src="{{ $user->avatar }}">
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <h4>미리 보기</h4>
                                            <div class="img-preview img-preview-sm avatar-img"></div>
                                          </div>
                                          <div class="col-md-12 m-t">미리보기에 나타난 선택된 영역이 새로운 이미지로 반영됩니다</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                      <h4>새 이미지 업로드 하기</h4>
                                      <p>
                                          대표 이미지를 변경하실 수 있습니다.
                                      </p>
                                      <div class="btn-group">
                                          <label title="Upload image file" for="inputImage" class="btn btn-primary">
                                              <input type="file" accept="image/*" name="file" id="inputImage" class="hide">
                                              새이미지
                                          </label>
                                          <label title="Update image" id="update-avatar" class="btn btn-success">업데이트</label>
                                      </div>
                                      <br>

                                      <div class="btn-group">
                                          <button class="btn btn-white" id="zoomIn" type="button">줌인</button>
                                          <button class="btn btn-white" id="zoomOut" type="button">줌아웃</button>
                                          <button class="btn btn-white" id="rotateLeft" type="button">왼쪽 회전</button>
                                          <button class="btn btn-white" id="rotateRight" type="button">오른쪽 회전</button>
                                          <button class="btn btn-warning" id="setDrag" type="button">다시</button>
                                      </div>
                                      <div class="m-t" id="avatar-result"></div>
                                    </div>
                                </div>

                            </fieldset>

                            <h1>아이디/이메일 변경</h1>
                            <fieldset>
                                <p>아이디와 이메일을 변경하실 수 있습니다</p>
                                <div class="row">
                                    <div class="col-lg-8 form-horizontal">
                                        <div id="form-group-name" class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label class="col-sm-2 control-label">아이디</label>
                                            <div class="col-sm-10">
                                                <input id="name" name="name" type="text" class="form-control" value="{{ $user->name }}">
                                                @if ($errors->has('name'))
                                                    <span class="help-block m-b-none text-danger">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div id="form-group-email" class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                          <label class="col-sm-2 control-label">이메일</label>
                                          <div class="col-sm-10">
                                              <input id="email" name="email" type="text" class="form-control" value="{{ $user->email }}">
                                              @if ($errors->has('email'))
                                                  <span class="help-block">
                                                      <strong>{{ $errors->first('email') }}</strong>
                                                  </span>
                                              @endif
                                              <button type="button" class="btn btn btn-w-m btn-success m-t" id="update-basic">업데이트</button>
                                          </div>
                                        </div>
                                        <div class="m-t" id="basic-result"></div>
                                    </div>
                                </div>
                            </fieldset>

                            <h1>비밀번호 변경</h1>
                            <fieldset>
                                <p>비밀번호를 변경해 주세요</p>
                                <div class="row">
                                    <div class="col-lg-8 form-horizontal" id="pwd-container">
                                        <div id="form-group-password" class="m-b-none form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                            <label class="col-sm-2 control-label">비밀번호</label>
                                            <div class="col-sm-10">
                                                <input id="password" name="password" type="password"  class="form-control" >
                                                <div class="pwstrength_progress m-b-none m-t-xs" ></div>
                                            </div>
                                        </div>

                                        <div id="form-group-password-confirmation" class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                          <label class="col-sm-2 control-label">비밀번호 확인</label>
                                          <div class="col-sm-10">
                                              <input id="password-confirmation" name="password_confirmation" type="password"  class="form-control">
                                              @if ($errors->has('password_confirmation'))
                                                  <span class="help-block">
                                                      <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                  </span>
                                              @endif
                                              <button type="button" class="btn btn-w-m btn-success m-t" id="update-password">업데이트</button>
                                          </div>
                                        </div>

                                        <div class="m-t" id="password-result"></div>
                                    </div>
                                </div>
                            </fieldset>

                            <h1>기타 변경</h1>
                            <fieldset>
                              <p>소개글을 남겨주세요</p>
                              <div class="row">
                                  <div class="col-lg-12 form-horizontal">
                                      <div class="form-group">
                                          <label class="col-sm-2 control-label">소개글</label>
                                          <div class="col-sm-10">
                                              <textarea id="aboutme" class="form-control" placeholder="I love code!" rows="5">{{$user->aboutme}}</textarea>
                                          </div>
                                      </div>

                                      <div class="form-group">
                                          <label class="col-sm-2 control-label">소속</label>
                                          <div class="col-sm-10"><input id="company" name="company" type="text" class="form-control" value="{{ ($user->settings()->get('company')) ? $user->settings()->get('company') :  "" }}">
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-sm-2 control-label">역할</label>
                                          <div class="col-sm-10"><input id="position" name="position" type="text" class="form-control" value="{{ ($user->settings()->get('position')) ? $user->settings()->get('position') : "" }}">
                                          </div>
                                      </div>

                                      <div class="form-group">
                                          <label class="col-sm-2 control-label">홈페이지</label>
                                          <div class="col-sm-10"><input id="website" name="website" type="text" class="form-control" value="{{ ($user->settings()->get('website')) ? $user->settings()->get('website') : "" }}">
                                          </div>
                                      </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">국가</label>
                                            <div class="col-sm-10">
                                                <div class="flagstrap" data-input-name="country" data-selected-country="{{$user->settings()->get('nation')}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">도시</label>
                                            <div class="col-sm-10"><input id="city" name="city" type="text" class="form-control" value="{{ ($user->settings()->get('city')) ? $user->settings()->get('city') : "" }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">연락처</label>
                                            <div class="col-sm-10"><input id="phone" name="phone" type="text" class="form-control" value="{{ ($user->settings()->get('phone')) ? $user->settings()->get('phone') : "" }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">주소</label>
                                            <div class="col-sm-10">
                                                <input id="address" name="address" type="text" class="form-control" value="{{ ($user->settings()->get('address')) ? $user->settings()->get('address') : "" }}">

                                                <button type="button" class="btn btn-success btn-w-m m-t" id="update-settings">업데이트</button>
                                            </div>
                                        </div>
                                        <div class="m-t" id="settings-result"></div>
                                  </div>
                               </div>
                               <p>SNS 추가하기</p>
                               <div class="row">
                                   <div class="col-lg-12 form-horizontal">
                                       <div class="form-group">

                                           <label class="col-sm-2 control-label">SNS</label>
                                           <div class="col-sm-5 sns_select2_div">
                                               <div class="" id="my-sns">
                                                   @foreach ($user->settings()->get('SNS') as $sns => $value)
                                                       @if($value != '')
                                                       <a data-sns-link="{{$value}}" data-sns-name="{{$sns}}" class="m-b btn btn-social-icon btn-{{$sns}}" title="{{$sns}}"><span class="fa fa-{{$sns}}"></span></a>
                                                       @endif
                                                    @endforeach
                                                </div>
                                               <select class="sns_select2 js-example-responsive">
                                                    <option></option>
                                                    @foreach ($sns_list as $sns)
                                                        <option value="{{$sns}}">{{ucfirst($sns)}}</option>
                                                    @endforeach
                                                </select>
                                           </div>
                                       </div>

                                         <div class="form-group">
                                             <label class="col-sm-2 control-label" id="sns-label"></label>
                                             <div class="col-sm-10">
                                                 <input id="sns-link" type="text" class="form-control">
                                                 <button type="button" class="btn btn-success btn-w-m m-t" id="update-sns">업데이트</button>
                                                 <button type="button" class="btn btn-danger btn-w-m m-t" id="delete-sns">삭제</button>

                                                 <div class="m-t" id="sns-result"></div>
                                             </div>
                                         </div>

                                   </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection

@section('scripts')
<!-- Steps -->
<script src="{{ URL::asset('plugins/steps/jquery.steps.min.js') }}" type="text/javascript"></script>
<!-- Validation -->
<script src="{{ URL::asset('plugins/jquery-validation/jquery.validate.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('plugins/jquery-validation/additional-methods.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('plugins/jquery-validation/localization/messages_ko.js') }}" type="text/javascript"></script>
<!-- Image cropper -->
<script src="{{ URL::asset('plugins/cropper-master/cropper.min.js') }}"></script>
<!-- Nation Flag -->
<script src="{{ URL::asset('plugins/flagstrap/js/jquery.flagstrap.min.js')}}"></script>
<!-- Select 2 -->
<script src="{{ URL::asset('plugins/select2/select2.full.min.js')}}"></script>
<!-- Password meter -->
<script src="{{ URL::asset('plugins/pwstrength/pwstrength-bootstrap.min.js')}}"></script>
<script>
$(document).ready(function(){
    $("#form").steps({
        bodyTag: "fieldset",
        enableAllSteps: true,
        enablePagination: false,
        enableFinishButton: false,
    }).validate({
        errorPlacement: function (error, element)
        {
            element.before(error);
        }/*,
        rules: {
            confirm: {
                equalTo: "#password"
            }
        }*/
    });

    /* Password strength */
    // Example 3
    var pass_options = {};
    pass_options.ui = {
        container: "#pwd-container",
        showVerdictsInsideProgressBar: true,
        viewports: {
            progress: ".pwstrength_progress"
        }
    };
    pass_options.rules = {
        activated: {
            wordTwoCharacterClasses: true,
            wordRepetitions: true
        }
    };
    pass_options.common = {
        debug: true,
        usernameField: "#name"
    };
    $('#password').pwstrength(pass_options);

    var snsName = '';
    function snsFormSet(name, link){
        $('#sns-label').html('<a class="btn btn-social-icon btn-'+name+'"><span class="fa fa-'+name+'"></span></a>');
        $('#sns-link').val(link);
        snsName = name;
    }
    function snsFormInit(){
        $('#sns-label').html('');
        $('#sns-link').val('');
        snsName = '';
        sns_mode = 'add';
    }

    var sns_mode = 'add';
    function snsIconEventBind(){
        $('#my-sns a').click(function() {
            snsFormSet($(this).data('sns-name'), $(this).data('sns-link'));
            sns_mode = 'edit';
            $('#sns-result').html('');
        });
    }
    snsIconEventBind();


    function formatState (state) {
      if (!state.id) { return state.text; }
      var $state = $(
          '<span class="fa fa-'+state.id+'"> '+state.text+'</span>'
      );
      return $state;
    };

    function checkExistSNS(name){
        console.log(name);
        if($("#my-sns a[data-sns-name='"+name+"']").length > 0)
            return 1;
        else {
            return 0;
        }
    }

    $(".sns_select2").select2({
        placeholder: "Select a SNS",
        allowClear: true,
        templateResult: formatState
    }).on('select2:select', function (evt) {
        if(!checkExistSNS($(this).select2("val"))){
            sns_mode = 'add';
            snsFormSet($(this).select2("val"), '');
            $('#sns-result').html('');
        } else {
            makeAlert(2);
            alertStr = alertStr.replace(regAlertStr, '이미 사용중 입니다');
            $('#sns-result').html(alertStr);
            $(".sns_select2").trigger("select2:unselect");
        }
    }).on("select2:unselect", function(e) {
        snsFormInit();
        $(".sns_select2").val("").trigger('change');
    });

    $('#update-sns').click(function(){
        if($.trim(snsName) == ''){
            makeAlert(2);
            alertStr = alertStr.replace(regAlertStr, 'SNS를 선택해 주세요');
            $('#sns-result').html(alertStr);
            return false;
        }
        if($.trim($('#sns-link').val()) == ''){
            makeAlert(2);
            alertStr = alertStr.replace(regAlertStr, '링크를 작성해 주세요');
            $('#sns-result').html(alertStr);
            return false;
        }
        var formData = new FormData();
        formData.append('snsName', $.trim(snsName));
        formData.append('snsLink', $.trim($('#sns-link').val()));
        formData.append('mode', 'add');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': window.Laravel.csrfToken
            }
        });
        $.ajax('/profile/snsUpdate', {
              method: "POST",
              data: formData,
              processData: false,
              contentType: false,
              success: function (resp) {
                    console.log('Update success');
                    if(resp.result == 'success'){
                        makeAlert(0);
                        alertStr = alertStr.replace(regAlertStr, '업데이트 성공');
                        if(checkExistSNS(snsName)){
                            $("#my-sns a[data-sns-name='"+snsName+"']").data('sns-name',snsName);
                            $("#my-sns a[data-sns-name='"+snsName+"']").data('sns-link',$.trim($('#sns-link').val()));
                        } else {
                            $('#my-sns').append('<a data-sns-link="'+$.trim($('#sns-link').val())+'" data-sns-name="'+$.trim(snsName)+'" class="m-b btn btn-social-icon btn-'+$.trim(snsName)+'" title="'+$.trim(snsName)+'"><span class="fa fa-'+$.trim(snsName)+'"></span></a>');
                            snsIconEventBind();
                        }
                        $(".sns_select2").trigger("select2:unselect");
                    } else {
                        makeAlert(1);
                        alertStr = alertStr.replace(regAlertStr, '업데이트 실패');
                    }
                    $('#sns-result').html(alertStr);
              },
              error: function (resp) {
                    console.log('Upload error');
                    makeAlert(1);
                    alertStr = alertStr.replace(regAlertStr, '업데이트 실패');
                    $('#sns-result').html(alertStr);
              }
        });
    });

    $('#delete-sns').click(function(){
        if($.trim(snsName) == '' || sns_mode == 'add'){
            makeAlert(2);
            alertStr = alertStr.replace(regAlertStr, 'SNS를 선택해 주세요');
            $('#sns-result').html(alertStr);
            return false;
        }
        var formData = new FormData();
        formData.append('snsName', $.trim(snsName));
        formData.append('mode', 'delete');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': window.Laravel.csrfToken
            }
        });
        $.ajax('/profile/snsUpdate', {
              method: "POST",
              data: formData,
              processData: false,
              contentType: false,
              success: function (resp) {
                    console.log('Update success');
                    if(resp.result == 'success'){
                        makeAlert(0);
                        alertStr = alertStr.replace(regAlertStr, '삭제 성공');
                        if($("#my-sns a[data-sns-name='"+snsName+"']").length > 0)
                            $("#my-sns a[data-sns-name='"+snsName+"']").remove();
                        snsFormInit();
                    } else {
                        makeAlert(1);
                        alertStr = alertStr.replace(regAlertStr, '삭제 실패');
                    }
                    $('#sns-result').html(alertStr);
              },
              error: function (resp) {
                    console.log('Upload error');
                    makeAlert(1);
                    alertStr = alertStr.replace(regAlertStr, '삭제 실패');
                    $('#sns-result').html(alertStr);
              }
        });
    });



    // Nation Flags
    $('.flagstrap').flagStrap({
        placeholder: {
            value: "",
            text: "Please select a country"
        }
    });

    var $image = $(".image-crop > img")
    $($image).cropper({
        aspectRatio: 1,
        checkCrossOrigin: false, // S3 setting: <AllowedHeader>Authorization</AllowedHeader>
        //checkImageOrigin: false,
        preview: ".img-preview",
        done: function(data) {
            // Output the result data for cropping image.
        }
    });

    var $inputImage = $("#inputImage");
    if (window.FileReader) {
        $inputImage.change(function() {
            var fileReader = new FileReader(),
                    files = this.files,
                    file;

            if (!files.length) {
                return;
            }

            file = files[0];

            if (/^image\/\w+$/.test(file.type)) {
                fileReader.readAsDataURL(file);
                fileReader.onload = function () {
                    $inputImage.val("");
                    $image.cropper("reset", true).cropper("replace", this.result);
                };
            } else {
                alert("Please choose an image file.");
            }
        });
    } else {
        $inputImage.addClass("hide");
    }
    $("#zoomIn").click(function() {$image.cropper("zoom", 0.1);});
    $("#zoomOut").click(function() {$image.cropper("zoom", -0.1);});
    $("#rotateLeft").click(function() {$image.cropper("rotate", 45);});
    $("#rotateRight").click(function() {$image.cropper("rotate", -45);});
    $("#setDrag").click(function() {$image.cropper("reset");});

    // Ajax upload image
    function basicFormInit(type = 'init', error = '', msg = ''){
      if(type == 'init'){
        $('#form-group-name').removeClass('has-error');
        $('#form-group-email').removeClass('has-error');
        $('#form-group-name span').remove();
        $('#form-group-email span').remove();
      } else if(type=="error"){
        if(error == 'name'){
            $('#form-group-name').addClass('has-error');
            $('#form-group-name div').append('<span class="help-block"><strong>'+msg+'</strong></span>');
        }
        if(error == 'email'){
            $('#form-group-email').addClass('has-error');
            $('#form-group-email div').append('<span class="help-block"><strong>'+msg+'</strong></span>');
        }
      }
    }

    function passwordFormInit(type = 'init', error = '', msg = ''){
      if(type == 'init'){
        $('#form-group-password').removeClass('has-error');
        $('#form-group-password-confirmation').removeClass('has-error');
        $('#form-group-password span').remove();
        $('#form-group-password-confirmation span').remove();
      } else if(type=="error"){
        if(error == 'password'){
            $('#form-group-password').addClass('has-error');
            $('#form-group-password div').append('<span class="help-block"><strong>'+msg+'</strong></span>');
        }
        if(error == 'password-confirmation'){
            $('#form-group-password-confirmation').addClass('has-error');
            $('#form-group-password-confirmation div').append('<span class="help-block"><strong>'+msg+'</strong></span>');
        }
      }
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


    // Settings update
    $('#update-settings').click(function() {
        var formData = new FormData();
        formData.append('aboutme', $('#aboutme').val());
        formData.append('settings', JSON.stringify({'company':$('#company').val(),
                        'position':$('#position').val(),
                        'website': $('#website').val(),
                        'nation':$('select[name=country] option:selected').val(),
                        'city': $('#city').val(),
                        'website': $('#website').val(),
                        'phone': $('#phone').val(),
                        'address': $('#address').val()
                    }));
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': window.Laravel.csrfToken
            }
        });
        $.ajax('/profile/settingsUpdate', {
          method: "POST",
          data: formData,
          dataType: "text",
          processData: false,
          contentType: false,
          success: function (resp) {
            console.log('Update success');
            resp = JSON.parse(resp);
            if(resp.result == 'success'){
                makeAlert(0);
                alertStr = alertStr.replace(regAlertStr, '업데이트 성공');
            } else if(resp.result == 'none'){
                makeAlert(2);
                alertStr = alertStr.replace(regAlertStr, '변경사항이 없습니다');
            } else {
                makeAlert(1);
                alertStr = alertStr.replace(regAlertStr, '업데이트 실패');
            }
            $('#settings-result').html(alertStr);
          },
          error: function (resp) {
            console.log('Upload error');
            makeAlert(1);
            alertStr = alertStr.replace(regAlertStr, '업데이트 실패');
            $('#settings-result').html(alertStr);
          }
      });
    });

    // password update
    $('#update-password').click(function() {
        passwordFormInit('init');
        var formData = new FormData();
        formData.append('password', $('#password').val());
        formData.append('password_confirmation', $('#password-confirmation').val());
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': window.Laravel.csrfToken
            }
        });
        $.ajax('/profile/passwordUpdate', {
          method: "POST",
          data: formData,
          processData: false,
          contentType: false,
          success: function (resp) {
            console.log('Update success');
            if(resp.result == 'success'){
              makeAlert(0);
              alertStr = alertStr.replace(regAlertStr, '업데이트 성공');
            } else if(resp.result == 'none'){
              makeAlert(2);
              alertStr = alertStr.replace(regAlertStr, '변경사항이 없습니다');
            } else {
              if('password' in resp.errors){
                passwordFormInit('error', 'password', resp.errors.password);
              }
              if('password_confirmation' in resp.errors){
                passwordFormInit('error', 'password_confirmation', resp.errors.password_confirmation);
              }
              makeAlert(1);
              alertStr = alertStr.replace(regAlertStr, '업데이트 실패');
            }
            $('#password-result').html(alertStr);
          },
          error: function (resp) {
            console.log('Upload error');
            makeAlert(1);
            alertStr = alertStr.replace(regAlertStr, '업데이트 실패');
            $('#password-result').html(alertStr);
          }
        });
    });

    $('#update-basic').click(function() {
        basicFormInit('init');
        var formData = new FormData();
        formData.append('name', $('#name').val());
        formData.append('email', $('#email').val());
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': window.Laravel.csrfToken
            }
        });
        $.ajax('/profile/basicUpdate', {
          method: "POST",
          data: formData,
          processData: false,
          contentType: false,
          success: function (resp) {
            console.log('Update success');
            if(resp.result == 'success'){
              makeAlert(0);
              alertStr = alertStr.replace(regAlertStr, '업데이트 성공');
            } else if(resp.result == 'none'){
              makeAlert(2);
              alertStr = alertStr.replace(regAlertStr, '변경사항이 없습니다');
            } else {
              if('name' in resp.errors){
                basicFormInit('error', 'name', resp.errors.name);
              }
              if('email' in resp.errors){
                basicFormInit('error', 'email', resp.errors.email);
              }
              makeAlert(1);
              alertStr = alertStr.replace(regAlertStr, '업데이트 실패');
            }
            $('#basic-result').html(alertStr);
          },
          error: function (resp) {
            console.log('Upload error');
            makeAlert(1);
            alertStr = alertStr.replace(regAlertStr, '업데이트 실패');
            $('#basic-result').html(alertStr);
          }
        });
    });

    $('#update-avatar').click(function(){
        $image.cropper('getCroppedCanvas').toBlob(function (blob) {
            var formData = new FormData();
            formData.append('croppedImage', blob);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': window.Laravel.csrfToken
                }
            });

            $.ajax('/profile/avatarUpload', {
              method: "POST",
              data: formData,
              processData: false,
              contentType: false,
              success: function (resp) {
                console.log('Upload success');
                if(resp.result == 'success'){
                  makeAlert(0);
                  alertStr = alertStr.replace(regAlertStr, '이미지 변경 성공');
                } else {
                  makeAlert(1);
                  alertStr = alertStr.replace(regAlertStr, '이미지 변경 실패.');
                }
                $('#avatar-result').html(alertStr);
              },
              error: function (resp) {
                console.log(resp);
                console.log('Upload error');
              }
            });
        });
    });
});
</script>
@endsection
