{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
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
            <a href="#" class="h1"><b>Location </b>Voiture</a>
        </div>
        <div class="card-body">
            <h3 class=" text-center">Véfification d'Email</h3>
            <p class="login-box-msg">
                Merci pour l'enregistrement! Avant de commencer, pourriez-vous vérifier votre adresse e-mail en cliquant sur le lien que nous venons de vous envoyer par e-mail ? Si vous n'avez pas reçu l'e-mail, nous vous en enverrons volontiers un autre.
            </p>

            {{-- @if(session('error'))
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
            @endif --}}

            <div class="row">
                <div class="col-7">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                        <button type="submit" class="btn btn-success btn-block">Renvoyer l'e-mail de vérification</button>

                        <!-- /.col -->

                        <!-- /.col -->
                    </form>
                </div>

                <div class="col-5">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit" class="btn btn-danger btn-block">
                            {{ __('Se déconnecter') }}
                        </button>
                    </form>
                </div>
            </div>

        </div>
        <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
