<?php $y = 1;

foreach ($data as $r) { ?>
  <tr data-dismiss="modal" onclick="selectRadius(<?= $r->nilai ?>)">
    <td><?= $y++; ?></td>
    <td><?= $r->kel; ?></td>
    <td><?= $r->kec; ?></td>
    <td><?= $r->nomor_radius; ?></td>
    <td><?= $r->nilai; ?></td>
  </tr>
<?php } ?>