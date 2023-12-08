<?= $this->extend('default') ?>
<?= $this->section('page_title'); ?>
<?= $title; ?>
<?= $this->endSection(); ?>

<?= $this->section('context'); ?>
<?= $title; ?>
<?= $this->endSection(); ?>

<?= $this->section('css'); ?>

<link rel="stylesheet" href="<?= base_url('adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('adminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
<?= $this->endSection(); ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header align-center">
        <h3 class="card-title"><?= $title; ?> </h3>
        <div class="card-tools">

            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-masuk">
                <i class="fas fa-plus"></i> Masuk
            </button>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-keluar">
                <i class="fas fa-minus"></i> Keluar
            </button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body overflow-auto">
        <ul class="nav nav-tabs" id="dataTableTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="table1-tab" data-toggle="tab" href="#table1" role="tab" aria-controls="table1" aria-selected="true">Riwayat Transaksi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="table2-tab" data-toggle="tab" href="#table2" role="tab" aria-controls="table2" aria-selected="false">Stock</a>
            </li>
        </ul>

        <!-- Toggle Content -->
        <div class="tab-content mt-3">
            <div class="tab-pane fade show active" id="table1" role="tabpanel" aria-labelledby="table1-tab">
                <table class="table table-bordered nowrap responsive" id="dataTable1" style="width:100%">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Aset</th>
                            <th>Status</th>
                            <th>Jumlah</th>
                            <th>Stock</th>
                            <th>PIC</th>
                            <th>Dari</th>
                            <th>Tujuan</th>
                            <th>Lokasi</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($asetBergerakLog as $log) : ?>
                            <tr>
                                <td><?= $log['kode']; ?></td>
                                <td><?= $log['namabarang'] . " " . $log['merk'] . " " . $log['tipebarang']; ?></td>
                                <td><span class="badge badge-pill badge-<?= $log['statusbarang'] == 'Masuk' ? 'success' : 'danger'; ?>"><?= $log['statusbarang']; ?></span>
                                </td>
                                <td><?= $log['jumlah']; ?></td>
                                <td><?= $log['ketersediaan']; ?></td>
                                <td><?= $log['pic']; ?></td>
                                <td><?= $log['dari']; ?></td>
                                <td><?= $log['tujuan']; ?></td>
                                <td><?= $log['namaruang']; ?></td>
                                <td><?= $log['tanggal']; ?></td>
                                <td><?= $log['keterangan']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="table2" role="tabpanel" aria-labelledby="table2-tab">
                <table class="table table-bordered nowrap responsive" id="table-detail" style="width:100%">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Aset</th>
                            <th>Stock</th>
                            <th>Lokasi</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($asetBergerakStock as $stock) : ?>
                            <tr>
                                <td><?= $stock['kodebarang']; ?></td>
                                <td><?= $stock['namabarang'] . " " . $stock['merk'] . " " . $stock['tipebarang']; ?>
                                <td><?= $stock['ketersediaan']; ?></td>
                                <td><?= $stock['namaruang']; ?></td>
                                <td><?= $stock['keterangan']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="result"></div>
    </div>
    <!-- /.card-body -->
</div>

