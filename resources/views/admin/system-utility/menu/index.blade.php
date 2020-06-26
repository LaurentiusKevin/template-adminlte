@extends('layout')
@section('title','System Utility')
@section('sub-title','Menu')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <section class="col-lg-12 connectedSortable">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-table mr-1"></i>
                                List Data
                            </h3>
                        </div>
                        <div class="card-body">
                            {!! $dataTable->table(['class'=>'table table-sm thead-dark table-bordered table-striped', 'style'=>'width: 100%;']) !!}
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </section>
@endsection

@section('script')
    <script type="text/javascript">
        function reloadDataTable()
        {
            $('#listData').DataTable().ajax.reload();
        }

        function create(route)
        {
            $.ajax({
                url: route,
                method: 'post',
                success: (response) => {
                    $.fancybox.open(response);
                }
            })
        }

        function editData(route)
        {
            let data = $('#listData').DataTable().row('.selected').data();
            if (data !== undefined) {
                $.ajax({
                    url: route,
                    method: 'post',
                    data: {id: data.id},
                    success: function (response) {
                        $.fancybox.open(response);
                    }
                })
            } else {
                Swal.fire({
                    icon: 'info',
                    title: 'Data Belum Dipilih!',
                    text: 'Silahkan pilih data yang akan diedit!'
                });
            }
        }

        function deleteData(route)
        {
            let data = $('#listData').DataTable().row('.selected').data();
            if (data === undefined) {
                Swal.fire({
                    icon: 'info',
                    title: 'Data Belum Dipilih!',
                    text: 'Silahkan pilih data yang akan dihapus!'
                });
            } else {
                Swal.fire({
                    title: 'Hapus data ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Hapus!'
                }).then((result) => {
                    $.ajax({
                        url: route,
                        method: 'post',
                        data: {id: data.id},
                        success: function (response) {
                            if (response === 'success') {
                                reloadDataTable();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Terhapus'
                                });
                            } else {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Gagal',
                                    text: 'Silahkan coba lagi'
                                });
                            }
                        },
                        error: function (response) {
                            Swal.fire({
                                icon: 'error',
                                title: 'System Error',
                            });
                        }
                    })
                });
            }
        }

        $(document).ready(function () {
            const DataTable = $('#listData').DataTable();
            const dataTableTbody = $('#listData tbody');

            dataTableTbody.on( 'click', 'tr', function () {
                if ( $(this).hasClass('selected') ) {
                    $(this).removeClass('selected');
                }
                else {
                    DataTable.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            } );

            {{--dataTableTbody.on( 'click', 'button.row-delete', function (e) {--}}
            {{--    Swal.fire({--}}
            {{--        title: 'Hapus data ini?',--}}
            {{--        icon: 'warning',--}}
            {{--        showCancelButton: true,--}}
            {{--        confirmButtonText: 'Hapus!'--}}
            {{--    }).then((result) => {--}}
            {{--        $.ajax({--}}
            {{--            url: '{{ route('admin.master.roles.api.submit-delete') }}',--}}
            {{--            method: 'post',--}}
            {{--            data: {id: $(this).attr('data-id')},--}}
            {{--            success: function (response) {--}}
            {{--                if (response === 'success') {--}}
            {{--                    reloadDataTable();--}}
            {{--                    Swal.fire({--}}
            {{--                        icon: 'success',--}}
            {{--                        title: 'Terhapus'--}}
            {{--                    });--}}
            {{--                } else {--}}
            {{--                    Swal.fire({--}}
            {{--                        icon: 'warning',--}}
            {{--                        title: 'Gagal',--}}
            {{--                        text: 'Silahkan coba lagi'--}}
            {{--                    });--}}
            {{--                }--}}
            {{--            },--}}
            {{--            error: function (response) {--}}
            {{--                Swal.fire({--}}
            {{--                    icon: 'error',--}}
            {{--                    title: 'System Error',--}}
            {{--                });--}}
            {{--            }--}}
            {{--        })--}}
            {{--    });--}}
            {{--});--}}
        });
    </script>
    {!! $dataTable->scripts() !!}
@endsection
