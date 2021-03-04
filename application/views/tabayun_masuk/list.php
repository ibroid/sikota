<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/backend/css/plugins/datatables.bootstrap.min.css') ?>" />
<div id="content">

  
  <div class="col-md-12 padding-0">
    <div class="col-md-12">
      <?= Notifikasi::showFlash('notif'); ?>
      <div class="panel">
        <div class="panel-body">
          <div class="table-responsive">
            <h3 class="text-primary">
              List Data Tabayun Masuk
              <a href="#"><small class="text-danger text-muted">[Cek Data Baru]</small> </a>
            </h3>
            <table id="tableserverside" class="table table-responsive table table-hover table-bordered" style="width:100%">
              <thead>
                <tr class="text-white" style="background: #2196f3">
                  <th class="text-center">No</th>
                  <th class="text-center">Pemohon Bantuan</th>
                  <th class="text-center">Nomor Perkara <br> Jenis Delegasi <br> Tgl Sidang</th>
                  <th class="text-center">Nama & <br> Biodata Pihak</th>
                  <th class="text-center">No & <br> Tgl Surat </th>
                  <th class="text-center"><br>Biaya & <br> No.Resi</th>
                  <th class="text-center">JS/JSP Ditunjuk</th>
                  <th class="text-center">Pelaksanaan</th>
                  <!--<th class="text-center">Aksi</th>-->
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Penunjukan JS-->
<div class="modal fade" id="modalTunjukJS" role="dialog">
  <div class="modal-dialog text-center">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background: #2196f3">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-white text-center"><b>Edit Penunjukan Jurusita / JSP</b></h4>
      </div>
      <div class="modal-body">
        <br>
        <div class="row">
          <div class="form-group">
            <label class="col-sm-3 control-label text-right">Tgl Delegasi</label>
            <div class="col-sm-8">
              <input type="text" required autocomplete="off" name="tgl_delegasi" class="info form-control datepicker">
            </div>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="form-group">
            <label class="col-sm-3 control-label text-right">Tgl Penunjukan</label>
            <div class="col-sm-8">
              <input type="text" required autocomplete="off" name="tgl_penunjukan_jurusita" class="info form-control datepicker">
            </div>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="form-group">
            <label class="col-sm-3 control-label text-right">Jurusita/JSP</label>
            <div class="col-sm-8">
              <select required name="jenis_delegasi_text" class="info form-control">
                <?php foreach ($this->SIPP->jurusitaaktif('jurusita',) as $j) : ?><option><?= $j->nama_gelar; ?></option>
                <?php endforeach ?>
              </select>
            </div>
          </div>
        </div>
      </div>
      <br>

      <div class="modal-footer">
        <button class="btn btn-warning" type="button" data-dismiss="modal"><i class="fa fa-undo"></i> Cancel / Batal</button>
        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
      </div>
    </div>

  </div>
</div>


