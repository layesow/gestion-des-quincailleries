@extends('admin.layouts.master')
@section('contenu')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Abonnement</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                <li class="breadcrumb-item active">Abonnement</li>
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
                        <div class="card-body">
                            <h2>Souscrire au Plan : {{ $plan->nom }}</h2>
                        <form action="{{ route('enregistrer.souscription', ['planId' => $plan->id]) }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="plan_nom">Nom du Plan</label>
                                <input type="text" id="plan_nom" class="form-control" value="{{ $plan->nom }}" readonly>
                            </div>

                            <div class="form-group">
                                <label for="plan_description">Description</label>
                                <textarea id="plan_description" class="form-control" readonly>{{ $plan->description }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="plan_duree">Durée</label>
                                <input type="text" id="plan_duree" class="form-control" value="{{ $plan->duree_jours }} jours" readonly>
                            </div>

                            <div class="form-group">
                                <label for="plan_prix">Prix</label>
                                <input type="text" id="plan_prix" class="form-control" value="{{ $plan->prix }} FCFA" readonly>
                            </div>

                            <button type="submit" class="btn btn-primary float-right">Confirmer votre abonnement</button>
                        </form>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </section>
</div>
@endsection

