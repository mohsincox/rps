<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    {{ Html::style('/css/app.css') }} 
    {{ Html::style('/css/style.css') }} 
    {{ Html::style('/css/font-awesome.min.css') }}
    {{ Html::style('/css/bootstrap-chosen.css') }}
    {{ Html::style('/css/jquery.dataTables.min.css') }}
    <!-- <link href="/css/app.css" rel="stylesheet"> -->
    <!-- <link href="/css/style.css" rel="stylesheet"> -->
    <!-- <link href="/css/font-awesome.min.css" rel="stylesheet"> -->
    <!-- <link href="/css/bootstrap-chosen.css" rel="stylesheet"> -->
    <!-- <link href="/css/jquery.dataTables.min.css" rel="stylesheet"> -->
    {{--<link href="{{ asset('plugins/bootstrap-chosen-master/bootstrap-chosen.css') }}" rel="stylesheet">--}}
    @yield('style')
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

</head>
<body>
    <span  id="url">
        {{ url('/') }}
    </span>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        {{--<li><a href="{{ url('/register') }}">Register</a></li>--}}
                    @else
                        <li><a href="{{ url('/home') }}">Home</a></li>
                        <li><a href="{{ url('/class') }}">Class</a></li>
                        <li><a href="{{ url('/section') }}">Section</a></li>
                        <li><a href="{{ url('/year') }}">Year</a></li>
                        <li><a href="{{ url('/subject') }}">Subject</a></li>
                        <li><a href="{{ url('/term') }}">Term</a></li>
                        <li><a href="{{ url('/student') }}">Student</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                RESULT <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/result') }}">Result Show</a></li>
                                <li><a href="{{ url('/result/create') }}">Result Create</a></li>
                                <li><a href="{{ url('/result/show-result-form') }}">Class Wise Result</a></li>
                                <li><a href="{{ url('/result/show-result-fail-form') }}">Class Wise Result With Fail</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ url('/result/print-form') }}">Print Result</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('/logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    {{--@include('flash::message')--}}
    {{--@yield('content')--}}
    <div class="container">
        <div class="row">
            @include('flash::message')

            <div class="col-md-12">
                @yield('content')
            </div>
        </div>
    </div>

    <div class="hidden-print">
        <hr/>
    </div>
    <div class="footer hidden-print">
        <div class="container">
            @include('layouts.partial.footer')

        </div>
    </div>

    <!-- Scripts -->
    <!-- <script src="/js/app.js"></script> -->
    {!! Html::script('/js/app.js') !!}
    {!! Html::script('/js/jquery-3.1.1.min.js') !!}
    {!! Html::script('/js/chosen.jquery.min.js') !!}
    {{--{!! Html::script('js/search_id.js') !!}--}}
    {{--<script src="{{ asset('plugins/chosen_v1.6.2/chosen.jquery.min.js') }}"></script>--}}
    {!! Html::script('/js/jquery.dataTables.min.js') !!}
    <!-- <script src="/js/jquery.dataTables.min.js"></script> -->
    @yield('script')
</body>
</html>
