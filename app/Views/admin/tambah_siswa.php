<?= $this->extend('layout/template'); ?>

<?= $this->section('page-content'); ?>

<div class="card border-bottom-primary shadow h-100 py-2">
    <div class="card-body">
        <form action="<?= site_url('admin/save_siswa'); ?>" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="nis">NIS</label>
                        <input type="number" name="nis" id="nis" class="form-control <?= ($validation->hasError('nis')) ? 'is-invalid' : ''; ?>">
                        <div class="invalid-feedback"><?= $validation->getError('nis'); ?></div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="<?= old('nama'); ?>" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Kelas</label>
                        <select class="selectpicker form-control" name="id_kelas" data-container="body" data-live-search="true" title="Pilih Kelas">
                            <?php if (old('id_kelas') == true) : ?>
                                <optgroup label="pilihan sebelumnya">
                                    <option selected value="<?= old('id_kelas'); ?>"><?= old('id_kelas'); ?></option>
                                </optgroup>
                            <?php endif; ?>
                            <?php foreach ($kelas as $k) : ?>
                                <option value="<?= $k['id_kelas']; ?>"><?= $k['nama_kelas']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="">JK</label>
                        <div class="form-control">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="jk" type="radio" id="inlineCheckbox1" value="L" <?= (old('jk') == 'L' ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="inlineCheckbox1">L</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="jk" type="radio" id="inlineCheckbox2" value="P" <?= (old('jk') == 'P' ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="inlineCheckbox2">P</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" name="alamat" id="alamat" class="form-control" value="<?= old('alamat'); ?>">
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="">Gambar</label>
                        <div class="custom-file">
                            <input type="file" name="gambar_siswa" class="custom-file-input <?= ($validation->hasError('gambar_Siswa')) ? 'is-invalid' : ''; ?>" id="gambar" onchange="previewImg()">
                            <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                            <div class="invalid-feedback"><?= $validation->getError('gambar_siswa'); ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-2">
                        <img src="/assets/img/siswa/default.jpg" alt="" class="img-thumbnail img-preview" style="width: 150px;">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>