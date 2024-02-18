<div class="col-md-12">
            <div class="card card-outline card-primary">
              <div class="card-header">
                <h3 class="card-title"><?= $judul?></h3>
                <div class="card-tools">
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table id="example1" class="table table-borderless table-hover">
                    <thead>
                        <tr class="text-center">
                            <th>Cover</th>
                            <th>Buku</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($buku as $key => $value) { ?>
                            <tr>
                                <td class="text-center"><img src="<?= base_url('cover/'.  $value['cover']) ?>" width="250px" height="270px">
                        <p><b><?= $value['id_buku'] ?></b></p></td>
                        <td>
                        <p><h5 class="text-primary"><?= $value['judul'] ?></h5></p>
                            <p><b> Kategori : </b> <?= $value['id_kategori']?><br>
                            <b> Penulis : </b> <?= $value['penulis']?><br>
                            <b> Penerbit : </b> <?= $value['penerbit']?><br>
                            <b> Tahun : </b> <?= $value['tahun_terbit']?><br>
                            <b> Deskripsi : </b> <?= $value['deskripsi']?> 
                        </p>
                        </td>
                            </tr>

                       <?php } ?>
                    </tbody>
                </table>
                </div>
              </div>
</div>