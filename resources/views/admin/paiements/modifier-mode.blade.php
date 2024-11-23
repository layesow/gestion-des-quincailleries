<!-- resources/views/admin/paiements/modifier-mode.blade.php -->

@extends('admin.layouts.master')

@section('contenu')
<div class="content-wrapper">
    <div class="content-header">
        <h1>Modifier le Mode de Paiement</h1>
    </div>
    <div class="content">
        <form action="{{ route('paiements.mettre-a-jour-mode', $paiement->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="mode_paiement_id">Mode de Paiement</label>
                <select name="mode_paiement_id" id="mode_paiement_id" class="form-control">
                    @foreach ($modesPaiement as $mode)
                        <option value="{{ $mode->id }}" {{ $paiement->mode_paiement_id == $mode->id ? 'selected' : '' }}>
                            {{ $mode->nom }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
</div>
@endsection
