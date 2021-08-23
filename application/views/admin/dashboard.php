<?php if ($this->session->userdata('id') == null) {
    redirect('Auth');
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
    <!-- https://fonts.google.com/specimen/Roboto -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/fontawesome.min.css">
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/templatemo-style.css">
    <!--
	Product Admin CSS Template
	https://templatemo.com/tm-524-product-admin
    -->
    <style>
        .form-control {
            padding: inherit !important;
        }

        label {
            color: black !important;
        }
    </style>
</head>

<body id="reportsPage">
    <div class="" id="home">
        <nav class="navbar navbar-expand-xl">
            <div class="container h-100">
                <a class="navbar-brand" href="#">
                    <h1 class="tm-site-title mb-0">Admin</h1>
                </a>
                <button class="navbar-toggler ml-auto mr-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars tm-nav-icon"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto h-100">
                        <!-- <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <i class="fas fa-tachometer-alt"></i>
                                Dashboard
                                <span class="sr-only">(current)</span>
                            </a>
                        </li> -->
                        <li class="nav-item">

                            <button type="button" class="btn btn-primary mt-4" data-toggle="modal" data-target="#exampleModal">
                                <i class="far fa-file-alt"></i>
                                Kirim Notifikasi
                            </button>
                        </li>

                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link d-block" href="<?= base_url() ?>Auth/logout">
                                <b>Logout</b>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </nav>
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <p class="text-white mt-5 mb-5">Welcome back, <b>Admin dengan id <?= $this->session->userdata('id') ?></b></p>
                </div>
                <div class="col-md-5 mt-4">
                    <?= $this->session->flashdata('massage'); ?>
                </div>
            </div>
            <!-- row -->

            <div class="col-12 tm-block-col">
                <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll">
                    <h2 class="tm-block-title">List Pemadaman</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Username</th>
                                <th scope="col">Notifikasi</th>
                                <th scope="col">Provinsi</th>
                                <th scope="col">Kota/Kabupaten</th>
                                <th scope="col">Kecamatan</th>
                                <th scope="col">Desa</th>
                                <th scope="col">Date</th>
                                <th scope="col">Link</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($notif as $val) : ?>
                                <tr>
                                    <th scope="row"><b>
                                            <div class="tm-status-circle moving">
                                            </div><?= $val['name'] ?>
                                        </b>
                                    </th>
                                    <td>
                                        <?= $val['isi'] ?>
                                    </td>
                                    <td><b><?= $val['provinsi'] ?></b></td>
                                    <td><b><?= $val['kotkab'] ?></b></td>
                                    <td><b><?= $val['kecamatan'] ?></b></td>
                                    <td><?= $val['desa'] ?></td>
                                    <td><?php echo date("Y-m-d H:i:s", $val['date'] + (60 * 60 * 6)); ?></td>
                                    <td><?= $val['link'] ?></td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pengiriman notifikasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url() ?>Admin" method="POST" id="form">

                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="provinsi">Provinsi</label>
                                <select id="provinsi" class="form-control" name="provinsi" onchange="getKotkab();">
                                    <option selected value="0">Pilih provinsi</option>
                                    <?php foreach ($prov as $val) : ?>
                                        <option value="<?= $val['id'] ?>"><?= $val['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="kotkab">Kota/Kabupaten</label>
                                <select id="kotkab" class="form-control" name="kotkab" onchange="getKecamatan();">
                                    <option selected value="0">Pilih kota/kabupaten</option>
                                    <option value="0">pilih dahulu provinsi</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="kecamatan">Kecamatan</label>
                                <select id="kecamatan" class="form-control" name="kecamatan" onchange="getDesa();">
                                    <option selected value="0">Pilih kecamatan</option>
                                    <option value="0">pilih dahulu kabupaten/kota</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="desa">Desa</label>
                                <select id="desa" class="form-control" name="desa">
                                    <option selected value="0">Pilih desa</option>
                                    <option value="0">pilih dahulu kecamatan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="isi">Pesan</label>
                                <textarea class="form-control" id="isi" rows="5" name="isi">isikan pesan</textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="link">Link</label>
                                <input type="text" class="form-control" id="link" placeholder="Link" name="link">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    </div>

    <script src="<?= base_url() ?>assets/js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="<?= base_url() ?>assets/js/moment.min.js"></script>
    <!-- https://momentjs.com/ -->
    <script src="<?= base_url() ?>assets/js/Chart.min.js"></script>
    <!-- http://www.chartjs.org/docs/latest/ -->
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
    <script src="<?= base_url() ?>assets/js/tooplate-scripts.js"></script>
    <script src="<?= base_url() ?>assets/js/script.js"></script>

    <script>
        var isi = 'isikan alamat lengkap';
        $(document).ready(function() {
            $('#alamat').click(function() {
                this.innerHTML = '';
            });
        });
    </script>
    <script>
        Chart.defaults.global.defaultFontColor = 'white';
        let ctxLine,
            ctxBar,
            ctxPie,
            optionsLine,
            optionsBar,
            optionsPie,
            configLine,
            configBar,
            configPie,
            lineChart;
        barChart, pieChart;
        // DOM is ready
        $(function() {
            drawLineChart(); // Line Chart
            drawBarChart(); // Bar Chart
            drawPieChart(); // Pie Chart

            $(window).resize(function() {
                updateLineChart();
                updateBarChart();
            });
        })
    </script>
</body>

</html>