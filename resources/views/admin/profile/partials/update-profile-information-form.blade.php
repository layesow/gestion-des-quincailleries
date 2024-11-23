
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
    <form id="form-create-item" class="form-border" method="post" action="{{ route('profil.update') }}">
        @csrf
        @method('patch')

        <h4 class="active"><span>Profil</span></h4>
        <div class="content">
                <div class="row">
                    <div class="col-lg-6 mb20">
                        <h5>Nom</h5>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Entrez votre nom" value="{{ old('name', $user->name) }}" required  autocomplete="name" />

                    </div>
                    <div class="col-lg-6 mb20">
                        <h5>Adresse Email</h5>
                        <input type="text" name="email" id="email" class="form-control" placeholder="Entrez votre email" value="{{ old('email', $user->email) }}" required autocomplete="username" />

                    </div>
                </div>
        </div>

        <input type="submit" id="submit" class="btn-main" value="Mettre à jour le profil">
    </form>
