<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Cafe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function index($cafeId)
    {
        $cafe = Cafe::with('menus')->findOrFail($cafeId);

        if (Auth::id() !== $cafe->id_user) {
            abort(403, 'Unauthorized access');
        }

        $menus = $cafe->menus;

        // If no menus exist, provide a way to create a new menu
        if ($menus->isEmpty()) {
            return view('menus.index', compact('cafe'))
                ->with('message', 'No menu items found for this café. Add the first menu item below!');
        }

        return view('menus.index', compact('cafe', 'menus'));
    }

    public function store(Request $request, $cafeId)
    {
        $cafe = Cafe::findOrFail($cafeId);

        if (Auth::user()->role !== 'cafe_owner') {
            abort(403, 'Unauthorized access');
        }

        $validatedData = $request->validate([
            'item_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'availability_date' => 'required|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $validatedData['photo'] = $request->file('photo')->store('menu_photos', 'public');

            Menu::create([
                'cafe_id' => $cafeId,
                'item_name' => $validatedData['item_name'],
                'price' => $validatedData['price'],
                'availability_date' => $validatedData['availability_date'],
                'photo' => $validatedData['photo'] ?? null, // Save the photo path or null
            ]);

            return back()->with('success', 'Menu item added successfully!');
        }
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);
        $cafe = $menu->cafe;

        if (Auth::id() !== $cafe->id_user) {
            abort(403, 'Unauthorized access');
        }

        $validatedData = $request->validate([
            'item_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'availability_date' => 'required|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $validatedData['photo'] = $request->file('photo')->store('menu_photos', 'public');
        }

        $menu->update($validatedData);

        return redirect()->route('menus.index', ['cafe' => $cafe->id_cafe])
            ->with('success', 'Menu updated successfully!');
    }


    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $cafe = $menu->cafe;

        if (Auth::id() !== $cafe->id_user) {
            abort(403, 'Unauthorized access');
        }

        return view('menus.edit', compact('menu'));
    }




    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $cafe = $menu->cafe;

        if (Auth::user()->role !== 'cafe_owner') {
            abort(403, 'Unauthorized access');
        }

        $menu->delete();

        return back()->with('success', 'Menu item deleted successfully!');
    }
}
