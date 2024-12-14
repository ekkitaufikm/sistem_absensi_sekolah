@extends('layout/main')

@section('css-library')
    {{-- Tempat Ngoding Meletakkan css library --}}

@endsection

@section('css-custom')
    {{-- Tempat Ngoding Meletakkan css custom --}}
    
@endsection

@section('content')
@php
    use Illuminate\Support\Facades\Crypt;
@endphp
<div class="page-body">
    <div class="container-fluid">
      <div class="page-title">
        <div class="row">
          <div class="col-sm-6">
            <h3>
               Absensi</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">                                       
                  <svg class="stroke-icon">
                    <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                  </svg></a></li>
              <li class="breadcrumb-item">Master Data</li>
              <li class="breadcrumb-item active">Absensi</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid datatable-init">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <h5>Data Log Absensi</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive custom-scrollbar">
                            <table class="display table-striped border" id="basic-1">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Tanggal</th>
                                        <th>Nama Karyawan</th>
                                        <th>Latitude</th>
                                        <th>Longitude</th>
                                        <th>Waktu Masuk</th>
                                        <th>Waktu Pulang</th>
                                        <th>Clock In</th>
                                        <th>Clock Out</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($absensi as $absn)
                                        <tr class="product-removes inbox-data">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $absn->today_date }}</td>
                                            <td>{{ $absn->karyawan->name }}</td>
                                            <td>{{ $absn->latitude }}</td>
                                            <td>{{ $absn->longitude }}</td>
                                            <td>{{ $absn->waktu_masuk }}</td>
                                            <td>{{ $absn->waktu_pulang }}</td>
                                            <td>{{ $absn->clock_type_masuk }}</td>
                                            <td>{{ $absn->clock_type_pulang }}</td>
                                            <td> 
                                            <div class="common-align gap-2 justify-content-start"> 
                                                <a href="{{ route('absensi.edit', ['id' => Crypt::encrypt($absn->id)]) }}" class="square-white">
                                                    <i class="fa-solid fa-pencil"></i>
                                                </a>
                                            </div>
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
    </div>
</div>
@endsection

@section('js-library')
{{-- Tempat Ngoding Meletakkan js library --}}
@endsection

@section('js-custom')
{{-- Tempat Ngoding Meletakkan js custom --}}
@endsection