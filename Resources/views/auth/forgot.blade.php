@extends('authguard::layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@lang('authguard::forgot.title')</div>

                <div class="card-body">

                    <form method="POST" action='{{ url("send/passwordlink/$url") }}'>

                        <input type="hidden" name="url" value='{{ url($reset_url.$url) }}'>

                        @if(session()->has('success'))
                            <div class="alert alert-success">
                                @lang(session()->get('success'))
                            </div>
                        @endif

                        @csrf

                        <div class="form-group">
                            <label for="email">@lang('authguard::forgot.forms.label.email')</label>
                            <input type="text" name="email" class="form-control" id="email" placeholder="@lang('authguard::forgot.forms.placeholder.email')" value="{{ old('email') }}">
                            @if($errors->get('email'))
                                <ul class="text-danger">
                                @foreach ($errors->get('email') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">@lang('authguard::forgot.buttons.submit')</button>
                        <a href='{{ url("login/$url") }}' class="btn btn-primary">@lang('authguard::forgot.buttons.login')</a>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
