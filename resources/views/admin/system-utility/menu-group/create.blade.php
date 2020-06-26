<div style="width: 50%;">
    <div class="row">
        <div class="col-12 col-md-6 col-lg-12">
            <h4 class="text-bold">Tambah Data</h4>
            <hr style="border: 1px solid green;">
            <form id="formData">
                <input type="hidden" name="type" value="baru">
                <div class="form-group">
                    <label for="iName">Name</label>
                    <input id="iName" name="name" type="text" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="iSegmentName">Segment Name</label>
                    <input id="iSegmentName" name="segment_name" type="text" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="iIcon">Icon</label>
                    <input id="iIcon" name="icon" type="text" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="iOrder">Order</label>
                    <input id="iOrder" name="ord" type="text" class="form-control" required>
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
        $('#formData').submit(function (e) {
            e.preventDefault();
            Swal.showLoading();

            $.ajax({
                url: '{{ route('admin.system.menu-group.api.submit-add') }}',
                method: 'post',
                data: $(this).serialize(),
                success: function (response) {
                    reloadDataTable();
                    if (response === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Data Tersimpan',
                            showConfirmButton: false,
                            timer: 1000,
                            onClose: function () {
                                $.fancybox.close();
                            }
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
