@extends('admin.layouts.master')
@section('contenu')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Catégories</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                <li class="breadcrumb-item active">catégorie</li>
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
                            <h3 class="card-title">Liste des catégories</h3>
                            <a href="" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-default"
                                style="float: right;">Ajouter une catégorie</a>
                        </div>
                        <div class="card-body">
                            @if(isset($categories))
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Nom de la catégorie</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($categories as $categorie)
                                        <tr>
                                            <td>{{$loop->index +1}}</td>
                                            <td>{{ $categorie->nom }}</td>
                                            <td>
                                                <div class="row" style="flex-wrap: nowrap;">
                                                    <button type="button" class="btn btn-primary mr-2 ml-3"><i class="far fa-eye"></i></button>
                                                    <button type="button" class="btn btn-success mr-2" data-toggle="modal" data-target="#modal-default{{ $categorie->id }}"><i class="fas fa-edit"></i></button>

                                                    <form action="{{ route('sup-categorie', $categorie->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette categorie ?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger mr-2"><i class="far fa-trash-alt"></i></button>
                                                    </form>

                                                </div>
                                            </td>
                                        </tr>
                                        <!-- produit edit modal -->
                                        @include('admin.categories.edit')
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
    @include('admin.categories.add')
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
