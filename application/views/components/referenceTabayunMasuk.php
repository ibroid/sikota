<table class="table table-bordered table-hover" id="tblRef">
  <thead>
    <tr>
      <th>Pengadilan Asal</th>
      <th>Nomor Perkara <br> Jenis Delegasi</th>
      <th>Pihak</th>
      <th>Biaya</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $d) { ?>
      <tr onclick="setFieldWesel('<?= $d->pn_asal_text; ?>','<?= $d->nomor_perkara ?>','<?= $d->jenis_delegasi_text; ?>', '<?= $d->pihak ?>' ,'<?= $d->biaya ?>','<?= $d->id ?>' )">
        <td><?= $d->pn_asal_text; ?></td>
        <td><?= $d->nomor_perkara . '<br>' . $d->jenis_delegasi_text; ?></td>
        <td><strong><?= $d->pihak . '</strong><br>' . $d->status_pihak ?></td>
        <td><?= buatrp($d->biaya) ?></td>
      </tr>
    <?php } ?>
  </tbody>
</table>