<div class="col-md-12">
     <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Data <?= $judul ?></h3>

            <div class="card-tools">
                <a href="<?= base_url('useradmin/AddData')?>" class="btn btn-primary btn-flat btn-sm" >
                    <i class="fas fa-plus"></i> Add
                </a>
            </div>
            </div>
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

               <table class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th width="50px">No</th>
                        <th>Nama User</th>
                        <th>Email</th>
                        <th>No Handphone</th>
                        <th>Password</th>
                        <th>Level</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($useradmin as $key => $value) { ?>
                    <tr>
                        <td><?= $no++ ?>.</td>
                        <td><?= $value['nama_admin'] ?> </td>
                        <td><?= $value['email'] ?> </td>
                        <td><?= $value['no_hp'] ?> </td>
                        <td><?= $value['password'] ?> </td>
                        <td class="text-center"><?= $value['level']=='0' ? '<span class="badge badge-success">Admin</span>': '<span class="badge badge-primary">Petugas</span>'?></td>
                        <td>
                        <a href="<?= base_url('useradmin/EditData/'. $value['id_admin'])?>" class="btn btn-warning btn-flat btn-sm" >
                        <i class="fas fa-edit"></i>
                        </a>
                        <button type="button" class="btn btn-danger btn-flat btn-sm" data-toggle="modal" data-target="#modal-delete<?=$value['id_admin'] ?>" >
                        <i class="fas fa-trash"></i>
                        </button>
                        </td>
                    </tr>
                  <?php  } ?>
                </tbody>
                </table>
            </div>
    </div> 
</div>   

<!-- Modal Delete -->
<?php foreach ($useradmin as $key => $value) { ?>
<div class="modal fade" id="modal-delete<?=$value['id_admin'] ?>">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit <?= $judul ?></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <?php echo form_open(base_url('useradmin/DeleteData/'.$value['id_admin'])) ?>
              <div class="form-group">
                    Apakah Yakin Hapus Data <b><?= $value['nama_admin']?></b>..?
                  </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger btn-flat">Delete</button>
            </div>
            <?php echo form_close() ?>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>
<?php } ?>