<div class="alert alert-{{$type or 'success'}} alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    @if(isset($title))
      <h2>{{$title}}</h2>
    @endif
    {{ $slot }}
    @if(isset($link))
      <a class="alert-link" href="{{$link or '#'}}">{{$linkTitle}}</a>.
    @endif
</div>
