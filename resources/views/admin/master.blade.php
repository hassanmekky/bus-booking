@include('admin.layouts.head')

@include('admin.layouts.sidebar')

<div class="nk-wrap ">
    @include('admin.layouts.header')

    @yield('content')

    @include('admin.layouts.footer')

</div>
<!-- wrap @e -->

@include('admin.layouts.foot')



