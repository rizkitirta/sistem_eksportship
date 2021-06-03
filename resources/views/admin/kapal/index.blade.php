@extends('admin.layouts.master')
@section('breadcrumb', 'Kapal')
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
                    <h3 class="card-title">Data Kapal</h3>
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#modal-lg">
                        Tambah Data
                    </button>
                    <table class="table table-striped bordered " id="datatable"  width="100%">
                        <thead>
                            <tr>
                                <th>Nama Kapal</th>
                                <th>Container</th>
                                <th>Quantity</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog">
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
                        <form action="{{ route('kapal.store') }}" method="POST" id="form">
                            <input type="hidden" name="id" id="id" value="">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="kapal_id">Nama Kapal</label>
                                    <select id="kapal_id" class="form-control" name="kapal_id">
                                        <option value="" disabled selected>Pilih Kapal</option>
                                        @foreach ($kapal as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_kapal }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="container_id">Nama Container</label>
                                    <select id="container_id" class="form-control" name="container_id">
                                        <option value="" disabled selected>Pilih Container</option>
                                        @foreach ($container as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_container }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="quantity">Qty Container</label>
                                    <input type="number" value="" class="form-control" id="quantity" name="quantity">
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="reset" class="btn btn-danger float-right">Reset</button>
                                <button type="submit" class="btn btn-success float-right mr-1">
                                    <i class="fas fa-save"></i>
                                    Save
                                </button>
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
                    url: "{{ route('kapal.index') }}"
                },
                columns: [{
                        data: 'nama_kapal',
                        name: 'nama_kapal'
                    },
                    {
                        data: 'nama_container',
                        name: 'nama_container'
                    },
                    {
                        data: 'quantity',
                        name: 'quantity'
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
            $('#form').attr('action', "{{ route('kapal.update') }}")
            let id = $(this).attr('id')
            $.ajax({
                url: "{{ route('kapal.edit') }}",
                type: 'POST',
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(res) {
                    console.log(res);
                    $('#id').val(res.id)
                    $('#kapal_id').val(res.kapal_id)
                    $('#container_id').val(res.container_id)
                    $('#quantity').val(res.quantity)
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
                        url: "{{ route('kapal.destroy') }}",
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
