<div class="navbar-wrapper">
    <div class="container-fluid container">
        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ route('home') }}">Frituur UCLL</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="{{ route('home') }}">{{ trans('messages.home') }}</a> </li>
                        <li><a href="{{ route('about') }}">{{ trans('messages.about_us') }}</a></li>
                        <li><a href="{{ route('opening') }}">{{ trans('messages.opening_hours') }}</a></li>
                        <li><a href="{{ route('contact') }}">{{ trans('messages.contact') }}</a></li>
                        <li><a href="{{ route('order') }}">{{ trans('messages.order') }}</a></li>

                        @if (auth()->check())
                            @if (isset($order))
                                <li><a href="{{ route('current_order') }}">{{ trans('messages.current_order') }} ({{ count($order->items) }})</a></li>
                            @endif
                            <li><a href="{{ route('logout') }}">{{ trans('messages.logout') }}</a></li>
                        @else
                            <li><a href="{{ route('login') }}">{{ trans('messages.login') }}</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>

