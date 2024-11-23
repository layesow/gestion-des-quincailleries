@extends('admin.layouts.master')
@section('contenu')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Depenses</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                <li class="breadcrumb-item active">Depense</li>
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
                            <h3 class="card-title">Liste des Depenses</h3>
                            <a href="" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-default"
                                style="float: right;">Ajouter une Depenses</a>
                        </div>
                        <div class="card-body">
                            @if(isset($depenses))
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Description</th>
                                            <th>Montant</th>
                                            <th>Date de Dépense</th>
                                            <th>Caisse</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($depenses as $depense)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $depense->description }}</td>
                                            <td>{{ number_format($depense->montant, 0, ',', ' ') }} FCFA</td>
                                            <td>{{ \Carbon\Carbon::parse($depense->date_depense)->format('d/m/Y') }}</td>
                                            <td>{{ $depense->caisse->nom }}</td>
                                            <td>
                                                <div class="row" style="flex-wrap: nowrap;">
                                                    <button type="button" class="btn btn-primary mr-2 ml-3"><i class="far fa-eye"></i></button>
                                                    <button type="button" class="btn btn-success mr-2" data-toggle="modal" data-target="#modal-default{{ $depense->id }}"><i class="fas fa-edit"></i></button>

                                                    <form action="{{ route('sup-depense', $depense->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette depense ?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger mr-2"><i class="far fa-trash-alt"></i></button>
                                                    </form>

                                                </div>
                                            </td>
                                        </tr>
                                        <!-- produit edit modal -->
                                        @include('admin.depenses.edit')
                                        <!-- /.fin produit edit modal -->
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p>Aucune depense trouvé.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- produit creation modal -->
    @include('admin.depenses.add')
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
