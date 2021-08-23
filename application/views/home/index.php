<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="<?= base_url() ?>assets/img/favicon.png" type="image/png">
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
	<style>
		.banner_inner {
			margin-top: -120px;
		}

		.primary_btn {
			font-size: 1rem;
		}
	</style>

</head>

<body>

	<!--================Header Menu Area =================-->

	<!--================Header Menu Area =================-->

	<!--================Home Banner Area =================-->
	<section class="home_banner_area">
		<?= $this->session->flashdata('massage'); ?>
		<div class="banner_inner">
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
						<div class="home_left_img">
							<img class="img-fluid" src="<?= base_url() ?>assets/img/banner/home-left.png" alt="">
						</div>
					</div>
					<div class="col-lg-6">
						<div class="banner_content">
							<h2>
								HiPLN
							</h2>
							<p>
								Daftar sekarang dan dapatakan notifikasi pemadaman listrik di daerah anda.
							</p>
							<div class="d-flex align-items-center">
								<button class="btn primary_btn px-3" data-toggle="modal" data-target="#exampleModal">Daftar</button>
								<button class="btn primary_btn px-3 ml-3" data-toggle="modal" data-target="#exampleModal2">update</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Home Banner Area =================-->
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
						<button type="submit" class="btn primary_btn px-3">Daftar</button>
					</div>
				</form>

			</div>
		</div>
	</div>
	<!--================ End Blog Area ================-->
	<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Update akun HiPLN</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="pl-3">Masukan alamat email, lalu kami akan mengirimkan alamat web untuk mengupdate akun anda</div>
				<form action="<?= base_url() ?>Home/update" method="POST" id="form">

					<div class="modal-body">
						<div class="form-row">
							<div class="form-group col-md-12">
								<label for="emailup">Email</label>
								<input type="email" class="form-control" id="emailup" placeholder="Email" name="emailup">
							</div>
						</div>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
						<button type="submit" class="btn primary_btn px-3">Kirim</button>
					</div>
				</form>

			</div>
		</div>
	</div>
	<!--================ Start Newsletter Area ================-->
	<section class="newsletter_area">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-12">
					<div class="newsletter_inner">
						<h1>Subscribe Our Newsletter</h1>
						<p>We won’t send any kind of spam</p>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12">
					<aside class="newsletter_widget">
						<div id="mc_embed_signup">
							<form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get" class="subscribe_form relative">
								<div class="input-group d-flex flex-row">
									<input name="EMAIL" placeholder="Enter email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your email address'" required="" type="email">
									<button class="btn primary_btn">Subscribe</button>
								</div>
							</form>
						</div>
					</aside>
				</div>
			</div>
		</div>
	</section>
	<!--================ End Newsletter Area ================-->

	<!--================Footer Area =================-->
	<footer class="footer_area section_gap_top">
		<div class="container">
			<div class="row footer_inner">
				<div class="col-lg-3 col-sm-6">
					<aside class="f_widget ab_widget">
						<div class="f_title">
							<h4>About Farfly</h4>
						</div>
						<ul>
							<li><a href="#"></a>For Business</a></li><a href="#">
								<li><a href="#"></a>Premium Plans
							</a></li>
							<li><a href="#"></a>Reviews</a></li>
							<li><a href="#"></a>How it Works</a></li>
							<li><a href="#"></a>Farfly Blog</a></li>
						</ul>
					</aside>
				</div>
				<div class="col-lg-3 col-sm-6">
					<aside class="f_widget ab_widget">
						<div class="f_title">
							<h4>Company</h4>
						</div>
						<ul>
							<li><a href="#"></a>Product Tour</a></li><a href="#">
								<li><a href="#"></a>Pricing
							</a></li>
							<li><a href="#"></a>Founding Members</a></li>
							<li><a href="#"></a>Case Studies</a></li>
							<li><a href="#"></a>Product Updates</a></li>
						</ul>
					</aside>
				</div>
				<div class="col-lg-3 col-sm-6">
					<aside class="f_widget ab_widget">
						<div class="f_title">
							<h4>Support</h4>
						</div>
						<ul>
							<li><a href="#"></a>Documentation</a></li><a href="#">
								<li><a href="#"></a>Data Securiry
							</a></li>
							<li><a href="#"></a>Site Performance</a></li>
							<li><a href="#"></a>Action Plan</a></li>
							<li><a href="#"></a>Resources</a></li>
						</ul>
					</aside>
				</div>
				<div class="col-lg-3 col-sm-6">
					<aside class="f_widget ab_widget">
						<div class="f_title">
							<h4>Legal</h4>
						</div>
						<ul>
							<li><a href="#"></a>Terms and conditions</a></li><a href="#">
								<li><a href="#"></a>Privacy Policy
							</a></li>
							<li><a href="#"></a>Cookie Information</a></li>
							<li><a href="#"></a>Opt - Out</a></li>
						</ul>
					</aside>
				</div>
			</div>
			<div class="row single-footer-widget">
				<div class="col-lg-6 col-md-6 col-sm-12">
					<div class="copy_right_text">
						<p>
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							Copyright &copy;<script>
								document.write(new Date().getFullYear());
							</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						</p>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12">
					<div class="social_widget">
						<a href="#"><i class="fa fa-facebook"></i></a>
						<a href="#"><i class="fa fa-twitter"></i></a>
						<a href="#"><i class="fa fa-dribbble"></i></a>
						<a href="#"><i class="fa fa-behance"></i></a>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!--================End Footer Area =================-->

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="<?= base_url() ?>assets/js/script.js"></script>

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

</body>

</html>