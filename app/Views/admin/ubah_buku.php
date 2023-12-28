<?= $this->extend('layout/template'); ?>

<?= $this->section('page-content'); ?>

<div class="card border-bottom-primary shadow h-100 py-2">
    <div class="card-body">
        <form action="<?= site_url('admin/update_buku'); ?>/<?= $buku['id_buku']; ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_buku" id="" value="<?= $buku['id_buku']; ?>">
            <input type="hidden" name="gambar_lama" id="" value="<?= $buku['gambar_buku']; ?>">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="kode_buku">Kode Buku</label>
                        <input type="text" name="kode_buku" id="kode_buku" class="form-control" value="<?= $buku['kode_buku']; ?>" readonly>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" name="judul" id="judul" class="form-control" value="<?= $buku['judul']; ?>" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="pengarang">Pengarang</label>
                        <input type="text" name="pengarang" id="pengarang" class="form-control" value="<?= $buku['pengarang']; ?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="penerbit">Penerbit</label>
                        <input type="text" name="penerbit" id="penerbit" class="form-control" value="<?= $buku['penerbit']; ?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="isbn">ISBN</label>
                        <input type="text" name="isbn" id="isbn" class="form-control" value="<?= $buku['isbn']; ?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="">Kategori</label>
                        <select name="id_kategori" id="id_kategori" class="form-control" required>
                            <?php foreach ($kategori as $k) : ?>
                                <option <?= ($k['id_kategori'] == $buku['id_kategori'] ? 'selected' : ''); ?> value="<?= $k['id_kategori']; ?>"><?= $k['nama_kategori']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="tahun_terbit">Tahun Terbit</label>
                        <input type="date" name="tahun_terbit" id="tahun_terbit" class="form-control" value="<?= $buku['tahun_terbit']; ?>" required>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" name="jumlah" id="jumlah" class="form-control" value="<?= $buku['jumlah']; ?>" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="">Gambar</label>
                        <div class="custom-file">
                            <input type="file" name="gambar_buku" class="custom-file-input <?= ($validation->hasError('gambar')) ? 'is-invalid' : ''; ?>" id="gambar" onchange="previewImg()">
                            <label class="custom-file-label" for="validatedCustomFile"><?= $buku['gambar_buku']; ?></label>
                            <div class="invalid-feedback"><?= $validation->getError('gambar'); ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-2">
                        <img src="/assets/img/buku/<?= $buku['gambar_buku']; ?>" alt="" class="img-thumbnail img-preview" style="width: 150px;">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>