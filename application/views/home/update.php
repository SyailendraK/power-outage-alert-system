<?php
if ($this->session->userdata('update') == null) {
    redirect('Home');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?></title>
    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="css/bootstrap.css"> -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/linericon/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/magnific-popup.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/nice-select/css/nice-select.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/animate-css/animate.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/flaticon/flaticon.css">
    <!-- main css -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
</head>

<body>
    <div class="container">
        <?= $this->session->flashdata('massage'); ?>
        <h2 class="text-center mt-4 mb-2">Halaman Update Member HiPLN</h2>
        <form action="<?= base_url() ?>Home/save" method="POST" id="form">

            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email">Nama</label>
                        <input type="text" class="form-control" id="email" placeholder="Nama" name="nama" value="<?= $member['nama'] ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="<?= $member['email'] ?>">
                    </div>
                </div>
                <div class="form-row">
                    <!-- <div class="form-group col-md-6">
                <label for="inputEmail4">No telp/Whatsapp (62+)</label>
                <input type="number" class="form-control" id="number" placeholder="contoh : 62855xxx" name="number" min="0">
            </div> -->

                    <div class="form-group col-md-6">
                        <label for="provinsi">Provinsi</label>
                        <select id="provinsi" class="form-control" name="provinsi" onchange="getKotkab();">
                            <option selected value="<?= $member['provinsi']['id'] ?>"><?= $member['provinsi']['name'] ?></option>
                            <?php foreach ($provinsi as $val) : ?>
                                <option value="<?= $val['id'] ?>"><?= $val['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="kotkab">Kota/Kabupaten</label>
                        <select id="kotkab" class="form-control" name="kotkab" onchange="getKecamatan();">
                            <option selected value="<?= $member['kotkab']['id'] ?>"><?= $member['kotkab']['name'] ?></option>
                            <option>pilih dahulu provinsi</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="kecamatan">Kecamatan</label>
                        <select id="kecamatan" class="form-control" name="kecamatan" onchange="getDesa();">
                            <option selected value="<?= $member['kecamatan']['id'] ?>"><?= $member['kecamatan']['name'] ?></option>
                            <option>pilih dahulu kabupaten/kota</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="desa">Desa</label>
                        <select id="desa" class="form-control" name="desa">
                            <option selected value="<?= $member['desa']['id'] ?>"><?= $member['desa']['name'] ?></option>
                            <option>pilih dahulu kecamatan</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">

                    <div class="form-group col-md-12">
                        <label for="alamat">Alamat detail</label>
                        <textarea class="form-control" id="alamat" rows="3" name="alamat"><?= $member['alamat'] ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="check" name="check" value="1">
                        <label class="form-check-label" for="check">
                            Saya telah membaca dan menyetujui <a href="#">ketentuan</a> yang berlaku.
                        </label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn primary_btn px-3">Update</button>
            </div>
        </form>
    </div>

    <script src="<?= base_url() ?>assets/js/jquery-3.2.1.min.js"></script>
    <script src="<?= base_url() ?>assets/js/popper.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/js/stellar.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery.magnific-popup.min.js"></script>
    <script src="<?= base_url() ?>assets/vendors/nice-select/js/jquery.nice-select.min.js"></script>
    <script src="<?= base_url() ?>assets/vendors/isotope/imagesloaded.pkgd.min.js"></script>
    <script src="<?= base_url() ?>assets/vendors/isotope/isotope-min.js"></script>
    <script src="<?= base_url() ?>assets/vendors/owl-carousel/owl.carousel.min.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery.ajaxchimp.min.js"></script>
    <script src="<?= base_url() ?>assets/vendors/counter-up/jquery.waypoints.min.js"></script>
    <script src="<?= base_url() ?>assets/vendors/counter-up/jquery.counterup.min.js"></script>
    <script src="<?= base_url() ?>assets/js/mail-script.js"></script>

    <script src="<?= base_url() ?>assets/js/script2.js"></script>

</body>

</html>