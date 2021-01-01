<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <div class="card-body">
                <div class="row">
                    <div class="col-auto mr-auto">
                        <h2 class=""><?= $title ?></h2>
                    </div>
                </div>
                <hr>
                <?= $this->session->flashdata('message'); ?>
                <div class="table-responsive">
                    <table class="table table-bordered" id="tabelku" width="100%">
                        <thead>
                            <tr class="text-center">
                                <th>NO</th>
                                <th>MAKUL</th>
                                <th>JUMLAH MAHASISWA</th>
                                <th>ACTION</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($data->result_array() as $row) : ?>
                                <tr>
                                    <td class="text-center"><?= $i ?></td>
                                    <td><?php echo $row['nama']; ?></td>
                                    <td class="text-center">
                                        <?php $sql = "SELECT DISTINCT p.nim FROM presensi p JOIN makul m ON p.idMakul=m.idMakul 
                                                    WHERE m.nama LIKE '" . $row['nama'] . "'";

                                        $jumlahNim = $this->db->query($sql)->num_rows();
                                        $sql = "SELECT DISTINCT nim FROM mahasiswa WHERE status = 'AKTIF'";
                                        $hasil = abs($this->db->query($sql)->num_rows()) - $jumlahNim;
                                        $sql = "SELECT COUNT( n.nilai) AS jumlah FROM nilaiakhir n JOIN makul m WHERE n.idMakul = m.idMakul AND n.nilai NOT LIKE 'A' AND n.nilai NOT LIKE 'B' AND m.nama LIKE '" . $row['nama'] . "' ";
                                        $jumlah = $this->db->query($sql)->result_array();
                                        $jmlh = abs($hasil) + abs($jumlah[0]['jumlah']);
                                        echo $jmlh;
                                        // $total += $jumlah[0]['jumlah'];
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?php echo base_url(); ?>KapasitasKelasBaru/isi/<?= $row['idMakul']; ?>" class=" badge badge-success text-center"> <i class="glyphicon glyphicon-edit"></i>
                                            Detail</a>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php $data = ['jumlahTotal' => $jmlh, 'jumlahMengulang' => $jumlah[0]['jumlah'], 'jumlahBelumMengambil' => $hasil];
                    // $this->session->set_userdata($data);
                    $this->session->set_tempdata('item', $data);

                    ?>
                    <hr>
                    <a href="<?= base_url('KapasitasKelasBaru/cetakAll/') ?>" class="btn btn-success float-right">
                        <i class="fas fa-file-excel" aria-hidden="true"></i> CETAK EXCEL</a>
                </div>
            </div>
        </div>
    </main>



    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Presensi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" enctype="multipart/form-data" action="<?php echo base_url("presensi/upload") ?>">
                    <div class="modal-body">
                        <input type="file" class="form-control-file" id="file" name="file[]" multiple>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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