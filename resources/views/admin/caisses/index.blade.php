@extends('admin.layouts.master')
@section('contenu')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Caisse</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                <li class="breadcrumb-item active">Caisse</li>
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
                            <h3 class="card-title">Liste des Caisse</h3>
                            <a href="" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-default"
                                style="float: right;">Ajouter une Caisse</a>
                        </div>
                        <div class="card-body">
                            @if(isset($caisses))
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Nom de la caisse</th>
                                            <th>solde_initial</th>
                                            <th>solde_actuel</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($caisses as $caisse)
                                        <tr>
                                            <td>{{$loop->index +1}}</td>
                                            <td>{{ $caisse->nom }}</td>
                                            <td>{{ number_format($caisse->solde_initial, 0, ',', ' ') }} </td>
                                            <td>{{ number_format($caisse->solde_actuel, 0, ',', ' ') }} </td>

                                            <td>
                                                <div class="row" style="flex-wrap: nowrap;">
                                                    <button type="button" class="btn btn-primary mr-2 ml-3"><i class="far fa-eye"></i></button>
                                                    <button type="button" class="btn btn-success mr-2" data-toggle="modal" data-target="#modal-default{{ $caisse->id }}"><i class="fas fa-edit"></i></button>

                                                    @if($caisses->count() > 1)
                                                        <form action="{{ route('sup-caisse', $caisse->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette caisse ?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger mr-2"><i class="far fa-trash-alt"></i></button>
                                                        </form>
                                                    @else
                                                        <button type="button" class="btn btn-danger mr-2" disabled><i class="far fa-trash-alt"></i></button>
                                                    @endif


                                                </div>
                                            </td>
                                        </tr>
                                        <!-- produit edit modal -->
                                        @include('admin.caisses.edit')
                                        <!-- /.fin produit edit modal -->
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p>Aucune caiss trouvé.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- produit creation modal -->
    @include('admin.caisses.add')
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
