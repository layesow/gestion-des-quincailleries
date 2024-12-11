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
                <label for="mode_paiement_abonne_id">Mode de Paiement</label>
                <select name="mode_paiement_abonne_id" id="mode_paiement_abonne_id" class="form-control">
                    @foreach ($modePaiementAbonne as $mode)
                        <option value="{{ $mode->id }}" {{ old('mode_paiement_abonne_id', $paiement->mode_paiement_abonne_id) == $mode->id ? 'selected' : '' }}>
                            {{ $mode->nom }}
                        </option>
                    @endforeach
                </select>
                @error('mode_paiement_abonne_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
</div>
@endsection
