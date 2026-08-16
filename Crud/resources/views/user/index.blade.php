@extends('app')
@section('main')

<div class="container">
        <div class="row justify-content-center">
            <!-- card -->
            <div class="card">
                <div class="card-header">
                    Tambah Data PIC Ruangan
                </div>
                    <div class="card-body">
                      <form action="{{ route('user.store')}}" method="POST">

                      @csrf
                        <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text" >Nama Lengkap</span>
                                <input type="text" class="form-control" placeholder="Jhon Doel" name="name">
                              </div>
                        </div>
                   

                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <span class="input-group-text" >Nama panggilan</span>
                            <input type="text" class="form-control" placeholder="Jhon Doel" name="username">
                          </div>
                    </div>

                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <span class="input-group-text" >Email</span>
                            <input type="Email" class="form-control" placeholder="@example.com" name="email">
                          </div>
                    </div>

                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <span class="input-group-text" >Password</span>
                            <input type="Password" class="form-control" placeholder="*****" name="Password">
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
                    Tambah Data PIC Ruangan
                </div>
                    <div class="card-body">
                      <from action ="{{ route('user.store') }}" method="post">
                        @csrf
                        <div class="teble-responsive">
                            <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col">Nama Lengkap</th>
                                    <th scope="col">Nama panggilan</th>
                                    <th scope="col">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach ($user as $item) 
                                  <tr>
                                  <td scope="row">{{ $item->name }}</td>
                                    <td scope="row">{{ $item->username }}</td>
                                    <td>
                                      <form action ="{{ route('user.destroy', $item->id)}}" method="post">
                                        <a href="{{ route('user.show', $item->id) }}" type="button" class="btn btn-primary">Detail</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('apakah anda ingin menghapus? {{ $item->name }} ? ')">Delete</button>
                                        <a href="{{ route('user.edit', $item->id) }}" type="button" class="btn btn-warning">Edit</a>
                                        </form>
                                    </td>
                                  </tr>
                                  @endforeach
                                </tbody>
                              </table>
                        </div>
                    </div>
                    </from>
              </div>
        </div>

        @endsection



    
