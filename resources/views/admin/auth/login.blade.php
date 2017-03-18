<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ config('app.name') }} | Login </title>

    <link rel="stylesheet" href="{{ URL::asset('admin/css/vendor.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('admin/css/app.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('admin/css/custom.css') }}" />

    <!-- custom insert -->
    <link href="{{ URL::asset('plugins/css/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('plugins/css/bootstrapSocial/bootstrap-social.css') }}" rel="stylesheet">



</head>

<body class="gray-bg">

    <div class="loginColumns animated fadeInDown">
        <div class="row">

            <div class="col-md-6">
                <h2 class="font-bold">Welcome to IN+</h2>

                <p>
                    Perfectly designed and precisely prepared admin theme with over 50 pages with extra new web app views.
                </p>

                <p>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                </p>

                <p>
                    When an unknown printer took a galley of type and scrambled it to make a type specimen book.
                </p>

                <p>
                    <small>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</small>
                </p>

            </div>
            <div class="col-md-6">
                <div class="ibox-content">
                    <form id="form-login" class="m-t" role="form" action="{{ route('login') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('email') ? "has-error" : "" }}">
                            <input type="email" name="email" class="form-control" placeholder="이메일 주소" value="{{ old('email') }}" required>
                        </div>
                        <div class="form-group {{ $errors->has('password') ? "has-error" : "" }}">
                            <input type="password" name="password" class="form-control" placeholder="비밀번호" required>
                        </div>

                        <div class="checkbox checkbox-primary">
                            <input value="1" id="checkbox1" type="checkbox" name="remember" value="{{ old('remember') }}">
                            <label for="checkbox1">
                                로그인 정보 저장
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block full-width m-b">로그인</button>

                        @if (count($errors) > 0)
                        <div class="alert alert-danger alert-dismissable">
                          <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
                          <strong>로그인 실패</strong><br>
                          이메일 또는 패스워드를 다시 확인하시기 바랍니다.
                        </div>
                        @endif

                        @if (session('notice'))
                            <div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
                                {{ session('notice') }}
                            </div>
                        @endif

                        @if (session('warning'))
                            <div class="alert alert-danger alert-dismissable">
                              <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
                              {{ session('warning') }}
                            </div>
                        @endif

                        <!-- Social Login -->
                        <a class="btn btn-block btn-social btn-facebook" href="{{ url('socialAuth/facebook') }}">
                            <span class="fa fa-facebook"></span> Facebook 로그인
                        </a>
                        <a class="btn btn-block btn-social btn-instagram" href="{{ url('socialAuth/instagram') }}">
                            <span class="fa fa-instagram"></span> Instagram 로그인
                        </a>
                        <a class="btn btn-block btn-social btn-google m-b" href="{{ url('socialAuth/google') }}">
                            <span class="fa fa-google"></span> Google 로그인
                        </a>

                        <p class="text-muted m-t">
                            <small>계정이 없으신가요?</small>
                        </p>
                        <a class="btn btn-white btn-block" href="{{ route('register') }}">가입하기</a>
                    </form>

                    <p class="m-t">
                      <small><a class="text-danger" href="{{ url('/password/reset') }}">
                          비밀번호 재설정
                      </a></small><br>
                      <small><a class="text-info" href="{{ route('activation') }}">사용자 인증 이메일 보내기</a></small>
                    </p>
                    <p>
                        <small>{{ config('app.name') }} <a class="text-info" href="#">이용약관</a>, <a class="text-info" href="#">개인정보취급방침</a></small>
                    </p>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-6 col-xs-6">
                <strong>Copyright</strong> {{ config('app.name') }}
            </div>
            <div class="col-md-6 col-xs-6 text-right">
                &copy; 2016-2017
            </div>
        </div>
    </div>

    <script src="{{ URL::asset('plugins/jquery/jquery-3.1.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('plugins/jquery/jquery-migrate-3.0.0.min.js') }}" type="text/javascript"></script>
    <!-- Validation -->
    <script src="{{ URL::asset('plugins/jquery-validation/js/jquery.validate.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('plugins/jquery-validation/js/additional-methods.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('plugins/jquery-validation/js/localization/messages_ko.js') }}" type="text/javascript"></script>

    <script>
    $(function()
    {
      $('#form-login').validate()
    })
    </script>
</body>

</html>
