<div id="content">
  <?= $this->load->view('panel')->output->final_output; ?>
  <div class="col-md-12 padding-0">
    <div class="col-md-12">
      <div class="panel">
        <div class="panel-heading">
          <h3 class="text-primary">CETAK LAPORAN SURAT</h3>
        </div>

        <div class="panel-body">
          <div class="row">
            <div class="form-group">
              <label class="col-sm-2 control-label text-right">Pilih Jenis Laporan</label>
                <div class="col-sm-6">
                    <select name="jenis_delegasi_text" class="info form-control">
                      <option>Laporan Surat Masuk</option>
                      <option>Laporan Surat Keluar</option>
                    </select>
                </div>
            </div>
          </div>
              <br>
          <div class="row">
            <div class="form-group">
              <label class="col-sm-2 control-label text-right">Pilih Bulan Laporan</label>
                <div class="col-sm-3">
                    <input type="date" class="info form-control mb-4 mr-sm-4" name="tgl_awal">
                </div>
                <div class="col-sm-3">
                    <button class="btn btn-success  btn pull-right"><i class="fa fa-print"></i>  Cetak Laporan</button>
                </div>
            </div>
          </div>
<br>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="ModalCetakLaporanSuratMasuk" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Cetak Laporan Surat Masuk</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <label for="bulan">Jenis Surat</label>
              <select class="form-control" required name="jenis_surat" id="sell">
                <option>Surat Umum</option>
                <option>Bantuan Delegasi</option>
                <option>Jawaban Delegasi</option>
              </select>
            </div>
            
            <div class="row">
              <div class="col-md-6">
                <label for="" class="mr-sm-4">Tgl Surat:</label>
                <input type="Month" class="form-control mb-4 mr-sm-4" name="tgl_surat">
              </div>
              <div class="col-md-6">
                <label for="pwd" class="mr-sm-4">Tgl Catat:</label>
                <input type="date" class="form-control mb-4 mr-sm-4" name="tgl_catat">
              </div>
            </div>

            <br>
              <div class="text-right">
                <button type="submit" class="btn ripple-infinite btn-raised btn-success">Simpan</button>
              </div>
          </form>

        </div>
        <br>

      </div>

    </div>
  </div>


</div>