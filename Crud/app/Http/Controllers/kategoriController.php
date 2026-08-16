<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kategori;
use Illuminate\Http\Request;

class kategoriController extends Controller
{
    public function index(){
        $kategori = Kategori::all();
        $user = User::all();
        return view('kategori.index', compact("kategori"));
    }
    public function store(Request $request){
        $input = $request->all();
        Kategori:: create($input);
        return redirect('/kategori');
    }
    public function edit($id){
        $kategori = Kategori::find($id);
        $user = User::all();
        return view('kategori.edit', compact('kategori'));
    }
    public function update(Request $request, $id){
        $kategori = Kategori::find($id);
        $data = $request->all();
        $kategori->update($data);
        return redirect('/kategori');
    }
    public function destroy($id){
        $kategori = Kategori::find($id);
        $kategori->delete();
        return back();
    }
}
