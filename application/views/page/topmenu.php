<div class="panel">
  <div class="panel-body padding-0">
    <div class="col-md-12 col-sm-12">
      <h3 class="animated fadeInLeft">Surat Umum</h3>
      <p class="animated fadeInDown"><span class="fa  fa-map-marker"></span> Jakarta,Indonesia</p>

      <ul class="nav navbar-nav">
        <?php foreach ($sub_menu as $sb) { ?>
          <li><a href="<?= base_url() . $sb->link_sub ?>"><?= $sb->nama_sub ?></a></li>
        <?php } ?>
      </ul>
    </div>
    <!-- cuaca -->
  </div>
</div>