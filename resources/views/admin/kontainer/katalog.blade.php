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
        <div class="col-4">
            <!-- general form elements -->
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Tambah Katalog</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('katalogContainer.store') }}" method="POST" id="form">
                    <input type="hidden" name="id" id="id" value="">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama_container">Nama container</label>
                            <input type="text" value="" class="form-control" id="nama_container" name="nama_container">
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
                    <h3 class="card-title">Data Container</h3>
                </div>
                <div class="card-body">
                    <button class="btn btn-sm btn-success mb-1" id="btn-tambah">Tambah Katalog</button>
                    <table class="table table-striped bordered " id="datatable" width="100%">
                        <thead>
                            <tr>
                                <th>Nama Container</th>
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
                $('#form').attr('action', "{{ route('katalogContainer.store') }}")
                $('#form')[0].reset()
                $('#id').val('')
            })
        })

        function loadData() {
            $('#datatable').DataTable({
                serverSide: true,
                processing: true,
                ajax: {
                    url: "{{ route('katalogContainer.index') }}"
                },
                columns: [{
                        data: 'nama_container',
                        name: 'nama_container'
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
            $('#btn-update').show()
            $('#btn-save').hide()
            $('#form').attr('action', "{{ route('katalogContainer.update') }}")
            let id = $(this).attr('id')
            $.ajax({
                url: "{{ route('katalogContainer.edit') }}",
                type: 'POST',
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(res) {
                    console.log(res);
                    $('#id').val(res.id)
                    $('#nama_container').val(res.nama_container)
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
                        url: "{{ route('katalogContainer.destroy') }}",
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
