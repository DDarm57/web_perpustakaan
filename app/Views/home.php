<?= $this->extend('layout/template'); ?>

<?= $this->section('page-content'); ?>

<?php if (session()->getFlashdata('pesan_hijau')) : ?>
    <div class="swal" data-swal="<?= session()->getFlashdata('pesan_hijau'); ?>"></div>
<?php endif; ?>

<div class="card border-left-primary shadow h-100 py-2">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><strong>Selmat datang</strong> <?= session()->get('full_name'); ?></h6>
    </div>
    <div class="card-body">
        Apa pengertian dan fungsi perpustakaan?
        Hasil gambar untuk perpustakaan adalah
        Perpustakaan adalah fasilitas atau tempat menyediakan sarana bahan bacaan. Tujuan dari perpustakaan sendiri, khususnya perpustakaan perguruan tinggi adalah memberikan layanan informasi untuk kegiatan belajar, penelitian, dan pengabdian masyarakat dalam rangka melaksanakan Tri Dharma Perguruan Tinggi (Wiranto dkk,1997).
    </div>
</div>


<?= $this->endSection(); ?>