<div class="modal fade" id="modal-masuk">

    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form method="post" id="form-aset-bergerak-masuk">
                <div class="modal-header bg-success">
                    <h4 class="modal-title">Transaksi Aset Masuk</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="Stock">Stock</label>
                            <h1><span class="badge badge-primary" id="stock">Cari aset terlebih dahulu</span></h1>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-10 col-md-11">
                            <label for="kode">Kode Aset</label>
                            <select class="form-control select2 " id="kode-masuk" name="kode" required style="width: 100%; "></select>
                        </div>
                        <div class="form-group col-2 col-md-1">
                            <label for="camera"></label>
                            <a href="#" id="camera" class="form-control text-center"><i class="fas fa-camera m-0 p-0"></i></a>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="jumlah">Jumlah (Meter/Paket/Set/Unit)*</label>
                            <input type="number" placeholder="10" required min="1" minlength="1" class="form-control" id="jumlah" name="jumlah">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="dari">Penyalur</label>
                            <input type="text" required class="form-control uppercase-input" placeholder="Adaw Watson" id="dari" name="dari">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="pic">PIC (Person In Charge)*</label>
                            <input type="text" required class="form-control uppercase-input" placeholder="Adaw Watson" id="pic" name="pic">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="keterangan">Keterangan</label>
                            <textarea class="form-control" name="keterangan" id="keterangan" rows="3"></textarea>
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" id="btn-aset-bergerak-masuk" class="btn btn-primary">Order</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-keluar">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form method="post" id="form-aset-bergerak-keluar" action="#">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title">Transaksi Aset Keluar</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="Stock">Stock</label>
                            <h1><span class="badge badge-primary" id="stock-keluar">Cari aset terlebih dahulu</span></h1>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-10 col-md-11">
                            <label for="kode">Kode Aset</label>
                            <select class="form-control select2" id="kode-keluar" name="kode" required style="width: 100%; "></select>
                        </div>
                        <div class="form-group col-2 col-md-1">
                            <label for="camera"></label>
                            <a href="#" id="camera" class="form-control text-center"><i class="fas fa-camera m-0 p-0"></i></a>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="jumlah">Jumlah (Meter/Paket/Set/Unit)*</label>
                            <input type="number" placeholder="10" required min="1" minlength="1" class="form-control" id="jumlah-keluar" name="jumlah">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="pic">PIC (Person In Charge)*</label>
                            <input type="text" required class="form-control uppercase-input" placeholder="Adaw Watson" id="pic" name="pic">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="tujuan">Penerima*</label>
                            <input type="text" required class="form-control uppercase-input" placeholder="Ujang Watson" id="tujuan" name="tujuan">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="keterangan">Keterangan</label>
                            <textarea class="form-control" name="keterangan" id="keterangan" rows="3"></textarea>
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" id="btn-aset-bergerak-keluar" class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<?= $this->endSection(); ?>

<?= $this->section('javascript'); ?>

<script src="<?= base_url('adminLTE/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
<script src="<?= base_url('adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js'); ?>"></script>

