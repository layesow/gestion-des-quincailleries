@extends('admin.layouts.master')
@section('contenu')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Liste des Abonnements</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                <li class="breadcrumb-item active">Liste des Abonnements</li>
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Liste des Abonnements</h3>
                        </div>
                        <div class="card-body">
                            <!-- Affichage des abonnements -->
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Quincaillerie</th>
                                        <th>Plan Abonnement</th>
                                        <th>Date de début</th>
                                        <th>Date de fin</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($abonnements as $abonnement)
                                        <tr>
                                            <td>{{ $abonnement->id }}</td>
                                            <td>{{ $abonnement->quincaillerie->name }}</td>
                                            <td>{{ $abonnement->planAbonnement->nom }}</td>
                                            <td>
                                                {{ $abonnement->date_debut ? \Carbon\Carbon::parse($abonnement->date_debut)->format('d/m/Y') : 'Non définie' }}
                                            </td>
                                            <td>
                                                {{ $abonnement->date_fin ? \Carbon\Carbon::parse($abonnement->date_fin)->format('d/m/Y') : 'Non définie' }}
                                            </td>
                                            <td>
                                                <span class="
                                                    badge
                                                    @if($abonnement->statut == 'en attente')
                                                        badge-secondary
                                                    @elseif($abonnement->statut == 'actif')
                                                        badge-success
                                                    @elseif($abonnement->statut == 'expiré')
                                                        badge-danger
                                                    @elseif($abonnement->statut == 'inactif')
                                                        badge-warning
                                                    @endif
                                                ">
                                                    {{ ucfirst($abonnement->statut) }}
                                                </span>
                                            </td>
                                            <td>
                                                <!-- Vérifier si l'abonnement est en attente -->
                                                @if($abonnement->statut == 'en attente')
                                                    <!-- Bouton pour activer l'abonnement -->
                                                    <form action="{{ route('abonnements.mise_a_jour', $abonnement->id) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success">
                                                            Activer
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="badge badge-info">Déjà activé</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
        </div>
    </section>
</div>
@endsection

