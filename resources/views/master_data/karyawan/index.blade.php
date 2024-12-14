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
               Karyawan</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">                                       
                  <svg class="stroke-icon">
                    <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                  </svg></a></li>
              <li class="breadcrumb-item">Master Data</li>
              <li class="breadcrumb-item active">Karyawan</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid e-category">
        <div class="row">
            <div class="col-sm-12"> 
                <div class="card">
                    <div class="card-header card-no-border text-end">
                        <div class="card-header-right-icon"><a class="btn btn-primary f-w-500" href="#!" data-bs-toggle="modal" data-bs-target="#dashboard8"><i class="fa fa-plus pe-2"></i>Tambah Data</a>
                            <div class="modal fade" id="dashboard8" tabindex="-1" aria-labelledby="dashboard8" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content category-popup">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modaldashboard">Tambah Karyawan</h5>
                                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-0 custom-input">
                                            <div class="text-start">
                                                <div class="p-20">
                                                    <form id="create_users" class="row g-3 needs-validation" action="{{ url('karyawan/create/save') }}" method="POST">
                                                        @csrf
                                                        <div class="col-md-6">
                                                            <label class="form-label">Jabatan<span class="txt-danger">*</span></label>
                                                            <select class="form-select" aria-label="Select jabatan" name="m_jabatan_id">
                                                                <option disabled>--Choose Option--</option>
                                                                @foreach (\App\Models\JabatanModel::all() as $jabatan)
                                                                    <option value="{{ $jabatan->id }}">{{ $jabatan->nama }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label" for="nama">Nama<span class="txt-danger">*</span></label>
                                                            <input class="form-control" id="nama" type="text" name="name" placeholder="Masukkan Nama" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label" for="username">Username<span class="txt-danger">*</span></label>
                                                            <input class="form-control" id="username" type="text" name="username" placeholder="Masukkan Username" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label" for="password">Password<span class="txt-danger">*</span></label>
                                                            <input class="form-control" id="password" type="text" name="password" placeholder="Masukkan Password" required>
                                                            <span class="text-gray">Min 8 Karakter</span>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label" for="phone">No Hp<span class="txt-danger">*</span></label>
                                                            <input class="form-control" id="phone" type="text" name="phone" placeholder="Masukkan No Hp" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Role<span class="txt-danger">*</span></label>
                                                            <select class="form-select" aria-label="Select Role" name="m_role_id">
                                                                <option disabled>--Choose Option--</option>
                                                                @foreach (\App\Models\RoleModel::all() as $role)
                                                                    <option value="{{ $role->id }}">{{ $role->nama }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label class="form-label" for="alamat">Alamat<span class="txt-danger">*</span></label>
                                                            <textarea class="form-control" id="alamat" name="alamat" rows="3"></textarea>
                                                        </div>
                                                        <div class="col-md-12 d-flex justify-content-end">
                                                            <button class="btn btn-primary" id="submit" type="submit">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0">
                        <div class="list-product list-category">
                            <div class="recent-table table-responsive custom-scrollbar">
                                <table class="table" id="project-status">
                                    <thead> 
                                        <tr> 
                                            <th> </th>
                                            <th> <span class="f-light f-w-600">QR Code</span></th>
                                            <th> <span class="f-light f-w-600">Nama</span></th>
                                            <th> <span class="f-light f-w-600">Jabatan</span></th>
                                            <th> <span class="f-light f-w-600">Username</span></th>
                                            <th> <span class="f-light f-w-600">Role</span></th>
                                            <th> <span class="f-light f-w-600">Status</span></th>
                                            <th width="10%"> <span class="f-light f-w-600">Action</span></th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        @foreach ($users as $usr)
                                            <tr class="product-removes inbox-data">
                                                <td></td>
                                                @if ($usr->qr_code == NULL)
                                                    <td>QR Code belum ada</td>
                                                @else
                                                    <td>
                                                        <a href="{{ url("upload/qr_codes") }}/{{ $usr->qr_code }}" target="_blank" data-lightbox="gambar-item" data-title="Nama Item: {{ $usr->qr_code }}">
                                                            <img width="100%" src="{{ url("upload/qr_codes")}}/{{$usr->qr_code }}" alt="" align="left">
                                                        </a>
                                                    </td>
                                                @endif
                                                <td>{{ $usr->name }}</td>
                                                <td>{{ $usr->jabatan->nama ?? '-' }}</td>
                                                <td>{{ $usr->username }}</td>
                                                <td>{{ $usr->role->nama }}</td>
                                                <td>
                                                    @if ($usr->status == 1)
                                                        <span class="badge badge-success me-auto">Aktif</span>  
                                                    @elseif ($usr->status == 2)
                                                        <span class="badge badge-danger me-auto">Tidak Aktif</span>
                                                    @endif
                                                </td>
                                                <td> 
                                                <div class="common-align gap-2 justify-content-start"> 
                                                    <a href="{{ route('karyawan.show', ['id' => Crypt::encrypt($usr->id)]) }}" class="square-white">
                                                        <i class="fa-solid fa-info-circle"></i>
                                                    </a>
                                                    <a href="{{ route('karyawan.edit', ['id' => Crypt::encrypt($usr->id)]) }}" class="square-white">
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
</div>
@endsection

@section('js-library')
{{-- Tempat Ngoding Meletakkan js library --}}
@endsection

@section('js-custom')
{{-- Tempat Ngoding Meletakkan js custom --}}
<script>
    $(document).ready(function() {
        $("#submit").on('click', function(e) {
            e.preventDefault();
            $('#submit').prop('disabled', true);
            
            let formUrl = $('#create_users').attr('action');
            let form_data = new FormData($('#create_users')[0]);

            $.ajax({
                url: formUrl,
                method: "POST",
                data: form_data,
                contentType: false,
                processData: false,
                dataType: "JSON",
                timeout: 30000,
                error: function(xmlhttprequest, textstatus, message) {
                    var res = (textstatus === "timeout") ? "Request timeout!" : textstatus;
                    Swal.fire({
                        title: "Error",
                        html: res,
                        icon: "warning"
                    }).then(function() {
                        $('#btn-submit').prop('disabled', false);
                    });
                },
                success: function(response) {
                    let alert_text = "";
                    if ($.isArray(response.message)) {
                        $.each(response.message, function(i, message) {
                            alert_text += message + "<br>";
                        });
                    } else if (typeof response.message === 'object') {
                        $.each(response.message, function(key, messages) {
                            alert_text += messages[0] + "<br>";
                        });
                    } else {
                        alert_text = response.message;
                    }

                    if (response.status == true) {
                        Swal.fire({
                            title: "Success",
                            text: response.message,
                            icon: "success",
                            timer: 1500
                        }).then(function() {
                            window.location.href = response.url;
                        });
                    } else {
                        Swal.fire({
                            title: "Error",
                            html: alert_text,
                            icon: "warning"
                        }).then(function() {
                            $('#btn-submit').prop('disabled', false);
                        });
                    }
                }
            });
        });
    });
</script>
@endsection