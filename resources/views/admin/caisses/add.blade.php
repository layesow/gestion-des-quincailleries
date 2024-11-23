<div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ajouter une caisse</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('ajouter-caisse') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="nom">Nom de la caisse</label>
                                <input type="text" name="nom" class="form-control" id="nom"
                                    placeholder="Nom de la caisse" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="solde_initial">Solde initial</label>
                                <input type="text" name="solde_initial" class="form-control" id="solde_initial"
                                    placeholder="Solde initial" required>
                            </div>
                        </div>
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
</div>
