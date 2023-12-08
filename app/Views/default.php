<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Asset Management | <?= $this->renderSection('page_title'); ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('adminLTE/plugins/fontawesome-free/css/all.min.css'); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('adminLTE/dist/css/adminlte.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('adminLTE/plugins/select2/css/select2.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('adminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('adminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css'); ?>">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <style>
        .select2-selection--single {
            min-height: 34px !important;
        }
    </style>


    <?= $this->renderSection('css') ?>
</head>

<body class="hold-transition sidebar-mini sidebar-closed sidebar-collapse">
    <!-- Site wrapper -->
    <div class="wrapper">


        <?= $this->include('partials/top_menu') ?>

        <?= $this->include('partials/side_menu') ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <?php if (!empty(session()->getFlashdata('message-konten'))) : ?>
                <div class="alert alert-<?= session()->getFlashdata('message-konten')['status'] ?> alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('message-konten')['konten']; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif ?>

            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Dashboard</a></li>
                                <li class="breadcrumb-item active"><?= $this->renderSection('context'); ?></li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <?= $this->renderSection('content') ?>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <?= $this->include('partials/footer'); ?>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <div class="modal fade" id="modal-lg">

        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <form method="post" id="formAdjustInventori" action="#">
                    <div class="modal-header">
                        <h4 class="modal-title">Inventori Adjustment</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-row">
                            <div class="form-group col-10 col-md-11">
                                <label for="barcode">Barcode Aset*</label>
                                <select class="form-control select2" id="barcode" name="kode" required style="width: 100%; "></select>
                            </div>
                            <div class="form-group col-2 col-md-1">
                                <label for="camera"></label>
                                <a href="#" id="camera" class="form-control text-center"><i class="fas fa-camera m-0 p-0"></i></a>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label>Tipe Adjustment*</label>
                                <br>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="statusbarang" id="tipe-adjustment1" value="Masuk" checked>
                                    <label class="custom-control-label" for="tipe-adjustment1">
                                        Masuk
                                    </label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="statusbarang" id="tipe-adjustment2" value="Keluar">
                                    <label class="custom-control-label" for="tipe-adjustment2">
                                        Keluar
                                    </label>
                                </div>
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
                        <button type="button" id="btnAdjustInventori" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <!-- jQuery -->
    <script src="<?= base_url('adminLTE/plugins/jquery/jquery.min.js'); ?>"></script>

    <script src="<?= base_url('adminLTE/plugins/moment/moment.min.js'); ?>"></script>
    <script src="<?= base_url('adminLTE/plugins/moment/locale/id.js'); ?>"></script>

    <!-- Bootstrap 4 -->
    <script src="<?= base_url('adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('adminLTE/dist/js/adminlte.min.js'); ?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?= base_url('adminLTE/dist/js/demo.js'); ?>"></script>
    <script src="<?= base_url('adminLTE/plugins/select2/js/select2.full.min.js'); ?>"></script>

    <script src="<?= base_url('adminLTE/plugins/sweetalert2/sweetalert2.all.min.js'); ?>"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

    <script>
        $(document).ready(function() {
            function populateSelectOptions(options) {
                var select = $('#jenisbarang');
                select.empty(); // Clear existing options

                select.append('<option value="">-- Pilih Satuan --</option>')
                // Iterate through the options and append them to the select element
                $.each(options, function(index, option) {
                    select.append('<option value="' + option + '">' + option + '</option>');
                });
            }

            function setSelectedOption(desiredValue) {
                // Set the selected option based on the desired value
                $('#jenisbarang').val(desiredValue);
            }

            function fetchUniqueValues() {

                // Use the correct URL for fetching unique values
                $.ajax({
                    type: "GET",
                    url: "<?= base_url('/master-aset/distinct/jenisbarang'); ?>",
                    success: function(data) {
                        // Populate the select options
                        populateSelectOptions(data);
                        // Set the selected option based on some criteria
                        // setSelectedOption("desired_value");
                    },
                    error: function(error) {
                        console.error('Error fetching options:', error);
                    }
                });

            }

            function fetchData(search) {
                $.ajax({
                    url: '<?= base_url('/master-aset/search'); ?>', // Replace with your actual API endpoint
                    method: 'GET',
                    data: {
                        search: search
                    }, // Pass the search value to the server
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == 'error') {
                            Swal.showValidationMessage(`Kode ${search} sudah digunakan, silakan cari kode yang lain`)
                        } else {
                            if (Swal.getValidationMessage()) Swal.resetValidationMessage()
                        }
                    },
                    error: function(error) {
                        Swal.showValidationMessage(`Terjadi kesalahan ketika mengecek kode aset`)
                    }
                });
            }

            $('.select2').select2()
            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
            $('#barcode').select2({
                placeholder: "Ketikan kode / nama aset",
                allowClear: true,
                ajax: {
                    url: '<?= base_url('/AsetBergerakAPI'); ?>',
                    dataType: 'json',
                    delay: 250,
                    data: params => {
                        return {
                            search: params.term,
                            type: 'barcode'
                        };
                    },
                    processResults: data => {
                        if (data.results.length < 1) {
                            let kodebarangInput;
                            let namabarang;
                            let jenisbarangInput;
                            let tipebarangInput;
                            let jumlahInput;
                            let keteranganInput;

                            Swal.fire({
                                title: 'Tambah Master Aset',
                                html: `<form id="addMasterAset">
                                    <label>Aset yang anda cari tidak ditemukan, silakan tambah aset baru</label>
                                    <input type="text" id="kodebarang" name="kodebarang" class="swal2-input" placeholder="Kode Aset" autocomplete="off" minlength="8" maxlength="9">
                                    <input type="text" id="namabarang" name="namabarang" class="swal2-input" placeholder="Nama Aset" autocomplete="off">
                                    <select id="jenisbarang" name="jenisbarang" class="swal2-select" placeholder="Jenis Barang">
                                    </select>
                                    <input type="text" id="tipebarang" name="tipebarang" class="swal2-input" placeholder="Tipe Barang" autocomplete="off">
                                    <input type="number" id="jumlah" name="jumlah" class="swal2-input" placeholder="Jumlah" autocomplete="off" maxlength="11" >
                                    <input type="textarea" id="keterangan" name="keterangan" class="swal2-input" placeholder="Keterangan" autocomplete="off" >
                                </form>`,
                                backdrop: true,
                                confirmButtonText: 'Tambah',
                                focusConfirm: false,
                                showCloseButton: true,
                                didOpen: () => {
                                    fetchUniqueValues();


                                    const popup = Swal.getPopup()
                                    kodebarangInput = popup.querySelector('#kodebarang')
                                    namabarangInput = popup.querySelector('#namabarang')
                                    jenisbarangInput = popup.querySelector('#jenisbarang')
                                    tipebarangInput = popup.querySelector('#tipebarang')
                                    jumlahInput = popup.querySelector('#jumlah')
                                    keteranganInput = popup.querySelector('#keterangan')

                                    kodebarangInput.onkeyup = (event) => {
                                        if (event.key === 'Enter') {
                                            Swal.clickConfirm()
                                        }

                                        let searchValue = kodebarangInput.value

                                        if (searchValue.length < 8) return;
                                        fetchData(searchValue);
                                        // Call the fetchData function with the search value
                                    }
                                    namabarangInput.onkeyup = (event) => event.key === 'Enter' && Swal.clickConfirm()
                                    jenisbarangInput.onkeyup = (event) => event.key === 'Enter' && Swal.clickConfirm()
                                    tipebarangInput.onkeyup = (event) => event.key === 'Enter' && Swal.clickConfirm()
                                    jumlahInput.onkeyup = (event) => event.key === 'Enter' && Swal.clickConfirm()
                                    keteranganInput.onkeyup = (event) => event.key === 'Enter' && Swal.clickConfirm()

                                },
                                preConfirm: () => {
                                    const kodebarang = kodebarangInput.value
                                    const namabarang = namabarangInput.value
                                    const jenisbarang = jenisbarangInput.value
                                    const tipebarang = tipebarangInput.value
                                    const jumlah = jumlahInput.value
                                    const keterangan = keteranganInput.value

                                    if (!kodebarang || !namabarang || !jenisbarang || !jumlah) {
                                        Swal.showValidationMessage(`Tolong penuhi formulir`)
                                        return;
                                    }

                                    if (kodebarang.length < 8 || kodebarang.length > 9) {
                                        Swal.showValidationMessage('Kode aset harus terdiri dari 8 atau 9 karakter')
                                        return;
                                    }

                                    return new Promise(function(resolve) {
                                        // Serialize form data
                                        let formData = {}
                                        $("#addMasterAset").serializeArray().forEach(function(item) {
                                            formData[item.name] = item.value;
                                        });

                                        // Convert the form data to JSON
                                        let jsonData = JSON.stringify(formData);
                                        // Submit the form using AJAX to your CodeIgniter 4 resource
                                        $.ajax({
                                            type: "POST", // or "GET" depending on your resource method
                                            url: "<?= base_url('/MasterAsetAPI'); ?>", // Replace with your CI4 resource endpoint
                                            contentType: "application/json", // Set the content type to JSON
                                            data: jsonData,
                                            success: function(response) {
                                                // Handle the success response using SweetAlert2
                                                Swal.fire({
                                                    title: 'Success!',
                                                    text: "Aset baru berhasil ditambahkan",
                                                    icon: 'success',
                                                    confirmButtonText: 'OK'
                                                });
                                                resolve();
                                            },
                                            error: function(error) {
                                                // Handle the error response using SweetAlert2
                                                console.log(error)
                                                Swal.fire({
                                                    title: 'Error!',
                                                    text: 'An error occurred',
                                                    icon: 'error',
                                                    confirmButtonText: 'OK'
                                                });
                                                resolve();
                                            }
                                        });
                                    });

                                },

                                showLoaderOnConfirm: true,
                                allowOutsideClick: () => !Swal.isLoading()

                            })

                        } else {
                            $('#kolom-pertama').html('')
                        }

                        return data
                    },
                    cache: false,

                },
                minimumInputLength: 1 // Adjust as needed
            });


        });
        let uppercaseInputs = document.querySelectorAll('.uppercase-input');

        // Add an event listener to each input
        uppercaseInputs.forEach(function(input) {
            input.addEventListener('input', function() {
                // Convert the input value to uppercase
                this.value = this.value.toUpperCase();
            });
        });

        $("#btnAdjustInventori").click(function() {
            // Serialize form data
            let formData = $("#formAdjustInventori").serialize();

            // Submit the form using AJAX
            $.ajax({
                type: "POST", // or "GET" depending on your form method
                url: "<?= base_url('/aset-bergerak/transaksi'); ?>", // Replace with your server-side script URL
                data: formData,
                success: function(response) {
                    console.log(response)
                    // Handle the response using SweetAlert2
                    Swal.fire({
                        title: 'Success!',
                        text: response.message,
                        icon: response.status,
                        confirmButtonText: 'OK'
                    });
                    $('#barcode').val(null).trigger('change');
                },
                error: function(error) {
                    // Handle the error using SweetAlert2
                    Swal.fire({
                        title: 'Error!',
                        text: 'An error occurred',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                    $('#barcode').val(null).trigger('change');
                }
            });
        });
    </script>

    <?= $this->renderSection('javascript') ?>
</body>

</html>