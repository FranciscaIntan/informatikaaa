<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">

            <div class="row">
                <div class="col-9 mr-auto">
                    <div class="card-body">
                        <div class="row ">
                            <h2 class="mt-3 mb-3"><?= $title . " " . $makul->nama ?></h2>
                        </div>
                        <div class="row ">
                            <div class="col-5">
                                <label for="title">MATA KULIAH </label>
                            </div>
                            <div class="col">
                                <label for="title">: <?= $makul->nama . ' / ' . $makul->kelas ?> </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5">
                                <label for="title">TAHUN AJARAN </label>
                            </div>
                            <div class="col">
                                <label for="title">: <?= $makul->tahun ?>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5">
                                <label for="title">SEMESTER </label>
                            </div>
                            <div class="col">
                                <label for="title">: <?= $makul->semester ?>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5">
                                <label for="title">DOSEN </label>
                            </div>
                            <div class="col">
                                <label for="title">: <?= $this->NilaiAkhirModel->cariDosenNew($makul->idMakul)->dosen ?>
                                </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-auto">
                                <a type="button" class="btn btn-secondary" href="<?= base_url('nilaiakhir'); ?>">
                                    <i class="fas fa-chevron-left"></i> Kembali</a>
                                <!-- <a type="button" class="btn btn-success"
                                    href="<?= base_url('nilaiakhir/editNilaiAkhir/') . $makul->idMakul; ?>">
                                    <i class="fas fa-edit"></i> Edit </a>-->
                                <a type="button" class="btn btn-danger" href="<?= base_url('nilaiakhir/deleteDaftarNilai/' . $makul->idMakul); ?>" onclick="return confirm('Are you sure you want to delete grade list of <?= $makul->nama; ?>?');">
                                    <i class="far fa-trash-alt"></i> Hapus Daftar Nilai</a>
                                <a type="button" class="btn btn-primary" href=""> Laporan Kapasitas Kelas</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <!--<div class="table-responsive mt-1">

                <table class="table table-bordered" id="tabelku" width="100%">
                    <thead>
                        <tr class="text-center">
                            <th>NO</th>
                            <th>NIM</th>
                            <th>NAMA</th>
                            <th>NILAI AKHIR</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($mahasiswa->result_array() as $row) : ?>
                        <tr>
                            <td class="text-center"><?= $i ?></td>
                            <td><?php echo $row['nim']; ?></td>
                            <td><?php echo $row['nama']; ?></td>
                            <td class="text-center">A</td>
                            <td class="text-center"><a type="button" class="btn btn-success"
                                    href="<?= base_url('nilaiakhir/editNilaiAkhir/') . $makul->idMakul; ?>">
                                    <i class="fas fa-edit"></i></a>
                                <a type="button" class="btn btn-danger"
                                    href="<?= base_url('nilaiakhir/deleteNilaiAkhir/' . $makul->idMakul); ?>"
                                    onclick="return confirm('Are you sure you want to delete grade list of <?= $makul->nama; ?>?');">
                                    <i class="far fa-trash-alt"></i></a></td>
                        </tr>
                        <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>-->
            <?= $this->session->flashdata('message'); ?>
            <div class="table-responsive mt-1">

                <table class="table table-bordered" id="tabelku" width="100%">
                    <thead>
                        <tr class="text-center">
                            <th>NO</th>
                            <th>NIM</th>
                            <th>NAMA</th>
                            <th>NILAI AKHIR</th>
                            <th>ACTION</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($mahasiswa->result_array() as $row) : ?>
                            <tr>
                                <td class="text-center"><?= $i ?></td>
                                <td><?php echo $row['nim']; ?></td>
                                <td><?php echo $row['nama']; ?></td>
                                <td class="text-center"><?php echo $row['nilai']; ?></td>
                                <td class="text-center">
                                    <a type="button" class="btn btn-success" href="<?= base_url('nilaiakhir/editNilaiAkhir/') . $row['idNilaiAkhir']; ?>"><i class="fas fa-edit"></i>Edit</a>
                                    <!-- <a type="button" class="btn btn-danger" href="<?= base_url('nilaiakhir/deleteNilaiAkhir/') . $row['idNilaiAkhir']; ?>" onclick="return confirm('Are you sure you want to delete grade list of <?= $makul->nama; ?>?');"><i class="far fa-trash-alt"></i></a> -->
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>



        </div>
    </main>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#tabelku').dataTable({
                "scrollY": "400px",
                "scrollCollapse": true,
                "paging": true,
                "bAutoWidth": false
            });
        });
    </script>