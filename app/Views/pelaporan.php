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

<?= $this->endSection(); ?>
<!-- Default box -->
<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?= $title; ?> </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body overflow-auto">
        <table id="pelaporan" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr id="tableHeaders"></tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>


<!-- /.card -->
<?= $this->endSection() ?>


<?= $this->section('javascript') ?>
<!-- Select2 -->
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
<script src="<?= base_url('js/util.js'); ?>"></script>
<script>
    $(document).ready(function() {


        let url = window.location.href;

        // Split the URL by '/'
        let urlParts = url.split('/');
        let bigTitle = ''

        // Check if there is a second parameter
        if (urlParts.length > 2) {
            // The second parameter is at index 2
            let secondParameter = urlParts[5];
            console.log(secondParameter)
            fetchData(secondParameter)
            let newStr = secondParameter.split(/(?=[A-Z])/)
            bigTitle = newStr.join(' ').replace(' Model', '');
            $('.card-title').text("Pelaporan " + bigTitle);
        }

        function fetchData(modelName) {
            // if ($('#pelaporan').DataTable()) {
            //     $('#pelaporan').DataTable().destroy()
            // }
            $.ajax({
                url: "http://localhost/asset_management/pelaporan/getDataAndColumns/" + modelName,
                type: "GET",
                dataType: "json",
                deferRender: true,
                // async: false,
                success: function(response) {
                    // Initialize DataTables
                    let tableHeaders = response.columns.map(function(column) {
                        return '<th>' + column + '</th>';
                    });

                    // Append headers to the table
                    $('#tableHeaders').html(tableHeaders.join(''));

                    let dataTable = $('#pelaporan').DataTable({
                        language: {
                            emptyTable: "Silakam tentukan periode pelaporan terlebih dahulu",
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
                        dom: 'QBfrtip',
                        buttons: [
                            'copyHtml5',
                            {
                                extend: 'excelHtml5',
                                title: `Laporan ${bigTitle} ${formatDateDDMMYYHHMMSS(new Date())}`
                            },
                            {
                                extend: 'csvHtml5',
                                title: `Laporan ${bigTitle} ${formatDateDDMMYYHHMMSS(new Date())}`
                            },
                            {
                                extend: 'pdfHtml5',
                                title: `Laporan ${bigTitle} ${formatDateDDMMYYHHMMSS(new Date())}`,
                                download: 'open'
                            },
                            'print',
                            'colvis'
                        ],
                        data: response.data,
                        columns: response.columns.map(column => ({
                            data: column
                        })),
                    });

                    dataTable.searchPanes.container().prependTo(dataTable.table().container());
                    dataTable.searchPanes.resizePanes();

                },
                error: function(error) {
                    Swal.fire(
                        'Maaf',
                        'Gagal mengambil data, silakan hubungi admin',
                        'error'
                    )
                    console.error("Error fetching data and columns:", error.responseText);
                }
            });
        }



        // Initial data load with the default selected model

    });
</script>
<?= $this->endSection() ?>