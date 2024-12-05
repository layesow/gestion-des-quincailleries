@extends('admin.layouts.master')
@section('contenu')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

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
                            <style>
                                /* Pour assurer une taille uniforme des cartes */
                                .card {
                                    min-height: 150px; /* Ajustez cette valeur selon vos besoins */
                                    display: flex;
                                    flex-direction: column;
                                    justify-content: space-between;
                                }

                                /* Pour gérer la taille du titre */
                                .card-title {
                                    white-space: nowrap; /* Empêche le texte de passer à la ligne */
                                    overflow: hidden;    /* Cache tout ce qui dépasse */
                                    text-overflow: ellipsis; /* Affiche '...' à la fin si le texte est trop long */
                                    max-width: 100%;     /* Limite la largeur du titre pour éviter tout débordement */
                                }

                                /* Pour une hauteur minimale sur la card-body */
                                .card-body {
                                    flex-grow: 1;
                                    display: flex;
                                    flex-direction: column;
                                    justify-content: space-between;
                                }

                                .card-link {
                                    color: black !important; /* Assure que le texte reste noir */
                                    text-decoration: none;   /* Supprime le soulignement */
                                }

                                .card-link:hover .card-body {
                                    border: 1.5px solid rgb(20, 114, 237); /* Applique un contour plus visible au survol */
                                }

                                .card-body {
                                    transition: border-color 0.5s ease-in-out, border-width 0.5s ease-in-out; /* Transition plus rapide et fluide */
                                    border: 1px solid transparent; /* Bordure invisible par défaut */
                                }



                                #product-grid {
                                    max-height: 350px; /* Définir la hauteur maximale selon vos besoins */
                                    overflow-y: auto;  /* Activer le défilement vertical */
                                    padding-right: 10px; /* Ajout d'espace pour un défilement plus fluide */
                                }

                                .product-item {
                                    margin-bottom: 20px; /* Espacement entre les cartes */
                                }



                            </style>
                            <div class="row">
                                <!-- Liste des Produits -->
                                <div class="col-md-8 col-sm-12">
                                    <h5>Point de Vente (POS)</h5>
                                    <input type="text" id="search" class="form-control mb-3" placeholder="Rechercher un produit...">

                                    <div class="row" id="product-grid">
                                        @foreach($produits as $produit)

                                            <div class="col-md-3 col-sm-6 product-item" data-nom="{{ $produit->nom }}">
                                                <a href="javascript:void(0);" class="card-link add-to-cart text-black"
                                                    data-id="{{ $produit->id }}"
                                                    data-nom="{{ $produit->nom }}"
                                                    data-prix="{{ $produit->prix }}">

                                                    <div class="card mb-3 mt-2">
                                                        <div class="card-body p-2 text-center">
                                                            <!-- Gestion de l'image -->
                                                            @if($produit->photo)
                                                                <img src="{{ asset('produitImages/' .$produit->photo) }}" class="card-img-top img-fluid small-img" alt="{{ $produit->nom }}">
                                                            @else
                                                                <img src="{{ asset('imageVides/chariot.png') }}" class="card-img-top img-fluid small-img" alt="Produit par défaut">
                                                            @endif

                                                            <!-- Nom du produit -->
                                                            <h5 class="card-title mt-1">{{ $produit->nom }}</h5>

                                                            <!-- Prix -->
                                                            <p class="card-text text-center">
                                                                {{ number_format($produit->prix, 0, ',', ' ') }} CFA
                                                                @php
                                                                    // Calculer la quantité disponible dans les stocks associés
                                                                    $quantiteTotale = $produit->stocks->sum('quantite_actuelle');
                                                                @endphp
                                                                <span style="background-color: {{ $quantiteTotale <= 5 ? '#f30d0d' : '#28a745' }}; color: white; padding: 1px 5px; border-radius: 5px;">
                                                                    {{ $quantiteTotale }}
                                                                </span>

                                                            </p>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>


                                </div>


                                <!-- Résumé de la Vente -->
                                <div class="col-md-4 col-sm-12">
                                    <h5>Résumé de la Vente</h5>
                                    <form action="{{ route('pos.store') }}" method="POST" id="vente-form">
                                        @csrf
                                        
                                        {{-- fait deux champ avec row input prenom et nom des champ simple --}}
                                        <div class="form-row">
                                            <div class="col">
                                              <input type="text" name="client_nom" class="form-control" placeholder="Nom client">
                                            </div>
                                            <div class="col">
                                              <input type="tel" name="client_telephone" class="form-control" placeholder="telephone client" pattern="^\+?[0-9\s]{9,15}$" title="Entrez un numéro valide (9 à 15 chiffres, avec ou sans +)">
                                            </div>
                                        </div>



                                        <div class="mb-3" style="max-height: 300px; overflow-y: auto;">
                                        <table class="table table-bordered" id="cart-table">
                                            <thead>
                                                <tr>
                                                    <th>Produit</th>
                                                    <th>Quantité</th>
                                                    <th>Prix</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Les lignes du panier seront ajoutées ici via JavaScript -->
                                            </tbody>
                                        </table>
                                        </div>

                                        <div class="form-group">
                                            <hr>
                                            <label for="total">Total: </label>
                                            <input type="hidden" name="total" id="total" value="0">
                                            <span id="total-display">0 CFA</span>
                                        </div>

                                        <div class="form-group">
                                            <label>Mode de Paiement :</label><br>
                                            <div class="d-flex justify-content-start">
                                                @foreach($modesPaiement as $mode)
                                                    <div class="btn-group mr-2">
                                                        <button type="button" class="btn btn-outline-secondary btn-sm mode-paiement" data-id="{{ $mode->id }}">
                                                            {{ $mode->nom }}
                                                        </button>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <input type="hidden" name="modes_paiement_id" id="selected_mode_paiement" required>
                                        </div>
                                        {{-- <select name="modes_paiement_id" required>
                                            @foreach($modesPaiement as $mode)
                                                <option value="{{ $mode->id }}">{{ $mode->nom }}</option>
                                            @endforeach
                                        </select> --}}
                                        <script>
                                            document.querySelectorAll('.mode-paiement').forEach(button => {
                                                button.addEventListener('click', function() {
                                                    // Retirer la classe active de tous les boutons
                                                    document.querySelectorAll('.mode-paiement').forEach(btn => {
                                                        btn.classList.remove('active');
                                                        btn.classList.add('btn-outline-secondary'); // Ajouter le style par défaut
                                                        btn.classList.remove('btn-success'); // Retirer le style actif
                                                    });

                                                    // Ajouter la classe active au bouton cliqué
                                                    this.classList.add('active');
                                                    this.classList.remove('btn-outline-secondary'); // Retirer le style par défaut
                                                    this.classList.add('btn-success'); // Ajouter le style actif

                                                    // Mettre à jour le champ caché avec l'ID du mode de paiement sélectionné
                                                    document.getElementById('selected_mode_paiement').value = this.dataset.id;
                                                });
                                            });
                                        </script>


                                        <button type="submit" class="btn btn-success">Enregistrer la Vente</button>
                                    </form>
                                </div>
                            </div>

                            <style>
                                .card-body {
                                    overflow: auto; /* Permet de faire défiler le contenu si nécessaire */
                                }
                            </style>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection

