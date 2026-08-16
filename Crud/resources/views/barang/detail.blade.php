@extends('app')
@section('main')
<div class="container">
        <div class="row justify-content-center">
            <!-- card -->
    </div>
    
     <!-- card end -->

     <!-- show data -->
        <div class="card">
                <div class="card-header">
                 Data   Barang
                </div>
                    <div class="card-body">

                        <div class="teble-responsive">
                            <table class="table">

                                  <tr>
                                    <th scope="col">No. Barang</th>
                                    <td scope="col">:</td>
                                    <td scope="col">{{ $barang->nomor_barang }}</td>
                                  </tr>

                                  <tr>
                                    <th scope="col">Nama Barang</th>
                                    <td scope="col">:</td>
                                    <td scope="col">{{ $barang->nama_barang }}</td>
                                  </tr>

                                  <tr>
                                    <th scope="col">kategori</th>
                                    <td scope="col">:</td>
                                    <td scope="col">{{ $barang->kategori->name_kategori }}</td>
                                  </tr>

                                  <tr>
                                    <th scope="col">nama ruangan</th>
                                    <td scope="col">:</td>
                                    <td scope="col">{{ $barang->ruangan->nama_ruangan}}</td>
                                  </tr>

                                  <tr>
                                    <th scope="col">kondisi</th>
                                    <td scope="col">:</td>
                                    <td scope="col">
                                    @if ($barang->kondisi == 'baik')
                                      <span>Baik</span>
                                    @elseif ($barang->ukuran == 'rusak')
                                      <span>Rusak</span>
                                      @endif
                                    </td>
                                  </tr>

                                  <tr>
                                    <th scope="col">Stok/Satuan</th>
                                    <td scope="col">:</td>
                                    <td scope="col"> {{ $barang->stok }}
                                     @if ($barang->satuan == 'unit')
                                      <span>unit</span>
                                      @elseif ($barang->satuan == 'kilogram')
                                      <span>Kilogram</span>
                                      @elseif ($barang->satuan == 'butir')
                                      <span>Butir</span>
                                      @elseif ($barang->satuan == 'liter')
                                      <span>Liter</span>
                                      @elseif ($barang->satuan == 'lembar')
                                      <span>Lembar</span>
                                      @endif
                                    </td>
                                  </tr>
                              </table>
                              <a href="{{ url('barang') }}" type="button" class="btn btn-info"><i class="bi bi-arrow-left"></i></a>
                        </div>
                    </div>
              </div>
       
        <!-- end show data -->
    </div>
@endsection