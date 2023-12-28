<?= $this->extend('layout/template'); ?>

<?= $this->section('page-content'); ?>

<div class="card border-left-primary shadow h-100 py-2">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><strong>Admin</strong> <?= session()->get('full_name'); ?></h6>
    </div>
    <div class="card-body">
        <form action="<?= site_url('admin/save_profile'); ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" id="" value="<?= session()->get('id'); ?>">
            <input type="hidden" name="gambar_lama" id="" value="<?= session()->get('user_image'); ?>">
            <div class="row">
                <div class="col-sm-4">
                    <img class="img-thumbnail img-preview" src="/assets/img/admin/<?= session()->get('user_image'); ?>" alt="" style="width: 18rem;">
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="full_name">Nama :</label>
                        <input type="text" name="full_name" class="form-control <?= ($validation->hasError('full_name')) ? 'is-invalid' : ''; ?>" id="" value="<?= session()->get('full_name'); ?>">
                        <div class="invalid-feedback"><?= $validation->getError('full_name'); ?></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="full_name">Username :</label>
                                <input type="text" name="username" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" id="" value="<?= session()->get('username'); ?>">
                                <div class="invalid-feedback"><?= $validation->getError('username'); ?></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="password">Password :</label>
                                <input type="text" name="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="" value="<?= session()->get('password'); ?>">
                                <div class="invalid-feedback"><?= $validation->getError('password'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Gambar</label>
                        <div class="custom-file">
                            <input type="file" name="user_image" class="custom-file-input <?= ($validation->hasError('user_image')) ? 'is-invalid' : ''; ?>" id="gambar" onchange="previewImg()">
                            <label class="custom-file-label" for="validatedCustomFile"><?= session()->get('user_image'); ?></label>
                            <div class="invalid-feedback"><?= $validation->getError('user_image'); ?></div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <button type="submit" onclick="return confirm('jika anda mengubah data profile, maka akan logout secara otomatis. apakah anda yakin ?')" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<?= $this->endSection(); ?>