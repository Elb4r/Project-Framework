@extends('app')
@section('main')
 <!-- container -->
 <div class="container">
        <div class="row justify-content-center">
            <!-- card -->
            <div class="card">
                <div class="card-header">
                    Ubah Data PIC Ruangan
                </div>
                    <div class="card-body">
                    <form action ="{{ route('user.update', $user->id) }}" method ="POST">
                     @csrf
                     @method('PUT')
                        <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text" >Nama Lengkap</span>
                                <input type="text" class="form-control" placeholder="Jhon Doel" name="name" value="{{ $user->name }}">
                              </div>
                        </div>
                   
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <span class="input-group-text" >Username</span>
                            <input type="text" class="form-control" placeholder="Jhon Doel" name="name"value="{{ $user->username }}">
                          </div>
                     </div>


                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <span class="input-group-text" >Email</span>
                            <input type="email" class="form-control" placeholder="@example.com" name="email"value="{{ $user->email }}">
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
                </form>
                <a href="{{ url('user') }}" type="button" class="btn btn-info"><i class="bi bi-arrow-left"></i></a>
              </div>
              <!-- container end -->
        </div>
     <!-- card end -->
    </div>
    </div>
@endsection