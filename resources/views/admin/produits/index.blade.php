@extends('admin.layouts.master')
@section('contenu')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Produit</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                <li class="breadcrumb-item active">Produit</li>
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
                            <h3 class="card-title">Liste des Produits</h3>
                            <a href="" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-default"
                                style="float: right;">Ajouter un Produit</a>
                        </div>
                        <div class="card-body">
                            @if(isset($produits) && count($produits) > 0)
                            <form action="{{ route('delete-multiple-produits') }}" method="POST" id="delete-multiple-form">
                                @csrf
                                @method('DELETE')
                                <div class="card-header mx-0">
                                    <button type="submit" class="btn btn-danger btn-sm float-right"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer les produits sélectionnés ?')">
                                        Supprimer les produits sélectionnés
                                    </button>
                                </div>
                            </form>
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="select-all"></th>

                                            <th>#ID</th>
                                            <th>code_barre</th>
                                            <th>photo</th>
                                            <th>nom</th>
                                            <th>prix_de_vente</th>
                                            <th>quantite</th>
                                            {{-- <th>description</th> --}}
                                            {{-- <th>categorie</th> --}}
                                            <th>Statut</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($produits as $produit)
                                        <tr>
                                            <td><input type="checkbox" name="ids[]" form="delete-multiple-form" value="{{ $produit->id }}"></td>

                                            <td>{{$loop->index +1}}</td>
                                            <td>{{ $produit->code_barre }}</td>
                                            <td>
                                                {{-- {{ $agence->photo }} --}}
                                                @if ($produit->photo)
                                                <img class="mx-1" src="{{ asset('produitImages/'.$produit->photo) }}" alt="Image 1" style="max-width: 50%">
                                                @else
                                                    Pas d'image
                                                @endif
                                            </td>
                                            <td>{{ $produit->nom }}</td>
                                            <td>{{ number_format($produit->prix, 0, ',', ' ') }} FCFA</td>
                                            {{-- <td>{{ $produit->quantite }}</td> --}}
                                            <td>
                                                @php
                                                    $stock = $produit->stocks->first(); // Récupère le premier stock lié au produit
                                                @endphp
                                                {{ $stock ? $stock->quantite_actuelle : 'Stock non défini' }}
                                            </td>
                                            {{-- <td>
                                                {!! substr(strip_tags($produit->description), 0, 15) !!}{{ strlen(strip_tags($produit->description)) > 15 ? '...' : '' }}
                                            </td> --}}

                                            {{-- <td>{{ $produit->categorie->nom }}</td> --}}
                                            <td>
                                                @if($produit->statut == "public")
                                                <span class="badge badge-success">public</span>
                                                @else
                                                <span class="badge badge-danger">prive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="row" style="flex-wrap: nowrap;">
                                                    <button type="button" class="btn btn-primary mr-2 ml-3"><i class="far fa-eye"></i></button>
                                                    <button type="button" class="btn btn-success mr-2" data-toggle="modal" data-target="#modal-default{{ $produit->id }}"><i class="fas fa-edit"></i></button>
                                                    <form action="{{ route('sup-produit', $produit->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger mr-2"><i class="far fa-trash-alt"></i></button>
                                                    </form>

                                                </div>
                                            </td>
                                        </tr>
                                        <!-- produit edit modal -->
                                        @include('admin.produits.edit')
                                        <!-- /.fin produit edit modal -->
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p>Aucune voiture trouvé.</p>
                            @endif
                        </div>
                        <script>
                            document.getElementById('select-all').addEventListener('click', function(e) {
                                const checkboxes = document.querySelectorAll('input[name="ids[]"]');
                                checkboxes.forEach(checkbox => {
                                    checkbox.checked = e.target.checked;
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- produit creation modal -->
    @include('admin.produits.add')
    <!-- /.fin produit creation modal -->
</div>
@endsection



