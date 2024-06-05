<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="Style.css">
    <title>Rental Motor</title>
</head>
<body>
    <header class="atas">
        <h2>313 Ansa Rental</h2>
    </header>
    <div class="container">
        <div class="Inputan">
            <form action="" method="post" id="">
                <h1><b>Rental Motor</b></h1>
                <div class="">
                    <label for="Namapel" class="form-label">Nama Pelanggan :</label>
                    <input type="text" name="Namapel" id="Namapel" class="form-control" required>
                </div>
                <div class="">
                    <label for="Waktu" class="form-label">Lama Rental (Perhari) :</label>
                    <input type="number" name="Waktu" id="Waktu" class="form-control" min="1" max="100" required>
                </div>
                <div class="">
                    <label for="jenismot" class="form-label">Jenis Motor :</label>
                    <select type="name" name="jenismot" id="jenismot" class="form-control" required>
                        <option value="Vario">Vario</option>
                        <option value="Mio">Mio</option>
                        <option value="Vesmet">Vesmet</option>
                        <option value="Scoopy">Scoopy</option>
                    </select>
                    <br>
                    <button type="submit" class="btn btn-secondary"><i class="bx bxs-printer"></i>Bayar & Cetak Struk</button>
                </div>
            </form>
        </div>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            class RentalMotor {
                protected $Namapel;
                protected $jenismot;
                protected $Waktu;
                protected $DataHmotor = ["Vario" => 70000, "Mio" => 50000, "Vesmet" => 100000, "Scoopy" => 60000];
                protected $listMember = ['Sazidan', 'Sam', 'Alex', 'Ara'];
                protected $Diskon = 5;
                protected $Pajak = 10000;

                public function __construct($Namapel, $jenismot, $Waktu) {
                    $this->Namapel = $Namapel;
                    $this->jenismot = $jenismot;
                    $this->Waktu = $Waktu;
                }

                public function getNamapel() {
                    return $this->Namapel;
                }

                public function getJenisMot() {
                    return $this->jenismot;
                }

                public function getWaktu() {
                    return $this->Waktu;
                }

                public function getMemberStatus() {
                    if (in_array($this->Namapel, $this->listMember)) {
                        return "Member";
                    } else {
                        return "Non Member";
                    }
                }

                public function getHargaPerHari() {
                    return $this->DataHmotor[$this->jenismot];
                }

                public function getDiskon() {
                    if ($this->getMemberStatus() == "Member") {
                        return $this->Diskon;
                    } else {
                        return 0;
                    }
                }

                public function getPajak() {
                    return $this->Pajak;
                }
            }

            class TotalBayar extends RentalMotor {
                public function getTotalHarga() {
                    $hargaPerHari = $this->getHargaPerHari();
                    $diskon = $this->getDiskon();
                    $pajak = $this->getPajak();
                    $waktu = $this->getWaktu();

                    $hargaTotal = ($hargaPerHari * $waktu) - ($hargaPerHari * $diskon / 100) + $pajak;
                    return $hargaTotal;
                }
            }

            $Namapel = $_POST['Namapel'];
            $jenismot = $_POST['jenismot'];
            $Waktu = $_POST['Waktu'];

            $rental = new TotalBayar($Namapel, $jenismot, $Waktu);
            echo "<div class='ContainerStruck'>";
            echo "<div class='Struck'>";
            echo "<h4>313 Ansa Rental</h4>";
            echo "Jl. Ketikung Dua, Kecamatan NT <br> Bandar Hati <br>";
            echo "<hr style='border: 1px dashed #000;'>";
            echo "{$rental->getNamapel()}, Anda berstatus sebagai {$rental->getMemberStatus()} dan mendapatkan diskon sebesar {$rental->getDiskon()}%<br>";
            echo "Jenis motor yang dirental adalah ".$rental->getJenisMot(). " selama " .$rental->getWaktu(). "hari<br>";
            echo "Harga rental per-harinya adalah Rp. " . number_format($rental->getHargaPerHari(), 0, ',', '.') . "<br>";
            echo "Besarnya yang harus dibayarkan adalah Rp. " . number_format($rental->getTotalHarga(), 0, ',', '.') . "<br>";
            echo "<hr style='border: 1px dashed #000;'>";
            echo "Terima Kasih <br> Atas Kunjungannya<br>";
            echo "<hr style='border: 1px dashed #000;'>";
            echo "</div>";
            echo "<button type='submit' class='btn btn-primary'><a href='index.php' style='text-decoration: none; color: white;'><i class='bx bx-left-arrow-alt'></i> Kembali  </a></button>";
            echo "<br>";
            echo "<br>";
            echo "<br>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
