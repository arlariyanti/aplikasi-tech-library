<div class="col-sm-12">
<?php 
          if ($useranggota['verifikasi']== 1 ){ ?>
           <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-check"></i> Akun Anda Sudah Terverifikasi !</h5>
                </div>
            
         <?php } else { ?>
            <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-times"></i> Akun Anda Belun Terverifikasi !</h5>
                  Silahkan Hubungi Petugas Perpustakaan Untuk Verifikasi Data !
                </div>
         <?php } ?>
         
</div>



<div class="col-md-9">
     <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Data <?= $judul ?></h3>
            <div class="card-tools">
               
            </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th width="150px">Username</th>
                        <th width="50px">:</th>
                        <td><?= $useranggota['username']?></td>
                    </tr>
                    <tr>
                        <th>Email </th>
                        <th>:</th>
                        <td><?= $useranggota['email']?></td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <th>:</th>
                        <td><?= $useranggota['alamat']?></td>
                    </tr>
                    <tr>
                        <th>No Telepon</th>
                        <th>:</th>
                        <td><?= $useranggota['nomer_telpon']?></td>
                    </tr>
                   
                </table>
</div>
</div>
</div>
