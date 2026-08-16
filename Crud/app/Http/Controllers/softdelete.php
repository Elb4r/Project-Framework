<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class softdelete extends Controller
{
    public function show($id)
    {
        $barang = Barang::findOrFail($id);
        return view('barang.show', compact('barang'));
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        
        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Item deleted successfully.');
    }
}