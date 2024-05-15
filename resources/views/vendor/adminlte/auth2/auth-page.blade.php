@extends('adminlte::master')

@php( $dashboard_url = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'home') )

@if (config('adminlte.use_route_url', false))
    @php( $dashboard_url = $dashboard_url ? route($dashboard_url) : '' )
@else
    @php( $dashboard_url = $dashboard_url ? url($dashboard_url) : '' )
@endif

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('classes_body'){{ ($auth_type ?? 'login') . '-page' }}@stop

<style>
    .box {
        align-self: flex-end;
        animation-duration: 2s;
        animation-iteration-count: infinite;
        margin: 0 auto 0 auto;
        transform-origin: bottom;
    }

    .bounce {
        animation-name: bounce-1;
        animation-timing-function: linear;
    }

    @keyframes bounce-1 {
        0%   { transform: translateY(0); }
        50%  { transform: translateY(-25px); }
        100% { transform: translateY(0); }
    }
</style>

@section('body')
    <div class="{{ $auth_type ?? 'login' }}-box">

        {{-- Logo --}}
        <div class="{{ $auth_type ?? 'login' }}-logo">
            <a href="{{ $dashboard_url }}">
                <img class="box bounce" src="{{ asset(setting('logologin')) }}" height="150"/>
                <br/>
                {{-- <h2><strong>{!! setting('title') !!}</strong></h2> --}}
            </a>
        </div>

        {{-- Card Box --}}
        <div class="card card-info">

            {{-- Card Header --}}
            @hasSection('auth_header')
                <div class="card-header">
                    <h3 class="card-title float-none text-center">
                        @yield('auth_header')
                    </h3>
                </div>
            @endif

            {{-- Card Body --}}
            <div class="card-body {{ $auth_type ?? 'login' }}-card-body {{ config('adminlte.classes_auth_body', '') }}">
                @yield('auth_body')
            </div>
        </div>

    </div>
@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')
@stop
