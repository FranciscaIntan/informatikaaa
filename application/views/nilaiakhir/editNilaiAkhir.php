
    <div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <div class="row">
            <h2 class="mt-4 ml-4"><?= $title ?></h2>
        </div>
            <div class="row">
                <div class="col">
                    <div class="col">
                        <form action="<?= base_url('nilaiakhir/editNilaiMahasiswa'); ?>" method="post">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="nim">NIM</label>
                                    <input type="text" class="form-control" id="nim" name="nim"
                                        value="<?= $data['nim'] ?>">
                                    <?= form_error('nama', '<small class="text-danger pl-2">', '</small>') ?>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama Mahasiswa</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        value="<?= $data['nama'] ?>">
                                    <?= form_error('naman', '<small class="text-danger pl-2">', '</small>') ?>
                                </div>
                                <div class="form-group">
                                    <label for="makul">Matakuliah</label>
                                    <input type="text" class="form-control" id="makul" name="makul"
                                        value="<?= $data['namamakul'] ?>">
                                    <?= form_error('makul', '<small class="text-danger pl-2">', '</small>') ?>
                                </div>
                                <div class="form-group">
                                    <label for="dosen">Dosen</label>
                                    <input type="text" class="form-control" id="dosen" name="dosen"
                                        value="<?= $data['namadosen'] ?>" readonly>
                                    <?= form_error('dosen', '<small class="text-danger pl-2">', '</small>') ?>
                                </div>
                                <div class="form-group">
                                    <label for="nilai">Nilai</label>
                                    <input type="text" class="form-control" id="nilai" name="nilai"
                                        value="<?= $data['nilai'] ?>">
                                    <?= form_error('nilai', '<small class="text-danger pl-2">', '</small>') ?>
                                </div>
                                <div class="form-group">
                                    <a href="<?= base_url('nilaiakhir/isi/'.$data['idMakul']); ?>"
                                        class="btn btn-secondary">Kembali</a>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col">
                    <div class="table-responsive mt-1">
                       

                </div>
            </div>
        </div>
    </main>


    <script type="text/javascript">
    $(document).ready(function() {
        $('#tabelku').dataTable({
            "scrollY": "450px",
            "scrollCollapse": true,
            "paging": false,
            "bAutoWidth": false
        });
    });
    </script>