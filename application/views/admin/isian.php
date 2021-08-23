<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?></title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <h1>Form</h1>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Launch demo modal
        </button>
        <?= $this->session->flashdata('massage'); ?>
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
                    <form action="<?= base_url() ?>Admin/dashboard" method="POST" id="form">

                        <div class="modal-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="provinsi">Provinsi</label>
                                    <select id="provinsi" class="form-control" name="provinsi" onchange="getKotkab();">
                                        <option selected value="0">Pilih provinsi</option>
                                        <?php foreach ($provinsi as $val) : ?>
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
                                    <label for="alamat">Pesan</label>
                                    <textarea class="form-control" id="alamat" rows="5" name="pesan">isikan pesan</textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="email">Link</label>
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
</body>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="<?= base_url() ?>assets/js/script.js"></script>

<script>
    var isi = 'isikan alamat lengkap';
    $(document).ready(function() {
        $('#alamat').click(function() {
            this.innerHTML = '';
        });
    });
</script>

</html>