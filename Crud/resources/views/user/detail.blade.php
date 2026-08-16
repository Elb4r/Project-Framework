@extends('app')
@section('main')
<div class="container">
          <div class="row justify-content-center">

      <!-- show data -->
          <div class="card">
                  <div class="card-header">
                      Data PIC Ruangan
                  </div>
                      <div class="card-body">

                          <div class="teble-responsive">
                              <table class="table">
                                    <tr>
                                      <th scope="col">Nama Lengkap</th>
                                      <td scope="col">:</td>
                                      <td scope="col">{{ $user->name }}</td>
                                    </tr>
                                    <tr>
                                      <th scope="col">Nama panggilan</th>
                                      <td scope="col">:</td>
                                      <td scope="col">{{ $user->username}}</td>
                                    </tr>
                                    <tr>
                                      <th scope="col">Email</th>
                                      <td scope="col">:</td>
                                      <td scope="col">{{ $user->email}}</td>
                                    </tr>
                                    </table>
                          </div>

                </div>
          </div>
          <!-- end show data -->

          <!-- show data user-->
    <!-- end show data user-->

    <!-- show data room-->
          <div class="card">
            <div class="card-header">
              Detail Room
            </div>
                <div class="card-body">

                    <div class="teble-responsive">
                        <table class="table">
                              <tr>
                                <th scope="col">Nama Room</th>
                                <th scope="col">No.Room</th>
                              </tr>
                              <tr>
                                <td scope="col">Ruangan Mesin</td>
                                <td scope="col">Ruangan 123</td>
                              </tr>
                            </table>
                    </div>
              </div>
    </div>
    
    <!-- end show data room-->
      </div>
      <a href="{{ url('user') }}" type="button" class="btn btn-info"><i class="bi bi-arrow-left"></i></a>
  </div>
@endsection