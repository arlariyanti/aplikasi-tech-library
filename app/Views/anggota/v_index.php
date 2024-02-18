<div class="col-md-12">
     <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Data</h3>

            <div class="card-tools">
                <a href="<?= base_url('useranggota/AddData')?>" class="btn btn-primary btn-flat btn-sm" >
                    <i class="fas fa-plus"></i> Add
                </a>
            </div>
            </div>
            <div class="card-body">

            <?php 
             if (session()->getFlashdata('pesan')) {
             echo '<div class="alert alert-success alert-dismissible">
             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
             <h5><i class="icon fas fa-check"></i>';
            echo session()->getFlashdata('pesan');
             echo '</h5></div>';
             }
             ?>

            <table id="example1" class="table table-bordered table-hover">
                <thead>
                    <tr class="text-center">
                        <th width="50px">No</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>No Telepon</th>
                      
                        <th width="100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($useranggota as $key => $value) { ?>
                    <tr>
                        <td><?= $no++ ?>.</td>
                        <td><?= $value['username'] ?> </td>
                        <td><?= $value['password'] ?> <br>
                        <?php if ($value['verifikasi']==1) { ?>
                            <a class="text-success"><i class="fa fa-check"></i> Verifikasi</a>
                           <?php } else { ?>
                               <a class="text-danger"><i class="fa fa-times"></i>Belum Verifikasi</a><br>
                                 <a class="btn btn-success btn-xs" href="<?= base_url('useranggota/Verifikasi/'. $value['id_user'])?>"> Verifikasi Sekarang</a>
                            <?php } ?> 
                        </td>
                        <td><?= $value['email'] ?> </td>
                        <td><?= $value['alamat'] ?> </td>
                        <td><?= $value['nomer_telpon'] ?> </td>
                       
                       
                        <td class="text-center">
                        <a href="<?= base_url('useranggota/EditData/'. $value['id_user'])?>" class="btn btn-warning btn-flat btn-sm" >
                        <i class="fas fa-edit"></i>
                        </a>
                        <button type="button" class="btn btn-danger btn-flat btn-sm" data-toggle="modal" data-target="#modal-delete<?=$value['id_user'] ?>" >
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
<?php foreach ($useranggota as $key => $value) { ?>
<div class="modal fade" id="modal-delete<?=$value['id_user'] ?>">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Delete Data</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <?php echo form_open(base_url('useranggota/DeleteData/'.$value['id_user'])) ?>
              <div class="form-group">
                    Apakah Yakin Hapus Data <b><?= $value['username']?></b>..?
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
