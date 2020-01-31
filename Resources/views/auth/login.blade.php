@extends('authguard::layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> {{ isset($url) ? ucwords($url) : ""}} @lang('authguard::login.title')</div>

                <div class="card-body">
                    <form method="POST" action='{{ url("login/$url") }}'>
                    @csrf
                    @if($errors->all())
                        <ul class="text-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    @endif
                    <div class="form-group">
                        <label for="exampleInputEmail1">@lang('authguard::login.forms.label.email')</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="@lang('authguard::login.forms.placeholder.email')" value="{{ old('email') }}">
                        <small id="emailHelp" class="form-text text-muted">@lang('authguard::login.forms.note.email')</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">@lang('authguard::login.forms.label.password')</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="@lang('authguard::login.forms.placeholder.password')">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" name="remember" class="form-check-input" id="exampleCheck1" @if(old('remember')) checked @endif>
                        <label class="form-check-label" for="exampleCheck1">@lang('authguard::login.forms.label.remember')</label>
                    </div>

                    <button type="submit" class="btn btn-primary">@lang('authguard::login.buttons.submit')</button>
                    <a href='{{ url("/register/$url") }}'>@lang('authguard::login.buttons.register')</a>
                    <a href='{{ url("/forgot/password/$url") }}'>@lang('authguard::login.buttons.forgot_password')</a>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
