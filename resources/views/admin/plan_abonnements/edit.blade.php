<div class="modal fade" id="modal-default{{ $plan->id }}">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">modifier le plan d'aboonement</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('update-plan', ['id' => $plan->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="nom">Nom</label>
                                <input type="text" name="nom" value="{{ old('nom', $plan->nom) }}" class="form-control" id="nom"
                                    placeholder="Nom du plan" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control" id="description">{{ old('description', $plan->description) }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="duree_jours">Durée (en jours)</label>
                                <input type="number" name="duree_jours" class="form-control" id="duree_jours"
                                    value="{{ old('duree_jours', $plan->duree_jours) }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="prix">Prix</label>
                                <input type="number" name="prix" class="form-control" id="prix"
                                    value="{{ old('prix', $plan->prix) }}" step="0.01" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="statut">Statut</label>
                                <select name="statut" class="form-control" id="statut" required>
                                    <option value="actif" {{ old('statut', $plan->statut) == 'actif' ? 'selected' : '' }}>Actif</option>
                                    <option value="inactif" {{ old('statut', $plan->statut) == 'inactif' ? 'selected' : '' }}>Inactif</option>
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
