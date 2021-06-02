@extends('admin.layouts.master')
@section('breadcrumb', 'Pelabuhan')
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
                    <h3 class="card-title">Data Pelabuhan</h3>
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#modal-lg">
                        Tambah Data
                    </button>
                    <table class="table table-striped bordered " id="datatable">
                        <thead>
                            <tr>
                                <th>Negara</th>
                                <th>Lokasi</th>
                                <th>Operator</th>
                                <th>Jenis Pelabuhan</th>
                                <th>Otoritas Pelabuhan</th>
                                <th>Menghubungkan Ke</th>
                                <th>Jenis Dermaga</th>
                                <th>Kedatangan</th>
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
                            <h3 class="card-title">Form</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('pelabuhan.store') }}" method="POST" id="form">
                            <input type="hidden" name="id" id="id" value="">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="negara">Negara</label>
                                            <input type="text" value="" class="form-control" id="negara"
                                                placeholder="Indonesia" name="negara">
                                        </div>
                                        <div class="form-group">
                                            <label for="lokasi">Lokasi Pelabuhan</label>
                                            <input type="text" value="" class="form-control" id="lokasi"
                                                placeholder="Banten.." name="lokasi">
                                        </div>
                                        <div class="form-group">
                                            <label for="operator">Operator</label>
                                            <input type="text" value="" class="form-control" id="operator"
                                                placeholder="Indonesia" name="operator">
                                        </div>
                                        <div class="form-group">
                                            <label for="otoritas_pelabuhan">Otoritas Pelabuhan</label>
                                            <input type="text" value="" class="form-control" id="otoritas_pelabuhan"
                                                placeholder="Indonesia" name="otoritas_pelabuhan">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="jenis_pelabuhan">Jenis pelabuhan</label>
                                            <input type="text" value="" class="form-control" id="jenis_pelabuhan"
                                                placeholder="Indonesia" name="jenis_pelabuhan">
                                        </div>
                                        <div class="form-group">
                                            <label for="menghubungkan_ke">Menghubungkan Ke</label>
                                            <input type="text" value="" class="form-control" id="menghubungkan_ke"
                                                placeholder="Indonesia" name="menghubungkan_ke">
                                        </div>
                                        <div class="form-group">
                                            <label for="jenis_dermaga">Jenis Dermaga</label>
                                            <input type="text" value="" class="form-control" id="jenis_dermaga"
                                                placeholder="Indonesia" name="jenis_dermaga">
                                        </div>
                                        <div class="form-group">
                                            <label for="kedatangan">Kedatangan</label>
                                            <input type="text" value="" class="form-control" id="kedatangan"
                                                placeholder="Indonesia" name="kedatangan">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="reset" class="btn btn-danger float-right">Reset</button>
                                <button type="submit" class="btn btn-success float-right mr-1">Save</button>
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
                    url: "{{ route('pelabuhan.index') }}"
                },
                columns: [{
                        data: 'negara',
                        name: 'negara'
                    },
                    {
                        data: 'lokasi',
                        name: 'lokasi'
                    },
                    {
                        data: 'operator',
                        name: 'operator'
                    },
                    {
                        data: 'jenis_pelabuhan',
                        name: 'jenis_pelabuhan'
                    },
                    {
                        data: 'otoritas_pelabuhan',
                        name: 'otoritas_pelabuhan'
                    },
                    {
                        data: 'menghubungkan_ke',
                        name: 'menghubungkan_ke'
                    },
                    {
                        data: 'jenis_dermaga',
                        name: 'jenis_dermaga'
                    },
                    {
                        data: 'kedatangan',
                        name: 'kedatangan'
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
            $('#form').attr('action', "{{ route('pelabuhan.update') }}")
            let id = $(this).attr('id')
            $.ajax({
                url: "{{ route('pelabuhan.edit') }}",
                type: 'POST',
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(res) {
                    console.log(res);
                    $('#id').val(res.id)
                    $('#negara').val(res.negara)
                    $('#lokasi').val(res.lokasi)
                    $('#operator').val(res.operator)
                    $('#jenis_pelabuhan').val(res.jenis_pelabuhan)
                    $('#otoritas_pelabuhan').val(res.otoritas_pelabuhan)
                    $('#menghubungkan_ke').val(res.menghubungkan_ke)
                    $('#jenis_dermaga').val(res.menghubungkan_ke)
                    $('#kedatangan').val(res.kedatangan)
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
                        url: "{{ route('pelabuhan.destroy') }}",
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
