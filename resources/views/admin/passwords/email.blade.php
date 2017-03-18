<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ config('app.name') }} | Reset Password </title>

    <link rel="stylesheet" href="{{ URL::asset('admin/css/vendor.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('admin/css/app.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('admin/css/custom.css') }}" />

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
                    <p>패스워드를 재설정 합니다. 아래 입력하신 이메일 주소로 패스워드 재설정을 위한 링크가 보내집니다. 이메일을 체크하시기 바랍니다.</p>
                    <form id="form-login" class="m-t" role="form" action="{{ url('/password/email') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('email') ? "has-error" : "" }}">
                            <input type="email" name="email" class="form-control" placeholder="이메일 주소" value="{{ old('email') }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block full-width m-b">보내기</button>

                        @if (count($errors) > 0)
                       <div class="alert alert-danger alert-dismissable">
                         <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
                         @foreach ($errors->all() as $error)
                             {{ $error }}<br>
                         @endforeach
                       </div>
                       @endif

                       @if (session('status'))
                           <div class="alert alert-success alert-dismissable">
                               <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
                               {{ session('status') }}
                           </div>
                       @endif

                       <a class="btn btn-white btn-block" href="{{ route('login') }}">로그인</a>
                        <p class="text-muted m-t">
                            <small>계정이 없으신가요?</small>
                        </p>
                        <a class="btn btn-white btn-block" href="{{ route('register') }}">가입하기</a>
                    </form>

                    <p class="m-t">
                      <small><a class="text-danger" href="{{ url('/password/reset') }}">
                          비밀번호 재설정
                      </a></small>
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
