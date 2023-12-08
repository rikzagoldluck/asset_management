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

            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah-aset-tetap">
                <i class="fas fa-plus"></i> Tambah Aset
            </button>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-import-excel">
                <i class="fas fa-file-excel"></i> Import Excel
            </button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body overflow-auto">
        <ul class="nav nav-tabs" id="dataTableTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="table1-tab" data-toggle="tab" href="#table1" role="tab" aria-controls="table1" aria-selected="true">Ringkasan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="table2-tab" data-toggle="tab" href="#table2" role="tab" aria-controls="table2" aria-selected="false">Detail</a>
            </li>
        </ul>

        <!-- Toggle Content -->
        <div class="tab-content mt-3">
            <div class="tab-pane fade show active" id="table1" role="tabpanel" aria-labelledby="table1-tab">
                <table class="table table-bordered nowrap responsive" id="dataTable1" style="width:100%">
                    <thead>
                        <tr>
                            <th>Kode Group</th>
                            <th>Nama</th>
                            <th>Total Assets</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($asetTetapSumm as $asset) : ?>
                            <tr>
                                <td><?= $asset->kode_group ?></td>
                                <td><?= $asset->nama . " " . $asset->merk . " " . $asset->tipe ?></td>
                                <td><?= $asset->total_assets ?></td>
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
                            <th>Nama</th>
                            <th>Tipe</th>
                            <th>Merk</th>
                            <th>Tahun</th>
                            <th>Lokasi</th>
                            <th>Kondisi</th>
                            <th>Terakhir SO</th>
                            <th>Ket</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($asetTetapDetail as $asset) : ?>
                            <tr>
                                <td><?= $asset['kode']; ?></td>
                                <td><?= $asset['namabarang'];  ?></td>
                                <td><?= $asset['tipebarang']; ?></td>
                                <td><?= $asset['merk']; ?></td>
                                <td><?= $asset['tahun']; ?></td>
                                <td><?= $asset['namaruang']; ?></td>
                                <td><?= $asset['kondisi']; ?></td>
                                <td><?= $asset['tanggal']; ?></td>
                                <td><?= $asset['keterangan']; ?></td>
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

