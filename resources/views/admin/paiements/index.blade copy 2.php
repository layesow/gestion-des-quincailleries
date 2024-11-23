@extends('admin.layouts.master')
@section('contenu')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Liste des Paiements</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                <li class="breadcrumb-item active">Liste des Paiements</li>
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
                            <h3 class="card-title">Liste des Paiements</h3>
                        </div>
                        <div class="card-body">

                            <!-- Affichage des abonnements -->
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Abonnement</th>
                                        <th>Montant</th>
                                        <th>Date</th>
                                        <th>Mode de Paiement</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($paiements as $paiement)
                                        <tr>
                                            <td>{{ $paiement->id }}</td>
                                            <td>{{ $paiement->abonnement->planAbonnement->nom }}</td>
                                            <td>{{ $paiement->montant }} F CFA</td>
                                            <td>{{ $paiement->date_paiement }}</td>
                                            <td>
                                                <a href="{{ route('paiements.modifier-mode', $paiement->id) }}">
                                                    {{ $paiement->modePaiement->nom }}
                                                </a>
                                            </td>
                                            <td>{{ ucfirst($paiement->statut) }}</td>
                                            <td>
                                                @if($paiement->statut == 'en attente')
                                                    <form action="{{ route('paiements.valider', $paiement->id) }}" method="POST">
                                                        @csrf
                                                        <button class="btn btn-success" type="submit">Valider</button>
                                                    </form>
                                                @else
                                                    <span class="badge badge-success">Effectué</span>
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

