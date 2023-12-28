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

<div class="card border-bottom-primary shadow h-100 py-2">
    <div class="card-body">
        <form action="<?= site_url('admin/pinjam_buku'); ?>" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="kode_transaksi">Kode Transaksi</label>
                        <input type="text" name="kode_transaksi" class="form-control" id="" value="<?= $no_trans; ?>" readonly>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>NIS Siswa</label>
                        <select class="selectpicker form-control" name="id_siswa" data-container="body" data-live-search="true" title="Pilih NIS">
                            <?php foreach ($siswa as $s) : ?>
                                <option value="<?= $s['id_siswa']; ?>"><?= $s['nis']; ?> | <?= $s['nama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small class="text-danger"><?= $validation->getError('id_siswa'); ?></small>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Kode Buku</label>
                        <select class="selectpicker form-control" name="id_buku" data-container="body" data-live-search="true" title="Pilih Kode Buku">
                            <?php foreach ($buku as $b) : ?>
                                <option value="<?= $b['id_buku']; ?>"><?= $b['kode_buku']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small class="text-danger"><?= $validation->getError('id_buku'); ?></small>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="">Tanggal Pinjam</label>
                        <input type="date" name="tanggal_pinjam" id="" class="form-control" value="<?= $pinjam; ?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="">Tanggal Kembali</label>
                        <input type="date" name="tanggal_kembali" id="" class="form-control" value="<?= $kembali; ?>">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>

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
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $n = 1; ?>
                        <?php foreach ($transaksi as $b) : ?>
                            <tr>
                                <td><?= $n++; ?></td>
                                <td><?= $b['kode_transaksi']; ?></td>
                                <td><?= $b['nis_siswa']; ?></td>
                                <td><?= $b['nama_siswa']; ?></td>
                                <td><?= $b['buku_kode']; ?></td>
                                <td><?= $b['judul_buku']; ?></td>
                                <td><?php echo (date("d M, Y", strtotime($b['tanggal_pinjam']))) ?></td>
                                <td><?php echo (date("d M, Y", strtotime($b['tanggal_kembali']))) ?></td>
                                <td>
                                    <a href="<?= site_url('admin/detail_peminjaman'); ?>/<?= $b['kode_transaksi']; ?>" class="btn btn-info">Cek</a>
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