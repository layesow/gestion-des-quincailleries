@extends('admin.layouts.master')
@section('contenu')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> modes paiement abonne</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                <li class="breadcrumb-item active"> modes_paiement_abonne</li>
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Liste des paiement abonne</h3>
                            <a href="" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-default"
                                style="float: right;">Ajouter un  mode paiement abonne</a>
                        </div>
                        <div class="card-body">
                            @if(isset($modePaiementAbonnes))
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Nom du  modes_paiement</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($modePaiementAbonnes as $modePaiementAbonne)
                                        <tr>
                                            <td>{{$loop->index +1}}</td>
                                            <td>{{ $modePaiementAbonne->nom }}</td>
                                            <td>
                                                <div class="row" style="flex-wrap: nowrap;">
                                                    <button type="button" class="btn btn-primary mr-2 ml-3"><i class="far fa-eye"></i></button>
                                                    <button type="button" class="btn btn-success mr-2" data-toggle="modal" data-target="#modal-default{{ $modePaiementAbonne->id }}"><i class="fas fa-edit"></i></button>

                                                    <form action="{{ route('sup-modePaiementAbonne', $modePaiementAbonne->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce mode Paiement ?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger mr-2"><i class="far fa-trash-alt"></i></button>
                                                    </form>

                                                </div>
                                            </td>
                                        </tr>
                                        <!-- produit edit modal -->
                                        @include('admin.mode_paiement_abonne.edit')
                                        <!-- /.fin produit edit modal -->
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p>Aucune voiture trouvé.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- produit creation modal -->
    @include('admin.mode_paiement_abonne.add')
    <!-- /.fin produit creation modal -->
</div>
@endsection

{{-- CK-EDITOR script --}}
@section('script_js')
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
    ClassicEditor
        .create( document.querySelector( '#editorAdd' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection
