<div class="modal fade" id="modal-default{{ $categorie->id }}">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ajouter une Catégorie</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('update-categorie', ['id' => $categorie->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="exampleInput">Nom de la catégorie</label>
                                <input type="text" name="nom" value="{{ $categorie->nom }}" class="form-control" id="exampleInput"
                                    placeholder="Nom de la catégorie" required>
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