<script>
    $(document).ready(function() {
        $('#dataTable1').DataTable({
            order: [
                [9, 'desc']
            ],
            language: {
                emptyTable: "Data tidak ditemukan",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Selanjutnya",
                    previous: "Sebelumnya"
                },
                infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                infoFiltered: "(menyaring dari _MAX_ total data)",
                search: "Cari:",
                zeroRecords: "Tidak ada data yang ditemukan",
                searchPanes: {
                    title: {
                        _: 'Filter terpilih - %d',
                        0: 'Tidak ada filter yang dipilih',
                        1: 'Satu filter dipih'
                    }
                },
                searchBuilder: {
                    add: 'Tambah Kondisi',
                    condition: 'Pembanding',
                    clearAll: 'Reset',
                    delete: 'Hapus',
                    deleteTitle: 'Hapus Judul',
                    data: 'Kolom',
                    left: 'Kiri',
                    leftTitle: 'Judul Kiri',
                    logicAnd: 'Dan',
                    logicOr: 'Atau',
                    right: 'Kanan',
                    rightTitle: 'Judul Kanan',
                    title: {
                        0: 'Filter Dengan Kondisi',
                        _: 'Filter Dengan Kondisi (%d)'
                    },
                    value: 'Opsi',
                    valueJoiner: 'et'
                },
                buttons: {
                    colvis: 'Ganti Kolom'
                }
            },
            // searchPanes: {
            //     initCollapsed: true,
            //     cascadePanes: true,
            // },
            responsive: true,
        });

        $('#table-detail').DataTable({

            language: {
                emptyTable: "Data tidak ditemukan",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Selanjutnya",
                    previous: "Sebelumnya"
                },
                infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                infoFiltered: "(menyaring dari _MAX_ total data)",
                search: "Cari:",
                zeroRecords: "Tidak ada data yang ditemukan",
                searchPanes: {
                    title: {
                        _: 'Filter terpilih - %d',
                        0: 'Tidak ada filter yang dipilih',
                        1: 'Satu filter dipih'
                    }
                },
                searchBuilder: {
                    add: 'Tambah Kondisi',
                    condition: 'Pembanding',
                    clearAll: 'Reset',
                    delete: 'Hapus',
                    deleteTitle: 'Hapus Judul',
                    data: 'Kolom',
                    left: 'Kiri',
                    leftTitle: 'Judul Kiri',
                    logicAnd: 'Dan',
                    logicOr: 'Atau',
                    right: 'Kanan',
                    rightTitle: 'Judul Kanan',
                    title: {
                        0: 'Filter Dengan Kondisi',
                        _: 'Filter Dengan Kondisi (%d)'
                    },
                    value: 'Opsi',
                    valueJoiner: 'et'
                },
                buttons: {
                    colvis: 'Ganti Kolom'
                }
            },
            // searchPanes: {
            //     initCollapsed: true,
            //     cascadePanes: true,
            // },
            responsive: true,
            // dom: 'QBfrtip',
            // buttons: [
            //     'copyHtml5',
            //     {
            //         extend: 'excelHtml5',
            //         title: `Laporan ${bigTitle} ${formatDateDDMMYYHHMMSS(new Date())}`
            //     },
            //     {
            //         extend: 'csvHtml5',
            //         title: `Laporan ${bigTitle} ${formatDateDDMMYYHHMMSS(new Date())}`
            //     },
            //     {
            //         extend: 'pdfHtml5',
            //         title: `Laporan ${bigTitle} ${formatDateDDMMYYHHMMSS(new Date())}`,
            //         download: 'open'
            //     },
            //     'print',
            //     'colvis'
            // ],
            // data: response.data,
            // columns: response.columns.map(column => ({
            //     data: column
            // })),
        });
    });
</script>


<script>
    $(document).ready(function() {

        $('#kode-masuk').select2({
            placeholder: "Ketikan kode / nama aset",
            allowClear: true,
            ajax: {
                url: '<?= base_url('/master-aset/search-last-code'); ?>',
                dataType: 'json',
                delay: 250,
                data: params => {
                    return {
                        search: params.term,
                        type: 'Aset Bergerak'
                    };
                },
                processResults: data => {
                    return data
                },
                cache: false,

            },
            minimumInputLength: 1 // Adjust as needed
        });
        $('#kode-masuk').on("select2:select", function(e) {
            let kode = e.params.data.id;
            $.ajax({
                type: "GET", // or "GET" depending on your resource method
                url: "<?= base_url('/AsetBergerakAPI/'); ?>" + kode, // Replace with your CI4 resource endpoint
                dataType: 'json',
                success: function(data) {
                    if (!data) {
                        $('#stock').html('0');
                        return;
                    }
                    $('#stock').html(data.ketersediaan);
                },
                error: function(error) {
                    Swal.fire('Oops', error.responseText, 'error')
                    console.error('Error:', error);
                    console.log(error.responseText)
                }
            });
        });
        // $('#form-aset-bergerak-masuk').submit(function(e) {
        //     e.preventDefault(); // Prevent the default form submission

        //     // Get form data
        //     let formData = $(this).serialize();

        //     // Send form data using ajax
        //     $.ajax({
        //         type: 'POST', // or 'GET'
        //         url: '<?= base_url('/AsetTetapAPI'); ?>', // Replace with your server endpoint
        //         data: formData,
        //         success: function(response) {
        //             $('#modal-tambah-aset-tetap').modal('hide')
        //             Swal.fire('Yeay', response.msg ? response.msg + ' Aset Berhasil ditambahkan!' : 'Maaf, Aset gagal ditambahkan!', response.status).then(() => window.location.reload())
        //             // Handle the successful response
        //         },
        //         error: function(error) {
        //             // Handle errors
        //             Swal.fire('Oops', error.responseText, 'error').then(() => window.location.reload())
        //             console.log(error.responseText)
        //         }
        //     });




        // });
        $('#kode-keluar').select2({
            placeholder: "Ketikan kode / nama aset",
            allowClear: true,
            ajax: {
                url: '<?= base_url('/master-aset/search-last-code'); ?>',
                dataType: 'json',
                delay: 250,
                data: params => {
                    return {
                        search: params.term,
                        type: 'Aset Bergerak'
                    };
                },
                processResults: data => {
                    return data
                },
                cache: false,

            },
            minimumInputLength: 1 // Adjust as needed
        });
        $('#kode-keluar').on("select2:select", function(e) {
            let kode = e.params.data.id;
            $.ajax({
                type: "GET", // or "GET" depending on your resource method
                url: "<?= base_url('/AsetBergerakAPI/'); ?>" + kode, // Replace with your CI4 resource endpoint
                dataType: 'json',
                success: function(data) {
                    if (!data) {
                        $('#stock-keluar').html('0');
                        return;
                    }

                    $('#stock-keluar').html(data.ketersediaan);
                    if (parseInt($('#stock-keluar').text()) == 0) {
                        $('#btn-aset-bergerak-keluar').prop('disabled', true)
                        Swal.fire('Oops', 'Stock kosong, anda tidak bisa mengeluarkan aset', 'error').then(() => {
                            $('#modal-keluar').modal('hide');
                        })
                    } else {
                        $('#btn-aset-bergerak-keluar').prop('disabled', false)
                    }
                    $('#jumlah-keluar').attr('max', data.ketersediaan);
                    $('#jumlah-keluar').attr('maxLength', data.ketersediaan.length);
                },
                error: function(error) {
                    Swal.fire('Oops', error.responseText, 'error')
                    console.error('Error:', error);
                    console.log(error.responseText)
                }
            });
        });

        $("#form-aset-bergerak-keluar").submit(function(e) {
            e.preventDefault();

            if (parseInt($('#stock-keluar').text()) < parseInt($('#jumlah-keluar').text())) {
                Swal.fire('Oops', 'Jumlah tidak boleh lebih dari stock', "warning")
                return
            }
            // Serialize form data
            let formData = $("#form-aset-bergerak-keluar").serialize();
            formData += '&statusbarang=Keluar';
            formData += '&stock=' + $('#stock-keluar').text();

            // Submit the form using AJAX
            $.ajax({
                type: "POST", // or "GET" depending on your form method
                url: "<?= base_url('/aset-bergerak/transaksi'); ?>", // Replace with your server-side script URL
                data: formData,
                success: function(response) {
                    $('#modal-keluar').modal('hide')
                    Swal.fire('Yeay', response.msg, response.status).then(() => window.location.reload())
                },
                error: function(error) {
                    Swal.fire('Oops', error.responseText, 'error').then(() => window.location.reload())
                    console.log(error.responseText)
                }
            });
        });

        $("#form-aset-bergerak-masuk").submit(function(e) {
            e.preventDefault();
            // Serialize form data
            let formData = $("#form-aset-bergerak-masuk").serialize();
            formData += '&statusbarang=Masuk';
            formData += '&stock=' + $('#stock').text();

            // Submit the form using AJAX
            $.ajax({
                type: "POST", // or "GET" depending on your form method
                url: "<?= base_url('/aset-bergerak/transaksi'); ?>", // Replace with your server-side script URL
                data: formData,
                success: function(response) {
                    $('#modal-masuk').modal('hide')
                    Swal.fire('Yeay', response.msg, response.status).then(() => window.location.reload())
                },
                error: function(error) {
                    Swal.fire('Oops', error.responseText, 'error').then(() => window.location.reload())
                    console.log(error.responseText)
                }
            });
        });
    });
</script>
<?= $this->endSection(); ?>