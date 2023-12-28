<?= $this->extend('layout/template'); ?>

<?= $this->section('page-content'); ?>

<?php if (session()->getFlashdata('pesan_hijau')) : ?>
    <div class="alert alert-success alert-dismissible fade show mb-2" role="alert">
        <strong>Berhasil!!</strong> <?= session()->getFlashdata('pesan_hijau'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('pesan_merah')) : ?>
    <div class="alert alert-danger alert-dismissible fade show mb-2" role="alert">
        <strong>Gagal!!</strong> <?= session()->getFlashdata('pesan_merah'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>


<!-- DataTales Example -->
<div class="mb-2">
    <a href="" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#exampleModal">
        <span class="icon text-white-50">
            <i class="fas fa-plus"></i>
        </span>
        <span class="text">Tambah Data</span>
    </a>
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $n = 1; ?>
                    <?php foreach ($kategori as $b) : ?>
                        <tr>
                            <td><?= $n++; ?></td>
                            <td><?= $b['nama_kategori']; ?></td>
                            <td>
                                <div class="btn-group">
                                    <a href="#" class="btn btn-warning" id="edit_kategori" data-toggle="modal" data-target="#exampleModaleditkategori" data-id_kategori="<?= $b['id_kategori']; ?>" data-nama_kategori="<?= $b['nama_kategori']; ?>"><i class="fas fa-pen"></i></a>
                                    <a href="<?= site_url('admin/hapus_kategori'); ?>/<?= $b['id_kategori']; ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus')"><i class="fas fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= site_url('admin/save_kategori'); ?>" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_kategori">Nama kategori</label>
                        <input type="text" name="nama_kategori" id="" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal edit -->
<div class="modal fade" id="exampleModaleditkategori" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= site_url('admin/update_kategori'); ?>" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body modal-edit">
                    <input type="hidden" name="id_kategori" id="id_kategori">
                    <div class="form-group">
                        <label for="nama_kategori">Nama kategori</label>
                        <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>