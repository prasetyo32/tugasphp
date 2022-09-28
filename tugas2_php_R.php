<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Memproses Form Data Pegawai by R.P</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <style>
      .card {
        margin: 2rem;
      }
      h3 {
        margin-top: 1rem;
      }
      table {
        border: 1px solid black;
        width: 100%;
      }
      tr, th, td {
        border: 1px solid black;
      }
      .scroll {
        display: block;
        width: 100%;
        overflow: scroll;
      }
    </style>
  </head>
  <body>
    <div class="container px-5 my-5">
      <h3 class="text-center">Form Data Pegawai by R.P</h3>
        <form id="contactForm" method="post">
            <div class="mb-3">
                <label class="form-label" for="nama">Nama Pegawai</label>
                <input class="form-control" name="nama" id="nama" type="text" placeholder="Nama Lengkap" data-sb-validations="" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="agama">Agama</label>
                <select class="form-select" name="agama" id="agama" aria-label="Agama">
                    <option value="---   Pilih Agama   ---">--- Pilih Agama ---</option>
                    <option value="Islam">Islam</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Katholik">Katholik</option>
                    <option value="Buddha">Buddha</option>
                    <option value="Hindu">Hindu</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label d-block">Jabatan</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" value="Manager" id="manager" type="radio" name="jabatan" data-sb-validations="" />
                    <label class="form-check-label" for="manager">Manager</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" value="Asisten Manager" id="asistemManager" type="radio" name="jabatan" data-sb-validations="" />
                    <label class="form-check-label" for="asistemManager">Asisten Manager</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" value="Kepala Bagian" id="kepalaBagian" type="radio" name="jabatan" data-sb-validations="" />
                    <label class="form-check-label" for="kepalaBagian">Kepala Bagian</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" value="Staff" id="staff" type="radio" name="jabatan" data-sb-validations="" />
                    <label class="form-check-label" for="staff">Staff</label>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label d-block">Status</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" value="Menikah" id="menikah" type="radio" name="status" data-sb-validations="" />
                    <label class="form-check-label" for="menikah">Menikah</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" value="Belum Menikah" id="belumMenikah" type="radio" name="status" data-sb-validations="" />
                    <label class="form-check-label" for="belumMenikah">Belum Menikah</label>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="jumlahAnak">Jumlah Anak</label>
                <input class="form-control" name="jumlahAnak" id="jumlahAnak" type="text" placeholder="Jumlah Anak" data-sb-validations="" />
            </div>
            <div class="d-grid">
                <button class="btn btn-primary" name="proses" id="submitButton" type="submit">Submit</button>
            </div>
        </form>
    </div>
    <?php 
      //tangkap request
      $nama = $_POST['nama'];
      $agama = $_POST['agama'];
      $jabatan = $_POST['jabatan'];
      $status = $_POST['status'];
      $jmlAnak = $_POST['jumlahAnak'];
      $submit = $_POST['proses'];
      //tentukan gaji pokok
      switch($jabatan){
        case 'Manager': $gapok = 20000000; break;
        case 'Asisten Manager': $gapok = 15000000; break;
        case 'Kepala Bagian': $gapok = 10000000; break;
        case 'Staff': $gapok = 4000000; break;
        default: $gapok = ''; break;
      }
      //tentukan tunjangan jabatan
      $tujab = 0.2 * $gapok;
      //tentukan tunjangan keluarga
      if($status == 'Menikah' && $jmlAnak > 0 && $jmlAnak <= 2) $tukel = 0.05 * $gapok;
      else if($status == 'Menikah' && $jmlAnak > 2 && $jmlAnak <= 5) $tukel = 0.1 * $gapok;
      else if($status == 'Menikah' && $jmlAnak > 5) $tukel = 0.15 * $gapok;
      else $tukel;
      //tentukan gaji kotor
      $gakot = $gapok + $tujab + $tukel;
      //tentukan zakat profesi
      $zakrof = ($agama == 'Islam' && $gakot >= 6000000) ? 0.025 * $gakot : 0;
      //tentukan take home pay
      $taHomPay = $gakot - $zakrof;
      
      
    if(isset($submit)){ ?>
    <div class="card">
      <h3 class="text-center">Data Pegawai</h3>
      <div class="card-body">
        <table class="scroll" cellpadding="10" cellspacing="0">
          <thead>
            <tr bgcolor="aqua">
              <th scope="col">Nama Pegawai</th>
              <th scope="col">Agama</th>
              <th scope="col">Jabatan</th>
              <th scope="col">Status</th>
              <th scope="col">Jumlah Anak</th>
              <th scope="col">Gaji Pokok</th>
              <th scope="col">Tunjangan Jabatan</th>
              <th scope="col">Tunjangan Keluarga</th>
              <th scope="col">Gaji Kotor</th>
              <th scope="col">Zakat Profesi</th>
              <th scope="col">Take Home Pay</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><?= $nama; ?></td>
              <td><?= $agama; ?></td>
              <td><?= $jabatan; ?></td>
              <td><?= $status; ?></td>
              <td><?= $jmlAnak; ?></td>
              <td>
                <?= 'Rp. '. number_format($gapok, 2, ',', '.'); ?>
              </td>
              <td>
                <?= 'Rp. '. number_format($tujab, 2, ',', '.'); ?>
              </td>
              <td>
                <?= 'Rp. '. number_format($tukel, 2, ',', '.'); ?>
              </td>
              <td>
                <?= 'Rp. '. number_format($gakot, 2, ',', '.'); ?>
              </td>
              <td>
                <?= 'Rp. '. number_format($zakrof, 2, ',', '.'); ?>
              </td>
              <td>
                <?= 'Rp. '. number_format($taHomPay, 2, ',', '.'); ?>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <?php } ?>
    
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>