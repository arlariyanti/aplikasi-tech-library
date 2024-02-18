<div class="col-md-12">
            <div class="card card-outline card-primary">
              <div class="card-header">
                <h3 class="card-title">BUKU </h3>
                <div class="card-tools">
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <?php foreach ($buku as $key => $value) { ?>
                    <div class="col-sm-2">
                      <div class="text-center">
                      <div class="card-body box-profile">
                    <img class="profile-user-img img-fluid" src="<?= base_url('cover/'.$value['cover'])?>" width="150px" height="150px">
                    </div>
                    <a href="" ><?= $value['judul']?></a>
                    </div>
                    </div>
                    <?php } ?>
                    </div>
                </div>
              </div>
</div>