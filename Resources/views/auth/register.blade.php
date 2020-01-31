@extends('authguard::layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> {{ isset($url) ? ucwords($url) : ""}} @lang('authguard::register.title')</div>

                <div class="card-body">
                    <form method="POST" action='{{ url("register/$url") }}'>
                    @csrf
                        <div class="form-group">
                            <label for="inputName">@lang('authguard::register.forms.label.name')</label>
                            <input type="text" name="name" class="form-control" id="inputName" placeholder="@lang('authguard::register.forms.placeholder.name')" value="{{ old('name') }}">
                            @if($errors->get('name'))
                                <ul class="text-danger">
                                @foreach ($errors->get('name') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">@lang('authguard::register.forms.label.email')</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="@lang('authguard::register.forms.label.email')" value="{{ old('email') }}">
                            <small id="emailHelp" class="form-text text-muted">@lang('authguard::register.forms.note.email')</small>
                            @if($errors->get('email'))
                                <ul class="text-danger">
                                @foreach ($errors->get('email') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">@lang('authguard::register.forms.label.password')</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="@lang('authguard::register.forms.placeholder.password')">
                            @if($errors->get('password'))
                                <ul class="text-danger">
                                @foreach ($errors->get('password') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">@lang('authguard::register.buttons.submit')</button>
                        <a href='{{ url("/login/$url") }}'>@lang('authguard::register.buttons.login')</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
