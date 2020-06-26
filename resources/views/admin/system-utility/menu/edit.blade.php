<div style="width: 50%">
    <div class="row">
        <div class="col-12 col-md-6 col-lg-12">
            <h4 class="text-bold">Edit Data</h4>
            <hr style="border: 1px solid orange;">
            <form id="formData">
                <input type="hidden" name="id" value="{{ $data->id }}">
                <div class="form-group">
                    <label for="iGroup">Group Menu</label>
                    <select class="form-control" name="group_id" id="iGroup">
                        @foreach($group as $d)
                            @if($data->group_id == $d->id)
                                <option value="{{ $d->id }}" selected>{{ $d->name }}</option>
                            @else
                                <option value="{{ $d->id }}">{{ $d->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="iName">Name</label>
                    <input id="iName" name="name" type="text" class="form-control" value="{{ $data->name }}" required>
                </div>
                <div class="form-group">
                    <label for="iSegmentName">Segment Name</label>
                    <input id="iSegmentName" name="segment_name" type="text" class="form-control" value="{{ $data->segment_name }}" required>
                </div>
                <div class="form-group">
                    <label for="iRoute">Route</label>
                    <input id="iRoute" name="route" type="text" class="form-control" value="{{ $data->route }}" required>
                </div>
                <div class="form-group">
                    <label for="iOrder">Order</label>
                    <input id="iOrder" name="ord" type="text" class="form-control" value="{{ $data->ord }}" required>
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
                url: '{{ route('admin.system.menu.api.submit-edit') }}',
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
