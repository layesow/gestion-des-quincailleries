@extends('admin.layouts.master')
@section('contenu')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Utulisateurs</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                <li class="breadcrumb-item active">Utulisateurs</li>
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
                            <h3 class="card-title">Liste des utilisateurs</h3>
                            <a href="" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-default"
                                style="float: right;">Ajouter un utilisateur</a>
                        </div>
                        <div class="card-body">
                            @if(isset($users))
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Prénom</th>
                                            <th>Nom</th>
                                            <th>email</th>
                                            <th>telephone</th>
                                            <th>Adresse</th>
                                            <th>ville</th>
                                            <th>Agence</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                        <tr>
                                            <td>{{$loop->index +1}}</td>
                                            <td>{{ $user->prenom }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->telephone }}</td>
                                            <td>{{ $user->adresse }}</td>
                                            <td>{{ $user->ville }}</td>
                                            <td>{{ $user->agence ? $user->agence->name : 'Aucune agence associée' }}</td>
                                            <td>
                                                @foreach($user->roles as $role)
                                                    {{ $role->name }}
                                                    {{-- Si vous souhaitez afficher une virgule entre les rôles --}}
                                                    {{ $loop->last ? '' : ', ' }}
                                                @endforeach
                                            </td>
                                            <td>
                                                @if ($user->statut == "actif")
                                                <span class="badge badge-success">Actif</span>
                                                @else
                                                <span class="badge badge-danger">Inactif</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="row" style="flex-wrap: nowrap;">
                                                    <button type="button" class="btn btn-primary mr-2 ml-3"><i class="far fa-eye"></i></button>
                                                    <button type="button" class="btn btn-success mr-2" data-toggle="modal" data-target="#modal-default{{ $user->id }}"><i class="fas fa-edit"></i></button>

                                                    <form action="{{ route('sup-user', $user->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger mr-2"><i class="far fa-trash-alt"></i></button>
                                                    </form>

                                                </div>
                                            </td>
                                        </tr>
                                        <!-- produit edit modal -->
                                        @include('admin.utilisateurs.edit')
                                        <!-- /.fin produit edit modal -->
                                        @endforeach
                                    </tbody>
                                </table>
                                @else
                                    {{-- Gérer le cas où la variable $utilisateurs n'existe pas --}}
                                    <p>Aucun utilisateur trouvé.</p>
                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- produit creation modal -->
    @include('admin.utilisateurs.add')
    <!-- /.fin produit creation modal -->
</div>
@endsection
