@extends('admin.layouts.master')
@section('contenu')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Voitures</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                <li class="breadcrumb-item active">voitures</li>
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="alert alert-warning p-1 text-center" role="alert" id="alerte" style="opacity: 0; transition: opacity 0.5s ease-in-out;">
                Votre annonce sera examinée par l'administrateur avant d'être publiée. Cette étape peut prendre un certain temps. Merci de votre patience.
            </div>
            <script>
                // Fonction pour afficher l'alerte pendant 5 secondes puis la masquer pendant 3 secondes
                setInterval(function(){
                    var alerte = document.getElementById('alerte');
                    alerte.style.opacity = '1';
                    setTimeout(function(){
                        alerte.style.opacity = '0';
                        setTimeout(function(){
                            alerte.style.display = 'none';
                        }, 900);
                    }, 10000);
                }, 1000);
            </script>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Liste des voitures</h3>
                            <a href="" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-default"
                                style="float: right;">Ajouter une voiture</a>
                        </div>
                        <div class="card-body">
                            @if(isset($voitures))
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>immatriculation</th>
                                            <th>marque</th>
                                            <th>modele</th>
                                            <th>annee</th>
                                            <th>prix_journee</th>
                                            <th>nombre_places</th>
                                            <th>Status</th>
                                            <th>validation_anonne</th>

                                            <th>Couleur</th>
                                            <th>transmission</th>
                                            <th>carburant</th>
                                            <th>climatisation</th>
                                            <th>boite_de_vitesses</th>
                                            <th>photo</th>

                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($voitures as $voiture)
                                        <tr>
                                            <td>{{$loop->index +1}}</td>
                                            <td>{{ $voiture->immatriculation }}</td>
                                            <td>{{ $voiture->marque }}</td>
                                            <td>{{ $voiture->modele }}</td>
                                            <td>{{ $voiture->annee }}</td>
                                            <td>{{ $voiture->prix_journee }}</td>
                                            <td>{{ $voiture->nombre_places }}</td>
                                            <td>
                                                @if ($voiture->statut == "disponible")
                                                <span class="badge badge-success">Disponible</span>
                                                @elseif($voiture->statut == "en maintenance")
                                                <span class="badge badge-warning">En maintenance</span>
                                                @elseif($voiture->statut == "réservée")
                                                <span class="badge badge-info">Réservée</span>
                                                @else
                                                <span class="badge badge-danger">Louée</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($voiture->validation_status == "validée")
                                                <span class="badge badge-success">Validée</span>
                                                @elseif($voiture->validation_status == "en traitement")
                                                <span class="badge badge-warning">en traitement</span>
                                                @else
                                                <span class="badge badge-danger">invalidée</span>
                                                @endif
                                            </td>
                                            <td>{{ $voiture->couleur }}</td>
                                            <td>{{ $voiture->transmission }}</td>
                                            <td>{{ $voiture->carburant }}</td>
                                            <td>{{ $voiture->climatisation ? 'Oui' : 'Non' }}</td>
                                            <td>{{ $voiture->boite_de_vitesses }}</td>
                                            <td>@if (!empty($voiture->photo))
                                                @php
                                                    $photos = json_decode($voiture->photo);
                                                    $firstPhoto = reset($photos);
                                                @endphp
                                                <img src="{{ asset('images/voitures/' . $firstPhoto) }}" width="100" height="100" class="img-fluid" alt="Première photo de la voiture">

                                                <!-- Boucle pour accéder aux informations des autres photos -->
                                                @foreach(array_slice($photos, 1) as $photo)
                                                    <!-- Utilisez ici les informations des autres photos si nécessaire -->
                                                @endforeach
                                            @endif
                                        </td>
                                            <td>
                                                <div class="row" style="flex-wrap: nowrap;">
                                                    <button type="button" class="btn btn-primary mr-2 ml-3"><i class="far fa-eye"></i></button>
                                                    <button type="button" class="btn btn-success mr-2" data-toggle="modal" data-target="#modal-default{{ $voiture->id }}"><i class="fas fa-edit"></i></button>

                                                    <form action="{{ route('sup-voiture', $voiture->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette voiture ?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger mr-2"><i class="far fa-trash-alt"></i></button>
                                                    </form>

                                                </div>
                                            </td>
                                        </tr>
                                        <!-- produit edit modal -->
                                        @include('admin.voituresAgences.edit')
                                        <!-- /.fin produit edit modal -->
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                {{-- Gérer le cas où la variable $utilisateurs n'existe pas --}}
                                <p>Aucune voiture trouvé.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- produit creation modal -->
    @include('admin.voituresAgences.add')
    <!-- /.fin produit creation modal -->
</div>
@endsection

{{-- CK-EDITOR script --}}
{{-- @section('script_js')
<script>
    @foreach($voitures as $voiture)
    ClassicEditor
        .create( document.querySelector( '#editor{{ $voiture->id }}' ) )
        .catch( error => {
            console.error( error );
        } );
    @endforeach
    ClassicEditor
        .create( document.querySelector( '#editorAdd' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection --}}
@section('summer')
 <script>
    $(document).ready(function() {
        $('#summernote0').summernote({                // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: true                  // set focus to editable area after initializing summernote
        });
    });
</script>
 <script>
    $(document).ready(function() {
        $('[id^="summernoteVoiture"]').each(function() {
            $(this).summernote();
        });
    });
</script>
@endsection



