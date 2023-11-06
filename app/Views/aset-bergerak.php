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
<script src="<?= base_url('js/jsgrid-config.js'); ?>"></script>
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

  // Assuming you have an asynchronous function to fetch the values
  async function fetchUniqueValues() {
    try {
      // Use the correct URL for fetching unique values
      let response = await $.ajax({
        type: "GET",
        url: "/aset-bergerak/distinct/lokasi",
      });

      let response2 = await $.ajax({
        type: "GET",
        url: "/aset-bergerak/distinct/unit",
      });

      initializeJSGrid(response, response2);
    } catch (error) {
      console.error("Error fetching unique values:", error);
    }
  }

  // Call the function to fetch unique values
  fetchUniqueValues();

  function initializeJSGrid(uniqueValues1, uniqueValues2) {
    // $(function() {
    let lokasiUnique = uniqueValues1.map(name => {
      return {
        Name: name,
        Id: name
      };
    })

    let unitUnique = uniqueValues2.map(name => {
      return {
        Name: name,
        Id: name
      };
    })
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
            url: "/AsetBergerakAPI",
            data: filter,
          });
        },
        insertItem: function(item) {
          return $.ajax({
            type: "POST",
            url: "/AsetBergerakAPI",
            data: JSON.stringify(item),
            contentType: "application/json; charset=utf-8",
            dataType: "json",
          });
        },
        updateItem: function(item) {
          return $.ajax({
            type: "PUT",
            url: "/AsetBergerakAPI/1",
            data: JSON.stringify(item),
            contentType: "application/json; charset=utf-8",
            dataType: "json",
          });
        },
        deleteItem: function(item) {
          return $.ajax({
            type: "DELETE",
            url: "/AsetBergerakAPI/1",
            data: JSON.stringify(item),
            contentType: "application/json; charset=utf-8",
            dataType: "json",
          });
        }
      },
      fields: [{
          name: "kodebarang",
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
          name: "namabarang",
          title: "Nama",
          type: "text",
          width: 100,
          validate: "required"
        },
        {
          name: "statusbarang",
          title: "Status Barang",
          type: "select",
          width: 75,
          filtering: false,
          validate: "required",
          items: [{
              Name: "Masuk",
              Id: "Masuk"
            },
            {
              Name: "Keluar",
              Id: "Keluar"
            }
          ],
          valueField: "Id",
          textField: "Name",
          selectedIndex: 0,
          editTemplate: function() {
            let $select = jsGrid.fields.select.prototype.editTemplate.apply(this, arguments);
            $select.find("option[value='Masuk']")
            $select.find("option[value='Keluar']")
            return $select;
          }

        },
        {
          name: "unit",
          title: "Unit",
          type: "select",
          items: unitUnique,
          editTemplate: function() {
            let $select = jsGrid.fields.select.prototype.editTemplate.apply(this, arguments);
            let filteredValues = uniqueValues2;

            // Filter options based on the array
            $select.find("option").filter(function() {
              return filteredValues.indexOf($(this).text()) === -1;
            }).remove();
            return $select;
          },
          valueField: "Id",
          textField: "Name",
          width: 100,
          filtering: false,
          validate: "required"
        },

        {
          name: "lokasi",
          title: "Lokasi",
          type: "select",
          items: lokasiUnique,
          editTemplate: function() {
            let $select = jsGrid.fields.select.prototype.editTemplate.apply(this, arguments);
            let filteredValues = uniqueValues1;

            // Filter options based on the array
            $select.find("option").filter(function() {
              return filteredValues.indexOf($(this).text()) === -1;
            }).remove();
            return $select;

          },
          valueField: "Id",
          textField: "Name",
          width: 100,
          filtering: false,
          validate: "required"
        },
        {
          filtering: false,
          validate: "required",
          name: "ketersediaan",
          title: "Ketersediaan",
          type: "number",
          width: 100,
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