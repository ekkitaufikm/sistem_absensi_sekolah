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
               Jabatan</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">                                       
                  <svg class="stroke-icon">
                    <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                  </svg></a></li>
              <li class="breadcrumb-item">Master Data</li>
              <li class="breadcrumb-item active">Jabatan</li>
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
                                            <h5 class="modal-title" id="modaldashboard">Tambah Jabatan</h5>
                                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-0 custom-input">
                                            <div class="text-start">
                                                <div class="p-20">
                                                    <form id="create_jabatan" class="row g-3 needs-validation" action="{{ url('jabatan/create/save') }}" method="POST">
                                                        @csrf
                                                        <div class="col-md-6">
                                                            <label class="form-label" for="nama">Nama<span class="txt-danger">*</span></label>
                                                            <input class="form-control" id="nama" type="text" name="nama" placeholder="Masukkan Nama" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label" for="gaji">Gaji<span class="txt-danger">*</span></label>
                                                            <input class="form-control" id="gaji" type="text" name="gaji" placeholder="Ex : 1000000" required>
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
                                            <th> <span class="f-light f-w-600">Nama</span></th>
                                            <th> <span class="f-light f-w-600">Gaji</span></th>
                                            <th width="10%"> <span class="f-light f-w-600">Action</span></th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        @foreach ($jabatan as $jbt)
                                            <tr class="product-removes inbox-data">
                                                <td></td>
                                                <td>{{ $jbt->nama }}</td>
                                                <td>{{ rupiah($jbt->gaji) }}</td>
                                                <td> 
                                                <div class="common-align gap-2 justify-content-start"> 
                                                    <a href="{{ route('jabatan.edit', ['id' => Crypt::encrypt($jbt->id)]) }}" class="square-white">
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
            
            let formUrl = $('#create_jabatan').attr('action');
            let form_data = new FormData($('#create_jabatan')[0]);

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