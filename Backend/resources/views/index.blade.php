@include('layouts.head')


<div id="app">
    @include('layouts.menu')
    <div class="app-content">
        @include('layouts.navbar')
        @yield('content')
    </div>
<!-- start: FOOTER -->
    @include('layouts.footer')
</div>
@include('layouts.scripts')


@stack('scripts')


</body>
</html>