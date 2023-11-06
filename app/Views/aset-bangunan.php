<?= $this->extend('default') ?>
<?= $this->section('page_title'); ?>
<?= $title; ?>
<?= $this->endSection(); ?>

<?= $this->section('context'); ?>
<?= $title; ?>
<?= $this->endSection(); ?>

<!-- Default box -->

<?= $this->section('css') ?>
<!-- jsGrid -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="<?= base_url('adminLTE/plugins/jsgrid/jsgrid.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('adminLTE/plugins/jsgrid/jsgrid-theme.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('adminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css'); ?>">

<?= $this->endSection(); ?>


<?= $this->section('content') ?>
<!-- Main content -->
<section class="content">

  <div class="card">
    <div class="card-header">
      <h3 class="card-title"><?= $title; ?></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body overflow-auto">
      <div id="jsGrid1" class="overflow-auto"></div>
    </div>
    <!-- /.card-body -->
  </div>

</section>
<!-- /.content -->
<!-- /.content-wrapper -->
<?= $this->endSection(); ?>

<?= $this->section('javascript') ?>
<!-- <script src="<?= base_url('adminLTE/plugins/jsgrid/demos/db.js'); ?>"></script> -->
<script src="<?= base_url('adminLTE/plugins/jsgrid/jsgrid.min.js'); ?>"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?= base_url('js/jsgrid-config.js'); ?>"></script>
<script src="<?= base_url('adminLTE/plugins/sweetalert2/sweetalert2.all.min.js'); ?>"></script>
<script>
  function showNotification(message) {
    Swal.fire({
      title: 'Success',
      text: message,
      icon: 'success',
      confirmButtonText: 'OK'
    });
  }

  function refreshAndSortGrid() {
    // Refresh the grid
    $("#jsGrid1").jsGrid("loadData");

    // Sort the grid based on a certain column
    let sortingField = "tanggal"; // Replace with the actual column name
    let sortingOrder = "desc"; // or "desc" for descending order
    $("#jsGrid1").jsGrid("sort", sortingField, sortingOrder);
  }

  function initializeJSGrid(uniqueValues1, uniqueValues2) {
    // $(function() {
    $("#jsGrid1").jsGrid({
      height: "400px",
      width: "100%",
      // filtering: true,
      inserting: true,
      editing: true,
      sorting: true,
      paging: true,
      autoload: true,
      pageSize: 10,
      pageButtonCount: 5,
      deleteConfirm: "Apakah anda yakin ingin menghapus data?",
      noDataContent: "Mohon maaf, data tidak ditemukan",
      pagerFormat: "Halaman: {first} {prev} {pages} {next} {last}    {pageIndex} dari {pageCount}",
      pagePrevText: "Sebelumnya",
      pageNextText: "Selanjutnya",
      pageFirstText: "Pertama",
      pageLastText: "Terakhir",

      editButtonTooltip: "Edit", // tooltip of edit item button
      deleteButtonTooltip: "Delete", // tooltip of delete item button
      searchButtonTooltip: "Search", // tooltip of search button
      insertButtonTooltip: "Insert", // tooltip of insert button
      updateButtonTooltip: "Update", // tooltip of update item button
      cancelEditButtonTooltip: "Cancel edit", // tooltip of cancel editing button

      controller: {
        loadData: function(filter) {
          return $.ajax({
            type: "GET",
            url: "/AsetBangunanAPI",
            data: filter,
          });
        },
        insertItem: function(item) {
          return $.ajax({
            type: "POST",
            url: "/AsetBangunanAPI",
            data: JSON.stringify(item),
            contentType: "application/json; charset=utf-8",
            dataType: "json",
          });
        },
        updateItem: function(item) {
          return $.ajax({
            type: "PUT",
            url: "/AsetBangunanAPI/1",
            data: JSON.stringify(item),
            contentType: "application/json; charset=utf-8",
            dataType: "json",
          });
        },
        deleteItem: function(item) {
          return $.ajax({
            type: "DELETE",
            url: "/AsetBangunanAPI/1",
            data: JSON.stringify(item),
            contentType: "application/json; charset=utf-8",
            dataType: "json",
          });
        }
      },
      fields: [{
          name: "koderuang",
          title: "Kode",
          type: {
            "readonly": true
          },
          width: 75,
          validate: [
            "required",
            {
              validator: "maxLength",
              param: 5
            },
          ]
        },
        {
          name: "namaruang",
          title: "Nama",
          type: "text",
          width: 100,
          validate: "required"
        },
        {
          name: "pruang",
          title: "P(M)",
          type: "text",
          width: 100,
          validate: [
            "required",

            function(value, item) {
              return /^[0-9]+(\,[0-9]+)?$/.test(value);
            }
          ]
        },
        {
          name: "lruang",
          title: "L(M)",
          type: "text",
          width: 100,
          validate: [
            "required",
            function(value, item) {
              return /^[0-9]+(\,[0-9]+)?$/.test(value);
            }
          ]
        },
        {
          name: "truang",
          title: "T(M)",
          type: "text",
          width: 100,
          validate: [
            "required",
            function(value, item) {
              return /^[0-9]+(\,[0-9]+)?$/.test(value);
            }
          ]
        },

        {
          filtering: false,
          validate: "required",
          name: "dinding",
          title: "Dinding",
          type: "select",
          width: 100,
          items: [{
              Name: "Baik",
              Id: "Baik"
            },
            {
              Name: "Rusak",
              Id: "Rusak"
            },
            {
              Name: "Rusak Sedang",
              Id: "Rusak Sedang"
            },
            {
              Name: "Rusak Parah",
              Id: "Rusak Parah"
            },
          ],
          valueField: "Id",
          textField: "Name",
          selectedIndex: 0,
          editTemplate: function() {
            let $select = jsGrid.fields.select.prototype.editTemplate.apply(this, arguments);
            $select.find("option[value='Baik']")
            $select.find("option[value='Rusak']")
            $select.find("option[value='Rusak Sedang']")
            $select.find("option[value='Rusak Parah']")
            return $select;
          }

        },

        {
          filtering: false,
          validate: "required",
          name: "jendela",
          title: "Jendela",
          type: "select",
          width: 100,
          items: [{
              Name: "Baik",
              Id: "Baik"
            },
            {
              Name: "Rusak",
              Id: "Rusak"
            },
            {
              Name: "Rusak Sedang",
              Id: "Rusak Sedang"
            },
            {
              Name: "Rusak Parah",
              Id: "Rusak Parah"
            },
          ],
          valueField: "Id",
          textField: "Name",
          selectedIndex: 0,
          editTemplate: function() {
            let $select = jsGrid.fields.select.prototype.editTemplate.apply(this, arguments);
            $select.find("option[value='Baik']")
            $select.find("option[value='Rusak']")
            $select.find("option[value='Rusak Sedang']")
            $select.find("option[value='Rusak Parah']")
            return $select;
          }

        },

        {
          filtering: false,
          validate: "required",
          name: "lantai",
          title: "Lantai",
          type: "select",
          width: 100,
          items: [{
              Name: "Baik",
              Id: "Baik"
            },
            {
              Name: "Rusak",
              Id: "Rusak"
            },
            {
              Name: "Rusak Sedang",
              Id: "Rusak Sedang"
            },
            {
              Name: "Rusak Parah",
              Id: "Rusak Parah"
            },
          ],
          valueField: "Id",
          textField: "Name",
          selectedIndex: 0,
          editTemplate: function() {
            let $select = jsGrid.fields.select.prototype.editTemplate.apply(this, arguments);
            $select.find("option[value='Baik']")
            $select.find("option[value='Rusak']")
            $select.find("option[value='Rusak Sedang']")
            $select.find("option[value='Rusak Parah']")
            return $select;
          }

        },

        {
          filtering: false,
          validate: "required",
          name: "atap",
          title: "Atap",
          type: "select",
          width: 100,
          items: [{
              Name: "Baik",
              Id: "Baik"
            },
            {
              Name: "Rusak",
              Id: "Rusak"
            },
            {
              Name: "Rusak Sedang",
              Id: "Rusak Sedang"
            },
            {
              Name: "Rusak Parah",
              Id: "Rusak Parah"
            },
          ],
          valueField: "Id",
          textField: "Name",
          selectedIndex: 0,
          editTemplate: function() {
            let $select = jsGrid.fields.select.prototype.editTemplate.apply(this, arguments);
            $select.find("option[value='Baik']")
            $select.find("option[value='Rusak']")
            $select.find("option[value='Rusak Sedang']")
            $select.find("option[value='Rusak Parah']")
            return $select;
          }

        },



        {
          name: "keterangan",
          title: "Keterangan",
          type: "textarea",
          width: 100,
          filtering: false
        },
        {
          validate: "required",
          name: "tanggal",
          title: "Tanggal",
          type: "date",
          width: 100,
          filtering: false,

        },
        {
          type: "control"
        }
      ],
      onError: function(args) {
        Swal.fire({
          title: 'Error',
          text: 'Mohon maaf terjadi kesalahan',
          icon: 'error',
          confirmButtonText: 'OK'
        });
      },
      onItemUpdated: function(args) {
        // args.item contains the updated item
        showNotification('Data sudah di Update');
        refreshAndSortGrid();
      },
      onItemDeleted: function(args) {
        // args.item contains the deleted item
        showNotification('Data sudah di hapus');
        refreshAndSortGrid();
      },
      onItemInserted: function(args) {
        // args.item contains the inserted item
        showNotification('Data sudah ditambahkan');
        refreshAndSortGrid();
      }
    });
    // });
  }
  initializeJSGrid()
  let debounceTimer;

  $("#general-search").on("input", function() {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(function() {
      let searchTerm = $("#general-search").val();
      $("#jsGrid1").jsGrid("loadData", {
        search: searchTerm
      }).done(function() {
        console.log("filtering completed");
      });;
    }, 300); // Adjust the debounce time as needed
  });
</script>
<?= $this->endSection(); ?>
<!-- jsGrid -->