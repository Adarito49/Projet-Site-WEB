<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Applied;
use App\Models\Offer;

class UserController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        $appliedOffers = $user->appliedOffers;
        return view('profile.profile', compact('user', 'appliedOffers'));
    }

    public function index()
{
    $users = User::all();
    return view('edit_sheet.user.index', compact('users'));
}

public function update(Request $request)
{
    $id = $request->input('user_id');
    $validatedData = $request->validate([
        'email' => 'required|email',
        'phone_number' => 'required',
        'center' => 'required',
        'promotion' => 'required',
        'role' => '',
    ]);

    $user = User::findOrFail($id);
    $user->update($validatedData);

    return redirect()->route('user.index')->with('success', 'Utilisateur mis à jour avec succès !');
}

public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->route('user.index')->with('success', 'Utilisateur supprimé avec succès !');
}
}
