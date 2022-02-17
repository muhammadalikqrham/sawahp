<?php
include_once '../conf/function.php';

if (upgradeUser($_GET['id']) > 0) {

  echo  "
          <script>
            alert('Akun Tersebut Telah Menjadi Admin!');
            document.location.href = 'http://localhost/sawahp/admin/user'
          </script>";
} else {
  echo 'Data gagal Dihapus';
}
