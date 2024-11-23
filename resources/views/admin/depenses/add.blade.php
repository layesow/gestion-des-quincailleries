<div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ajouter une depense</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('ajouter-depense') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="caisse_id">Caisse</label>
                        <select name="caisse_id" id="caisse_id" class="form-control" required>
                            <option value="">Sélectionner une caisse</option>
                            @foreach($caisses as $caisse)
                                <option value="{{ $caisse->id }}">{{ $caisse->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" name="description" id="description" class="form-control" placeholder="Description de la dépense" required>
                    </div>
                    <div class="form-group">
                        <label for="montant">Montant</label>
                        <input type="number" name="montant" id="montant" class="form-control" placeholder="Montant de la dépense" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="date_depense">Date de dépense</label>
                        <input type="date" name="date_depense" id="date_depense" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
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
