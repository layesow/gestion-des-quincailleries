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
                @foreach($plans as $plan)
                    <div class="col-md-4 mb-4">
                        <div class="card border-light rounded-lg shadow-lg bg-light">
                            <div class="card-body text-center">
                                <h3 class=" text-primary mb-3">{{ $plan->nom }}</h3>
                                <hr>
                                <p class="card-text mx-2" style="font-size: 1.25rem;"><strong>Durée :</strong> {{ $plan->duree_jours }} jours</p>
                                <p class="card-text mx-2 text-success" style="font-size: 1.25rem;"><strong>Prix :</strong> {{ $plan->prix }} FCFA</p>
                                <a href="{{ route('souscrire', ['planId' => $plan->id]) }}" class="btn btn-primary btn-lg w-100">S'abonner</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
@endsection

