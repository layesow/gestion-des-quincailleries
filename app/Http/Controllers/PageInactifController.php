<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;

class PageInactifController extends Controller
{
    public function show(): View
    {
        return view('page_inactif'); // Assurez-vous que la vue existe dans le dossier des vues
    }

}
