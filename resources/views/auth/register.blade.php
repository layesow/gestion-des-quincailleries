@extends('layouts.regist')
@section('form')
<style>
    .register-box {
    width: 60%;
    }

    @media (max-width: 768px) {
        .register-box {
            width: 90%;
        }
    }
    /* Styles pour améliorer l'apparence du champ de date sur les appareils mobiles */
@media (max-width: 768px) {
    input[type="date"].form-control {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        position: relative;
        display: inline-block;
        padding: 0.625em;
        font-size: 1em;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
    }

    /* Placeholder pour le champ de date */
    input[type="date"].form-control::before {
        content: attr(placeholder);
        color: #6c757d;
        display: block;
        position: absolute;
        top: 50%;
        left: 0.625em;
        transform: translateY(-50%);
        pointer-events: none;
    }

    input[type="date"].form-control:focus::before,
    input[type="date"].form-control:not(:placeholder-shown)::before {
        display: none;
    }
}

</style>
<div class="register-box" style="overflow-y: auto;height:85%;">
    <div class="card card-success card-outline">
        <div class="card-header text-center">
            <a href="#" class="h1"><b>Location </b>Voiture</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success mt-2" role="alert">
                    <p class="mb-3"><strong>Compte créé avec succès</strong></p>
                    <p class="lead">{{ session('success') }}</p>
                </div>
            @endif
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                @error('prenom')
                                    <div class="mt-2 text-danger">{{ $message }}</div>
                                @enderror
                                <div class="input-group mb-3">
                                    <input type="text" id="prenom" class="form-control" placeholder="Prénom" name="prenom" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @error('name')
                                    <div class="mt-2 text-danger">{{ $message }}</div>
                                @enderror
                                <div class="input-group mb-3">
                                    <input type="text" id="name" class="form-control" placeholder="Nom" name="name" required autofocus autocomplete="name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                @error('email')
                                    <div class="mt-2 text-danger">{{ $message }}</div>
                                @enderror
                                <div class="input-group mb-3">
                                    <input type="email" id="email" class="form-control" placeholder="Email" name="email" :value="old('email')" required autocomplete="username">
                                </div>
                            </div>
                            <div class="col-md-6">
                                @error('telephone')
                                    <div class="mt-2 text-danger">{{ $message }}</div>
                                @enderror
                                <div class="input-group mb-3">
                                    <input type="tel" id="telephone" class="form-control" placeholder="Téléphone" name="telephone" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                @error('adresse')
                                    <div class="mt-2 text-danger">{{ $message }}</div>
                                @enderror
                                <div class="input-group mb-3">
                                    <input type="text" id="adresse" class="form-control" placeholder="Adresse" name="adresse" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @error('ville')
                                    <div class="mt-2 text-danger">{{ $message }}</div>
                                @enderror
                                <div class="input-group mb-3">
                                    <input type="text" id="ville" class="form-control" placeholder="Ville" name="ville" required>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="input-group mb-3">
                            <div class="input-group">
                                @error('date_naissance')
                                    <div class="mt-2 text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <input type="date" id="date_naissance" class="form-control" name="date_naissance" required>
                        </div> --}}
                        <div class="input-group mb-3">
                            <div class="input-group">
                                @error('date_naissance')
                                    <div class="mt-2 text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control" id="date_naissance" name="date_naissance" data-inputmask-alias="datetime" placeholder="Date de naissance" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" inputmode="numeric">
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                @error('password')
                                    <div class="mt-2 text-danger">{{ $message }}</div>
                                @enderror
                                <div class="input-group mb-3">
                                    <input type="password" id="password" class="form-control" placeholder="Mot de passe" name="password" required autocomplete="new-password">
                                </div>
                            </div>
                            <div class="col-md-6">
                                @error('password_confirmation')
                                    <div class="mt-2 text-danger">{{ $message }}</div>
                                @enderror
                                <div class="input-group mb-3">
                                    <input type="password" id="password_confirmation" class="form-control" placeholder="Confirmer le mot de passe" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            @foreach ($roles as $role)
                            @if ($role->name === 'client' || $role->name === 'agence')
                                <label style="margin-right: 20px;" inline-flex items-center class="@if ($role->name === 'agence') agence-fields-trigger @endif">
                                <input type="radio" name="role" value="{{ $role->name }}" {{ $role->name === 'client' ? 'checked' : '' }} class="rounded border-gray-100 text-indigo-100 shadow-sm focus:border-indigo-200 focus:ring focus:ring-indigo-100 focus:ring-opacity-50 m-1" />
                                <span class="ml-2.5 mr-2">{{ $role->name }}</span>
                                </label>
                            @endif
                            @endforeach
                        </div>
                        {{-- <div class="input-group mb-3">
                            @foreach ($roles as $role)
                            @if ($role->name === 'client' || $role->name === 'agence')
                                <label style="margin-right: 20px;" inline-flex items-center class="@if ($role->name === 'agence') agence-fields-trigger @endif">
                                    <input type="radio" name="role" value="{{ $role->name }}" {{ $role->name === 'client' ? 'checked' : '' }} class="rounded border-gray-100 text-indigo-100 shadow-sm focus:border-indigo-200 focus:ring focus:ring-indigo-100 focus:ring-opacity-50 m-1" />
                                    <span class="ml-2.5 mr-2">
                                        {{ $role->name === 'agence' ? 'Agence ou Prestataire' : $role->name }}
                                    </span>
                                </label>
                            @endif
                            @endforeach
                        </div> --}}

                    </div>
                    <div class="col-md-12" id="agence-fields" style="display: none;">
                        <div class="row">
                            <div class="col-md-6">
                                @error('agence_name')
                                    <div class="mt-2 text-danger">{{ $message }}</div>
                                @enderror
                                <div class="input-group mb-3">
                                    <input type="text" id="agence_name" class="form-control" placeholder="nom de l'agence (requis)" name="agence_name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                @error('agence_email')
                                    <div class="mt-2 text-danger">{{ $message }}</div>
                                @enderror
                                <div class="input-group mb-3">
                                    <input type="email" id="agence_email" class="form-control" placeholder="email de l'agence (obtionnel)" name="agence_email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                @error('agence_telephone')
                                    <div class="mt-2 text-danger">{{ $message }}</div>
                                @enderror
                                <div class="input-group mb-3">
                                    <input type="tel" id="agence_telephone" class="form-control" placeholder="telephone de l'agence (obtionnel)" name="agence_telephone">
                                </div>
                            </div>
                            <div class="col-md-6">
                                @error('agence_adresse')
                                    <div class="mt-2 text-danger">{{ $message }}</div>
                                @enderror
                                <div class="input-group mb-3">
                                    <input type="text" id="agence_adresse" class="form-control" placeholder="adresse de l'agence (obtionnel)" name="agence_adresse">
                                </div>
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <input type="text" id="agence_ville" class="form-control" placeholder="ville de l'agence" name="agence_ville">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <input type="text" id="agence_pays" class="form-control" placeholder="pays de l'agence" name="agence_pays">
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-success">
                            <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                            <label for="agreeTerms">
                                J'accepte les <a href="#">termes et conditions</a>
                            </label>
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-success btn-block">S'inscrire</button>
                    </div>
                </div>
            </form>
            <a href="{{ route('login') }}" class="text-center">J'ai déjà un compte</a>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const agenceFields = document.getElementById('agence-fields');
        const roleInput = document.querySelector('input[name="role"]:checked');
        if (roleInput.value === 'client') {
        agenceFields.style.display = 'none';
        }
    });

    document.querySelectorAll('input[name="role"]').forEach(roleInput => {
        roleInput.addEventListener('change', function() {
        const agenceFields = document.getElementById('agence-fields');
        const roleValue = this.value;
        agenceFields.style.display = roleValue === 'agence' ? 'block' : 'none';
        agenceFields.querySelectorAll('input, textarea').forEach(field => field.value = ''); // Clear agence fields
        });
    });
