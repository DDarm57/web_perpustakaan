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
<div class="card shadow mb-4 mt-2">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Peminjaman</h6>
    </div>
    <div class="card-body">
        <form action="<?= site_url('admin/Mdelete_siswa'); ?>" method="POST">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Transaksi</th>
                            <th>NIS Siswa</th>
                            <th>Nama Siswa</th>
                            <th>Kode Buku</th>
                            <th>Judul Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th>Terlambat</th>
                            <th>Dikembalikan Pada</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $n = 1; ?>
                        <?php foreach ($riwayat as $b) : ?>
                            <tr>
                                <td><?= $n++; ?></td>
                                <td><?= $b['r_kodeTr']; ?></td>
                                <td><?= $b['r_nis']; ?></td>
                                <td><?= $b['r_nama']; ?></td>
                                <td><?= $b['r_kodeBuku']; ?></td>
                                <td><?= $b['r_judul']; ?></td>
                                <td><?php echo (date("d M, Y", strtotime($b['r_pinjam']))) ?></td>
                                <td><?php echo (date("d M, Y", strtotime($b['r_kembali']))) ?></td>
                                <td><?= $b['r_status']; ?></td>
                                <td><?= $b['r_terlambat']; ?></td>
                                <td><?php echo (date("d M, Y - H:i:s", strtotime($b['created_at']))) ?></td>
                                <td>
                                    <a href="" class="btn btn-info">Cek</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>