<div class="modal fade" id="modal-import-excel">

    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form id="excelForm" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Import Aset Tetap</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group" id="cari-kode-parent">
                        <label for="cari-kode">Cari kode terakhir</label>
                        <small id="cari-kode-help" class="form-text text-danger text-bold mb-2 ">Harap diperhatikan! Menambahkan data menggunakan import excel memerlukan kode yang paling akhir dari aset yang ingin ditambahkan, maka anda harus mencari kode terakhir dari aset yang ingin ditambahkan terlebih dahulu. <span class="text-success"> Silakan unduh template excel untuk mellihat contoh</span> </small>
                        <select class="form-control select2 " id="cari-kode" name="cari-kode" required style="width: 100%; "></select>
                    </div>
                    <div class="form-group">
                        <label>Excel Aset Tetap</label>
                        <a href="<?= base_url('public/adminLTE/aset-tetap-template.xlsx'); ?>" download="aset-tetap-template.xlsx" class="font-sm">Unduh template</a>
                        <div class="input-group">
                            <div class="custom-file">
                                <input class="custom-file-input" type="file" name="excelFile" id="uploadExcel" accept=".xlsx, .xls">
                                <label class="custom-file-label" for="uploadExcel">Pilih File</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="button" id="btnUploadExcel" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-tambah-aset-tetap">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form method="post" id="formTambahAsetTetap">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Aset Tetap</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group" id="cari-kode-for-tambah-aset-parent">
                        <label for="cari-kode-for-tambah-aset">Cari kode terakhir</label>
                        <select class="form-control select2" id="cari-kode-for-tambah-aset" required style="width: 100%; "></select>
                    </div>

                    <div class="form-group">
                        <label for="kode-terakhir-for-tambah-aset">Kode Terakhir</label>
                        <input type="text" class="form-control" id="kode-terakhir-for-tambah-aset" placeholder="Kode terakhir akan tampil disini" name="kode" readonly>
                    </div>

                    <div class="form-group">
                        <label for="jumlah">Jumlah*</label>
                        <input required type="number" min="0" value="1" class="form-control" id="jumlah" name="jumlah" placeholder="Berapa banyak barang yang akan ditambahkan" readonly>
                    </div>

                    <div class="form-group">
                        <label for="kondisi">Kondisi*</label>
                        <select class="form-control" id="kondisi" name="kondisi" placeholder="Pilih kondisi aset" readonly>
                            <option>Baik</option>
                            <option>Rusak Ringan</option>
                            <option>Rusak Sedang</option>
                            <option>Rusak Parah</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="lokasi">Lokasi*</label>
                        <select class="form-control" id="lokasi" name="lokasi" placeholder="Pilih lokasi aset" readonly>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" name="keterangan" id="keterangan" placeholder="Aset ini dapat dipindah" readonly></textarea>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" id="btnTambahAsetTetap" class="btn btn-primary">Tambah</button>
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
    // let response = [];

    $(document).ready(function() {
        $('#dataTable1').DataTable({
            language: {
                emptyTable: "Data belum ditemukan",
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
            order: [
                [7, 'desc']
            ],
            language: {
                emptyTable: "Data belum ditemukan",
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
            searchPanes: {
                initCollapsed: true,
                cascadePanes: true,
            },
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
        $('#uploadExcel').on('change', function(e) {
            //get the file name
            let fileName = e.target.files[0].name
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        })
        $.ajax({
            type: "GET", // or "GET" depending on your resource method
            url: "<?= base_url('/AsetBangunanAPI'); ?>", // Replace with your CI4 resource endpoint
            dataType: 'json',
            success: function(data) {
                $('#lokasi').append('')
                $(data).each((i, el) => {
                    $('#lokasi').append(`<option value="${el.koderuang}">${el.namaruang}</option>`)
                })

            },
            error: function(error) {
                Swal.fire('Oops', 'Terjadi kesalahan ketika mengambil data ruangan', 'error')
                console.error('Error:', error);
                console.log(error.responseText)
            }
        });

        $('#cari-kode').select2({
            placeholder: "Ketikan kode / nama aset",
            allowClear: true,
            ajax: {
                url: '<?= base_url('/master-aset/search-last-code'); ?>',
                dataType: 'json',
                delay: 250,
                data: params => {
                    return {
                        search: params.term,
                        type: 'Aset Tetap'
                    };
                },
                processResults: data => {
                    return data
                },
                cache: false,

            },
            minimumInputLength: 1 // Adjust as needed
        });

        $('#cari-kode').on("select2:select", function(e) {
            let kode = e.params.data.id;
            $.ajax({
                type: "GET", // or "GET" depending on your resource method
                url: "<?= base_url('/aset-tetap/search-last-code/'); ?>/" + kode, // Replace with your CI4 resource endpoint
                dataType: 'json',
                success: function(data) {

                    if ($('#kode-terakhir')) $('#kode-terakhir').remove();
                    if (data) {
                        let lastDigits = parseInt(data.kode.slice(-4)) + 1;

                        // Format ulang kode dengan leading zeros
                        let newCode = data.kode.slice(0, -4) + ('0000' + lastDigits).slice(-4);


                        $('#cari-kode-parent').after(`
                        <div class="form-group" id="kode-terakhir" >
                            <label >Kode Terakhir : </label>
                            <label class="text-success">${newCode}</label>
                            <small  class="form-text text-primary text-bold mb-2 ">Silakan salin kode diatas</small>
                        </div>`)
                    } else {
                        $('#cari-kode-parent').after(`
                        <div class="form-group" id="kode-terakhir" >
                            <label >Kode Terakhir : </label>
                            <label class="text-success" >${kode + '0001'}</label>
                            <small  class="form-text text-primary text-bold mb-2 ">Silakan salin kode diatas</small>
                        </div>`)
                    }


                    // Handle the returned data here
                },
                error: function(error) {
                    Swal.fire('Oops', error.responseText, 'error')
                    console.error('Error:', error);
                    console.log(error.responseText)
                }
            });
        });

        $('#cari-kode-for-tambah-aset').select2({
            placeholder: "Ketikan kode / nama aset untuk mencari kode terakhir",
            allowClear: true,
            ajax: {
                url: '<?= base_url('/master-aset/search-last-code'); ?>',
                dataType: 'json',
                delay: 250,
                data: params => {
                    return {
                        search: params.term,
                        type: 'Aset Tetap'
                    };
                },
                processResults: data => {
                    return data
                },
                cache: false,

            },
            minimumInputLength: 1 // Adjust as needed
        });

        $('#cari-kode-for-tambah-aset').on("select2:select", function(e) {
            let kode = e.params.data.id;
            $.ajax({
                type: "GET", // or "GET" depending on your resource method
                url: "<?= base_url('/aset-tetap/search-last-code/'); ?>/" + kode,
                // Replace with your CI4 resource endpoint
                dataType: 'json',
                success: function(data) {
                    if (data) {
                        $('#kode-terakhir-for-tambah-aset').val(data.kode)
                    } else {
                        $('#kode-terakhir-for-tambah-aset').val(kode + '0000')
                    }

                    $('#kondisi').removeAttr('readonly')
                    $('#jumlah').removeAttr('readonly')
                    $('#lokasi').removeAttr('readonly')
                    $('#keterangan').removeAttr('readonly')


                    // Handle the returned data here
                },
                error: function(error) {
                    Swal.fire('Oops', error.responseText, 'error')
                    console.error('Error:', error);
                    console.log(error.responseText)
                }
            });
        });

        $('#formTambahAsetTetap').submit(function(e) {
            e.preventDefault(); // Prevent the default form submission

            // Get form data
            let formData = $(this).serialize();

            // Send form data using ajax
            $.ajax({
                type: 'POST', // or 'GET'
                url: '<?= base_url('/AsetTetapAPI'); ?>', // Replace with your server endpoint
                data: formData,
                success: function(response) {
                    $('#modal-tambah-aset-tetap').modal('hide')
                    Swal.fire('Yeay', response.msg ? response.msg + ' Aset Berhasil ditambahkan!' : 'Maaf, Aset gagal ditambahkan!', response.status).then(() => window.location.reload())
                    // Handle the successful response
                },
                error: function(error) {
                    // Handle errors
                    Swal.fire('Oops', error.responseText, 'error').then(() => window.location.reload())
                    console.log(error.responseText)
                }
            });




        });

        $("#btnUploadExcel").on("click", function() {
            // Perform AJAX request to handle file upload
            let formData = new FormData($("#excelForm")[0]);

            $.ajax({
                type: "POST",
                url: "<?= base_url('/aset-tetap/upload'); ?>", // Replace with your controller method URL
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    Swal.fire(response.status == 'success' ? 'Yeay' : 'Oops', response.msg, response.status).then(() => window.location.reload())
                    console.log(response)
                },
                error: function(error) {
                    Swal.fire('Oops', JSON.parse(error.responseText).message, 'error').then(() => window.location.reload())
                    console.log(error.responseText)
                }
            });



        });
    });
</script>
<?= $this->endSection(); ?>