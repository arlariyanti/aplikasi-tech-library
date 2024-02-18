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
             echo form_open_multipart('Buku/UpdateData/'.$buku['id_buku']);
             ?>
                  <div class="row">
                <div class="col-sm-2">
                <div class="col-sm-12">
              <div class="form-group">
              <label>Cover</label>
                <img src="<?= base_url('cover/'.$buku['cover'])?>" id="gambar_load" class="img-fluid" width="200px" height="200px">
              </div>
             </div>
                <div class="col-sm-10">
                  <div class="form-group">
                    <label >Pilih Cover</label>
                        <input type="file" name="cover" class="form-control" id="preview_gambar" accept="image/*">
                </div>
                </div>
          </div>
                <div class="col-sm-10">

                 <div class="col-sm-3">
                 <div class="form-group">
                   <label>Kategori</label>
                   <div class="input-group">
                   <select name="id_kategori"  class="form-control">
                   <option value="">--Pilih Kategori--</option>
                   <?php foreach ($kategori as $key => $value) { ?>
                       <option value="<?= $value['id_kategori']?>"><?= $value['kategori']?></option>
                   <?php } ?>
                   </select>
                   <span class="input-group-append">
                   <a href="<?= base_url('Kategori')?>" class="btn btn-primary btn-flat">
                   <i class="fas fa-plus"></i>
               </a>
                 </span>
                 </div>
                 </div>
                 </div>

                 <div class="col-sm-12">
                 <div class="form-group">
                   <label>Judul Buku</label>
                   <input class="form-control" name="judul" value="<?= old('judul')?>" placeholder="Judul Buku">
                 </div>
                 </div>

                 <div class="col-sm-12">
                 <div class="form-group">
                   <label>Penulis</label>
                   <input class="form-control" name="penulis" value="<?= old('penulis')?>" placeholder="Penulis">
                 </div>
                 </div>

                 <div class="col-sm-3">
                 <div class="form-group">
                   <label>Penerbit</label>
                   <input class="form-control" name="penerbit" value="<?= old('penerbit')?>" placeholder="Penerbit">
                 </div>
                 </div>

                 <div class="col-sm-12">
                 <div class="form-group">
                   <label>Tahun Terbit</label>
                   <input class="form-control" name="tahun_terbit" value="<?= old('tahun_terbit')?>" placeholder="Tahun Terbit">
                 </div>
                 </div>

                 <div class="col-sm-12">
                 <div class="form-group">
                   <label>Deskripsi</label>
                   <input class="form-control" name="deskripsi" value="<?= old('deskripsi')?>" placeholder="Deskripsi">
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