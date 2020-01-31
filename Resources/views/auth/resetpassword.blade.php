@extends('authguard::layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> @lang('authguard::resetpassword.title')</div>

                <div class="card-body">

                    @if($token_response != null)

                        <form method="POST" action='{{ url("reset/password/$url") }}'>

                            @if(session()->has('success'))
                                <div class="alert alert-success">
                                    @lang(session()->get('success'))
                                </div>
                            @endif

                            <div class="form-group">
                                <input type="hidden" name="email" value="{{ $token_response->email }}">
                                @if($errors->get('email'))
                                    <ul class="text-danger">
                                    @foreach ($errors->get('email') as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                    </ul>
                                @endif
                            </div>

                            @csrf

                            <div class="form-group">
                                <label for="newPassword">@lang('authguard::resetpassword.forms.label.new_password')</label>
                                <input type="password" name="new_password" class="form-control" id="newPassword" placeholder="@lang('authguard::resetpassword.forms.placeholder.new_password')">
                                @if($errors->get('new_password'))
                                    <ul class="text-danger">
                                    @foreach ($errors->get('new_password') as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                    </ul>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="confirmpassword">@lang('authguard::resetpassword.forms.label.confirm_password')</label>
                                <input type="password" name="confirm_password" class="form-control" id="confirmpassword" placeholder="@lang('authguard::resetpassword.forms.placeholder.confirm_password')">
                                @if($errors->get('confirm_password'))
                                    <ul class="text-danger">
                                    @foreach ($errors->get('confirm_password') as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                    </ul>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary">@lang('authguard::resetpassword.buttons.submit')</button>

                        </form>

                    @else

                        @include('authguard::auth.tokenexpire', ['url'=> $url] )

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@stop
