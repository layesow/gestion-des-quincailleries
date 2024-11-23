{{-- <x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}


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
            <a href="#" class="h2"><b>Location </b>Voiture</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Réinitialiser votre mot de passe</p>

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

            <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="input-group mb-3">
                <input class="form-control" id="email" class="block mt-1 w-full" type="email" name="email" value="{{ old('email') }}"" required autofocus autocomplete="username" placeholder="Email">
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
                <input class="form-control" id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" placeholder="Password">
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

            <div class="input-group mb-3">
                <input class="form-control" id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="confirme mot de passe">
                <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
                </div>
            </div>
            <div class="">
                @if ($errors->has('password'))
                    <div class="mb-3 text-danger">
                        {{ $errors->first('password_confirmation') }}
                    </div>
                @endif
                {{-- <x-input-error :messages="$errors->get('password')" class="mt-0 text-danger" /> --}}
            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-12">
                <button type="submit" class="btn btn-success btn-block">Réinitialiser le mot de passe</button>
                </div>
                <!-- /.col -->
            </div>
            </form>



        </div>
        <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection


