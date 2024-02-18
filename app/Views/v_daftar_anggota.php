<div class="login-box">
<!-- /.login-logo -->
  <div class="card card-outline card-primary"> 
    <div class="card-header text-center">
  </div>

  <div class="card-body">
  <?php 
      //notifikasi validasi
      $errors = session()->getFlashdata('errors');
      if (!empty($errors)) { ?> 
         <div class="alert alert-danger" role="alert">
              <h4>Periksa Entry Form</h4>
              <ul> 
                  <?php  foreach ($errors as $key => $errors) { ?>
                      <li><?= esc($errors) ?></li> 
                  <?php } ?> 
              </ul> 
         </div>
      <?php } ?>

      <?php 
             if (session()->getFlashdata('pesan')) {
             echo '<div class="alert alert-success alert-dismissible">
             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
             <h5><i class="icon fas fa-check"></i>';
            echo session()->getFlashdata('pesan');
             echo '</h5></div>';
             }
      ?>

     <?php echo form_open('Auth/Daftar')?>
     <div class="form-group">
          <input class="form-control" name="username" value="<?= old('username')?>" placeholder="Username">
        </div>

        <div class="form-group">
          <input type="password" class="form-control" name="password" value="<?= old('password')?>" placeholder="Password">
        </div>

        <div class="form-group">  
          <input type="password"class="form-control" name="ulangi_password" value="<?= old('ulangi_password')?>" placeholder="Ulangi Password">
        </div>

        <div class="form-group">
          <input type="email"class="form-control" name="email" value="<?= old('email')?>" placeholder="Email">
        </div>

        <div class="form-group">
          <input type="alamat" class="form-control" name="alamat" value="<?= old('alamat')?>" placeholder="Alamat">
        </div>

        <div class="form-group">  
          <input type="nomer_telpon" class="form-control" name="nomer_telpon" value="<?= old('nomer_telpon')?>" placeholder="No Telepon">
        </div>

      

        <div class="row">
          <div class="col-sm-6">
              <a class="btn btn-success btn-block" href="<?= base_url('Auth/LoginAnggota') ?>">Kembali Login</a>   
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <button type="submit" class="btn btn-primary btn-block">Daftar</button>
          </div>
          <?php echo form_close()?>

    </div>
    </div>
    <!-- /.card-body -->
  </div>
  </div>
  </div>
  </div>
</div>