<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <div class="container">
                <div class="row mt-3">
                    <div class="col-md-10">
                        <div class="card">
                            <div class="card-header">
                                Detail Data Pendadaran
                            </div>

                            <div class="card-body">
                                <table>
                                    <tr>
                                        <td width="130">
                                            <img src="http://exelsa.usd.ac.id/lihatGambar.php?act=nim&nim=<?= $pendadaran['nim']; ?>"
                                                width="100">
                                        </td>
                                        <td>
                                            <h5 class="card-title"><?= $pendadaran['nama']; ?></h5>
                                            <p class="card-text"><?= $pendadaran['nim']; ?></p>
                                        </td>
                                    </tr>
                                </table>
                                <br>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td width="200">
                                                <p class="card-text">Dosen Pembimbing 1:</p>
                                            </td>
                                            <td>
                                                <p class="card-text"><?= $pendadaran['dosen1']; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="card-text">Dosen Pembimbing 2:</p>
                                            </td>
                                            <td>
                                                <p class="card-text"><?= $pendadaran['dosen2']; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="card-text">Judul:</p>
                                            </td>
                                            <td>
                                                <p class="card-text"><?= $pendadaran['judul']; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="card-text">Reviewer Kolokium:</p>
                                            </td>
                                            <td>
                                                <p class="card-text"><?= $pendadaran['reviewer']; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="card-text">Ketua Penguji:</p>
                                            </td>
                                            <td>
                                                <p class="card-text"><?= $pendadaran['ketuaPenguji']; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="card-text">Sekretaris Penguji:</p>
                                            </td>
                                            <td>
                                                <p class="card-text"><?= $pendadaran['sekretarisPenguji']; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="card-text">Anggota Penguji:</p>
                                            </td>
                                            <td>
                                                <p class="card-text"><?= $pendadaran['anggotaPenguji']; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="card-text">Tanggal:</p>
                                            </td>
                                            <td>
                                                <p class="card-text"><?= format_indo($pendadaran['tanggal']); ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="card-text">Jam:</p>
                                            </td>
                                            <td>
                                                <p class="card-text"><?= $pendadaran['durasi']; ?> WIB</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="card-text">Ruangan:</p>
                                            </td>
                                            <td>
                                                <p class="card-text"><?= $pendadaran['ruang']; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="card-text">Keterangan:</p>
                                            </td>
                                            <td>
                                                <p class="card-text"><?= $pendadaran['keterangan']; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="card-text">Nilai:</p>
                                            </td>
                                            <td>
                                                <p class="card-text"><?= $pendadaran['nilai']; ?></p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <br>
                                <a href="<?= base_url() ?>pendadaran" class="btn btn-danger float-right"><i
                                        class="fas fa-arrow-left"></i> Kembali</a>
                                <a href="<?= base_url() ?>pendadaran/pdf/<?= $pendadaran['id']; ?>"
                                    class="btn btn-primary"><i class="fas fa-file-pdf"></i> Detail</a>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-download"></i> Cetak Undangan
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="<?= base_url() ?>pendadaran/undangan/<?= $pendadaran['id']; ?>"
                                            class="dropdown-item"><i class="fas fa-file-pdf"></i> Undangan PDF</a>
                                        <a href="<?= base_url() ?>pendadaran/undangantxt/<?= $pendadaran['id']; ?>"
                                            class="dropdown-item"><i class="fas fa-file-alt"></i> Undangan TXT</a>
                                        <a href="<?= base_url() ?>pendadaran/undanganWord/<?= $pendadaran['id']; ?>"
                                            class="dropdown-item"><i class="fas fa-file-word"></i> Undangan WORD</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>