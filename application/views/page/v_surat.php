
<div id="content">
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
          



    <div class="col-md-12">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-primary">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <h4 style="color:white;">List Surat Masuk</h4>
                    </a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                  <div class="panel-body">
                    <p>eusian didieu</p>
                  </div>
                </div>
            </div>
                      
            <div class="panel panel-success">
                <div class="panel-heading" role="tab" id="headingTwo">
                    <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <h4 style="color:white;">List Surat Keluar</h4>
                    </a>
                    </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                  <div class="panel-body">
                            <p>siian didieu</p>
                  </div>
                </div>
            </div>      
        </div>
    </div>
</div>

