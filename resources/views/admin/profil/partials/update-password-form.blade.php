
    {{-- <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('New Password')" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form> --}}


    <form method="post" action="{{ route('password.update') }}" class="form-border"  class="mt-6 space-y-6">
        @csrf
        @method('put')
        <p class="mt-1 text-sm text-gray-600">
            {{ __('Assurez-vous que votre compte utilise un mot de passe long et aléatoire pour rester en sécurité.') }}
        </p>
        <div class="content">
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-6 mb-3">
                        <h5>Mot de passe actuel</h5>
                        <input type="password" name="current_password" id="update_password_current_password" class="form-control" placeholder="Entrez votre mot de passe actuel" autocomplete="current-password" />
                        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" style="color: red" />
                    </div>

                    <div class="col-lg-6 mb-3">
                        <h5>Confirmation du Mot de passe</h5>
                        <input type="password" name="password_confirmation" id="update_password_password_confirmation" class="form-control" placeholder="Confirmez votre nouveau mot de passe" autocomplete="new-password" />
                        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" style="color: red" />
                    </div>

                    <div class="col-lg-12 mb-3">
                        <h5>Nouveau Mot de passe</h5>
                        <input type="password" name="password" id="update_password_password" class="form-control" placeholder="Entrez votre nouveau mot de passe" autocomplete="new-password" />
                        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" style="color: red" />
                    </div>

                </div>
            </div>
        </div>

        <input type="submit" id="submit" class="btn btn-primary" value="Mettre à jour le mot de passe">

        @if (session('status') === 'password-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600"
            >{{ __('Enregistré.') }}</p>
        @endif


    </form>
