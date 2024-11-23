<div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ajouter une voiture</h4>
                {{-- ajoute une alert pour lui dire que l'annonce sera traité, validée ou invalidé par l'admin lor de publication --}}
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('ajouter-voiture') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <div class="alert alert-warning p-0 text-center" role="alert">
                            Votre annonce sera examinée par l'administrateur avant d'être publiée. Cette étape peut prendre un certain temps. Merci de votre patience.
                        </div>


                        <div class="row">
                            <div class="col-md-4">
                                <label for="exampleInput">marque</label>
                                <input type="text" name="marque" class="form-control" id="exampleInput"
                                    placeholder="Entrer votre marque" required>
                            </div>
                            <div class="col-md-4">
                                <label for="exampleInput">immatriculation</label>
                                <input type="text" name="immatriculation" class="form-control" id="exampleInput"
                                    placeholder="Entrer votre immatriculation" required>
                            </div>
                            <div class="col-md-4">
                                <label for="exampleInput">modele</label>
                                <input type="text" name="modele" class="form-control" id="exampleInput"
                                    placeholder="Entrer votre modele" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="exampleFormControlTextarea1" class="form-label">Description de la voiture</label>
                                <textarea name="description" class="form-control" id="summernote0" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="exampleInput">annee</label>
                                <input type="number" name="annee" class="form-control" id="exampleInput"
                                    placeholder="Entrer l'annee" required>
                            </div>

                            <div class="col-md-6">
                                <label for="exampleInput">nombre_places</label>
                                <input type="number" name="nombre_places" class="form-control" id="exampleInput"
                                    placeholder="Entrer le nombre de places" required>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="exampleInput">nombre_portes</label>
                                    <input type="number" name="nombre_portes" class="form-control" id="exampleInput"
                                        placeholder="Entrer le nombre portes">
                            </div>

                            <div class="col-md-4">
                                <label for="climatisation">Climatisation</label>
                                <select class="form-control" id="climatisation" name="climatisation">
                                    <option value="1">Oui</option>
                                    <option value="0">Non</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                    <label for="exampleInput">boite_de_vitesses</label>
                                    <input type="text" name="boite_de_vitesses" class="form-control" id="exampleInput"
                                        placeholder="Entrer la boite_de_vitesses">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Type de Carburant</label>
                                <select class="form-control" id="carburant" name="carburant" required>
                                    <option value="">--Choisir le Carburant--</option>
                                    @foreach ($carburant as $carbu)
                                    <option value="{{ $carbu }}">{{ $carbu }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInput">prix_journee</label>
                                <input type="number" name="prix_journee" class="form-control" id="exampleInput"
                                    placeholder="Entrer le prix par jour" required>
                            </div>

                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="exampleInputFile">L'image de la voiture</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input name="photo[]" multiple type="file" class="custom-file-input" id="exampleInputFile" class="form-control-file">
                                        <label class="custom-file-label" for="exampleInputFile">Choisir le fichier</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>Statut</label>
                                <select class="form-control" id="statut" name="statut" required>
                                    <option value="">--Choisir le statut--</option>
                                    @foreach ($statut as $statu)
                                    <option value="{{ $statu }}">{{ $statu }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="exampleInput">couleur</label>
                                <input type="text" name="couleur" class="form-control" id="exampleInput"
                                    placeholder="Entrer la couleur" required>
                            </div>
                            <div class="col-md-6">
                                <label>Type de Transmission</label>
                                <select class="form-control" id="transmission" name="transmission" required>
                                    <option value="">--Choisir Transmission--</option>
                                    @foreach ($transmission as $trans)
                                    <option value="{{ $trans }}">{{ $trans }}</option>
                                    @endforeach
                                </select>
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
