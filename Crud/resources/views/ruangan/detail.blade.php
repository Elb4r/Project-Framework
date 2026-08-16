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
                 Data Ruangan
                </div>
                    <div class="card-body">
                        <div class="teble-responsive">
                            <table class="table">
                                  <tr>
                                    <th scope="col">Nama Ruangan</th>
                                    <td scope="col">:</td>
                                    <td scope="col">{{ $ruangan->nama_ruangan}}</td>
                                  </tr>

                                  <tr>
                                    <th scope="col">No Ruangan</th>
                                    <td scope="col">:</td>
                                    <td scope="col">{{$ruangan->nomor_ruangan}}</td>
                                  </tr>
                                  <tr>
                                    <th scope="col">Ukuran</th>
                                    <td scope="col">:</td>
                                    <td scope="col">
                                      @if ($ruangan->ukuran == 'small')
                                      <span>small</span>
                                      @elseif($ruangan->ukuran == 'medium')
                                      <span>medium</span>
                                      @elseif($ruangan->ukuran == 'large')
                                      <span>large</span>
                                      @endif
                                    </td>
                                  </tr>
                                  <tr>
                                    <th scope="col">PIC Ruangan</th>
                                    <td scope="col">:</td>
                                    <td scope="col">{{ $ruangan->users->name }}</td>
                                  </tr>
                              </table>
                              <a href="{{ url('ruangan') }}" type="button" class="btn btn-info"><i class="bi bi-arrow-left"></i></a>
                        </div>
                    </div>
              </div>
       
        <!-- end show data -->
    </div>
@endsection