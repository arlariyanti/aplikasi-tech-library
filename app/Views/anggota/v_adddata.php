<div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
      
                <div class="card-body">
                <?php 
      //notifikasi
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

              
             <?php 
             echo form_open_multipart('useranggota/SimpanData');
             ?>
              <div class="row">
             <div class="col-sm-2">
             <div class="row">
              <div class="col-sm-12">
              <div class="form-group">
              <label>Foto</label>
                <img src="<?= base_url('foto/blankfoto.jpg')?>" id="gambar_load" class="img-fluid" width="200px" height="200px">
              </div>
             </div>
             <div class="col-sm-12">
                  <div class="form-group">
                    <label >Pilih Foto</label>
                        <input type="file" name="foto" class="form-control" id="preview_gambar" accept="image/*">
                </div>
                </div>
             </div>
             </div>
             <div class="col-sm-10">
                    <div class="row">
                    <div class="col-sm-6">
                  <div class="form-group">
                    <label>Username</label>
                    <input class="form-control" name="username" value="<?= old('username')?>"placeholder="Username">
                  </div>
                  </div>

                  <div class="col-sm-6">
                  <div class="form-group">
                    <label>Password</label>
                    <input class="form-control" name="password" value="<?= old('password')?>" placeholder="Password">
                  </div>
                  </div>


                  <div class="col-sm-6">
                  <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" name="email" value="<?= old('email')?>" placeholder="Email">
                  </div>
                  </div>

                  <div class="col-sm-6">
                  <div class="form-group">
                    <label>Alamat</label>
                    <input class="form-control" name="alamat" value="<?= old('alamat')?>" placeholder="Alamat">
                  </div>
                  </div>

                  <div class="col-sm-12">
                  <div class="form-group">
                    <label>No Telepon</label>
                    <input class="form-control" name="nomer_telpon" value="<?= old('nomer_telpon')?>" placeholder="No Telepon">
                  </div>
                  </div>


                </div>
            </div>
            </div>
            </div>
<!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                  <a href="<?= base_url('useranggota')?>" class="btn btn-warning"><i class="fas fa-share"></i>Kembali</a>
                </div>
            <?php echo form_close() ?>
            </div>
            </div>