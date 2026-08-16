@extends('app')
@section('main')
<div class="container">
        <div class="row justify-content-center">
            <!-- card -->
            <div class="card">
                <div class="card-header">
                    Tambah Data Ruangan
                </div>
                    <div class="card-body">
                      <form action="{{ route('ruangan.store')}}" method="POST">
                        @csrf
                        
                        <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text" >Nama Ruangan</span>
                                <input type="text" class="form-control" placeholder="Nama Ruangan" name="nama_ruangan">
                              </div>
                        </div>

                     <div class="col-md-6">
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="inputGroupSelect01">Ukuran</label>
                            <select class="form-select" id="inputGroupSelect01" name="ukuran">
                              <option selected>--pilih--</option>
                              <option value="small">small</option>
                              <option value="medium">medium</option>
                              <option value="large">large</option>
                            </select>
                          </div>
                     </div>

                     <div class="col-md-6">
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="inputGroupSelect02">PIC Ruangan</label>
                            <select class="form-select" id="inputGroupSelect02" name="user_id">
                              <option selected>--pilih--</option>
                              @foreach ($user as $item)

                              <option value="{{ $item->id }}">{{ $item->name }}</option>
                             @endforeach
                            </select>
                          </div>
                     </div>

                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success"><i class="bi bi-plus"></i>Berhasil</button>
                    </div>
                </div>
              </div>
              </form>

              <!-- container end -->
        </div>
    </div>
    
     <!-- card end -->

     <!-- show data -->
        <div class="card">
                <div class="card-header">
                 Data Ruangan
                </div>
                    <div class="card-body">

                        <div class="teble-responsive">
                            <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col">Nama Ruangan</th>
                                    <th scope="col">No. Ruangan</th>
                                    <th scope="col">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach ($ruangan as $item)
                                  <tr>
                                    <td scope="row">{{ $item->nama_ruangan }}</td>
                                    <td>{{ $item->nomor_ruangan }}</td>
                                    <td>
                                    <form action ="{{ route('ruangan.destroy', $item->id)}}" method="post">
                                        <a href="{{ route('ruangan.show', $item->id) }}" type="button" class="btn btn-primary">Detail</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="sumbit" class="btn btn-danger" onclick="return confirm('apakah anda ingin menghapus {{ $item->nama_ruangan }} ? ')">Delete</button>
                                        <a href="{{ route('ruangan.edit', $item->id) }}" type="button" class="btn btn-warning">Edit</a>
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