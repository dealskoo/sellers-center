@extends('seller::layouts.auth')

@section('title',__('seller::auth.create_new_password'))

@section('body')
    <div class="align-items-center d-flex h-100">
        <div class="card-body">

            <!-- Logo -->
            <div class="auth-brand text-center text-lg-start">
                <a href="{{ route('seller.dashboard') }}" class="logo-dark">
                    <span><img src="{{ asset(config('seller.logo')) }}" alt="" height="40"></span>
                </a>
                <a href="{{ route('seller.dashboard') }}" class="logo-light">
                    <span><img src="{{ asset(config('seller.logo_dark')) }}" alt="" height="40"></span>
                </a>
            </div>

            <!-- title-->
            <h4 class="mt-0">{{ __('seller::auth.create_new_password') }}</h4>
            <p class="text-muted mb-4">{{ __('seller::auth.create_new_password_tip',['length'=>config('seller.password_length')]) }}</p>

            <!-- form -->
            <form action="{{ route('seller.password.update') }}" method="post">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('seller::auth.email_address') }}</label>
                    <input class="form-control" type="email" id="email" name="email" value="{{ old('email') }}" required
                           placeholder="{{ __('seller::auth.email_address_placeholder') }}">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('seller::auth.password') }}</label>
                    <input class="form-control" type="password" required id="password"
                           min="{{ config('seller.password_length') }}"
                           placeholder="{{ __('seller::auth.password_placeholder') }}">
                </div>
                <div class="mb-3">
                    <label for="password_confirmation"
                           class="form-label">{{ __('seller::auth.confirm_password') }}</label>
                    <input class="form-control" type="password" required id="password_confirmation"
                           min="{{ config('seller.password_length') }}"
                           placeholder="{{ __('seller::auth.confirm_password_placeholder') }}">
                </div>
                <div class="mb-0 d-grid text-center">
                    <button class="btn btn-primary" type="submit"><i
                            class="mdi mdi-account-circle"></i> {{ __('seller::auth.create_new_password') }}
                    </button>
                </div>
            </form>
            <!-- end form-->
        </div> <!-- end .card-body -->
    </div> <!-- end .align-items-center.d-flex.h-100-->
@endsection
