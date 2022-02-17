<?php include_once '../conf/function.php' ?>
<?php include_once '../template/header.php'; ?>
<?php

$bobot = query("SELECT * FROM tb_user WHERE status != 'Super Admin'");

?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <?php if ($_SESSION['status'] == 'User' || $_SESSION['status'] == 'Admin') : ?>
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>ANDA TIDAK PUNYA AKSES KE MENU INI</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blank Page</li>
            </ol>
          </div>
        </div>
      </div>
    <?php else : ?>
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Halaman User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blank Page</li>
            </ol>
          </div>
        </div>
      </div>

      <!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Tabel Data Alternatif</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        <!-- /.card -->
        <a href="http://localhost/sawahp/admin/alternatif/add_alternatif.php" class="btn btn-secondary"><i class="fas fa-plus mr-3"></i>Tambah Alternatif</a>
        <div class="card mt-3">
          <div class="card-header">
            <h3 class="card-title">Data Alternatif</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Email</th>
                  <th>Nama</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 0;
                foreach ($bobot as $row) :
                ?>
                  <tr>
                    <td><?= ++$no ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['nama'] ?></td>
                    <td align="center">
                      <?php if ($row['status'] == 'User') : ?>
                        <a href="update.php?id=<?= $row['id_user'] ?>" class="btn btn-success btn-sm" onclick="return confirm('Yakin ingin mengubah status user  ini ?')">Angkat Jadi Admin</a>
                      <?php else : ?>
                        <a href="downgrade.php?id=<?= $row['id_user'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin mengubah status user  ini ?')">Ubah Jadi User</a>
                      <?php endif; ?>
                      <!-- <a href="hapus.php?id=<?= $row['id_user'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini ?')"> <i class="fas fa-trash"></i></a> -->
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.card -->
    <?php endif; ?>

    <?php include_once '../template/footer.php' ?>