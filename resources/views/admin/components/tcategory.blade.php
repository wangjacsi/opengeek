@if(count($tcategories) == 0)
<div class="col-md-12">
    현재 강좌가 없습니다
</div>
@else
@foreach ($tcategories as $tcategory1)
    @php
    $tlistNum = $tcategory1->tlistsCount;
    $htmlChildrenBtn = '';
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

    @foreach ($tcategory1->children as $tcategory2)
        @php
            $tlistNum += $tcategory2->tlistsCount;
        @endphp
        @if ($loop->first)
            @php
                $htmlChildrenBtn = '<div></div>';
            @endphp
        @elseif($loop->last)

        @else
        @endif
    @endforeach

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
