@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Подтверждение e-mail адреса') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('На ваш e-mail отправлена ссылка для подтверждения') }}
                        </div>
                    @endif

                    {{ __('Проверьте свой e-mail') }}
                    {{ __('Если ссылка не пришла') }}, <a href="{{ route('verification.resend') }}">{{ __('нажмите, чтобы получить заново') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
