<div class="modal fade" id="modal-default{{ $voiture->id }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modifier une voiture</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('update-voiture', ['id' => $voiture->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="exampleInput">marque</label>
                                <input type="text" name="marque" class="form-control" id="exampleInput"
                                    placeholder="Entrer votre marque" value="{{ $voiture->marque }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="exampleInput">immatriculation</label>
                                <input type="text" name="immatriculation" class="form-control" id="exampleInput"
                                    placeholder="Entrer votre immatriculation" value="{{ $voiture->immatriculation }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="exampleInput">modele</label>
                                <input type="text" name="modele" class="form-control" id="exampleInput"
                                    placeholder="Entrer votre modele" value="{{ $voiture->modele }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="exampleFormControlTextarea1" class="form-label">Description de la voiture</label>
                                <textarea name="description" class="form-control" id="summernoteVoiture{{ $voiture->id }}" rows="2">{{ $voiture->description }}</textarea>
                            </div>
                        </div>
                    </div>
                    {{-- <script>
                        // Initialisation de CKEditor pour la partie d'édition
                        ClassicEditor
                            .create( document.querySelector( '#editor' ) )
                            .catch( error => {
                                console.error( error );
                            } );
                    </script> --}}
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="exampleInput">annee</label>
                                <input type="number" name="annee" class="form-control" id="exampleInput"
                                    placeholder="Entrer l'annee" value="{{ $voiture->annee }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInput">nombre_places</label>
                                <input type="number" name="nombre_places" class="form-control" id="exampleInput"
                                    placeholder="Entrer le nombre de places" value="{{ $voiture->nombre_places }}" required>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="exampleInput">nombre_portes</label>
                                    <input type="number" name="nombre_portes" class="form-control" id="exampleInput"
                                        placeholder="Entrer le nombre portes" value="{{ $voiture->nombre_portes }}">
                            </div>

                            <div class="col-md-4">
                                <label for="climatisation">Climatisation</label>
                                <select class="form-control" id="climatisation" name="climatisation">
                                    <option value="1" {{ $voiture->climatisation == 1 ? 'selected' : '' }}>Oui</option>
                                    <option value="0" {{ $voiture->climatisation == 0 ? 'selected' : '' }}>Non</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                    <label for="exampleInput">boite_de_vitesses</label>
                                    <input type="text" name="boite_de_vitesses" class="form-control" id="exampleInput"
                                        placeholder="Entrer la boite_de_vitesses" value="{{ $voiture->boite_de_vitesses }}">
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
                                        <option value="{{ $carbu }}" {{ $voiture->carburant == $carbu ? 'selected' : '' }}>
                                            {{ $carbu }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInput">prix_journee</label>
                                <input type="number" name="prix_journee" class="form-control" id="exampleInput"
                                    placeholder="Entrer le prix par jour" value="{{ $voiture->prix_journee }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="exampleInput">couleur</label>
                                <input type="text" name="couleur" class="form-control" id="exampleInput"
                                    placeholder="Entrer la couleur" value="{{ $voiture->couleur }}" required>
                            </div>
                            <div class="col-md-6">
                                <label>Type de Transmission</label>
                                <select class="form-control" id="transmission" name="transmission" required>
                                    <option value="">--Choisir Transmission--</option>
                                    @foreach ($transmission as $trans)
                                        <option value="{{ $trans }}" {{ $voiture->transmission == $trans ? 'selected' : '' }}>
                                            {{ $trans }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Statut</label>
                                <select class="form-control" id="statut" name="statut" required>
                                    <option value="">--Choisir le statut--</option>

                                    @foreach ($statut as $statu)
                                        <option value="{{ $statu }}" {{ $voiture->statut == $statu ? 'selected' : '' }}>
                                            {{ $statu }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputFile1">L'image de la voiture</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile" name="photo[]" multiple>
                                        <label class="custom-file-label" for="exampleInputFile">Choisir des fichiers</label>
                                        </div>
                                    </div>
                                    <div>
                                            @if($voiture->photo)
                                        <label>Photos actuelles de la voiture :</label>
                                        <div class="d-flex flex-wrap">
                                            @foreach(json_decode($voiture->photo) ?? [] as $photo)
                                                @if(file_exists(public_path('images/voitures/' . $photo)))
                                                    <img src="{{ asset('images/voitures/' . $photo) }}" alt="Voiture Photo" class="mr-2 mb-2" style="max-width: 40%">
                                                @else
                                                    <p>Image non trouvée : {{ $photo }}</p>
                                                @endif
                                            @endforeach
                                        </div>
                                        @else
                                            <p>Aucune image actuelle pour la voiture</p>
                                        @endif

                                    </div>

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
        <script>
            $('[id^="exampleInputFile"]').change(function(e) {
                var id = $(this).attr('id').replace('exampleInputFile', '');
                var fileName = e.target.files[0].name;
                $('.custom-file-label[for="exampleInputFile' + id + '"]').html(fileName);
            });
        </script>
    </div>
    <!-- /.modal-dialog -->
    <script>
        document.getElementById('exampleInputFile').addEventListener('change', function(e) {
            var files = e.target.files;
            var fileNames = [];
            for (var i = 0; i < files.length; i++) {
                fileNames.push(files[i].name);
            }
            document.querySelector('.custom-file-label').innerHTML = fileNames.join(', ');
        });
    </script>
</div>


