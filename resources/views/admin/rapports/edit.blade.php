<div class="modal fade" id="modal-default{{ $rapport->id }}">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modifier le rapport</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('update-rapport', ['id' => $rapport->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <!-- Champ pour le titre du rapport -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="titre">Titre du rapport</label>
                                <input
                                    type="text"
                                    name="titre"
                                    value="{{ $rapport->titre }}"
                                    class="form-control"
                                    id="titre"
                                    placeholder="Titre du rapport"
                                    required
                                >
                            </div>
                        </div>
                    </div>

                    <!-- Champ pour la description du rapport -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="description">Description</label>
                                <textarea
                                    name="description"
                                    class="form-control"
                                    id="description"
                                    placeholder="Description du rapport"
                                    required
                                >{{ $rapport->description }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Champ pour la date du rapport -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="date_rapport">Date du rapport</label>
                                <input
                                    type="date"
                                    name="date_rapport"
                                    value="{{ $rapport->date_rapport }}"
                                    class="form-control"
                                    id="date_rapport"
                                    required
                                >
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Boutons de soumission et de fermeture -->
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
