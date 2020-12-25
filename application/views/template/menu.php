<!-- start:Left Menu -->
<div id="left-menu">
  <div class="sub-left-menu scroll">
    <ul class="nav nav-list">
      <li>
        <div class="left-bg"></div>
      </li>
      <li class="time">
        <h1 class="animated fadeInLeft"><?= date('H:i') ?></h1>
        <p class="animated fadeInRight"><?= date('d, D F Y') ?></p>
      </li>
      <?php foreach ($this->menu->menu() as $m) : ?>
        <li class="ripple"><a href="<?= base_url() . $m->link_menu ?>"><span class="icons <?= $m->logo_menu ?>"></span><?= $m->nama_menu ?></a></li>
      <?php endforeach; ?>

    </ul>
  </div>
</div>
<!-- end: Left Menu -->