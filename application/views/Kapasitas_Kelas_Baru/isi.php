<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <div class="card-body">
            <div class="row">
                <div class="col-8 mr-auto">
                    <div class="card-body">
                        <h2 class="mt-3 mb-3"><?= $title." ".$makul->nama ?></h2>
                        <div class="row ">
                            <div class="col-5">
                                <label for="title">MATA KULIAH </label>
                            </div>
                            <div class="col">
                                <label for="title">: <?= $makul->nama.' / '.$makul->kelas ?> </label>
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
                        </div>
                </div>
            </div>
            <hr>

            <?php
                $cetak = ['makul' => $makul];
                  ?> 
            <!-- TABEL -->
            <table class="table table-bordered" id="tabelku" width="100%">
                    <thead>
                        <tr class="text-center">
                            <th>Belum Mengambil</th>
                            <th>Mengulang</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                    <td class="text-center"><?php $sql = "SELECT DISTINCT p.nim FROM presensi p JOIN makul m ON p.idMakul=m.idMakul 
                                                    WHERE m.nama LIKE '" .$makul->nama. "'";
                                                   
                                                    $jumlahNim = $this->db->query($sql)->num_rows();
                                                    
                                                    $sql = "SELECT DISTINCT nim FROM mahasiswa WHERE status = 'AKTIF'";
                                                    $hasil = abs($this->db->query($sql)->result_array()) - $jumlahNim;
                                                    echo abs($hasil);
                                                    ?>
                                                    </td>
                    <td class="text-center"><?php $sql = "SELECT n.nilai AS jumlah FROM nilaiakhir n JOIN makul m WHERE n.idMakul = m.idMakul AND n.nilai NOT LIKE 'A' AND n.nilai NOT LIKE 'B' AND m.nama LIKE '" .$makul->nama. "' ";
                                                    $jumlah = $this->db->query($sql)->num_rows();
                                                    echo $jumlah[0]['jumlah'];
                                                    // $total += $jumlah[0]['jumlah'];
                                                    ?></td>
                    </tr>
                    </tbody>
                </table>
                             
        </div>
    </main>

