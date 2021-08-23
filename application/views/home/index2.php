<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?></title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="vendors/linericon/style.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="vendors/nice-select/css/nice-select.css">
    <link rel="stylesheet" href="vendors/animate-css/animate.css">
    <link rel="stylesheet" href="vendors/flaticon/flaticon.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700,800,300" rel="stylesheet" type="text/css">

    <style>
        body {
            background-image: url("<?= base_url() ?>/assets/img/home-banner.jpg");
            background-repeat: no-repeat;
            background-position: right top;
            overflow-y: hidden;
        }

        .container {
            padding-top: 7%;
        }

        .hipln {
            font-size: 3rem;
        }

        section {
            text-align: initial;
            color: white;
        }

        .isi {
            margin-top: -0.2% !important;
            padding-left: 6% !important;
        }

        .img {
            padding-left: 10%;
        }
    </style>
</head>

<body>
    <div class="container">

        <section class="pt-5">
            <div class="row">
                <div class="col-md-6 img">
                    <img src="<?= base_url() ?>/assets/img/Logo_PLN.png" alt="Logo PLN" height="70%;">
                </div>
                <div class="col-md-6 mt-5 pt-5 isi">
                    <h2 class="hipln mb-3">HiPLN</h2>
                    <p class="mb-3">
                        Daftarkan diri anda sekarang, dan dapatakan notifikasi <br>pemadaman listrik di daerah anda.
                    </p>
                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
                        Daftar Akun
                    </button>
                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
                        Update Akun
                    </button>
                </div>
            </div>
        </section>


        <?= $this->session->flashdata('massage'); ?>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pendaftaran HiPLN</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url() ?>Home" method="POST" id="form">

                        <div class="modal-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="email">Nama</label>
                                    <input type="text" class="form-control" id="email" placeholder="Nama" name="nama">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="Email" name="email">
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
                                        <option selected>Pilih provinsi</option>
                                        <?php foreach ($provinsi as $val) : ?>
                                            <option value="<?= $val['id'] ?>"><?= $val['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="kotkab">Kota/Kabupaten</label>
                                    <select id="kotkab" class="form-control" name="kotkab" onchange="getKecamatan();">
                                        <option selected>Pilih kota/kabupaten</option>
                                        <option>pilih dahulu provinsi</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="kecamatan">Kecamatan</label>
                                    <select id="kecamatan" class="form-control" name="kecamatan" onchange="getDesa();">
                                        <option selected>Pilih kecamatan</option>
                                        <option>pilih dahulu kabupaten/kota</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="desa">Desa</label>
                                    <select id="desa" class="form-control" name="desa">
                                        <option selected>Pilih desa</option>
                                        <option>pilih dahulu kecamatan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">

                                <div class="form-group col-md-12">
                                    <label for="alamat">Alamat detail</label>
                                    <textarea class="form-control" id="alamat" rows="3" name="alamat">isikan alamat lengkap</textarea>
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
                            <button type="submit" class="btn btn-primary">Datar</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
</body>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="<?= base_url() ?>assets/js/script.js"></script>
<script src="js/stellar.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="vendors/nice-select/js/jquery.nice-select.min.js"></script>
<script src="vendors/isotope/imagesloaded.pkgd.min.js"></script>
<script src="vendors/isotope/isotope-min.js"></script>
<script src="vendors/owl-carousel/owl.carousel.min.js"></script>
<script src="js/jquery.ajaxchimp.min.js"></script>
<script src="vendors/counter-up/jquery.waypoints.min.js"></script>
<script src="vendors/counter-up/jquery.counterup.min.js"></script>
<script src="js/mail-script.js"></script>

<script>
    var isi = 'isikan alamat lengkap';
    $(document).ready(function() {
        $('#alamat').click(function() {
            this.innerHTML = '';
        });
    });
</script>

</html>