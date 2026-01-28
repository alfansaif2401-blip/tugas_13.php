<?php
$dsn = 'mysql:dbname=db_akademik_petik;host=localhost';
$user = 'root';
$password = '';

try {
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, 
                       PDO::ERRMODE_EXCEPTION);
   $dbh->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY,TRUE);
   echo 'Alhamdulillah Sukses koneksi Database';
   } catch (PDOException $e) {
    echo 'Gagal Koneksi dengan sebab : '.$e->getMessage();                    
    }
?>