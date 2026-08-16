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
                    <form action="{{ route('kategori.store')}}" method="POST">

                        @csrf
                        <div class="row">
                        <div class="col-md-10">
                            <div class="input-group mb-6">
                                <span class="input-group-text" >Nama Kategori</span>
                                <input type="text" class="form-control" placeholder="Nama Kategori" name="name_kategori">
                              </div>
                        </div>

                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success"><i class="bi bi-plus"></i>Berhasil</button>
                    </div>
                </div>
              </form>
              </div>
              <!-- container end -->
        </div>
    </div>
    
     <!-- card end -->

     <!-- show data -->
        <div class="card">
                <div class="card-header">
                 Data Kategori
                </div>
                        <div class="teble-responsive">
                            <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col">Nama Kategori</th>
                                    <th scope="col">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                @foreach ($kategori as $item) 
                                  <tr>
                                  <td scope="row">{{ $item->name_kategori }}</td>
                                    <td>
                                    <form action ="{{ route('kategori.destroy', $item->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('apakah anda ingin menghapus? {{ $item->name }} ? ')">Delete</button>
                                        <a href="{{ route('kategori.edit', $item->id) }}" type="button" class="btn btn-warning">Edit</a>
                                       </form>
                                    </td>
                                  </tr>
                                  @endforeach
                                </tbody>
                              </table>
                        </div>
                    </div>
              </div>
        </div>
@endsection