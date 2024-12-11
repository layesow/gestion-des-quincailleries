<div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ajouter un Mode Paiement Abonne</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('ajouter-modePaiementAbonne') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="exampleInput">Mode Paiement</label>
                                <input type="text" name="nom" class="form-control" id="exampleInput"
                                    placeholder="Mode Paiement" required>
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