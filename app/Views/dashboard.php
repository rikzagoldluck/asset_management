<?= $this->extend('default') ?>
<?= $this->section('page_title'); ?>
<?= $title; ?>
<?= $this->endSection(); ?>

<?= $this->section('context'); ?>
<?= $title; ?>
<?= $this->endSection(); ?>
<!-- Default box -->
<?= $this->section('content') ?>
<div class="container-fluid">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-lg-4 col-6">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h3><?= $today_out; ?></h3>

          <p>Transaction OUT Today</p>
        </div>
        <div class="icon">
          <i class="fas fa-cart-arrow-down"></i>
        </div>
        <a data-toggle="modal" data-target="#modal-transaksi-keluar-today" class="small-box-footer">More Detail<i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <!-- <h3>53<sup style="font-size: 20px">%</sup></h3> -->
          <h3><?= $today_in; ?></h3>

          <p>Transaction IN Today</p>
        </div>
        <div class="icon">
          <i class="fas fa-cart-plus"></i>
        </div>
        <a data-toggle="modal" data-target="#modal-transaksi-masuk-today" class="small-box-footer">More Detail <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-12">
      <div class="small-box bg-warning">
        <div class="inner">
          <h3><?= $stok_0; ?></h3>

          <p>Asset With ZERO Stock</p>
        </div>
        <div class="icon">
          <i class="fab fa-creative-commons-zero"></i>
        </div>
        <a data-toggle="modal" data-target="#modal-stok-0" class="small-box-footer">More Detail<i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <!-- <div class="col-lg-3 col-6">
      <div class="small-box bg-danger">
        <div class="inner">
          <h3>65</h3>

          <p>Unique Visitors</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="#" class="small-box-footer">More Detail<i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div> -->
    <!-- ./col -->
  </div>

  <div class="row">
    <div class="col-12">

      <!-- DIRECT CHAT -->
      <div class="card direct-chat direct-chat-primary collapsed-card">
        <div class="card-header">
          <h3 class="card-title">Stock Movement</h3>

          <div class="card-tools">

            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-plus"></i>
            </button>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-3">

          <div id="weekly-stock-moves-container" class="w-90" style="height: 400px;"></div>
        </div>

        <!-- /.card-footer-->
      </div>
      <!--/.direct-chat -->
    </div>
  </div>

  <div class="row">
    <div class="col-12 col-md-6"> <!-- Top Less Stock -->
      <div class="card bg-gradient-danger collapsed-card">
        <div class="card-header border-0">
          <h3 class="card-title">
            <!-- <i class="fas fa-signal mr-1"></i> -->
            <i class="fas fa-battery-quarter mr-1"></i>
            Top 10 Less Stock
          </h3>
          <!-- card tools -->
          <div class="card-tools">

            <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-plus"></i>
            </button>
          </div>
          <!-- /.card-tools -->
        </div>
        <div class="card-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>Code</th>
                <th>Asset</th>
                <th>Location</th>
                <th>Stock</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; ?> <?php foreach ($top_less_stock as $produk) : ?>
                <tr>
                  <td><?= $i; ?></td>
                  <td><?= $produk['kodebarang']; ?></td>
                  <td><?= $produk['namabarang']; ?></td>
                  <td>
                    <?= $produk['namaruang']; ?>
                  </td>
                  <td><span class="badge bg-warning"> <?= $produk['ketersediaan'] . ' ' . $produk['unit']; ?></span> </td>
                </tr>
                <?php $i++; ?>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <!-- /.card-body-->

      </div>
      <!-- /.card -->
    </div>
    <div class="col-12 col-md-6"> <!-- Top Most Stock -->
      <div class="card bg-gradient-lime collapsed-card">
        <div class="card-header border-0">
          <h3 class="card-title">
            <i class="fas fa-battery-full mr-1"></i>
            Top 10 Most Stock
          </h3>
          <!-- card tools -->
          <div class="card-tools">

            <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-plus"></i>
            </button>
          </div>
          <!-- /.card-tools -->
        </div>
        <div class="card-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>Code</th>
                <th>Asset</th>
                <th>Location</th>
                <th>Stock</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; ?>
              <?php foreach ($top_most_stock as $produk) : ?>
                <tr>
                  <td><?= $i; ?></td>
                  <td><?= $produk['kodebarang']; ?></td>
                  <td><?= $produk['namabarang']; ?></td>
                  <td>
                    <?= $produk['namaruang']; ?>
                  </td>
                  <td> <span class="badge bg-primary"> <?= $produk['ketersediaan'] . ' ' . $produk['unit']; ?></span> </td>
                </tr>
                <?php $i++; ?>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <!-- /.card-body-->

      </div>
      <!-- /.card -->
    </div>
    <div class="col-12 col-md-6"> <!-- Top Product Transaction -->
      <div class="card bg-gradient-indigo collapsed-card ">
        <div class="card-header border-0">
          <h3 class="card-title">
            <i class="fas fa-map-marker-alt mr-1"></i>
            Top 10 Most Transaction by Product
          </h3>

          <div class="card-tools">
            <button type="button" class="btn bg-primary btn-sm" data-card-widget="collapse">
              <i class="fas fa-plus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>Code</th>
                <th>Asset</th>
                <th>Location</th>
                <th>Transaction</th>

              </tr>
            </thead>
            <tbody>
              <?php $i = 1; ?>
              <?php foreach ($most_transaction_by_product as $aset) : ?>
                <tr>
                  <td><?= $i; ?></td>
                  <td><?= $aset['kode']; ?></td>
                  <td>
                    <?= $aset['namabarang']; ?>
                  </td>
                  <td><?= $aset['namaruang']; ?></td>
                  <td><span class="badge bg-pink">
                      <?= $aset['transaction_count']; ?> Time(s)</span>
                  </td>
                </tr>

                <?php $i++; ?>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->

        <!-- /.card-footer -->
      </div>
      <!-- /.card -->
    </div>
    <div class="col-12 col-md-6"> <!-- Top Location Transaction -->
      <div class="card bg-gradient-orange collapsed-card">
        <div class="card-header border-0">
          <h3 class="card-title">
            <i class="fas fa-map-marker-alt mr-1"></i>
            Top 10 Most Transaction by Location
          </h3>

          <div class="card-tools">
            <button type="button" class="btn bg-primary btn-sm" data-card-widget="collapse">
              <i class="fas fa-plus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>Code</th>
                <th>Asset</th>
                <th>Location</th>
                <th>Transaction</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; ?>
              <?php foreach ($most_transaction_by_location as $aset) : ?>
                <tr>
                  <td><?= $i; ?></td>
                  <td><?= $aset['kode']; ?></td>
                  <td>
                    <?= $aset['namabarang']; ?>
                  </td>
                  <td><?= $aset['namaruang']; ?></td>
                  <td><span class="badge bg-lime">
                      <?= $aset['transaction_count']; ?> Time(s)</span>
                  </td>
                </tr>

                <?php $i++; ?>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->

        <!-- /.card-footer -->
      </div>
      <!-- /.card -->
    </div>
  </div>
  <!-- /.row -->
  <!-- Main row -->

  <!-- /.row (main row) -->
