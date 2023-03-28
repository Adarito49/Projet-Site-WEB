<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'offer_id' => 'required|integer',
        ]);

        $offerId = $request->input('offer_id');

        $favorite = new Favorite();
        $favorite->user_id = Auth::id();
        $favorite->offer_id = $offerId;

        $favorite->save();

        return response()->json(['success' => true], 200);
    }

    public function index()
    {
        $favorites = auth()->user()->favorites;
        return view('favorites.favorites', compact('favorites'));
    }
    

    public function remove(Request $request)
    {
        $request->validate([
            'offer_id' => 'required|integer',
        ]);

        $offerId = $request->input('offer_id');

        $favorite = Favorite::where([
            ['user_id', '=', Auth::id()],
            ['offer_id', '=', $offerId],
        ])->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json(['success' => true], 200);
        } else {
            return response()->json(['error' => 'Favorite not found'], 404);
        }
    }

    public function showFavorites()
    {
        $favorites = auth()->user()->favorites;
        return view('favorites', compact('favorites'));
    }
}
