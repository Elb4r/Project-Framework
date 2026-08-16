<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ruangan;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use PDO;

class RuanganController extends Controller
{
    public function index(){
        $ruangan = ruangan::all();
        $user = User::all();
        return view('ruangan.index', compact('user', 'ruangan'));
    }
    public function store(Request $request){
        $input = $request->all();
        $input['nomor_ruangan'] = 'Ruangan'.'  '.random_int(100,999);
        ruangan:: create($input);
        return redirect('/ruangan');
    }
    public function show($id){
        $ruangan = ruangan::find($id);
        return view('ruangan.detail', compact('ruangan'));
    }
    public function edit($id){
        $ruangan = ruangan::find($id);
        $user = User::all();
        return view('ruangan.edit', compact('ruangan','user'));
    }
    public function update(Request $request, $id){
        $ruangan = ruangan::find($id);
        $data = $request->all();
        $ruangan->update($data);
        return redirect('/ruangan');
    }
    public function destroy($id){
        if($id == 12){
            return back();
        }        
        DB::table('barang')->where('id_ruangan', $id)->update(['id_ruangan' => 12]);
        $ruangan = ruangan::find($id);
       
        $ruangan->delete();
        return back();
    }
}
