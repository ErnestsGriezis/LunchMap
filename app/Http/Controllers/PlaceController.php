<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cafe;
use Illuminate\Support\Facades\Auth;



class PlaceController extends Controller
{
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'price_category' => 'required|string|in:low,medium,high',
            'rating' => 'required|integer|min:1|max:5',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Max size 2MB
        ]);

        if ($request->hasFile('photo')) {
            try {
                $validatedData['photo'] = $request->file('photo')->store('photos', 'public');
            } catch (\Exception $e) {

                $validatedData['photo'] = null;
            }
        }

        Cafe::create([
            'name' => $validatedData['name'],
            'location' => $validatedData['location'],
            'price_category' => $validatedData['price_category'],
            'rating' => $validatedData['rating'],
            'description' => $validatedData['description'],
            'id_user' => Auth::id(), // Link the place to the logged-in user
            'photo' => $validatedData['photo'] ?? null,
        ]);
        return redirect()->route('home');
    }
}
