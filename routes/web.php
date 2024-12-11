<?php

use App\Models\ModePaiementAbonne;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\StockController;
use App\Http\Controllers\Admin\VenteController;
use App\Http\Controllers\Admin\CaisseController;
use App\Http\Controllers\Admin\DepenseController;
use App\Http\Controllers\Admin\ProduitController;
use App\Http\Controllers\Admin\RapportController;
use App\Http\Controllers\Admin\PaiementController;
use App\Http\Controllers\Admin\CategorieController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AbonnementController;
use App\Http\Controllers\Admin\ProfilAdminController;
use App\Http\Controllers\Admin\ModePaiementController;
use App\Http\Controllers\Admin\QuincallerieController;
use App\Http\Controllers\Admin\PlanAbonnementController;
use App\Http\Controllers\Admin\ModePaiementAbonneController;

// front route

Route::get('/', function () {
    return view('welcome');
});




// route admin
Route::middleware(['auth', 'verified', 'role:admin|quincaillier|gestionnaire', /* 'check.quincaillerie.status' */])->prefix('admin')->group(function () {
    // Les routes admin et agence
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.index');

    //profile
    Route::get('/profil', [ProfilAdminController::class, 'edit'])->name('profil-admin.edit');
    Route::patch('/profil', [ProfilAdminController::class, 'update'])->name('profil-admin.update');
    Route::delete('/profil', [ProfilAdminController::class, 'destroy'])->name('profil-admin.destroy');

    //mode_paiement
    Route::get('/mode-paiement-abonne', [ModePaiementAbonneController::class, 'index'])->name('admin.modePaiementAbonne');
    Route::get("/mode-paiement-abonne/ajouter",[ModePaiementAbonneController::class,"create"])->name("ajouter-modePaiementAbonne");
    Route::post("/mode-paiement-abonne/ajouter",[ModePaiementAbonneController::class,"store"])->name("ajouter-modePaiementAbonne");
    Route::get('/mode-paiement-abonne/{id}/modifier', [ModePaiementAbonneController::class, 'edit'])->name('modifer-modePaiementAbonne');
    Route::put('/mode-paiement-abonne/{id}/modifier', [ModePaiementAbonneController::class, 'update'])->name('update-modePaiementAbonne');
    Route::delete('/mode-paiement-abonne/{id}', [ModePaiementAbonneController::class, 'destroy'])->name('sup-modePaiementAbonne');



    // Sous-groupe pour "admin"
    Route::group(['middleware' => 'role:admin'], function () {

        //Quincailleries
        Route::get('/quincailleries', [QuincallerieController::class, 'index'])->name('admin.quincaillerie');
        Route::get('/quincaillerie/ajouter', [QuincallerieController::class, 'create'])->name('ajouter-quincaillerie');
        Route::post('/quincaillerie/ajouter', [QuincallerieController::class, 'store'])->name('ajouter-quincaillerie');
        Route::get('/quincaillerie/{id}/modifier', [QuincallerieController::class, 'edit'])->name('modifer-quincaillerie');
        Route::put('/quincaillerie/{id}/modifier', [QuincallerieController::class, 'update'])->name('update-quincaillerie');
        Route::delete('/quincaillerie/{id}', [QuincallerieController::class, 'destroy'])->name('sup-quincaillerie');


    });

    // Sous-groupe pour "agence"
    Route::group(['middleware' => 'role:quincaillier'], function () {

        Route::get('/categories', [CategorieController::class, 'index'])->name('admin.categories');
        Route::get("/categorie/ajouter",[CategorieController::class,"create"])->name("ajouter-categorie");
        Route::post("/categorie/ajouter",[CategorieController::class,"store"])->name("ajouter-categorie");
        Route::get('/categorie/{id}/modifier', [CategorieController::class, 'edit'])->name('modifer-categorie');
        Route::put('/categorie/{id}/modifier', [CategorieController::class, 'update'])->name('update-categorie');
        Route::delete('/categorie/{id}', [CategorieController::class, 'destroy'])->name('sup-categorie');

        //produit
        Route::get('/produits', [ProduitController::class, 'index'])->name('admin.produit');
        Route::get("/produit/ajouter",[ProduitController::class,"create"])->name("ajouter-produit");
        Route::post("/produit/ajouter",[ProduitController::class,"store"])->name("ajouter-produit");
        Route::get('/produit/{id}/modifier', [ProduitController::class, 'edit'])->name('modifer-produit');
        Route::put('/produit/{id}/modifier', [ProduitController::class, 'update'])->name('update-produit');
        Route::delete('/produit/{id}', [ProduitController::class, 'destroy'])->name('sup-produit');
        Route::delete('/produits/delete-multiple', [ProduitController::class, 'deleteMultiple'])->name('delete-multiple-produits');


        //caisse
        Route::get('/caisses', [CaisseController::class, 'index'])->name('admin.caisses');
        Route::get("/caisse/ajouter",[CaisseController::class,"create"])->name("ajouter-caisse");
        Route::post("/caisse/ajouter",[CaisseController::class,"store"])->name("ajouter-caisse");
        Route::get('/caisse/{id}/modifier', [CaisseController::class, 'edit'])->name('modifer-caisse');
        Route::put('/caisse/{id}/modifier', [CaisseController::class, 'update'])->name('update-caisse');
        Route::delete('/caisse/{id}', [CaisseController::class, 'destroy'])->name('sup-caisse');

        //maode_paiement
        Route::get('/mode-paiement', [ModePaiementController::class, 'index'])->name('admin.modePaiement');
        Route::get("/mode-paiement/ajouter",[ModePaiementController::class,"create"])->name("ajouter-modePaiement");
        Route::post("/mode-paiement/ajouter",[ModePaiementController::class,"store"])->name("ajouter-modePaiement");
        Route::get('/mode-paiement/{id}/modifier', [ModePaiementController::class, 'edit'])->name('modifer-modePaiement');
        Route::put('/mode-paiement/{id}/modifier', [ModePaiementController::class, 'update'])->name('update-modePaiement');
        Route::delete('/mode-paiement/{id}', [ModePaiementController::class, 'destroy'])->name('sup-modePaiement');

        //rapports
        Route::get('/rapports', [RapportController::class, 'index'])->name('admin.rapport');
        Route::get("/rapport/ajouter",[RapportController::class,"create"])->name("ajouter-rapport");
        Route::post("/rapport/ajouter",[RapportController::class,"store"])->name("ajouter-rapport");
        Route::get('/rapport/{id}/modifier', [RapportController::class, 'edit'])->name('modifer-rapport');
        Route::put('/rapport/{id}/modifier', [RapportController::class, 'update'])->name('update-rapport');
        Route::delete('/rapport/{id}', [RapportController::class, 'destroy'])->name('sup-rapport');

        //stock
        Route::get('/stocks', [StockController::class, 'index'])->name('admin.stock');


        //depenses
        Route::get('/depenses', [DepenseController::class, 'index'])->name('admin.depense');
        Route::get("/depense/ajouter",[DepenseController::class,"create"])->name("ajouter-depense");
        Route::post("/depense/ajouter",[DepenseController::class,"store"])->name("ajouter-depense");
        Route::get('/depense/{id}/modifier', [DepenseController::class, 'edit'])->name('modifer-depense');
        Route::put('/depense/{id}/modifier', [DepenseController::class, 'update'])->name('update-depense');
        Route::delete('/depense/{id}', [DepenseController::class, 'destroy'])->name('sup-depense');

        //depenses
        Route::get('/plan-abonnements', [PlanAbonnementController::class, 'index'])->name('admin.plan');
        Route::get("/plan-abonnement/ajouter",[PlanAbonnementController::class,"create"])->name("ajouter-plan");
        Route::post("/plan-abonnement/ajouter",[PlanAbonnementController::class,"store"])->name("ajouter-plan");
        Route::get('/plan-abonnement/{id}/modifier', [PlanAbonnementController::class, 'edit'])->name('modifer-plan');
        Route::put('/plan-abonnement/{id}/modifier', [PlanAbonnementController::class, 'update'])->name('update-plan');
        Route::delete('/plan-abonnement/{id}', [PlanAbonnementController::class, 'destroy'])->name('sup-plan');



        // routes/web.php
        /*
        Route::get('/paiements', [PaiementController::class, 'index'])->name('paiements.index');
        Route::get('/paiements/creer/{abonnementId}', [PaiementController::class, 'creerPaiement'])->name('paiements.creer');
        Route::post('/paiements/enregistrer/{abonnementId}', [PaiementController::class, 'enregistrerPaiement'])->name('paiements.enregistrer');
        Route::post('/paiements/valider/{paiementId}', [PaiementController::class, 'validerPaiement'])->name('paiements.valider');
        */
        // routes/web.php



        // Afficher la page POS
        Route::get('/pos', [VenteController::class, 'index'])->name('pos.index');

        // Enregistrer une vente
        Route::post('/pos/vente', [VenteController::class, 'store'])->name('pos.store');

        Route::get('/ventes', [VenteController::class, 'showVentes'])->name('ventes.index');
        Route::get('/ventes/{id}/pdf', [VenteController::class, 'generatePDF'])->name('ventes.pdf');
        Route::get('/ventes/{id}', [VenteController::class, 'show'])->name('voir-vente');
        Route::delete('ventes/{id}', [VenteController::class, 'destroy'])->name('ventes.sup');

    });


    // pour les sabonné a un plan dabonnement
    Route::get('/abonnements', [AbonnementController::class, 'index'])->name('abonnements.index');
    Route::get('/packs', [AbonnementController::class, 'pack'])->name('abonnements.pack');
    Route::get('/abonnements/souscrire/{planId}', [AbonnementController::class, 'souscrire'])->name('souscrire');
    Route::post('/abonnements/enregistrer-souscription/{planId}', [AbonnementController::class, 'enregistrerSouscription'])->name('enregistrer.souscription');
    Route::post('/abonnements/mise-a-jour/{abonnementId}', [AbonnementController::class, 'miseAJourAbonnement'])->name('abonnements.mise_a_jour');

    // route des paiements
    Route::get('/paiements', [PaiementController::class, 'index'])->name('paiements.index');
    Route::get('/paiements/creer/{abonnementId}', [PaiementController::class, 'creerPaiement'])->name('paiements.creer');
    Route::post('/paiements/enregistrer/{abonnementId}', [PaiementController::class, 'enregistrerPaiement'])->name('paiements.enregistrer');
    Route::post('/paiements/valider/{paiementId}', [PaiementController::class, 'validerPaiement'])->name('paiements.valider');
    Route::get('/paiements/modifier-mode/{paiementId}', [PaiementController::class, 'modifierMode'])->name('paiements.modifier-mode');

    Route::post('/paiements/{paiement_id}/mettre-a-jour-mode', [PaiementController::class, 'mettreAJourMode'])->name('paiements.mettre-a-jour-mode');


});










require __DIR__.'/auth.php';
