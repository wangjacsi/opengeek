<!DOCTYPE html>
<html lang="en">

@include('front.layouts.head')

<body class="">

@include('front.layouts.header')

@include('front.layouts.rightMenu')

<div class="content-wrapper">
@yield('content')
</div>


@include('front.layouts.footer')

@component('front.components.svg')
@endcomponent

@include('front.layouts.search')

<!-- JS Script -->
@include('front.layouts.scripts')

</body>
</html>
