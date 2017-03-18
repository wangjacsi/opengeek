@extends('admin.layouts.app')

@section('title', 'Profile')

@section('styles')
<!-- Social Icon -->
<link href="{{ URL::asset('plugins/bootstrapSocial/bootstrap-social.css') }}" rel="stylesheet">
<!-- Nation Flag css -->
<link href="{{ URL::asset('plugins/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet">
@stop

@section('content')
  @component('admin.components.breadcrumb')
    @slot('title')
        Profile
    @endslot
    <li><a href="index.html">Home</a></li>
    <li><a>Extra Pages</a></li>
    <li class="active"><strong>Profile</strong></li>
  @endcomponent

  <div class="wrapper wrapper-content">
      <div class="row animated fadeInRight">
          <div class="col-md-4">
            <div class="ibox float-e-margins">
              <div class="ibox-content text-center">
                  <h1>{{$user->name}}</h1>
                  <div class="m-b-sm">
                    <img alt="image" class="img-circle" src="{{ ($user->avatar != null)  ?
                      $user->avatar :
                      URL::asset('front/img/teammember'.rand(1, 4).'.png') }}">
                  </div>
                  @if($user->settings()->get('company'))
                    <h3>{{$user->settings()->get('company')}}</h3>
                  @endif
                  @if($user->settings()->get('position'))
                    <p class="font-bold">{{$user->settings()->get('position')}}</p>
                  @endif
                  <p class="">Since {{ Carbon\Carbon::parse($user->created_at)->format('F Y') }}</p>
              </div>

              <div class="widget-text-box no-borders ">
                  <p>{{ ($user->aboutme != null)  ?
                    $user->aboutme :
                    "" }}</p>

                  <ul class="list-unstyled m-t-md">
                      @if ($user->settings()->get('nation'))
                        <li><span class="fa fa-location-arrow m-r-xs"></span><label>Location: </label> <span class="flag-icon flag-icon-{{strtolower($user->settings()->get('nation'))}}"></span> {{$nation}}{{$user->settings()->get('city') ? ', '.$user->settings()->get('city') : ''}}</li>
                      @endif
                    @if ($user->email)
                      <li><span class="fa fa-envelope m-r-xs"></span><label>Email: </label> {{$user->email}}</li>
                    @endif

                    @if ($user->settings()->get('website'))
                      <li><span class="fa fa-home m-r-xs"></span><label>Website: </label> <a target="_blank" href="http://{{$user->settings()->get('website')}}">{{$user->settings()->get('website')}}</a></li>
                    @endif
                    @if ($user->settings()->get('phone'))
                      <li><span class="fa fa-phone m-r-xs"></span><label>Contact: </label> {{$user->settings()->get('phone')}}</li>
                    @endif
                  </ul>
                  <div class="user-button">
                      <div class="row m-b">
                          <div class="col-md-12">
                            @foreach ($user->settings()->get('SNS') as $key => $value)
                              @if($value != null && $value != "")
                                <a target="_blank" href="{{$value}}" class="btn btn-social-icon btn-{{$key}}"><span class="fa fa-{{$key}}"></span></a>
                              @endif
                            @endforeach
                          </div>
                      </div>
                      @if(!$owner)
                      <button type="button" class="btn btn-block btn-outline btn-primary">Follow</button>
                      @else
                      <button type="button" class="btn btn-block btn-outline btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
                      @endif
                  </div>
              </div>
            </div>

            <div class="ibox" id="member-card">
                <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-1"> Follower</a></li>
                        <li class=""><a data-toggle="tab" href="#tab-2">Following</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane active">
                            <div class="panel-body">
                              <div class="col-sm-3 text-center m-b-sm">
                                  <div class="m-b-xs">
                                      <a><img alt="image" class="img-circle" src="{{ URL::asset('admin/img/a2.jpg') }}" style="width: 100%"></a>
                                  </div>
                                  <a><small>Anthony Jackson</small></a>
                              </div>
                              <div class="col-sm-3 text-center m-b-sm">
                                  <div class="m-b-xs">
                                      <a><img alt="image" class="img-circle" src="{{ URL::asset('admin/img/a1.jpg') }}" style="width: 100%"></a>
                                  </div>
                                  <a><small>Nicki Smith</small></a>
                              </div>
                              <div class="col-sm-3 text-center m-b-sm">
                                  <div class="m-b-xs">
                                      <a><img alt="image" class="img-circle" src="{{ URL::asset('admin/img/a3.jpg') }}" style="width: 100%"></a>
                                  </div>
                                  <a><small>Rooney Lindsay</a></small>
                              </div>
                              <div class="col-sm-3 text-center m-b-sm">
                                  <div class="m-b-xs">
                                      <a><img alt="image" class="img-circle" src="{{ URL::asset('admin/img/a4.jpg') }}" style="width: 100%"></a>
                                  </div>
                                  <a><small>Lionel Mcmillan</a></small>
                              </div>
                              <div class="col-sm-3 text-center m-b-sm">
                                  <div class="m-b-xs">
                                      <a><img alt="image" class="img-circle" src="{{ URL::asset('admin/img/a5.jpg') }}" style="width: 100%"></a>
                                  </div>
                                  <a><small>Edan Randall</a></small>
                              </div>
                              <div class="col-sm-3 text-center m-b-sm">
                                  <div class="m-b-xs">
                                      <a><img alt="image" class="img-circle" src="{{ URL::asset('admin/img/a6.jpg') }}" style="width: 100%"></a>
                                  </div>
                                  <a><small>Jasper Carson</a></small>
                              </div>
                              <div class="col-sm-3 text-center m-b-sm">
                                  <div class="m-b-xs">
                                      <a><img alt="image" class="img-circle" src="{{ URL::asset('admin/img/a7.jpg') }}" style="width: 100%"></a>
                                  </div>
                                  <a><small>Reuben Pacheco</a></small>
                              </div>
                              <div class="col-sm-3 text-center m-b-sm">
                                  <div class="m-b-xs">
                                      <a><img alt="image" class="img-circle" src="{{ URL::asset('admin/img/a8.jpg') }}" style="width: 100%"></a>
                                  </div>
                                  <a><small>Simon Carson</a></small>
                              </div>
                              <div class="col-sm-3 text-center m-b-sm">
                                  <div class="m-b-xs">
                                      <a><img alt="image" class="img-circle" src="{{ URL::asset('admin/img/a2.jpg') }}" style="width: 100%"></a>
                                  </div>
                                  <a><small>Lionsel Mcmillan</a></small>
                              </div>
                              <div class="col-sm-3 text-center m-b-sm">
                                  <div class="m-b-xs">
                                      <a><img alt="image" class="img-circle" src="{{ URL::asset('admin/img/a7.jpg') }}" style="width: 100%"></a>
                                  </div>
                                  <a><small>Nicki Smith</a></small>
                              </div>
                            </div>
                        </div>
                        <div id="tab-2" class="tab-pane">
                            <div class="panel-body">
                              <div class="col-sm-3 text-center m-b-sm">
                                  <div class="m-b-xs">
                                      <a><img alt="image" class="img-circle" src="{{ URL::asset('admin/img/a7.jpg') }}" style="width: 100%"></a>
                                  </div>
                                  <a><small>Reuben Pacheco</a></small>
                              </div>
                              <div class="col-sm-3 text-center m-b-sm">
                                  <div class="m-b-xs">
                                      <a><img alt="image" class="img-circle" src="{{ URL::asset('admin/img/a8.jpg') }}" style="width: 100%"></a>
                                  </div>
                                  <a><small>Simon Carson</a></small>
                              </div>
                              <div class="col-sm-3 text-center m-b-sm">
                                  <div class="m-b-xs">
                                      <a><img alt="image" class="img-circle" src="{{ URL::asset('admin/img/a2.jpg') }}" style="width: 100%"></a>
                                  </div>
                                  <a><small>Lionsel Mcmillan</a></small>
                              </div>
                              <div class="col-sm-3 text-center m-b-sm">
                                  <div class="m-b-xs">
                                      <a><img alt="image" class="img-circle" src="{{ URL::asset('admin/img/a7.jpg') }}" style="width: 100%"></a>
                                  </div>
                                  <a><small>Nicki Smith</a></small>
                              </div>

                              <div class="col-sm-3 text-center m-b-sm">
                                  <div class="m-b-xs">
                                      <a><img alt="image" class="img-circle" src="{{ URL::asset('admin/img/a2.jpg') }}" style="width: 100%"></a>
                                  </div>
                                  <a><small>Anthony Jackson</small></a>
                              </div>
                              <div class="col-sm-3 text-center m-b-sm">
                                  <div class="m-b-xs">
                                      <a><img alt="image" class="img-circle" src="{{ URL::asset('admin/img/a1.jpg') }}" style="width: 100%"></a>
                                  </div>
                                  <a><small>Nicki Smith</small></a>
                              </div>
                              <div class="col-sm-3 text-center m-b-sm">
                                  <div class="m-b-xs">
                                      <a><img alt="image" class="img-circle" src="{{ URL::asset('admin/img/a3.jpg') }}" style="width: 100%"></a>
                                  </div>
                                  <a><small>Rooney Lindsay</a></small>
                              </div>
                              <div class="col-sm-3 text-center m-b-sm">
                                  <div class="m-b-xs">
                                      <a><img alt="image" class="img-circle" src="{{ URL::asset('admin/img/a4.jpg') }}" style="width: 100%"></a>
                                  </div>
                                  <a><small>Lionel Mcmillan</a></small>
                              </div>
                              <div class="col-sm-3 text-center m-b-sm">
                                  <div class="m-b-xs">
                                      <a><img alt="image" class="img-circle" src="{{ URL::asset('admin/img/a5.jpg') }}" style="width: 100%"></a>
                                  </div>
                                  <a><small>Edan Randall</a></small>
                              </div>
                              <div class="col-sm-3 text-center m-b-sm">
                                  <div class="m-b-xs">
                                      <a><img alt="image" class="img-circle" src="{{ URL::asset('admin/img/a6.jpg') }}" style="width: 100%"></a>
                                  </div>
                                  <a><small>Jasper Carson</a></small>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if(!$owner)
            <div class="ibox">
                <div class="ibox-content">

                    <h3>메세지 보내기</h3>

                    <p class="small">
                        {{ $user->name }}에게 메세지를 남기세요
                    </p>

                    <div class="form-group">
                        <label>내 용</label>
                        <textarea class="form-control" placeholder="Your message" rows="7"></textarea>
                    </div>
                    <button class="btn btn-primary btn-block">보내기</button>

                </div>
            </div>
            @endif
        </div>

        <div class="col-md-8">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <h2>강좌 리스트</h2>
                    <h3>운영 중인 강좌</h3>
                    <div class="row">
                        <div class="col-md-3 narrow">
                            <div class="ibox">
                                <div class="ibox-content product-box">
                                    <img alt="image" class="img-responsive" src="{{ URL::asset('images/tutorials/python.png') }}">

                                    <div class="product-desc">
                                        <span class="product-price">
                                            $10
                                        </span>
                                        <small class="text-muted">개발언어, Python</small>
                                        <a href="#" class="product-name"> Python 기본 강좌</a>

                                        <div class="small m-t-xs">
                                            Many desktop publishing packages and web page editors now.
                                        </div>
                                        <div class="m-t text-righ">

                                            <a href="#" class="btn btn-xs btn-outline btn-primary">Info <i class="fa fa-long-arrow-right"></i> </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 narrow">
                            <div class="ibox">
                                <div class="ibox-content product-box">
                                    <img alt="image" class="img-responsive" src="{{ URL::asset('images/tutorials/php.png') }}">

                                    <div class="product-desc">
                                        <span class="product-price">
                                            $10
                                        </span>
                                        <small class="text-muted">개발언어, PHP</small>
                                        <a href="#" class="product-name"> 모던 PHP 활용하기</a>

                                        <div class="small m-t-xs">
                                            Many desktop publishing packages and web page editors now.
                                        </div>
                                        <div class="m-t text-righ">

                                            <a href="#" class="btn btn-xs btn-outline btn-primary">Info <i class="fa fa-long-arrow-right"></i> </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 narrow">
                            <div class="ibox">
                                <div class="ibox-content product-box ">

                                    <img alt="image" class="img-responsive" src="{{ URL::asset('images/tutorials/laravel.png') }}">

                                    <div class="product-desc">
                                        <span class="product-price">
                                            $10
                                        </span>
                                        <small class="text-muted">웹 프로그래밍, Laravel</small>
                                        <a href="#" class="product-name"> Laravel 5.4 프레임워크 활용한 웹 개발</a>

                                        <div class="small m-t-xs">
                                            Many desktop publishing packages and web page editors now.
                                        </div>
                                        <div class="m-t text-righ">

                                            <a href="#" class="btn btn-xs btn-outline btn-primary">Info <i class="fa fa-long-arrow-right"></i> </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 narrow">
                            <div class="ibox">
                                <div class="ibox-content product-box">

                                    <img alt="image" class="img-responsive" src="{{ URL::asset('images/tutorials/nodejs.png') }}">
                                    <div class="product-desc">
                                        <span class="product-price">
                                            $10
                                        </span>
                                        <small class="text-muted">웹프로그래밍, Nodejs</small>
                                        <a href="#" class="product-name"> Nodejs 멀티 미디어 웹 플랫폼 개발하기</a>

                                        <div class="small m-t-xs">
                                            Many desktop publishing packages and web page editors now.
                                        </div>
                                        <div class="m-t text-righ">

                                            <a href="#" class="btn btn-xs btn-outline btn-primary">Info <i class="fa fa-long-arrow-right"></i> </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>






                    </div>

                    <h3>수강 중인 강좌</h3>
                    <ul class="todo-list m-t small-list ui-sortable">
                        <li>
                            <a href="#" class="check-link"><i class="fa fa-check-square"></i> </a>
                            <span class="m-l-xs todo-completed">Buy a milk</span>

                        </li>
                        <li>
                            <a href="#" class="check-link"><i class="fa fa-check-square"></i> </a>
                            <span class="m-l-xs  todo-completed">Go to shop and find some products.</span>

                        </li>
                        <li>
                            <a href="#" class="check-link"><i class="fa fa-square-o"></i> </a>
                            <span class="m-l-xs">Send documents to Mike</span>
                            <small class="label label-primary"><i class="fa fa-clock-o"></i> 1 mins</small>
                        </li>
                        <li>
                            <a href="#" class="check-link"><i class="fa fa-square-o"></i> </a>
                            <span class="m-l-xs">Go to the doctor dr Smith</span>
                        </li>
                        <li>
                            <a href="#" class="check-link"><i class="fa fa-square-o"></i> </a>
                            <span class="m-l-xs">Plan vacation</span>
                        </li>
                    </ul>

                    <div class="divider"></div>
                    <h3>관심 강좌</h3>
                    <ul class="todo-list m-t small-list ui-sortable">
                        <li>
                            <a href="#" class="check-link"><i class="fa fa-check-square"></i> </a>
                            <span class="m-l-xs todo-completed">Buy a milk</span>

                        </li>
                        <li>
                            <a href="#" class="check-link"><i class="fa fa-check-square"></i> </a>
                            <span class="m-l-xs  todo-completed">Go to shop and find some products.</span>

                        </li>
                        <li>
                            <a href="#" class="check-link"><i class="fa fa-square-o"></i> </a>
                            <span class="m-l-xs">Plan vacation</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
      </div>
  </div>
@endsection

@section('scripts')

@endsection
