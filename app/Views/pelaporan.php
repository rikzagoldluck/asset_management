<?= $this->extend('default') ?>
<?= $this->section('page_title'); ?>
<?= $title; ?>
<?= $this->endSection(); ?>

<?= $this->section('context'); ?>
<?= $title; ?>
<?= $this->endSection(); ?>
<?= $this->section('css') ?>
<link rel="stylesheet" href="<?= base_url('adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('adminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('adminLTE/plugins/datatables-searchpanes/css/searchPanes.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('adminLTE/plugins/datatables-searchbuilder/css/searchBuilder.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('adminLTE/plugins/datatables-select/css/select.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css">
<link rel="stylesheet" href="<?= base_url('adminLTE/plugins/daterangepicker/daterangepicker.css'); ?>">
<link rel="stylesheet" href="<?= base_url('adminLTE/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css'); ?>">
<?= $this->endSection(); ?>
<!-- Default box -->
<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label>Periode Pelaporan:</label>

            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-clock"></i></span>
                </div>
                <input type="text" class="form-control float-right" id="periode-pelaporan">
            </div>
            <!-- /.input group -->
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label>Lokasi:</label>

            <select class="form-control select2 " id="lokasi" name="lokasi" required style="width: 100%; "></select>

        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?= $title; ?> </h3>
        <!-- <div class="card-tools">

            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-import-excel">
                <i class="fas fa-file-excel"></i> Import Excel
            </button>
        </div> -->
    </div>
    <!-- /.card-header -->
    <div class="card-body overflow-auto">

        <table id="pelaporan" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Unit</th>
                    <th>Stok Awal</th>
                    <th>Mutasi</th>
                    <th>Stok Akhir</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>


<!-- /.card -->
<?= $this->endSection() ?>


<?= $this->section('javascript') ?>

<script src="<?= base_url('adminLTE/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
<script src="<?= base_url('adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js'); ?>"></script>
<script src="<?= base_url('adminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js'); ?>"></script>
<script src="<?= base_url('adminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js'); ?>"></script>
<script src="<?= base_url('adminLTE/plugins/datatables-buttons/js/buttons.print.min.js'); ?>"></script>
<script src="<?= base_url('adminLTE/plugins/datatables-buttons/js/buttons.html5.min.js'); ?>"></script>
<script src="<?= base_url('adminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js'); ?>"></script>
<script src="<?= base_url('adminLTE/plugins/jszip/jszip.min.js'); ?>"></script>
<script src="<?= base_url('adminLTE/plugins/pdfmake/pdfmake.min.js'); ?>"></script>
<script src="<?= base_url('adminLTE/plugins/pdfmake/vfs_fonts.js'); ?>"></script>
<script src="<?= base_url('adminLTE/plugins/datatables-searchpanes/js/dataTables.searchPanes.min.js'); ?>"></script>
<script src="<?= base_url('adminLTE/plugins/datatables-searchbuilder/js/dataTables.searchBuilder.min.js'); ?>"></script>
<script src="<?= base_url('adminLTE/plugins/datatables-searchpanes/js/searchPanes.bootstrap4.min.js'); ?>"></script>
<script src="<?= base_url('adminLTE/plugins/datatables-searchbuilder/js/searchBuilder.bootstrap4.min.js'); ?>"></script>
<script src="<?= base_url('adminLTE/plugins/datatables-select/js/dataTables.select.min.js'); ?>"></script>
<script src="<?= base_url('adminLTE/plugins/datatables-select/js/select.bootstrap4.min.js'); ?>"></script>
<script src="https://cdn.datatables.net/datetime/1.5.1/js/dataTables.dateTime.min.js"></script>
<script src="<?= base_url('adminLTE/plugins/daterangepicker/daterangepicker.js'); ?>"></script>
<script src="<?= base_url('adminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js'); ?>"></script>
<script src="<?= base_url('js/util.js'); ?>"></script>

