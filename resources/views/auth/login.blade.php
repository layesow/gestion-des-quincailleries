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
            <a href="#" class="h1"><b>Location </b>Voiture</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">S'identifier pour commencer la session</p>

            @if(session('error'))
                <div class="alert alert-danger mt-2" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            @if(session('info'))
                <div class="alert alert-info mt-2" role="alert">
                    {{ session('info') }}
                </div>
            @endif
            @if(session('success'))
                <div class="alert alert-success mt-2" role="alert">
                    <h3 class="mb-3 text-center">Compte créé avec succès</h3>
                    <p class="lead">{{ session('success') }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
            <div class="input-group mb-3">
                <input class="form-control" id="email" class="block mt-1 w-full" type="email" name="email" placeholder="Votre email" :value="old('email')"  autofocus autocomplete="username">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            {{-- erreur div --}}
            <div class="mb-3">
                @if ($errors->has('email'))
                    <div class="mt-0 text-danger">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>

            <div class="input-group mb-3">
                <input class="form-control" id="password" class="block mt-1 w-full" type="password" name="password" placeholder="Mot de passe" {{-- required --}} autocomplete="current-password">
                <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
                </div>
            </div>
            <div class="">
                @if ($errors->has('password'))
                    <div class="mb-3 text-danger">
                        {{ $errors->first('password') }}
                    </div>
                @endif
                {{-- <x-input-error :messages="$errors->get('password')" class="mt-0 text-danger" /> --}}
            </div>
            <div class="row">
                <div class="col-7">
                <div class="icheck-success">
                    <input type="checkbox" id="remember">
                    <label for="remember">
                        Se souvenir de moi
                    </label>
                </div>
                </div>
                <!-- /.col -->
                <div class="col-5">
                <button type="submit" class="btn btn-success btn-block">Se connecter</button>
                </div>
                <!-- /.col -->
            </div>
            </form>


            <!-- /.social-auth-links -->

            <p class="mb-1">
                @if (Route::has('password.request'))
                    {{-- <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a> --}}
                    <a href="{{ route('password.request') }}">J'ai oublié mon mot de passe</a>
                @endif
            </p>
            <p class="mb-0">
            <a href="{{ route('register') }}" class="text-center">Inscrivez-vous</a> si vous n'avez pas de compte
            </p>
        </div>
        <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
