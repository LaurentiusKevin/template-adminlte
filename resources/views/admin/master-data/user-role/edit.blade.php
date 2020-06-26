<div style="width: 50%">
    <div class="row">
        <div class="col-12 col-md-6 col-lg-12">
            <h4 class="text-bold">Edit Data</h4>
            <hr style="border: 1px solid orange;">
            <form id="formData">
                <input type="hidden" name="id" value="{{ $data->id }}">
                <div class="form-group">
                    <label for="iName">Nama</label>
                    <input type="text" class="form-control" name="name" id="iName" value="{{ $data->name }}" required>
                </div>
                <div class="form-group">
                    <label for="iInfo">Info</label>
                    <input type="text" class="form-control" name="info" id="iInfo" value="{{ $data->info }}">
                </div>
                <label>Menu</label>
                <table class="table table-sm table-bordered">
                    <thead>
                    <tr class="table-primary">
                        <th class="text-center">Nama Menu</th>
                        <th class="text-center" style="width: 10%">View</th>
                        <th class="text-center" style="width: 10%">Create</th>
                        <th class="text-center" style="width: 10%">Edit</th>
                        <th class="text-center" style="width: 10%">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($menu AS $group)
                        <tr class="table-active">
                            <th colspan="5">{{ $group['name'] }}</th>
                        </tr>
                        @foreach($group['menu'] AS $m)
                            <tr>
                                <th>{{ $m->name }}</th>
                                <td class="text-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="view[]" value="{{ $m->id }}" id="view-{{ $m->id }}" {{ ($m->view) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="view-{{ $m->id }}"></label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="create[]" value="{{ $m->id }}" id="create-{{ $m->id }}" {{ ($m->create) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="create-{{ $m->id }}"></label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="edit[]" value="{{ $m->id }}" id="edit-{{ $m->id }}" {{ ($m->edit) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="edit-{{ $m->id }}"></label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="delete[]" value="{{ $m->id }}" id="delete-{{ $m->id }}" {{ ($m->delete) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="delete-{{ $m->id }}"></label>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
                <div class="row justify-content-end">
                    <div class="col-sm-12 col-lg-3 mt-2">
                        <button type="submit" class="btn btn-block btn-success"><i class="fas fa-check mr-2"></i>Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        let formData = $('#formData');
        formData.submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('admin.master-data.master-role.api.submit-edit') }}',
                method: 'post',
                data: $(this).serialize(),
                success: function (response) {
                    if (response === 'success') {
                        reloadDataTable();
                        Swal.fire({
                            icon: 'success',
                            title: 'Data Tersimpan',
                            showConfirmButton: false,
                            timer: 1000
                        });
                    } else {
                        console.log(response);
                        Swal.fire({
                            icon: 'warning',
                            title: 'Data Gagal Tersimpan',
                            text: 'Silahkan coba lagi',
                        });
                    }
                },
                error: function (response) {
                    console.log(response);
                    Swal.fire({
                        icon: 'error',
                        title: 'System Error',
                    });
                }
            }).then(() => {
                $.fancybox.close();
            })
        })
    });
</script>
