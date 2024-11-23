{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
    </x-guest-layout>
--}}

@extends('layouts.auth')
@section('form')
<style>
    .login-box {
    width: 50%;
    }

    @media (max-width: 768px) {
        .login-box {
            width: 90%;
        }
    }
</style>
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-success card-outline">
        <div class="card-header text-center">
            <a href="#" class="h3"><b>Location </b>Voiture</a>
        </div>
        <div class="card-body">
            <h5 class=" text-center">Mot de passe oublié</h5>
            <p class="login-box-msg">
                Vous avez oublié votre mot de passe ? Pas de problème. Indiquez-nous votre adresse électronique et nous vous enverrons un lien de réinitialisation du mot de passe qui vous permettra d'en choisir un nouveau.
            </p>

            <!-- Session Status -->
            @if (session('status'))
                <div class="alert alert-info">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="input-group mb-3">
                            <input class="form-control" id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"  autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            @if ($errors->has('email'))
                                <div class="mb-3 text-danger">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>

                        <div class="input-group mb-3">
                            <button type="submit" class="btn btn-success btn-block">Lien de réinitialisation du mot de passe</button>
                            </div>

                        <div>
                    </form>
                </div>

            </div>

        </div>
        <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
