<div style="width: 50%">
    <div class="row">
        <div class="col-12 col-md-6 col-lg-12">
            <h4 class="text-bold">Edit Data</h4>
            <hr style="border: 1px solid orange;">
            <form id="formData">
                <input type="hidden" name="id" value="{{ $data->id }}">
                <div class="form-group">
                    <label for="iName">Name</label>
                    <input id="iName" name="name" type="text" class="form-control" value="{{ $data->name }}" required>
                </div>
                <div class="form-group">
                    <label for="iEmail">Email</label>
                    <input id="iEmail" name="email" type="email" class="form-control" value="{{ $data->email }}">
                </div>
                <div class="form-group">
                    <label for="iUsername">Username</label>
                    <input id="iUsername" name="username" type="text" class="form-control" value="{{ $data->username }}" required>
                </div>
                <div class="form-group">
                    <label for="iPassword">Password</label>
                    <input id="iPassword" name="password" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="iRole">Role</label>
                    <select class="form-control" name="master_roles_id" id="iRole" required>
                        <option>-- Pilih Role --</option>
                        @foreach($role as $r)
                            <option value="{{ $r->id }}" {{ ($r->id == $data->master_roles_id) ? 'selected' : '' }}>{{ $r->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row justify-content-end">
                    <div class="col-sm-12 col-lg-3 mt-2 mb-lg-0">
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
                url: '{{ route('admin.master-data.user-aplikasi.api.submit-edit') }}',
                method: 'post',
                data: $(this).serialize(),
                success: function (response) {
                    if (response === 'success') {
                        reloadDataTable();
                        $.fancybox.close();
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
            })
        })
    });
</script>