</div><!-- /.container-fluid -->
<!-- /.card -->

<div class="modal fade" id="modal-stok-0">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Asset With ZERO Stock</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>Code</th>
              <th>Asset</th>
              <th>Location</th>
              <th>Recent S0</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            <?php foreach ($stok_0_all as $aset) : ?>
              <tr>
                <td><?= $i; ?></td>
                <td><?= $aset['kodebarang']; ?></td>
                <td>
                  <?= $aset['namabarang']; ?>
                </td>
                <td><span class="badge bg-danger"><?= $aset['namaruang']; ?></span></td>
                <td><?= $aset['tanggal']; ?></td>
              </tr>

              <?php $i++; ?>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-transaksi-masuk-today">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Asset Transaction IN Today</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>Code</th>
              <th>Asset</th>
              <th>Location</th>
              <th>Status</th>
              <th>Amount</th>
              <th>Stock</th>
              <th>PIC</th>
              <th>Donor</th>
              <th>Remarks</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            <?php foreach ($today_in_all as $aset) : ?>
              <tr>
                <td><?= $i; ?></td>
                <td><?= $aset['kodebarang']; ?></td>
                <td>
                  <?= $aset['namabarang']; ?>
                </td>
                <td><?= $aset['namaruang']; ?></td>
                <td><span class="badge bg-<?= $aset['statusbarang'] == 'Masuk' ? 'success' : 'danger' ?>"><?= $aset['statusbarang']; ?></td>
                <td><?= $aset['jumlah']; ?></td>
                <td><?= $aset['ketersediaan'] . ' ' . $aset['unit']; ?></td>
                <td><?= $aset['pic']; ?></td>
                <td><?= $aset['dari']; ?></td>
                <td><?= $aset['keterangan']; ?></td>
              </tr>

              <?php $i++; ?>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-transaksi-keluar-today">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Asset Transaction OUT Today</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>Code</th>
              <th>Asset</th>
              <th>Location</th>
              <th>Status</th>
              <th>Amount</th>
              <th>Stock</th>
              <th>PIC</th>
              <th>Receiver</th>
              <th>Remarks</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            <?php foreach ($today_out_all as $aset) : ?>
              <tr>
                <td><?= $i; ?></td>
                <td><?= $aset['kodebarang']; ?></td>
                <td>
                  <?= $aset['namabarang']; ?>
                </td>
                <td><?= $aset['namaruang']; ?></td>
                <td><span class="badge bg-<?= $aset['statusbarang'] == 'Masuk' ? 'success' : 'danger' ?>"><?= $aset['statusbarang']; ?></td>
                <td><?= $aset['jumlah']; ?></td>
                <td> <?= $aset['ketersediaan'] . ' ' . $aset['unit']; ?></td>
                <td><?= $aset['pic']; ?></td>
                <td><?= $aset['tujuan']; ?></td>
                <td><?= $aset['keterangan']; ?></td>
              </tr>

              <?php $i++; ?>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?= $this->endSection() ?>

<?= $this->section('javascript'); ?>
<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
<script src="https://code.highcharts.com/stock/modules/export-data.js"></script>
<script src="https://code.highcharts.com/stock/modules/accessibility.js"></script>

<script>
  (async () => {

    const data = await fetch(
      "<?= base_url('weeklyStockData'); ?>"
    ).then(response => response.json());

    // Create the chart
    Highcharts.stockChart('weekly-stock-moves-container', {
      rangeSelector: {
        selected: 1
      },

      title: {
        text: 'Milestone Stock Inventory'
      },

      series: [{
        name: 'Stock',
        data: data,
        tooltip: {
          valueDecimals: 0
        }
      }]
    });
  })();
</script>
<?= $this->endSection(); ?>