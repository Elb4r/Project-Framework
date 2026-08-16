@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Barang</h1>
    <p>ID: {{ $barang->id }}</p>
    <p>Nama: {{ $barang->nama }}</p>
    <p>Deskripsi: {{ $barang->deskripsi }}</p>
    <p>Harga: {{ $barang->harga }}</p>
    <p>Stok: {{ $barang->stok }}</p>

    <form action="{{ route('barang.destroy', $barang->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
</div>
@endsection