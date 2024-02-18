<div class="login-logo">
    <a href="<?= base_url() ?>"><b>Lara Digital</b></a>
    <br><h3><b>Perpustakaan-Digit</b></h3>
  </div>

<div class="row">
    <div class="login-box">
        <div class="col-lg-12 col-12">
            <div class="small-box bg-success">
        
              <div class="inner">
                <h3>User</h3>

                <p>Login Untuk User</p>
              </div>
              <div class="icon">
                <i class="fas fa fa-user"></i>
              </div>
              <a href="<?= base_url('Auth/LoginUser') ?>" class="small-box-footer">
                Login <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
        </div>
    </div>

    <div class="login-box">
        <div class="col-lg-12 col-12">
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>Anggota</h3>

                <p>Login Untuk Anggota</p>
              </div>
              <div class="icon">
                <i class="fas fa fa-users"></i>
              </div>
              <a href="<?= base_url('Auth/LoginAnggota') ?>" class="small-box-footer">
                Login <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
        </div>
    </div>
</div>