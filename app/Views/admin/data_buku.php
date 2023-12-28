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

<?php if (session()->getFlashdata('pesan_info')) : ?>
    <div class="alert alert-info alert-dismissible fade show mb-2" role="alert">
        <?= session()->getFlashdata('pesan_info'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>


<!-- DataTales Example -->
<div class="mb-2">
    <a href="<?= site_url('admin/tambah_buku'); ?>" class="btn btn-primary btn-icon-split">
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
        <form action="<?= site_url('admin/Mdelete_buku'); ?>" method="POST">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th><input type="checkbox" name="" id="centangSemuaBuku"></th>
                            <th>No</th>
                            <th>Kode Buku</th>
                            <th>Judul</th>
                            <th>Pengarang</th>
                            <th>Penerbit</th>
                            <th>ISBN</th>
                            <th>Kategori</th>
                            <th>Tahun Terbit</th>
                            <th>Jumlah</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $n = 1; ?>
                        <?php foreach ($buku as $b) : ?>
                            <tr>
                                <th><input type="checkbox" name="id_buku[]" class="centangIdbuku" value="<?= $b['id_buku']; ?>"></th>
                                <td><?= $n++; ?></td>
                                <td><?= $b['kode_buku']; ?></td>
                                <td><?= $b['judul']; ?></td>
                                <td><?= ($b['pengarang'] == null ? '<p class="text-danger">kosong</p>' : $b['pengarang']); ?></td>
                                <td><?= ($b['penerbit'] == null ? '<p class="text-danger">kosong</p>' : $b['penerbit']); ?></td>
                                <td><?= ($b['isbn'] == null ? '<p class="text-danger">kosong</p>' : $b['isbn']); ?></td>
                                <td><?= $b['nama_kategori']; ?></td>
                                <td><?= ($b['tahun_terbit'] == null ? '<p class="text-danger">kosong</p>' : $b['tahun_terbit']); ?></td>
                                <td><?= ($b['jumlah'] == 0 ? '<p class="text-danger">Dipinjam</p>' : $b['jumlah']); ?></td>
                                <td><img src="/assets/img/buku/<?= $b['gambar_buku']; ?>" alt="" style="width: 100px;"></td>
                                <td>
                                    <div class="btn-group">
                                        <a href="<?= site_url('admin/ubah_buku'); ?>/<?= $b['id_buku']; ?>" class="btn btn-warning"><i class="fas fa-pen"></i></a>
                                        <a href="<?= site_url('admin/hapus_buku'); ?>/<?= $b['id_buku']; ?>" class="btn btn-danger" onclick="return confirm('apakah yakin ingin menghapus data?')"><i class="fas fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="mt-2">
                <button type="submit" onclick="return confirm('Apakah anda yakin ingin menghapus data')" class="btn btn-danger">Hapus Semua</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>