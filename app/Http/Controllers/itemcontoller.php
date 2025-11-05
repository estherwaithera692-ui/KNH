<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item; // Assuming you have an Item model

class itemcontoller extends Controller
{
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        $item = Item::findOrFail($id);
        $item->update([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return redirect()->route('items.index')->with('success', 'Item updated successfully!');
    }
}
