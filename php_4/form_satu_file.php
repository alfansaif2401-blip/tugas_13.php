<!DOCTYPE html>
<html>
<head>
    <title>Form Satu File</title>
</head>
<body>

 <h2>Form Biodata</h2>
 <form method="post">  
   Nama: <input type="text" name="name"><br><br>
   Asal:<input type="text" name="asal"><br><br>
   <button type="submit">Simpan</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<h3>Output:</h3>"; 
    echo "Nama: " . $_POST['name'] . "<br>";
    echo "Asal: " . $_POST['asal'] . "<br>";
}
?>
</body>
</html>