@extends('authguard::layouts.master')

@section('content')
    <h1>@lang('authguard::welcome.hello_word')</h1>

    <p>
        @lang('authguard::welcome.loadfrom'){!! config('authguard.name') !!}
    </p>
@endsection
