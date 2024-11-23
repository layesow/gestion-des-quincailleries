<div class="modal fade" id="modal-default{{ $produit->id }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modifier un produit</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('update-produit', ['id' => $produit->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInput">code_barre</label>
                                    <input type="text" name="code_barre" class="form-control" id="exampleInput" placeholder="Entrer votre code_barre" value="{{ $produit->code_barre }}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="categorie_id">Catégorie</label>
                                    <select class="form-control" id="categorie_id" name="categorie_id" required>
                                        <option value="">--Choisir une catégorie--</option>
                                        @foreach ($categories as $categorie)
                                            <option value="{{ $categorie->id }}" {{ $produit->categorie_id == $categorie->id ? 'selected' : '' }}>{{ $categorie->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="exampleInput">Nom du produit</label>
                                <input type="text" name="nom" class="form-control" id="exampleInput" placeholder="Nom du produit" value="{{ $produit->nom }}" required>
                            </div>
                            <div class="col-md-2">
                                <label for="exampleInput">prix</label>
                                <input type="text" name="prix" class="form-control" id="exampleInput" placeholder="Entrer votre prix" value="{{ floor($produit->prix) }}" step="1">
                            </div>
                            {{-- <div class="col-md-4">
                                <label for="exampleInput">quantite</label>
                                <input type="text" name="quantite" class="form-control" id="exampleInput" placeholder="Entrer votre téléphone" value="{{ $produit->quantite }}">
                            </div> --}}
                            <div class="col-md-3">
                                <label for="currentStock">Quantité actuelle</label>
                                <input type="text" class="form-control" id="currentStock"
                                       value="{{ $produit->stocks->first() ? $produit->stocks->first()->quantite_actuelle : 0 }}"
                                       readonly>
                            </div>

                            <div class="col-md-3">
                                <label for="addStock">Ajouter au stock</label>
                                <input type="number" name="quantite" class="form-control" id="addStock"
                                       placeholder="Ajouter une quantité" value="0" min="0">
                            </div>


                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                                <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="2">{{ $produit->description }}</textarea>
                            </div>
                        </div>
                    </div>


                    <hr>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="exampleInputFile">L'image de l'engence</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input name="photo" type="file" class="custom-file-input" id="exampleInputFile" class="form-control-file">
                                        <label class="custom-file-label" for="exampleInputFile">Choisir le fichier</label>
                                    </div>
                                </div>
                                <div>
                                    @if($produit->photo)
                                        <img src="{{ asset('produitImages/' . $produit->photo) }}" alt="Image actuelle de l'agence" style="max-width: 50%;">

                                    @else
                                        <p>Aucune image actuelle</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Select</label>
                                <select class="form-control" id="statut" name="statut" required>
                                    <option value="">--Choisir le statut--</option>
                                    @foreach ($statut as $statu)
                                        <option value="{{ $statu }}" {{ old('statut', $produit->statut) == $statu ? 'selected' : '' }}>
                                            {{ $statu }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
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

    <script>
        // Écoutez le changement de l'input de type fichier
        document.getElementById('exampleInputFile').addEventListener('change', function(e) {
            // Obtenez le nom du fichier sélectionné
            var fileName = e.target.files[0].name;

            // Mettez à jour le libellé du champ personnalisé avec le nom du fichier
            document.querySelector('.custom-file-label').innerHTML = fileName;
        });
    </script>

</div>
