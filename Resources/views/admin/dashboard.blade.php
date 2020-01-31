@extends('authguard::layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                @if(session()->has('success'))
                    <div class="alert alert-success">
                       @lang(session()->get('success'))
                    </div>
                @endif
            </div>
            <div class="col-12">
                @lang('authguard::admin.title')
            </div>
            <div class="col-12">
                <a href="{{ url('admin/logout/') }}" class="btn btn-primary">@lang('authguard::admin.buttons.logout')</a>
            </div>
        </div>
    </div>
@stop
