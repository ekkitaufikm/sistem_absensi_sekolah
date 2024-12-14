@extends('layout/main')

@section('css-library')
    {{-- Tempat Ngoding Meletakkan css library --}}

@endsection

@section('css-custom')
    {{-- Tempat Ngoding Meletakkan css custom --}}
    
@endsection

@section('content')
<div class="page-body">
    <div class="container-fluid">
      <div class="page-title">
        <div class="row">
          <div class="col-sm-6">
            <h3>
               Karyawan</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">                                       
                  <svg class="stroke-icon">
                    <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                  </svg></a></li>
              <li class="breadcrumb-item">Master Data</li>
              <li class="breadcrumb-item">Karyawan</li>
              <li class="breadcrumb-item active">Detail Karyawan</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid e-category">
        <div class="row">
            <div class="col-xl-12">
                <div class="card height-equal">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <h5 class="card-title">Data Karyawan</h5>
                            </div>
                            <div class="col-lg-6 d-flex justify-content-end">
                                <a href="{{ url('karyawan') }}" class="btn btn-sm btn-primary">Kembali</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body custom-input">
                        <table id="datatable" class="table text-justify">
                            <tbody>
                                <tr>
                                    <td class="text-sm-end">Jabatan</td>
                                    <td>:</td>
                                    <td class="text-sm-start">{{ $users->jabatan->nama ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-sm-end">Nama Lengkap</td>
                                    <td>:</td>
                                    <td class="text-sm-start">{{ $users->name }}</td>
                                </tr>
                                <tr>
                                    <td class="text-sm-end">No HP</td>
                                    <td>:</td>
                                    <td class="text-sm-start">{{ $users->phone }}</td>
                                </tr>
                                <tr>
                                    <td class="text-sm-end">Alamat</td>
                                    <td>:</td>
                                    <td class="text-sm-start">{{ $users->alamat }}</td>
                                </tr>
                                <tr>
                                    <td class="text-sm-end">Role</td>
                                    <td>:</td>
                                    <td class="text-sm-start">{{ $users->role->nama }}</td>
                                </tr>
                                <tr>
                                    <td class="text-sm-end">Status</td>
                                    <td>:</td>
                                    <td class="text-sm-start">
                                        @if ($users->status == 1)
                                            <span class="badge badge-info me-auto">Aktif</span>
                                        @elseif ($users->status == 2)
                                            <span class="badge badge-success me-auto">Tidak Aktif</span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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