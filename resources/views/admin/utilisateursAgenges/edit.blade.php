<div class="modal fade" id="modal-default{{ $utilisateur->id }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modifier un utilisateur</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('update-utilisateur', ['id' => $utilisateur->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="exampleInput">Prenom</label>
                                <input type="text" name="prenom" class="form-control" id="exampleInput"
                                    placeholder="Entrer votre prenom" value="{{ $utilisateur->prenom }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="exampleInput">Nom</label>
                                <input type="text" name="name" class="form-control" id="exampleInput"
                                    placeholder="Nom de l'utilisateur" value="{{ $utilisateur->name }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="exampleInput">Email</label>
                                <input type="email" name="email" class="form-control" id="exampleInput"
                                    placeholder="Entrer votre email" value="{{ $utilisateur->email }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="exampleInput">Telephone</label>
                                <input type="tel" name="telephone" class="form-control" id="exampleInput"
                                    placeholder="Entrer votre telephone" value="{{ $utilisateur->telephone }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="exampleInput">Adresse</label>
                                <input type="text" name="adresse" class="form-control" id="exampleInput"
                                    placeholder="Entrer votre adresse" value="{{ $utilisateur->adresse }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="exampleInput">Ville</label>
                                <input type="text" name="ville" class="form-control" id="exampleInput"
                                    placeholder="Entrer votre ville" value="{{ $utilisateur->ville }}" required>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="exampleInput">Date de naissance</label>
                                <input type="date" name="date_naissance" class="form-control" value="{{ $utilisateur->date_naissance }}" id="exampleInput">
                            </div>
                            <div class="col-md-4">
                                <label>Selectionner le statut</label>
                                <select class="form-control" id="statut" name="statut" required>
                                    <option value="">--Choisir le statut--</option>
                                    @foreach ($statut as $statu)
                                        <option value="{{ $statu }}" {{ $utilisateur->statut == $statu ? 'selected' : '' }}>
                                            {{ $statu }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="exampleInput">Mot de passe</label>
                                <input type="password" name="password" class="form-control" id="exampleInput"
                                    placeholder="Entrer votre password">
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Enregister</button>
                </div>
            </form>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->

</div>
