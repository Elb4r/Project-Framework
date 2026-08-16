@extends('app')
@section('main')
<div class="container">
        <div class="row justify-content-center">
            <!-- card -->
            <div class="card">
                <div class="card-header">
                    Tambah Data Kategori
                </div>
                    <div class="card-body">
                    <form action ="{{ route('kategori.update', $kategori->id) }}" method ="POST">
                     @csrf
                     @method('PUT')
                        <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text" >Nama Kategori</span>
                                <input type="text" class="form-control" placeholder="Nama Kategori" name="name_kategori" value="{{ $kategori->name_kategori }}">
                              </div>
                        </div>

                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success"><i class="bi bi-plus"></i>Berhasil</button>
                    </div>
                </div>
                <a href="{{ url('kategori') }}" type="button" class="btn btn-info"><i class="bi bi-arrow-left"></i></a>
              </div>
              <!-- container end -->
        </div>
    </div>
    
     <!-- card end -->

     <!-- show data -->
       
        <!-- end show data -->
    </div>
@endsection