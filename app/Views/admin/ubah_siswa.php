<?= $this->extend('layout/template'); ?>

<?= $this->section('page-content'); ?>

<div class="card border-bottom-primary shadow h-100 py-2">
    <div class="card-body">
        <form action="<?= site_url('admin/update_siswa'); ?>/<?= $siswa['id_siswa']; ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="gambar_lama" id="" value="<?= $siswa['gambar_siswa']; ?>">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="nis">NIS</label>
                        <input type="text" name="nis" id="nis" class="form-control" value="<?= $siswa['nis']; ?>" readonly>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="<?= $siswa['nama']; ?>" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="id_kelas">Kelas</label>
                        <select class="selectpicker form-control" name="id_kelas" data-container="body" data-live-search="true" title="Pilih Kelas">
                            <?php foreach ($kelas as $k) : ?>
                                <option <?= ($k['id_kelas'] == $siswa['id_kelas'] ? 'selected' : ''); ?> value="<?= $k['id_kelas']; ?>"><?= $k['nama_kelas']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="">JK</label>
                        <div class="form-control">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="jk" type="checkbox" id="inlineCheckbox1" value="L" <?= ($siswa['jk'] == 'L' ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="inlineCheckbox1">L</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="jk" type="checkbox" id="inlineCheckbox2" value="P" <?= ($siswa['jk'] == 'P' ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="inlineCheckbox2">P</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" name="alamat" id="alamat" class="form-control" value="<?= $siswa['alamat']; ?>">
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="">Gambar</label>
                        <div class="custom-file">
                            <input type="file" name="gambar_siswa" class="custom-file-input <?= ($validation->hasError('gambar_Siswa')) ? 'is-invalid' : ''; ?>" id="gambar" onchange="previewImg()">
                            <label class="custom-file-label" for="validatedCustomFile"><?= $siswa['gambar_siswa']; ?></label>
                            <div class="invalid-feedback"><?= $validation->getError('gambar_siswa'); ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-2">
                        <img src="/assets/img/siswa/<?= $siswa['gambar_siswa']; ?>" alt="" class="img-thumbnail img-preview" style="width: 150px;">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>