<!-- Modal Pelaksanaan Bantuan Tabayun-->
<div class="modal fade" id="modalPelaksanaan" role="dialog">
  <div class="modal-dialog text-center">

    <!-- Modal content-->
    <div class="modal-content modal-lg full">
      <div class="modal-header" style="background: #2196f3">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-white text-center"><b>Update Pelaksanaan Bantuan</b></h4>
      </div>
      <div class="modal-body">




        <br>
        <div class="row">
          <div class="form-group">
            <label class="col-sm-3 control-label text-right">Tgl Terima Berkas</label>
            <div class="col-sm-6">
              <input type="text" autocomplete="off" name="tgl_surat_diterimaa" class="info form-control datepicker">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group">
            <label class="col-sm-3 control-label text-right">No.Perkara</label>
            <div class="col-sm-6">
              <input type="text" autocomplete="off" name="nomor_relaas" class="info form-control">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group">
            <label class="col-sm-3 control-label text-right">Tgl Pelaksanaan</label>
            <div class="col-sm-6">
              <input type="text" autocomplete="off" name="tgl_pelaksanaan" class="info form-control datepicker">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group">
            <label class="col-sm-3 control-label text-right">Status Pelaksanaan</label>
            <div class="col-sm-6">
              <select name="status_delegasi" id="status_delegasi" class="info form-control">
                <option id="main-status" value="-1" selected>-- Pilih status pelaksanaan -- </option>
                <option value="1">Bertemu (ditandatangani)</option>
                <option value="2">Bertemu (tidak bersedia tanda tangan)</option>
                <option value="3" selected>Tidak Bertemu (Diterima oleh Lurah / Kepala Desa)</option>
                <option value="4">Tidak Bertemu (Alamat tidak ada)</option>
                <option value="9">Tidak Dapat Dilaksanakan</option>

              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group">
            <label class="col-sm-3 control-label text-right">Catatan Pelaksanaan</label>
            <div class="col-sm-6">
              <textarea rows="2" class="info form-control" id="catatan_proses" name="catatan_proses"></textarea>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group">
            <label class="col-sm-3 control-label text-right">Upload File</label>
            <div class="col-sm-6">
              <input type="file" class="info form-control" name="file">
            </div><!-- /.col-lg-6 -->
          </div>
        </div><!-- /.row -->
        <br>
        <div class="row">
          <div class="form-group">
            <label class="text-primary col-sm-4 control-label text-center">Pengiriman Kembali Hasil Tabayun</label>
          </div>
        </div><!-- /.row -->
        <div class="row">
          <div class="form-group">
            <label class="col-sm-3 control-label text-right">Tgl Surat Pengantar</label>
            <div class="col-sm-6">
              <input type="text" autocomplete="off" name="tgl_pengiriman_relaas" class="info form-control datepicker">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group">
            <label class="col-sm-3 control-label text-right">No Pengantar</label>
            <div class="col-sm-6">
              <input type="text" autocomplete="off" name="nomor_surat_pengantar_relaar" placeholder="Nomor Surat Pengiriman Relaas Asli" class="info form-control">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group">
            <label class="col-sm-3 control-label text-right">Tgl Resi Pengiriman</label>
            <div class="col-sm-6">
              <input type="text" autocomplete="off" name="p_tgl_resi" class="info form-control datepicker">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group">
            <label class="col-sm-3 control-label text-right">No Resi Pengiriman</label>
            <div class="col-sm-6">
              <input type="text" autocomplete="off" placeholder="No Resi" name='nomor_resi' class="info form-control">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group">
            <label class="col-sm-3 control-label text-right">Biaya Panggilan Riil</label>
            <div class="col-sm-6">
              <input type="text" autocomplete="off" placeholder="Biaya Riil" name='biaya' class="info form-control">
            </div>
          </div>
        </div>
      </div>
      <br>

      <div class="modal-footer">
        <button class="btn btn-warning" type="button" data-dismiss="modal"><i class="fa fa-undo"></i> Cancel / Batal</button>
        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
      </div>
    </div>

  </div>
</div>

<script src="<?php echo base_url('assets/backend/jquery/jquery-2.2.3.min.js') ?>"></script>
<script src="<?php echo base_url('assets/backend/datatables/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/backend/datatables/js/dataTables.bootstrap.min.js') ?>"></script>


<script type="text/javascript">
  var tableserverside;

  $(document).ready(function() {

    //datatables
    table = $('#tableserverside').DataTable({

      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      "order": [], //Initial no order.

      // Load data for the table's content from an Ajax source
      "ajax": {
        "url": "<?php echo site_url('ListTabayunMasuk/ajax_list') ?>",
        "type": "POST",
        "data": function(data) {
          data.pn_asal_text = $('#pn_asal_text').val();
          data.nomor_perkara = $('#nomor_perkara').val();
          data.jenis_delegasi_text = $('#jenis_delegasi_text').val();
          data.pihak = $('#pihak').val();
        }
      },

      //Set column definition initialisation properties.
      "columnDefs": [{
        "targets": [0], //first column / numbering column
        "orderable": false, //set not orderable
      }, ],

    });


  });
</script>