@extends('app')
@section('main')
<div class="container">
        <div class="row justify-content-center">
            <!-- card -->
            <div class="card">
                <div class="card-header">
                    Tambah Data Barang
                </div>
                    <div class="card-body">
                        <form action="{{ route('barang.store') }}" method="post">
                            @csrf
                        <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-6">
                                <span class="input-group-text" >Nama Barang</span>
                                <input type="text" class="form-control" placeholder="Nama Barang" name="nama_barang">
                              </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupSelect01">Kategori Barang</label>
                                <select class="form-select" id="inputGroupSelect01" name="id_kategori">
                                  <option selected>--pilih--</option>
                                  @foreach ($kategori as $item)
                                  <option value="{{ $item->id }}">{{ $item->name_kategori }}
                                  </option>
                                  @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupSelect02">Nama Ruangan</label>
                                <select class="form-select" id="inputGroupSelect02" name="id_ruangan">
                                  <option selected>--pilih--</option>
                                  @foreach ($ruangan as $item)
                                  <option value="{{ $item->id }}">{{ $item->nama_ruangan }}
                                  </option>
                                  @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupSelect03">Stok/Satuan</label>
                                <input type="text" name="stok" class="form-control">
                                <select class="form-select" id="inputGroupSelect03" name="satuan">
                                  <option selected>--pilih--</option>
                                  <option value="unit">Unit</option>
                                  <option value="kilogram">Kilogram</option>
                                  <option value="butir">Butir</option>
                                  <option value="liter">Liter</option>
                                  <option value="lembar">Lembar</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupSelect04">Kondisi</label>
                                <select class="form-select" id="inputGroupSelect04" name="kondisi">
                                  <option selected>--pilih--</option>
                                  <option value="baik">Baik</option>
                                  <option value="rusak">Rusak</option>
                                </select>
                            </div>
                        </div>

                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success"><i class="bi bi-plus"></i>Berhasil</button>
                    </div>
                    </form>
                </div>
              </div>
        </div>
    </div>
     <!-- card end -->

     <!-- show data -->
        <div class="card">
                <div class="card-header">
                 Data Barang
                </div>
                    <div class="card-body">
                    <from action ="{{ route('barang.store') }}" method="post">
                        @csrf
                        <div class="teble-responsive">
                            <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Satuan</th>
                                    <th scope="col">Nama ruangan</th>
                                    <th scope="col">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                @foreach ($barang as $item) 
                                  <tr>
                                  <td scope="row">{{ $item->nomor_barang }}</td>
                                    <td scope="row">{{ $item->nama_barang }}</td>
                                    <td scope="row">{{ $item->ruangan->nama_ruangan }}</td>
                                    <td>
                                    <form action ="{{ route('barang.destroy', $item->id)}}" method="post">
                                        <a href="{{ route('barang.show', $item->id) }}" type="button" class="btn btn-primary">Detail</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('apakah anda ingin menghapus? {{ $item->nama_barang }} ? ')">Delete</button>
                                        <a href="{{ route('barang.edit', $item->id) }}" type="button" class="btn btn-warning">Edit</a>
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
      </div>
      @endsection