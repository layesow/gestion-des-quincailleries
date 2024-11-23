<!-- resources/views/admin/paiements/creer.blade.php -->
@extends('admin.layouts.master')

@section('contenu')
<div class="content-wrapper">
    <div class="content-header">
        <h1>Créer un Paiement pour {{ $abonnement->planAbonnement->nom }}</h1>
    </div>
    <div class="content">
        <form action="{{ route('paiements.enregistrer', $abonnement->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="mode_paiement_id">Mode de Paiement</label>
                <select name="mode_paiement_id" id="mode_paiement_id" class="form-control">
                    <option value="1">Carte Bancaire</option>
                    <option value="2">Mobile Money</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer le Paiement</button>
        </form>
    </div>
</div>
@endsection