@section('scriptsPOS')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('search');
        const productItems = document.querySelectorAll('.product-item');

        searchInput.addEventListener('input', function () {
            const searchTerm = this.value.toLowerCase();

            productItems.forEach(item => {
                const productName = item.getAttribute('data-nom').toLowerCase();
                if (productName.includes(searchTerm)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
    </script>

<script>
// Gestion du panier avec JavaScript
document.addEventListener('DOMContentLoaded', function () {
    const cart = [];
    let total = 0;

    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    const cartTableBody = document.querySelector('#cart-table tbody');
    const totalInput = document.getElementById('total');
    const totalDisplay = document.getElementById('total-display');

   // Ajouter la logique pour gérer les prix promotionnels dans le panier
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const nom = this.getAttribute('data-nom');
            const prix = parseFloat(this.getAttribute('data-prix')); // Le prix est soit promo soit standard

            const existingProduct = cart.find(item => item.id === id);
            if (existingProduct) {
                existingProduct.quantite += 1;
            } else {
                cart.push({ id, nom, prix, quantite: 1 });
            }

            updateCart();
        });
    });


    function updateCart() {
        // Réinitialise le tableau
        cartTableBody.innerHTML = '';
        total = 0;

        cart.forEach(item => {
            const row = document.createElement('tr');

            /* row.innerHTML = `
                <td>${item.nom}</td>
                <td>
                    <input type="number" min="1" value="${item.quantite}" class="form-control quantite" data-id="${item.id}">
                </td>
                <td>${(item.prix * item.quantite).toFixed(2)}</td>
                <td>
                    <button class="btn btn-danger remove-item" data-id="${item.id}"><i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                </td>
            `; */
            row.innerHTML = `
                <td>${item.nom}</td>
                <td>
                    <input type="number" min="1" value="${item.quantite}" class="form-control quantite" data-id="${item.id}">
                </td>
                <td>${Math.round(item.prix * item.quantite)}</td>
                <td>
                    <button class="btn btn-danger remove-item" data-id="${item.id}"><i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                </td>
            `;

            cartTableBody.appendChild(row);

            //total += item.prix * item.quantite;
            total += Math.round(item.prix * item.quantite);

        });

        totalInput.value = total;
        //totalDisplay.textContent = total.toFixed(2) + ' CFA';
        totalDisplay.textContent = Math.round(total) + ' CFA';


        // Ajouter les écouteurs pour les nouvelles actions
        document.querySelectorAll('.quantite').forEach(input => {
            input.addEventListener('change', function () {
                const id = this.getAttribute('data-id');
                const newQuantite = parseInt(this.value);
                const product = cart.find(item => item.id === id);
                if (product) {
                    product.quantite = newQuantite;
                    updateCart();
                }
            });
        });

        document.querySelectorAll('.remove-item').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const index = cart.findIndex(item => item.id === id);
                if (index !== -1) {
                    cart.splice(index, 1);
                    updateCart();
                }
            });
        });
    }

    // Lorsque le formulaire est soumis, ajoute les produits au formulaire
    document.getElementById('vente-form').addEventListener('submit', function (e) {
        // Empêche la soumission si le panier est vide
        if (cart.length === 0) {
            e.preventDefault();
            alert('Le panier est vide!');
        } else {
            // Crée des champs cachés pour chaque produit
            cart.forEach(item => {
                const inputId = document.createElement('input');
                inputId.type = 'hidden';
                inputId.name = `produits[${item.id}][id]`;
                inputId.value = item.id;
                this.appendChild(inputId);

                const inputQuantite = document.createElement('input');
                inputQuantite.type = 'hidden';
                inputQuantite.name = `produits[${item.id}][quantite]`;
                inputQuantite.value = item.quantite;
                this.appendChild(inputQuantite);
            });
        }
    });
});
</script>
@endsection
