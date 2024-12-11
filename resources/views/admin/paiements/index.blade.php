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
                                            <td>{{ $paiement->abonnement->planAbonnement->nom }}
                                                (@if($paiement->abonnement && $paiement->abonnement->quincaillerie)
                                                {{ $paiement->abonnement->quincaillerie->name }}
                                            @else
                                                Non défini
                                            @endif)
                                            </td>
                                            <td>{{ number_format($paiement->montant, 0, ',', ' ') }} FCFA</td>
                                            <td>{{ \Carbon\Carbon::parse($paiement->date_paiement)->format('d/m/Y') }}</td>
                                            {{-- <td>
                                                <a href="#" data-toggle="modal" data-target="#modalModifierMode{{ $paiement->id }}"
                                                    data-paiement-id="{{ $paiement->id }}"
                                                    data-mode-paiement-id="{{ $paiement->mode_paiement_id }}">
                                                    {{ $paiement->modePaiement->nom }}
                                                </a>
                                            </td> --}}
                                            <td>
                                                <a href="#" data-toggle="modal" data-target="#modalModifierMode{{ $paiement->id }}"
                                                    data-paiement-id="{{ $paiement->id }}"
                                                    data-mode-paiement-id="{{ $paiement->mode_paiement_abonne_id }}">
                                                    {{ $paiement->modePaiementAbonne->nom ?? 'Non défini' }}
                                                </a>
                                            </td>

                                            <td>
                                                <span class="
                                                    badge
                                                    @if($paiement->statut == 'en attente')
                                                        badge-secondary
                                                    @elseif($paiement->statut == 'effectué')
                                                        badge-info
                                                    @endif
                                                ">
                                                    {{ ucfirst($paiement->statut) }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($paiement->statut == 'en attente')
                                                    <form action="{{ route('paiements.valider', $paiement->id) }}" method="POST">
                                                        @csrf
                                                        <button class="btn btn-success" type="submit">Valider</button>
                                                    </form>
                                                @else
                                                    <span class="badge badge-success">Paiement Effectué</span>
                                                @endif
                                            </td>
                                        </tr>

                                        <!-- Modal pour modifier le mode de paiement -->
                                        <div class="modal fade" id="modalModifierMode{{ $paiement->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Modifier le Mode de Paiement</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('paiements.mettre-a-jour-mode', $paiement->id) }}" method="POST">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="mode_paiement_abonne_id">Mode de Paiement</label>
                                                                <select name="mode_paiement_abonne_id" id="mode_paiement_abonne_id" class="form-control">
                                                                    @foreach ($modesPaiementAbonne as $mode)
                                                                        <option value="{{ $mode->id }}" {{ $paiement->mode_paiement_abonne_id == $mode->id ? 'selected' : '' }}>
                                                                            {{ $mode->nom }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                            <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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
