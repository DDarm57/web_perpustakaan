<?= $this->extend('layout/template'); ?>

<?= $this->section('page-content'); ?>

<div class="card border-left-primary shadow h-100 py-2">
    <div class="card-body">
        <form action="<?= site_url('admin/kembali_buku'); ?>" method="POST">
            <input type="hidden" name="id_transaksi" id="" value="<?= $detail['id_transaksi']; ?>">
            <div class="row">
                <div class="col-md-2 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="img-thumbnail" width="150px" src="/assets/img/siswa/<?= $detail['gambar_siswa']; ?>"><span class="font-weight-bold mt-2">NIS : <?= $detail['nis']; ?></span><span class="text-black-50"><?= $detail['nama']; ?></span><span> </span></div>
                </div>
                <div class="col-md-4 border-right">
                    <div class="p-2 py-2">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profil Peminjam</h4>
                        </div>
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" name="r_nama" id="" value="<?= $detail['nama']; ?>" class="form-control" readonly>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">NIS</label>
                                    <input type="text" name="r_nis" id="" value="<?= $detail['nis']; ?>" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Kelas</label>
                                    <input type="text" name="" id="" value="<?= $detail['nama_kelas']; ?>" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Alamat</label>
                            <textarea name="" id="" cols="10" rows="5" class="form-control" readonly><?= $detail['alamat']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">JK</label>
                            <div class="form-control">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="jk" type="checkbox" id="inlineCheckbox1" value="L" <?= ($detail['jk'] == 'L' ? 'checked' : ''); ?> disabled>
                                    <label class="form-check-label" for="inlineCheckbox1">L</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="jk" type="checkbox" id="inlineCheckbox2" value="P" <?= ($detail['jk'] == 'P' ? 'checked' : ''); ?> disabled>
                                    <label class="form-check-label" for="inlineCheckbox2">P</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-2 py-2">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Detail Buku</h4>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 mb-2">
                                <img class="img-thumbnail" width="150px" src="/assets/img/buku/<?= $detail['gambar_buku']; ?>">
                                <h6 class="mt-2"><strong>Kode Buku :</strong> <?= $detail['buku_kode']; ?></h6>
                                <input type="hidden" name="r_kodeBuku" id="" value="<?= $detail['buku_kode']; ?>">
                            </div>
                            <div class="col-sm-8">
                                <h5><strong>Judul :</strong></h5>
                                <h5><?= $detail['judul']; ?></h5>
                                <input type="hidden" name="r_judul" id="" value="<?= $detail['judul_buku']; ?>">
                                <hr>
                                <h6><strong>Kode Transaksi :</strong> <?= $detail['kode_transaksi']; ?></h6>
                                <input type="hidden" name="r_kodeTr" id="" value="<?= $detail['kode_transaksi']; ?>">
                                <h6><strong>Pengarang :</strong> <?= $detail['pengarang']; ?></h6>
                                <h6><strong>Penerbit :</strong> <?= $detail['penerbit']; ?></h6>
                                <h6><strong>ISBN :</strong> <?= $detail['isbn']; ?></h6>
                                <h6><strong>Kategori</strong> <?= $detail['nama_kategori']; ?></h6>
                                <h6><strong>Tahun Terbit :</strong> <?= $detail['tahun_terbit']; ?></h6>
                            </div>
                        </div>
                        <hr>
                        <div class="mt-2">
                            <h4><strong>Tanggal Pinjam : </strong><?php echo (date("d M, Y", strtotime($detail['tanggal_pinjam']))) ?></h4>
                            <input type="hidden" name="r_pinjam" id="" value="<?= $detail['tanggal_pinjam']; ?>">
                            <h4><strong>Tanggal Kembali : </strong><?php echo (date("d M, Y", strtotime($detail['tanggal_kembali']))) ?></h4>
                            <input type="hidden" name="r_kembali" id="" value="<?= $detail['tanggal_kembali']; ?>">
                        </div>
                        <hr>
                        <div class="mt-2">
                            <h4><strong>Status : </strong><?= $detail['status']; ?></h4>
                            <input type="hidden" name="r_status" id="" value="dikembalikan">
                            <h4 class="<?= ($detail['terlambat'] == 0 ? 'text-success' : 'text-danger'); ?>"><strong>Terlambat : </strong><?= $detail['terlambat']; ?> hari</h4>
                            <input type="hidden" name="r_terlambat" id="" value="<?= $detail['terlambat']; ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-2">
                <button type="submit" class="btn btn-primary" onclick="return confirm('apakah anda yakin ingin mengembalikan buku')">Kembali Buku</button>
            </div>
        </form>
    </div>
</div>


<?= $this->endSection(); ?>