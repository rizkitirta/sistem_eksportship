@extends('admin.layouts.master')
@section('breadcrumb', 'Katalog-Kapal')
@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-4">
            <!-- general form elements -->
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Form Data</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('katalogKapal.store') }}" method="POST" id="form">
                    <input type="hidden" name="id" id="id" value="">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="nama_kapal">nama_kapal</label>
                                    <input type="text" value="" class="form-control" id="nama_kapal" name="nama_kapal">
                                </div>
                                <div class="form-group">
                                    <label for="jenis_kapal">jenis_kapal</label>
                                    <input type="text" value="" class="form-control" id="jenis_kapal" name="jenis_kapal">
                                </div>
                                <div class="form-group">
                                    <label for="kapasitas_kapal">kapasitas_kapal</label>
                                    <input type="text" value="" class="form-control" id="kapasitas_kapal"
                                        name="kapasitas_kapal">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="reset" class="btn btn-danger float-right">Reset</button>
                        <button type="submit" class="btn btn-success float-right mr-1" id="btn-save">
                            <i class="fas fa-save"></i>
                            Save
                        </button>
                        <button type="submit" class="btn btn-success float-right mr-1" id="btn-update">
                            <i class="fas fa-save"></i>
                            Update
                        </button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
        <div class="col-8">
            <div class="card card-success shadow">
                <div class="card-header">
                    <h3 class="card-title">Data Kapal</h3>
                </div>
                <div class="card-body">
                    <button class="btn btn-success btn-sm mb-1" id="btn-tambah">Tambah Katalog</button>
                    <table class="table table-striped bordered " id="datatable" width="100%">
                        <thead>
                            <tr>
                                <th>Nama Kapal</th>
                                <th>Jenis Kapal</th>
                                <th>Kapasitas Kapal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ asset('AdminLTE/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script>
        $(document).ready(function() {
            //Hide Button Form Update
            $('#btn-update').hide()

            //Reload Datatable
            loadData()

            $('#btn-tambah').on('click', function() {
                $('#btn-update').hide()
                $('#btn-save').show()
                $('#form').attr('action', "{{ route('katalogKapal.store') }}")
                $('#form')[0].reset()
                $('#id').val('')
            })
        })

        function loadData() {
            $('#datatable').DataTable({
                serverSide: true,
                processing: true,
                ajax: {
                    url: "{{ route('katalogKapal.index') }}"
                },
                columns: [{
                        data: 'nama_kapal',
                        name: 'nama_kapal'
                    },
                    {
                        data: 'jenis_kapal',
                        name: 'jenis_kapal'
                    },
                    {
                        data: 'kapasitas_kapal',
                        name: 'kapasitas_kapal'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        orderable: false,
                    },
                ]
            })
        }

        //Store
        $(document).on('submit', 'form', function(event) {
            event.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                typeData: "JSON",
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(res) {
                    console.log(res)
                    $('#form')[0].reset()
                    $('#datatable').DataTable().ajax.reload()
                    Swal.fire({
                        icon: 'success',
                        title: res.message,
                        showConfirmButton: false,
                        timer: 1500
                    })
                },
                error: function(xhr) {
                    console.log(xhr);
                    Swal.fire({
                        icon: 'error',
                        title: xhr.responseJSON.message,
                    })
                }
            })
        })

        //Edit
        $(document).on('click', '.edit', function() {
            $('#btn-save').hide()
            $('#btn-update').show()
            $('#form').attr('action', "{{ route('katalogKapal.update') }}")
            let id = $(this).attr('id')
            $.ajax({
                url: "{{ route('katalogKapal.edit') }}",
                type: 'POST',
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(res) {
                    console.log(res);
                    $('#id').val(res.id)
                    $('#nama_kapal').val(res.nama_kapal)
                    $('#jenis_kapal').val(res.jenis_kapal)
                    $('#kapasitas_kapal').val(res.kapasitas_kapal)
                    $('#datatable').DataTable().ajax.reload()
                },
                error: function(xhr) {
                    console.log(xhr);
                    Swal.fire({
                        icon: 'error',
                        title: xhr.responseJSON.message,
                    })
                }
            })
        })

        //Hapus
        $(document).on('click', '.hapus', function() {
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Data Akan Dihapus Permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    let id = $(this).attr('id')
                    $.ajax({
                        url: "{{ route('katalogKapal.destroy') }}",
                        type: 'POST',
                        data: {
                            id: id,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(res) {
                            console.log(res);
                            $('#datatable').DataTable().ajax.reload()
                        },
                        error: function(xhr) {
                            console.log(xhr);

                        }
                    })
                    Swal.fire(
                        'Deleted!',
                        'Your data has been deleted.',
                        'success'
                    )
                }
            })

        })

    </script>
@endsection
