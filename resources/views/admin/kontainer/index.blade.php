@extends('admin.layouts.master')
@section('breadcrumb', 'Container')
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
        <div class="col-12">
            <div class="card card-success shadow">
                <div class="card-header">
                    <h3 class="card-title">Data Container</h3>
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#modal-lg">
                        Tambah Data
                    </button>
                    <table class="table table-striped bordered " id="datatable">
                        <thead>
                            <tr>
                                <th>Nama Container</th>
                                <th>Ukuran Container</th>
                                <th>Jenis Muatan</th>
                                <th>Isi Muatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah/Edit Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- general form elements -->
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Form Data</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('container.store') }}" method="POST" id="form">
                            <input type="hidden" name="id" id="id" value="">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama_container">Nama container</label>
                                    <input type="text" value="" class="form-control" id="nama_container"
                                        name="nama_container">
                                </div>
                                <div class="form-group">
                                    <label for="ukuran_container">Ukuran container</label>
                                    <input type="text" value="" class="form-control" id="ukuran_container"
                                        name="ukuran_container">
                                </div>
                                <div class="form-group">
                                    <label for="jenis_muatan">Jenis muatan</label>
                                    <input type="text" value="" class="form-control" id="jenis_muatan" name="jenis_muatan">
                                </div>
                                <div class="form-group">
                                    <label for="isi_muatan">Isi muatan</label>
                                    <input type="text" value="" class="form-control" id="isi_muatan" name="isi_muatan">
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="reset" class="btn btn-danger float-right">Reset</button>
                                <button type="submit" class="btn btn-success float-right mr-1">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="btn-tutup">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

@endsection
@section('script')
    <script src="{{ asset('AdminLTE/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script>
        $(document).ready(function() {
            loadData()
        })

        function loadData() {
            $('#datatable').DataTable({
                serverSide: true,
                processing: true,
                ajax: {
                    url: "{{ route('container.index') }}"
                },
                columns: [{
                        data: 'nama_container',
                        name: 'nama_container'
                    },
                    {
                        data: 'ukuran_container',
                        name: 'ukuran_container'
                    },
                    {
                        data: 'jenis_muatan',
                        name: 'jenis_muatan'
                    },
                    {
                        data: 'isi_muatan',
                        name: 'isi_muatan'
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
                    $('#btn-tutup').click()
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
            $('#modal-lg').modal()
            $('#form').attr('action', "{{ route('container.update') }}")
            let id = $(this).attr('id')
            $.ajax({
                url: "{{ route('container.edit') }}",
                type: 'POST',
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(res) {
                    console.log(res);
                    $('#id').val(res.id)
                    $('#nama_container').val(res.nama_container)
                    $('#ukuran_container').val(res.ukuran_container)
                    $('#jenis_muatan').val(res.jenis_muatan)
                    $('#isi_muatan').val(res.isi_muatan)
                    $('#btn-tutup').click()
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
                        url: "{{ route('container.destroy') }}",
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
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })

        })

    </script>
@endsection
