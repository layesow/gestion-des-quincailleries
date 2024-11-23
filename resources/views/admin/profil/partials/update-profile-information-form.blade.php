
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
    <form id="form-create-item" class="form-border" method="post" action="{{ route('profil-admin.update') }}">
        @csrf
        @method('patch')

        <div class="content">
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-4 mb-2 ">
                        <h5>Prénom</h5>
                        <input type="text" name="prenom" id="prenom" class="form-control" placeholder="Entrez votre prenom" value="{{ old('prenom', $user->prenom) }}" required  autocomplete="prenom" />
                    </div>
                    <div class="col-lg-4 mb-2 ">
                        <h5>Nom</h5>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Entrez votre nom" value="{{ old('name', $user->name) }}" required  autocomplete="name" />
                    </div>
                    <div class="col-lg-4 mb-2">
                        <h5>Adresse Email</h5>
                        <input type="text" name="email" id="email" class="form-control" placeholder="Entrez votre email" value="{{ old('email', $user->email) }}" required autocomplete="username" />

                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 mb-2 ">
                        <h5>Telephone</h5>
                        <input type="text" name="telephone" id="telephone" class="form-control" placeholder="Entrez votre telephone" value="{{ old('telephone', $user->telephone) }}" required  autocomplete="telephone" />
                    </div>
                    <div class="col-lg-6 mb-2 ">
                        <h5>Adresse</h5>
                        <input type="text" name="adresse" id="adresse" class="form-control" placeholder="Entrez votre nom" value="{{ old('adresse', $user->adresse) }}" required  autocomplete="adresse" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 mb-2 ">
                        <h5>Ville</h5>
                        <input type="ville" name="ville" id="ville" class="form-control" placeholder="Entrez votre ville" value="{{ old('ville', $user->ville) }}" required  autocomplete="ville" />
                    </div>
                    <div class="col-lg-6 mb-2 ">
                        <h5>Date de naissance</h5>
                        <input type="date" name="date_naissance" id="date_naissance" class="form-control" placeholder="Entrez votre date_naissance" value="{{ old('adresse', $user->date_naissance) }}" required  autocomplete="date_naissance" />
                    </div>
                </div>
            </div>
        </div>

        <input type="submit" id="submit" class="btn btn-primary" value="Mettre à jour ton profil">
    </form>
