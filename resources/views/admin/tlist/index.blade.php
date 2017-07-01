@extends('admin.layouts.app')

@section('title', 'Tutorial Lists')

@section('styles')
@stop

@section('content')
  @component('admin.components.breadcrumb')
    @slot('title')
        전체 강좌 살펴보기
    @endslot
    <li><a href="index.html">Home</a></li>
    <li><a>Extra Pages</a></li>
    <li class="active"><strong>Tutorial Lists</strong></li>
  @endcomponent

  <div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
          <div class="col-lg-12">
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
                      <div class="row">
                          @if(count($tcategories) == 0)
                          <div class="col-md-12">
                              현재 강좌가 없습니다
                          </div>
                          @else
                              @foreach ($tcategories as $tcategory1)
                                  @php
                                  if (strpos($tcategory1->name, '개발') !== false) {
                                      $bg = 'lazur';
                                      $facon = 'code';
                                  } elseif(strpos($tcategory1->name, '디자인') !== false) {
                                      $bg = 'red';
                                      $facon = 'object-group';
                                  } elseif(strpos($tcategory1->name, '비지니스') !== false) {
                                      $bg = 'yellow';
                                      $facon = 'trophy';
                                  }
                                  @endphp
                                  <div class="col-md-4">
                                      <div class="widget style1 {{$bg}}-bg">
                                            <div class="row">
                                                <a style="color:#fff;">
                                                <div class="col-xs-4">
                                                    <i class="fa fa-{{$facon}} fa-4x"></i>
                                                </div>
                                                <div class="col-xs-8 text-right">
                                                    <span style="font-size:15px;"> {{$tcategory1->name}} </span>
                                                    <h2 class="font-bold">260</h2>
                                                </div>
                                            </a>
                                            </div>
                                      </div>
                                  </div>
                            @endforeach


                        @endif
                      </div>
                          <div class="row">
                              <div class="col-md-12 float-e-margins">
                                  <button type="button" class="btn btn-default btn-sm">Small button</button>
                                  <button type="button" class="btn btn-default btn-sm">Small button</button>
                                  <button type="button" class="btn btn-default btn-sm">Small button</button>
                                  <button type="button" class="btn btn-default btn-sm">Small button</button>
                                  <button type="button" class="btn btn-default btn-sm">Small button</button>
                                  <button type="button" class="btn btn-default btn-sm">Small button</button>
                                  <button type="button" class="btn btn-default btn-sm">Small button</button>
                                  <button type="button" class="btn btn-default btn-sm">Small button</button>
                                  <button type="button" class="btn btn-default btn-sm">Small button</button>
                                  <button type="button" class="btn btn-default btn-sm">Small button</button>
                                  <button type="button" class="btn btn-default btn-sm">Small button</button>
                                  <button type="button" class="btn btn-default btn-sm">Small button</button>
                                  <button type="button" class="btn btn-default btn-sm">Small button</button>
                                  <button type="button" class="btn btn-default btn-sm">Small button</button>
                                  <button type="button" class="btn btn-default btn-sm">Small button</button>
                              </div>
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
                  </div>
              </div>
          </div>
      </div>
    <div class="row">
        <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-content">
                      <div class="row">
                          <div class="col-md-3">
                              <div class="ibox">
                                  <div class="ibox-content product-box">
                                      <div class="product-imitation">
                                          [ INFO ]
                                      </div>
                                      <div class="product-desc">
                                          <span class="product-price">
                                              $10
                                          </span>
                                          <small class="text-muted">Category</small>
                                          <a href="#" class="product-name"> Product</a>



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
                          <div class="col-md-3">
                              <div class="ibox">
                                  <div class="ibox-content product-box">

                                      <div class="product-imitation">
                                          [ INFO ]
                                      </div>
                                      <div class="product-desc">
                                          <span class="product-price">
                                              $10
                                          </span>
                                          <small class="text-muted">Category</small>
                                          <a href="#" class="product-name"> Product</a>



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
                          <div class="col-md-3">
                              <div class="ibox">
                                  <div class="ibox-content product-box active">

                                      <div class="product-imitation">
                                          [ INFO ]
                                      </div>
                                      <div class="product-desc">
                                          <span class="product-price">
                                              $10
                                          </span>
                                          <small class="text-muted">Category</small>
                                          <a href="#" class="product-name"> Product</a>



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
                          <div class="col-md-3">
                              <div class="ibox">
                                  <div class="ibox-content product-box">

                                      <div class="product-imitation">
                                          [ INFO ]
                                      </div>
                                      <div class="product-desc">
                                          <span class="product-price">
                                              $10
                                          </span>
                                          <small class="text-muted">Category</small>
                                          <a href="#" class="product-name"> Product</a>



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
                      <div class="row">
                          <div class="col-md-3">
                              <div class="ibox">
                                  <div class="ibox-content product-box">

                                      <div class="product-imitation">
                                          [ INFO ]
                                      </div>
                                      <div class="product-desc">
                                          <span class="product-price">
                                              $10
                                          </span>
                                          <small class="text-muted">Category</small>
                                          <a href="#" class="product-name"> Product</a>



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
                          <div class="col-md-3">
                              <div class="ibox">
                                  <div class="ibox-content product-box">

                                      <div class="product-imitation">
                                          [ INFO ]
                                      </div>
                                      <div class="product-desc">
                                          <span class="product-price">
                                              $10
                                          </span>
                                          <small class="text-muted">Category</small>
                                          <a href="#" class="product-name"> Product</a>



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
                          <div class="col-md-3">
                              <div class="ibox">
                                  <div class="ibox-content product-box">

                                      <div class="product-imitation">
                                          [ INFO ]
                                      </div>
                                      <div class="product-desc">
                                          <span class="product-price">
                                              $10
                                          </span>
                                          <small class="text-muted">Category</small>
                                          <a href="#" class="product-name"> Product</a>



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
                          <div class="col-md-3">
                              <div class="ibox">
                                  <div class="ibox-content product-box">

                                      <div class="product-imitation">
                                          [ INFO ]
                                      </div>
                                      <div class="product-desc">
                                          <span class="product-price">
                                              $10
                                          </span>
                                          <small class="text-muted">Category</small>
                                          <a href="#" class="product-name"> Product</a>



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
                      <div class="row">
                          <div class="col-md-3">
                              <div class="ibox">
                                  <div class="ibox-content product-box">

                                      <div class="product-imitation">
                                          [ INFO ]
                                      </div>
                                      <div class="product-desc">
                                          <span class="product-price">
                                              $10
                                          </span>
                                          <small class="text-muted">Category</small>
                                          <a href="#" class="product-name"> Product</a>



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
                          <div class="col-md-3">
                              <div class="ibox">
                                  <div class="ibox-content product-box">

                                      <div class="product-imitation">
                                          [ INFO ]
                                      </div>
                                      <div class="product-desc">
                                          <span class="product-price">
                                              $10
                                          </span>
                                          <small class="text-muted">Category</small>
                                          <a href="#" class="product-name"> Product</a>



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
                          <div class="col-md-3">
                              <div class="ibox">
                                  <div class="ibox-content product-box">

                                      <div class="product-imitation">
                                          [ INFO ]
                                      </div>
                                      <div class="product-desc">
                                          <span class="product-price">
                                              $10
                                          </span>
                                          <small class="text-muted">Category</small>
                                          <a href="#" class="product-name"> Product</a>



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
                          <div class="col-md-3">
                              <div class="ibox">
                                  <div class="ibox-content product-box">

                                      <div class="product-imitation">
                                          [ INFO ]
                                      </div>
                                      <div class="product-desc">
                                          <span class="product-price">
                                              $10
                                          </span>
                                          <small class="text-muted">Category</small>
                                          <a href="#" class="product-name"> Product</a>



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
                  </div>
              </div>
          </div>
      </div>

</div>

@endsection

@section('scripts')

<!-- Common Function -->
<script src="{{ URL::asset('js/common.js') }}"></script>
<script>
$(document).ready(function(){


});
</script>
@endsection
