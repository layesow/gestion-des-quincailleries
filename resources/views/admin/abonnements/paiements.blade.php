@extends('admin.layouts.master')
@section('contenu')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Liste des paiements</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                <li class="breadcrumb-item active">Liste des paiements</li>
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
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Abonnement</th>
                                        <th>Montant</th>
                                        <th>Date de paiement</th>
                                        <th>Statut</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($paiements as $paiement)
                                        <tr>
                                            <td>{{ $paiement->id }}</td>
                                            <td>{{ $paiement->abonnement->quincaillerie->name }}</td>
                                            <td>{{ $paiement->montant }}</td>
                                            <td>{{ $paiement->date_paiement ?? 'En attente' }}</td>
                                            <td>{{ ucfirst($paiement->statut) }}</td>
                                            <td>
                                                @if($paiement->statut == 'en attente')
                                                    <form action="{{ route('paiement.valider', $paiement->abonnement_id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success">Valider</button>
                                                    </form>
                                                @else
                                                    <span class="badge badge-info">Effectué</span>
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
        </div>
    </section>
</div>
@endsection

