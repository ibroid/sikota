<div class="row">
  <div class="col-md-6">
    <table class="table">
      <tr>
        <th>Penggugat</th>
      </tr>
      <?php foreach ($data['pihak1'] as $p1) { ?>
        <tr>
          <td>
            <a href="javascript:void(0)" data-dismiss="modal" data-alamat="<?= $p1->alamat ?>" data-pekerjaan="<?= $p1->pekerjaan ?>" data-pendidikan="<?= $p1->pendidikan ?>" data-agama="<?= $p1->agama ?>" data-tempatLahir="<?= $p1->tempat_lahir ?>" data-tanggalLahir="<?= $p1->tanggal_lahir ?>" data-status="Pe" class="pihak"> <?= $p1->nama; ?> </a>
          </td>
        </tr>
      <?php } ?>
    </table>
  </div>
  <div class="col-md-6">
    <table class="table">
      <tr>
        <th>Tergugat</th>
      </tr>
      <?php foreach ($data['pihak2'] as $p2) { ?>
        <tr>
          <td>
            <a href="javascript:void(0)" data-dismiss="modal" data-alamat="<?= $p2->alamat ?>" data-pekerjaan="<?= $p2->pekerjaan ?>" data-pendidikan="<?= $p2->pendidikan ?>" data-agama="<?= $p2->agama ?>" data-tempatLahir="<?= $p2->tempat_lahir ?>" data-tanggalLahir="<?= $p2->tanggal_lahir ?>" data-status="Ter" class="pihak"> <?= $p2->nama; ?></a>
          </td>
        </tr>
      <?php } ?>
    </table>
  </div>
</div>
<hr>
<div class="row">
  <div class="col-md-6">
    <table class="table">
      <tr>
        <th>Pengacara Penggugat</th>
      </tr>
      <?php foreach ($data['pengacara1'] as $c1) { ?>
        <tr>
          <td>
            <a href="javascript:void(0)" data-dismiss="modal" data-alamat="<?= $c1->alamat ?>" data-pekerjaan="<?= $c1->pekerjaan ?>" data-pendidikan="<?= $c1->pendidikan ?>" data-agama="<?= $c1->agama ?>" data-tempatLahir="<?= $c1->tempat_lahir ?>" data-tanggalLahir="<?= $c1->tanggal_lahir ?>" data-status="Kuasa Hukum Pe" class="pihak"> <?= $c1->nama; ?></a>
          </td>
        </tr>
      <?php } ?>
    </table>
  </div>
  <div class="col-md-6">
    <table class="table">
      <tr>
        <th>Pengacara Tergugat</th>
      </tr>
      <?php foreach ($data['pengacara2'] as $c2) { ?>
        <tr>
          <td>
            <a href="javascript:void(0)" data-dismiss="modal" data-alamat="<?= $c2->alamat ?>" data-pekerjaan="<?= $c2->pekerjaan ?>" data-pendidikan="<?= $c2->pendidikan ?>" data-agama="<?= $c2->agama ?>" data-tempatLahir="<?= $c2->tempat_lahir ?>" data-tanggalLahir="<?= $c2->tanggal_lahir ?>" data-status="Kuasa Hukum Ter" class="pihak"> <?= $c1->nama; ?></a>
          </td>
        </tr>
      <?php } ?>
    </table>
  </div>
</div>