@if($myTlists->count() > 0)
<table class="table table-hover">
    <tbody id="tlist-table">
        @foreach ($myTlists as $tlist)
            <tr>
            <td class="project-status">
                <span class="label label-{{$tlistStatus[$tlist->status]['css']}}">{{$tlistStatus[$tlist->status]['status']}}</span>
            </td>
            <td class="project-title">
                <a href="{{route('tlist.show', ['slug'=>$tlist->slug])}}">{{$tlist->title}}</a>
                <br/>
                <small>{{Carbon\Carbon::parse($tlist->created_at)->format('jS F Y')}}</small>
            </td>
            <td class="project-completion">
                <small>Completion with: {{$tlist->progress}}%</small>
                <div class="progress progress-mini">
                    <div style="width: {{$tlist->progress}}%;" class="progress-bar"></div>
                </div>
            </td>
            @foreach ($tlist->users as $user)
                @php
                $avatar_s = explode('.', $user->avatar);
                $ext = end($avatar_s);
                $sliced = array_slice($avatar_s, 0, -1);
                $string = implode(".", $sliced);
                $avatar_s = $string.'_s.'.$ext;
                @endphp
            <td class="project-people">
                <a href=""><img alt="image" class="img-circle" src="{{$avatar_s}}"></a>
            </td>
            @endforeach
            <td class="project-actions">
                <a href="#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> View </a>
                <a href="#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </a>
            </td>
            </tr>
          @endforeach
    </tbody>
</table>
@if(isset($search) && $search != '')
{{$myTlists->appends(['search' => $search])->links()}}
@else
{{$myTlists->links()}}
@endif

@else
<div class="well">
    <h3>
        나의 강좌가 없습니다
    </h3>
    강좌를 새롭게 오픈해 보세요
</div>
@endif
