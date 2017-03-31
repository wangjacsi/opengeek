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
@stop

@section('content')
  @component('admin.components.breadcrumb')
    @slot('title')
        Add a new Tutorial
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
                          <div class="form-group"><label class="col-sm-2 control-label">제목</label>

                              <div class="col-sm-10"><input type="text" class="form-control"></div>
                          </div>
                          <div class="hr-line-dashed"></div>
                          <div class="form-group"><label class="col-sm-2 control-label">강좌 동영상 링크</label>
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
                      <div class="row m-b-sm m-t-sm">
                          <div class="col-md-1">
                              <button type="button" id="loading-example-btn" class="btn btn-white btn-sm" ><i class="fa fa-refresh"></i> Refresh</button>
                          </div>
                          <div class="col-md-11">
                              <div class="input-group"><input type="text" placeholder="Search" class="input-sm form-control"> <span class="input-group-btn">
                                  <button type="button" class="btn btn-sm btn-primary"> Go!</button> </span>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-md-12">
                              <div class="project-list">

                          <table class="table table-hover">
                              <tbody id="tlist-table">
                              <tr>
                                  <td class="project-status">
                                      <span class="label label-primary">Active</span>
                                  </td>
                                  <td class="project-title">
                                      <a href="project_detail.html">Contract with Zender Company</a>
                                      <br/>
                                      <small>Created 14.08.2014</small>
                                  </td>
                                  <td class="project-completion">
                                          <small>Completion with: 48%</small>
                                          <div class="progress progress-mini">
                                              <div style="width: 48%;" class="progress-bar"></div>
                                          </div>
                                  </td>
                                  <td class="project-people">
                                      <a href=""><img alt="image" class="img-circle" src="img/a3.jpg"></a>
                                      <a href=""><img alt="image" class="img-circle" src="img/a1.jpg"></a>
                                      <a href=""><img alt="image" class="img-circle" src="img/a2.jpg"></a>
                                      <a href=""><img alt="image" class="img-circle" src="img/a4.jpg"></a>
                                      <a href=""><img alt="image" class="img-circle" src="img/a5.jpg"></a>
                                  </td>
                                  <td class="project-actions">
                                      <a href="#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> View </a>
                                      <a href="#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </a>
                                  </td>
                              </tr>
                              <tr>
                                  <td class="project-status">
                                      <span class="label label-primary">Active</span>
                                  </td>
                                  <td class="project-title">
                                      <a href="project_detail.html">There are many variations of passages</a>
                                      <br/>
                                      <small>Created 11.08.2014</small>
                                  </td>
                                  <td class="project-completion">
                                      <small>Completion with: 28%</small>
                                      <div class="progress progress-mini">
                                          <div style="width: 28%;" class="progress-bar"></div>
                                      </div>
                                  </td>
                                  <td class="project-people">
                                      <a href=""><img alt="image" class="img-circle" src="img/a7.jpg"></a>
                                      <a href=""><img alt="image" class="img-circle" src="img/a6.jpg"></a>
                                      <a href=""><img alt="image" class="img-circle" src="img/a3.jpg"></a>
                                  </td>
                                  <td class="project-actions">
                                      <a href="#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> View </a>
                                      <a href="#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </a>
                                  </td>
                              </tr>
                              <tr>
                                  <td class="project-status">
                                      <span class="label label-default">Unactive</span>
                                  </td>
                                  <td class="project-title">
                                      <a href="project_detail.html">Many desktop publishing packages and web</a>
                                      <br/>
                                      <small>Created 10.08.2014</small>
                                  </td>
                                  <td class="project-completion">
                                      <small>Completion with: 8%</small>
                                      <div class="progress progress-mini">
                                          <div style="width: 8%;" class="progress-bar"></div>
                                      </div>
                                  </td>
                                  <td class="project-people">
                                      <a href=""><img alt="image" class="img-circle" src="img/a5.jpg"></a>
                                      <a href=""><img alt="image" class="img-circle" src="img/a3.jpg"></a>
                                  </td>
                                  <td class="project-actions">
                                      <a href="#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> View </a>
                                      <a href="#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </a>
                                  </td>
                              </tr>
                              <tr>
                                  <td class="project-status">
                                      <span class="label label-primary">Active</span>
                                  </td>
                                  <td class="project-title">
                                      <a href="project_detail.html">Letraset sheets containing</a>
                                      <br/>
                                      <small>Created 22.07.2014</small>
                                  </td>
                                  <td class="project-completion">
                                      <small>Completion with: 83%</small>
                                      <div class="progress progress-mini">
                                          <div style="width: 83%;" class="progress-bar"></div>
                                      </div>
                                  </td>
                                  <td class="project-people">
                                      <a href=""><img alt="image" class="img-circle" src="img/a2.jpg"></a>
                                      <a href=""><img alt="image" class="img-circle" src="img/a3.jpg"></a>
                                      <a href=""><img alt="image" class="img-circle" src="img/a1.jpg"></a>
                                      <a href=""><img alt="image" class="img-circle" src="img/a7.jpg"></a>
                                  </td>
                                  <td class="project-actions">
                                      <a href="#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> View </a>
                                      <a href="#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </a>
                                  </td>
                              </tr>
                              <tr>
                                  <td class="project-status">
                                      <span class="label label-primary">Active</span>
                                  </td>
                                  <td class="project-title">
                                      <a href="project_detail.html">Contrary to popular belief</a>
                                      <br/>
                                      <small>Created 14.07.2014</small>
                                  </td>
                                  <td class="project-completion">
                                      <small>Completion with: 97%</small>
                                      <div class="progress progress-mini">
                                          <div style="width: 97%;" class="progress-bar"></div>
                                      </div>
                                  </td>
                                  <td class="project-people">
                                      <a href=""><img alt="image" class="img-circle" src="img/a4.jpg"></a>
                                  </td>
                                  <td class="project-actions">
                                      <a href="#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> View </a>
                                      <a href="#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </a>
                                  </td>
                              </tr>
                              <tr>
                                  <td class="project-status">
                                      <span class="label label-primary">Active</span>
                                  </td>
                                  <td class="project-title">
                                      <a href="project_detail.html">Contract with Zender Company</a>
                                      <br/>
                                      <small>Created 14.08.2014</small>
                                  </td>
                                  <td class="project-completion">
                                      <small>Completion with: 48%</small>
                                      <div class="progress progress-mini">
                                          <div style="width: 48%;" class="progress-bar"></div>
                                      </div>
                                  </td>
                                  <td class="project-people">
                                      <a href=""><img alt="image" class="img-circle" src="img/a1.jpg"></a>
                                      <a href=""><img alt="image" class="img-circle" src="img/a2.jpg"></a>
                                      <a href=""><img alt="image" class="img-circle" src="img/a4.jpg"></a>
                                      <a href=""><img alt="image" class="img-circle" src="img/a5.jpg"></a>
                                  </td>
                                  <td class="project-actions">
                                      <a href="#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> View </a>
                                      <a href="#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </a>
                                  </td>
                              </tr>
                              <tr>
                                  <td class="project-status">
                                      <span class="label label-primary">Active</span>
                                  </td>
                                  <td class="project-title">
                                      <a href="project_detail.html">There are many variations of passages</a>
                                      <br/>
                                      <small>Created 11.08.2014</small>
                                  </td>
                                  <td class="project-completion">
                                      <small>Completion with: 28%</small>
                                      <div class="progress progress-mini">
                                          <div style="width: 28%;" class="progress-bar"></div>
                                      </div>
                                  </td>
                                  <td class="project-people">
                                      <a href=""><img alt="image" class="img-circle" src="img/a7.jpg"></a>
                                      <a href=""><img alt="image" class="img-circle" src="img/a6.jpg"></a>
                                      <a href=""><img alt="image" class="img-circle" src="img/a3.jpg"></a>
                                  </td>
                                  <td class="project-actions">
                                      <a href="#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> View </a>
                                      <a href="#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </a>
                                  </td>
                              </tr>
                              <tr>
                                  <td class="project-status">
                                      <span class="label label-default">Unactive</span>
                                  </td>
                                  <td class="project-title">
                                      <a href="project_detail.html">Many desktop publishing packages and web</a>
                                      <br/>
                                      <small>Created 10.08.2014</small>
                                  </td>
                                  <td class="project-completion">
                                      <small>Completion with: 8%</small>
                                      <div class="progress progress-mini">
                                          <div style="width: 8%;" class="progress-bar"></div>
                                      </div>
                                  </td>
                                  <td class="project-people">
                                      <a href=""><img alt="image" class="img-circle" src="img/a5.jpg"></a>
                                      <a href=""><img alt="image" class="img-circle" src="img/a3.jpg"></a>
                                  </td>
                                  <td class="project-actions">
                                      <a href="#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> View </a>
                                      <a href="#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </a>
                                  </td>
                              </tr>
                              <tr>
                                  <td class="project-status">
                                      <span class="label label-primary">Active</span>
                                  </td>
                                  <td class="project-title">
                                      <a href="project_detail.html">Letraset sheets containing</a>
                                      <br/>
                                      <small>Created 22.07.2014</small>
                                  </td>
                                  <td class="project-completion">
                                      <small>Completion with: 83%</small>
                                      <div class="progress progress-mini">
                                          <div style="width: 83%;" class="progress-bar"></div>
                                      </div>
                                  </td>
                                  <td class="project-people">
                                      <a href=""><img alt="image" class="img-circle" src="img/a2.jpg"></a>
                                      <a href=""><img alt="image" class="img-circle" src="img/a3.jpg"></a>
                                      <a href=""><img alt="image" class="img-circle" src="img/a1.jpg"></a>
                                  </td>
                                  <td class="project-actions">
                                      <a href="#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> View </a>
                                      <a href="#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </a>
                                  </td>
                              </tr>
                              <tr>
                                  <td class="project-status">
                                      <span class="label label-primary">Active</span>
                                  </td>
                                  <td class="project-title">
                                      <a href="project_detail.html">Contrary to popular belief</a>
                                      <br/>
                                      <small>Created 14.07.2014</small>
                                  </td>
                                  <td class="project-completion">
                                      <small>Completion with: 97%</small>
                                      <div class="progress progress-mini">
                                          <div style="width: 97%;" class="progress-bar"></div>
                                      </div>
                                  </td>
                                  <td class="project-people">
                                      <a href=""><img alt="image" class="img-circle" src="img/a4.jpg"></a>
                                  </td>
                                  <td class="project-actions">
                                      <a href="#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> View </a>
                                      <a href="#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </a>
                                  </td>
                              </tr>
                              <tr>
                                  <td class="project-status">
                                      <span class="label label-primary">Active</span>
                                  </td>
                                  <td class="project-title">
                                      <a href="project_detail.html">There are many variations of passages</a>
                                      <br/>
                                      <small>Created 11.08.2014</small>
                                  </td>
                                  <td class="project-completion">
                                      <small>Completion with: 28%</small>
                                      <div class="progress progress-mini">
                                          <div style="width: 28%;" class="progress-bar"></div>
                                      </div>
                                  </td>
                                  <td class="project-people">
                                      <a href=""><img alt="image" class="img-circle" src="img/a7.jpg"></a>
                                      <a href=""><img alt="image" class="img-circle" src="img/a6.jpg"></a>
                                      <a href=""><img alt="image" class="img-circle" src="img/a3.jpg"></a>
                                  </td>
                                  <td class="project-actions">
                                      <a href="#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> View </a>
                                      <a href="#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </a>
                                  </td>
                              </tr>
                              </tbody>
                          </table>
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
                                          <input class="tagsinput form-control" id="tlist-tags" type="text" value="amazon,aws,ruby,Amsterdam,Washington"/>
                                          <span class="help-block m-b-none">최대 10개 까지 등록 가능</span>
                                      </div>
                                  </div>
                                  <div class="hr-line-dashed"></div>
                                  <div class="form-group" id="tutorial-list-group">
                                      <div class="col-sm-4 col-sm-offset-2">
                                          <button class="btn btn-primary" type="button" id="tlist-add">추가하기</button>
                                          <button class="btn btn-white" type="button" id="tlist-reset">초기화</button>
                                      </div>
                                  </div>
                                  <div class="m-t" id="tlist-result"></div>
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
<!-- Common Function -->
<script src="{{ URL::asset('js/common.js') }}"></script>
<script>
$(document).ready(function(){
    // tutorial list update
    var tlist_status = {'1':'진행중', '2':'완료', '3':'중지'};
    var tlist_status_label = {'1':'primary', '2':'success', '3':'danger'};
    function appendTlist(resp){
        var html = '<tr>';
            html += '<td class="project-status">';
            html += '<span class="label label-'+tlist_status_label[resp.data.status]+'">'+tlist_status[resp.data.status]+'</span>';
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
    }

    function tlistAjaxCallback(type, resp){
        console.log(resp);
        if(type== 'validerror'){
            $.each( resp.errors, function( key, value ) {
                basicFormValid('fg-tlist-'+key, 'error', value);
            });
        } else if(type== 'success'){
            appendTlist(resp);
            makeAlert(0);
            alertStr = alertStr.replace(regAlertStr, '강좌 리스트 생성 성공');
            $('#tlist-result').html(alertStr);
        } else {
            makeAlert(1);
            alertStr = alertStr.replace(regAlertStr, '강좌 리스트 생성 실패');
            $('#tlist-result').html(alertStr);
        }
    }

    $('#tlist-add').on('click', function (){
        basicFormValid(['fg-tlist-title','fg-tlist-category','fg-tlist-link', 'fg-tlist-desc', 'fg-tlist-status','tlist-range'], 'init', '');
        var formData = new FormData();
        formData.append('title', $('#tlist-title').val());
        formData.append('video_link', $('#tlist-link').val());
        formData.append('category', $('#tlist-category').val());
        formData.append('desc', $("#tlist-desc").val());
        formData.append('status', $('#tlist-status .tlist-status-check:checked').val());
        formData.append('progress', $("#tlist-range").prop("value"));
        formData.append('tags', $("#tlist-tags").val());
        AjaxRun('/tlist', 'POST', formData, {'success':'강좌 리스트 추가 성공',
                'error':'강좌 리스트 추가 실패'}, tlistAjaxCallback);
    });


    // Range Slider
    $("#tlist-range").ionRangeSlider({
        min: 0,
        max: 100,
        from: 5
    });


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