</script>
@endsection

{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="prenom" :value="__('Prénom')" />
            <x-text-input id="prenom" class="block mt-1 w-full" type="text" name="prenom" required />
            <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="telephone" :value="__('Téléphone')" />
            <x-text-input id="telephone" class="block mt-1 w-full" type="tel" name="telephone" required />
            <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="adresse" :value="__('Adresse')" />
            <x-text-input id="adresse" class="block mt-1 w-full" type="text" name="adresse" required />
            <x-input-error :messages="$errors->get('adresse')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="ville" :value="__('Ville')" />
            <x-text-input id="ville" class="block mt-1 w-full" type="text" name="ville" required />
            <x-input-error :messages="$errors->get('ville')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="date_naissance" :value="__('Date de naissance')" />
            <x-text-input id="date_naissance" name="date_naissance" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" type="date" required />
            <x-input-error :messages="$errors->get('date_naissance')" class="mt-2" />
        </div>


 <div class="mt-4">
    <x-input-label for="role" :value="__('Rôle')" />
    <div class="block mt-1">
        @foreach ($roles as $role)
          @if ($role->name === 'client' || $role->name === 'agence')
            <label style="margin-right: 20px;" inline-flex items-center class="@if ($role->name === 'agence') agence-fields-trigger @endif">
              <input type="radio" name="role" value="{{ $role->name }}" {{ $role->name === 'client' ? 'checked' : '' }} class="rounded border-gray-100 text-indigo-100 shadow-sm focus:border-indigo-200 focus:ring focus:ring-indigo-100 focus:ring-opacity-50 m-1" />
              <span class="ml-2.5 mr-2">{{ $role->name }}</span>
            </label>
          @endif
        @endforeach
      </div>
      <x-input-error :messages="$errors->get('role')" class="mt-2" />
    </div>


    <div id="agence-fields" style="display: none;">
        <div class="mt-4">
            <x-input-label for="agence_name" :value="__('Nom de l\'agence')" />
            <x-text-input id="agence_name" name="agence_name" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"  />
            <x-input-error :messages="$errors->get('agence_name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="agence_email" :value="__('Email de l\'agence')" />
            <x-text-input id="agence_email" name="agence_email" type="email" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"  />
            <x-input-error :messages="$errors->get('agence_email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="agence_telephone" :value="__('Téléphone de l\'agence')" />
            <x-text-input id="agence_telephone" name="agence_telephone" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"  />
            <x-input-error :messages="$errors->get('agence_telephone')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="agence_adresse" :value="__('Adresse de l\'agence')" />
            <x-text-input id="agence_adresse" name="agence_adresse" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"  />
            <x-input-error :messages="$errors->get('agence_adresse')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="agence_ville" :value="__('Ville de l\'agence')" />
            <x-text-input id="agence_ville" name="agence_ville" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"  />
            <x-input-error :messages="$errors->get('agence_ville')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="agence_pays" :value="__('Pays de l\'agence')" />
            <x-text-input id="agence_pays" name="agence_pays" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"  />
            <x-input-error :messages="$errors->get('agence_pays')" class="mt-2" />
        </div>

    </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
          const agenceFields = document.getElementById('agence-fields');
          const roleInput = document.querySelector('input[name="role"]:checked');
          if (roleInput.value === 'client') {
            agenceFields.style.display = 'none';
          }
        });

        document.querySelectorAll('input[name="role"]').forEach(roleInput => {
          roleInput.addEventListener('change', function() {
            const agenceFields = document.getElementById('agence-fields');
            const roleValue = this.value;
            agenceFields.style.display = roleValue === 'agence' ? 'block' : 'none';
            agenceFields.querySelectorAll('input, textarea').forEach(field => field.value = ''); // Clear agence fields
          });
        });
      </script>
</x-guest-layout> --}}