<script>
    $(document).ready(function() {
        let dataTable = $('#pelaporan').DataTable({
            language: {
                emptyTable: "Silakan tentukan periode pelaporan terlebih dahulu",
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
            responsive: true,
            dom: 'Bfrtip',
            autoWidth: false,
            buttons: [
                'copyHtml5',
                {
                    extend: 'excelHtml5',
                    title: function() {
                        return `Laporan Mutasi Aset ${$('#periode-pelaporan').val()} di ${$('#lokasi').val().split('-')[0]}`
                    }
                },
                {
                    extend: 'csvHtml5',
                    title: function() {
                        return `Laporan Mutasi Aset ${$('#periode-pelaporan').val()} di ${$('#lokasi').val().split('-')[0]}`
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: function() {
                        return `Laporan Mutasi Aset ${$('#periode-pelaporan').val()} di ${$('#lokasi').val().split('-')[0]}`
                    },
                    download: 'open'
                },
                'print',
                'colvis'
            ],
            columns: [{
                    data: 'kode',
                },
                {
                    data: 'namabarang'
                },
                {
                    data: 'unit'
                },
                {
                    data: 'stok_awal'
                },
                {
                    data: 'mutasi'
                },
                {
                    data: 'stok_akhir'
                },
                {
                    data: 'keterangan'
                }
            ]

        });

        $('#periode-pelaporan').daterangepicker({
            showDropdowns: true,
            minYear: 2013,
            maxYear: new Date().getFullYear() + 1,
            locale: {
                format: "DD-MM-YYYY",
                separator: " S/D ",
                applyLabel: "Tetapkan",
                cancelLabel: "Cancel",
                fromLabel: "Dari",
                toLabel: "Ke",
                customRangeLabel: "Custom",
                weekLabel: "W",
                daysOfWeek: [
                    "Minggu",
                    "Senin",
                    "Selasa",
                    "Rabu",
                    "Kamis",
                    "Jum\'at",
                    "Sabtu"
                ],
                monthNames: [
                    "Januari",
                    "Februari",
                    "Maret",
                    "April",
                    "Mei",
                    "Juni",
                    "Juli",
                    "Agustus",
                    "September",
                    "Oktober",
                    "November",
                    "Desember"
                ],
                firstDay: 1
            },
            autoApply: true,
            ranges: {
                'Hari ini': [moment(), moment()],
                'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                '7 Hari terakhir': [moment().subtract(6, 'days'), moment()],
                '30 Hari Terakhir': [moment().subtract(29, 'days'), moment()],
                'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
                'Bulan lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                '3 Bulan Terakhir': [moment().subtract(3, 'months').startOf('month'), moment().endOf('month')],
                '6 Bulan Terakhir': [moment().subtract(6, 'months').startOf('month'), moment().endOf('month')]
            },
            "alwaysShowCalendars": true,
        }, function(start, end, label) {
            // console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
            let data = {
                start: start.format('YYYY-MM-DD'),
                end: end.format('YYYY-MM-DD'),
                lokasi: $('#lokasi').val().split("-")[1]
            }
            $.ajax({
                url: "<?= base_url('/pelaporan/transaksi-aset'); ?>",
                type: "PATCH",
                dataType: "json",
                data: JSON.stringify(data),
                contentType: "application/json; charset=utf-8",
                deferRender: true,
                // async: false,
                success: function(response) {
                    console.log(response)
                    dataTable.clear();

                    // Add new data to DataTable
                    dataTable.rows.add(response);

                    // Redraw the DataTable
                    dataTable.draw();
                    // dataTable.searchPanes.container().prependTo(dataTable.table().container());
                    // dataTable.searchPanes.resizePanes();
                },
                error: function(e) {

                    console.error(e.responseText)
                }
            })


        });
        $('#lokasi').select2({
            placeholder: "Ketikan kode / nama lokasi",
            allowClear: true,
        });
        $.ajax({
            type: "GET", // or "GET" depending on your resource method
            url: "<?= base_url('/AsetBangunanAPI'); ?>", // Replace with your CI4 resource endpoint
            dataType: 'json',
            success: function(data) {
                $('#lokasi').append('')
                $(data).each((i, el) => {
                    $('#lokasi').append(`<option value="${el.namaruang + "-" + el.koderuang}">${el.namaruang}</option>`)
                })

            },
            error: function(error) {
                Swal.fire('Oops', 'Terjadi kesalahan ketika mengambil data ruangan', 'error')
                console.error('Error:', error);
                console.log(error.responseText)
            }
        });
        $('#lokasi').on("select2:select", function(e) {
            let periodePelaporan = $('#periode-pelaporan').val().split('S/D')
            let startArr = periodePelaporan[0].trim().split("-");
            let endArr = periodePelaporan[1].trim().split("-");


            // Rearrange the components into the desired order (year-month-day)
            let start = startArr[2] + "-" + startArr[1] + "-" + startArr[0];
            let end = endArr[2] + "-" + endArr[1] + "-" + endArr[0];
            let data = {
                start,
                end,
                lokasi: $('#lokasi').val().split("-")[1]
            }
            $.ajax({
                url: "<?= base_url('/pelaporan/transaksi-aset'); ?>",
                type: "PATCH",
                dataType: "json",
                data: JSON.stringify(data),
                contentType: "application/json; charset=utf-8",
                deferRender: true,
                // async: false,
                success: function(response) {
                    dataTable.clear();

                    // Add new data to DataTable
                    dataTable.rows.add(response);

                    // Redraw the DataTable
                    dataTable.draw();
                    // dataTable.searchPanes.container().prependTo(dataTable.table().container());
                    // dataTable.searchPanes.resizePanes();
                },
                error: function(e) {

                    console.error(e.responseText)
                }
            })
        });
    });
</script>
<?= $this->endSection() ?>