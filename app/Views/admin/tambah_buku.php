<?= $this->extend('layout/template'); ?>

<?= $this->section('page-content'); ?>

<div class="card border-bottom-primary shadow h-100 py-2">
    <div class="card-body">
        <form action="<?= site_url('admin/save_buku'); ?>" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="kode_buku">Kode Buku</label>
                        <input type="text" name="kode_buku" id="kode_buku" class="form-control <?= ($validation->hasError('kode_buku')) ? 'is-invalid' : ''; ?>">
                        <div class="invalid-feedback"><?= $validation->getError('kode_buku'); ?></div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" name="judul" id="judul" class="form-control" value="<?= old('judul'); ?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="pengarang">Pengarang</label>
                        <input type="text" name="pengarang" id="pengarang" class="form-control" value="<?= old('pengarang'); ?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="penerbit">Penerbit</label>
                        <input type="text" name="penerbit" id="penerbit" class="form-control" value="<?= old('penerbit'); ?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="isbn">ISBN</label>
                        <input type="text" name="isbn" id="isbn" class="form-control" value="<?= old('isbn'); ?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="">Kategori</label>
                        <select name="id_kategori" id="id_kategori" class="form-control selectpicker" data-container="body" data-live-search="true" title="Pilih Kategori">
                            <?php foreach ($kategori as $k) : ?>
                                <option <?= (old('id_kategori') == $k['id_kategori'] ? 'selected' : ''); ?> value="<?= $k['id_kategori']; ?>"><?= $k['nama_kategori']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="tahun_terbit">Tahun Terbit</label>
                        <input type="date" name="tahun_terbit" id="tahun_terbit" class="form-control" <?= old('tahun_terbit'); ?>>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" name="jumlah" id="jumlah" class="form-control" value="<?= (old('jumlah') ? old('jumlah') : '1'); ?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="">Gambar</label>
                        <div class="custom-file">
                            <input type="file" name="gambar_buku" class="custom-file-input <?= ($validation->hasError('gambar')) ? 'is-invalid' : ''; ?>" id="gambar" onchange="previewImg()">
                            <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                            <div class="invalid-feedback"><?= $validation->getError('gambar'); ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-2">
                        <img src="/assets/img/buku/default.jpg" alt="" class="img-thumbnail img-preview" style="width: 150px;">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>