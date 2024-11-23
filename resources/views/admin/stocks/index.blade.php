@extends('admin.layouts.master')
@section('contenu')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Stock</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                <li class="breadcrumb-item active">Stock</li>
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
                        </div>
                        <div class="card-body">
                            @if(isset($stocks))
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Photo</th>
                                            <th>Nom_du_produit_en_stock</th>
                                            <th>quantite_actuelle_dans_le_stock</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($stocks as $stock)
                                        <tr>
                                            <td>{{$loop->index +1}}</td>
                                            {{-- condition pour avoir produit vide sil ny pas de photo --}}
                                            @if($stock->produit->photo)
                                            <td>
                                                <img class="mx-1" src="{{ asset('produitImages/'.$stock->produit->photo) }}" alt="Image 1" style="max-width: 10%">
                                            </td>
                                                @else
                                                <td>pas de photo</td>
                                            @endif
                                            <td>{{ $stock->produit->nom }}</td> <!-- Afficher le nom du produit -->
                                            <td>{{ $stock->quantite_actuelle }}</td>

                                        </tr>
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
    {{-- @include('admin.categories.add') --}}
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
