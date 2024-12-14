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
              <li class="breadcrumb-item active">Edit Karyawan</li>
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
                                <h5 class="card-title">Edit Data Karyawan</h5>
                            </div>
                            <div class="col-lg-6 d-flex justify-content-end">
                                <a href="{{ url('karyawan') }}" class="btn btn-sm btn-primary">Kembali</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body custom-input">
                        <form id="edit_karyawan" class="row g-3 needs-validation" action="{{ url('karyawan/edit/save') }}/{{ $users->id }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="col-md-6">
                                <label class="form-label">Jabatan<span class="txt-danger">*</span></label>
                                <select class="form-select" aria-label="Select jabatan" name="m_jabatan_id">
                                    <option value="{{ $users->m_jabatan_id }}" selected>{{ $users->jabatan->nama ?? '-' }}</option>
                                    <option disabled>--Choose Option--</option>
                                    @foreach (\App\Models\JabatanModel::all() as $jabatan)
                                        <option value="{{ $jabatan->id }}">{{ $jabatan->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="nama">Nama<span class="txt-danger">*</span></label>
                                <input class="form-control" id="nama" type="text" name="name" value="{{ $users->name }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="username">Username<span class="txt-danger">*</span></label>
                                <input class="form-control" id="username" type="text" name="username" value="{{ $users->username }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Role<span class="txt-danger">*</span></label>
                                <select class="form-select" aria-label="Select Role" name="m_role_id">
                                    <option value="{{ $users->m_role_id }}" selected>{{ $users->role->nama }}</option>
                                    <option disabled>--Choose Option--</option>
                                    @foreach (\App\Models\RoleModel::all() as $role)
                                        <option value="{{ $role->id }}">{{ $role->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="password">Password<span class="txt-danger">*</span></label>
                                <input class="form-control" id="password" type="text" name="password" value="{{ $users->sandi }}" required>
                                <span class="text-gray">Min 8 Karakter</span>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="password">Verifikasi Password<span class="txt-danger">*</span></label>
                                <input class="form-control" id="password" type="text" name="verifikasi" value="{{ $users->sandi }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="phone">No Hp<span class="txt-danger">*</span></label>
                                <input class="form-control" id="phone" type="text" name="phone" value="{{ $users->phone }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Status<span class="txt-danger">*</span></label>
                                <select class="form-select" aria-label="Select Status" name="status">
                                    <option value="{{ $users->status }}" selected>
                                        @if ($users->status == 1)
                                            Aktif
                                        @else
                                            Tidak Aktif
                                        @endif
                                    </option>
                                    <option disabled>--Choose Option--</option>
                                    <option value="1">Aktif</option>
                                    <option value="2">Tidak Aktif</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="alamat">Alamat<span class="txt-danger">*</span></label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="3">{{ $users->alamat }}</textarea>
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
            
            let formUrl = $('#edit_karyawan').attr('action');
            let form_data = new FormData($('#edit_karyawan')[0]);

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