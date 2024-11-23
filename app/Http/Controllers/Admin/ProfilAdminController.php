<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use Illuminate\Http\Request;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

//use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\AdminProfileUpdateRequest;

class ProfilAdminController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request): View
    {
        return view('admin.profil.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        //cree la return redirect back
        return Redirect::back()->with('status', __("Profil mis à jour avec succès"));

        //return Redirect::route('profil.edit')->with('status', 'profile-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
