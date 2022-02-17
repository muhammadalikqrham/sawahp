<?php
include_once '../conf/function.php';

if (downgradeUser($_GET['id']) > 0) {

  echo  "
          <script>
            alert('Akun Tersebut Telah Menjadi User!');
            document.location.href = 'http://localhost/sawahp/admin/user'
          </script>";
} else {
  echo 'Data gagal Dihapus';
}
