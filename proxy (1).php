<?php
// proxy.php - Fetches M3U playlist with proper cookie handling and fresh tokens
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Allow your frontend to access this proxy

$m3uUrl = 'https://clarity-tv.vercel.app/api/playlist/?id=ALLINONE';
$cookieJar = __DIR__ . '/cookies.txt'; // File to store cookies (must be writable)

// Headers mimicking a real browser (update if needed)
$headers = [
    'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36',
    'Accept: */*',
    'Accept-Language: en-IN,en-GB;q=0.9,en-US;q=0.8,en;q=0.7,hi;q=0.6',
    'Referer: https://bashserver.xyz/kid.php',
    'sec-ch-ua: "Not:A-Brand";v="99", "Google Chrome";v="145", "Chromium";v="145"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Windows"',
    'sec-fetch-dest: video',
    'sec-fetch-mode: no-cors',
    'sec-fetch-site: same-origin'
];

// Initialize cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $m3uUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 15);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Enable in production with proper CA

// Cookie handling: read and write cookies to jar
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieJar);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieJar);

$m3uContent = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// If fetch fails, use embedded fallback playlist (you MUST paste the full playlist here)
if ($httpCode !== 200 || !$m3uContent) {
    $m3uContent = '#EXTM3U
#EXTINF:-1 tvg-id="123" group-title="Kids" tvg-logo="https://jiotv.catchup.cdn.jio.com/dare_images/images/Cartoon_Network_Hindi.png",Cartoon Network Hindi
#KODIPROP:inputstream.adaptive.license_type=clearkey
#KODIPROP:inputstream.adaptive.license_key=ea48cf7b24dd54dd98c369626b9ad105:ee5778d627dfae2c2affc02d76e8db6c
#EXTHTTP:{"cookie":"__hdnea__=st=1772450931~exp=1772537331~acl=/*~hmac=dc35e4a3c611bfa3bf0e6cd468c9effc4eb8921f4f67a9e339875fb1c6a8dd4f"}
https://jiotvbpkmob.cdn.jio.com/bpk-tv/CNHindi_BTS/output/index.mpd
#EXTINF:-1 tvg-id="124" group-title="Kids" tvg-logo="https://jiotv.catchup.cdn.jio.com/dare_images/images/Cartoon_Network_Tamil.png",Cartoon Network Tamil
#KODIPROP:inputstream.adaptive.license_type=clearkey
#KODIPROP:inputstream.adaptive.license_key=553fc9bdb0115b24b23d04be203d1b9d:a220f0a32aaee1e6989ef8e6a6728fe1
#EXTHTTP:{"cookie":"__hdnea__=st=1772450931~exp=1772537331~acl=/*~hmac=dc35e4a3c611bfa3bf0e6cd468c9effc4eb8921f4f67a9e339875fb1c6a8dd4f"}
https://jiotvbpkmob.cdn.jio.com/bpk-tv/CartoonNetworkTamil_BTS/output/index.mpd
#EXTINF:-1 tvg-id="125" group-title="Kids" tvg-logo="https://jiotv.catchup.cdn.jio.com/dare_images/images/Cartoon_Network_Telugu.png",Cartoon Network Telugu
#KODIPROP:inputstream.adaptive.license_type=clearkey
#KODIPROP:inputstream.adaptive.license_key=3e5ec63e26c1520380236941c3848f68:f944e7ee9260a9e6239170db4d6fa713
#EXTHTTP:{"cookie":"__hdnea__=st=1772450931~exp=1772537331~acl=/*~hmac=dc35e4a3c611bfa3bf0e6cd468c9effc4eb8921f4f67a9e339875fb1c6a8dd4f"}
https://jiotvbpkmob.cdn.jio.com/bpk-tv/CNTelugu_BTS/output/index.mpd
#EXTINF:-1 tvg-id="218" group-title="Kids" tvg-logo="https://jiotv.catchup.cdn.jio.com/dare_images/images/Disney_Channel.png",Disney Channel
#KODIPROP:inputstream.adaptive.license_type=clearkey
#KODIPROP:inputstream.adaptive.license_key=5181d3e6698055578cedc5bfc86b3e56:3dca7917d8cf9bb7095dc72b48bdcd3c
#EXTHTTP:{"cookie":"__hdnea__=st=1772450931~exp=1772537331~acl=/*~hmac=dc35e4a3c611bfa3bf0e6cd468c9effc4eb8921f4f67a9e339875fb1c6a8dd4f"}
https://jiotvbpkmob.cdn.jio.com/bpk-tv/Disney_Channel_BTS/output/index.mpd
#EXTINF:-1 tvg-id="219" group-title="Kids" tvg-logo="https://jiotv.catchup.cdn.jio.com/dare_images/images/Disney_International_HD.png",Disney International HD
#KODIPROP:inputstream.adaptive.license_type=clearkey
#KODIPROP:inputstream.adaptive.license_key=d0e021aa91c65e68a7028c2a6a762eca:d50822403365e360d12840251cecee84
#EXTHTTP:{"cookie":"__hdnea__=st=1772450931~exp=1772537331~acl=/*~hmac=dc35e4a3c611bfa3bf0e6cd468c9effc4eb8921f4f67a9e339875fb1c6a8dd4f"}
https://jiotvbpkmob.cdn.jio.com/bpk-tv/Disney_International_HD_BTS/output/index.mpd
#EXTINF:-1 tvg-id="220" group-title="Kids" tvg-logo="https://jiotv.catchup.cdn.jio.com/dare_images/images/Disney_Junior.png",Disney Junior
#KODIPROP:inputstream.adaptive.license_type=clearkey
#KODIPROP:inputstream.adaptive.license_key=1b1f9702f7d853c1b198495f64924311:40e11e60a12dd6c154dfea0ffbd5bda8
#EXTHTTP:{"cookie":"__hdnea__=st=1772450931~exp=1772537331~acl=/*~hmac=dc35e4a3c611bfa3bf0e6cd468c9effc4eb8921f4f67a9e339875fb1c6a8dd4f"}
https://jiotvbpkmob.cdn.jio.com/bpk-tv/Disney_Junior_BTS/output/index.mpd
#EXTINF:-1 tvg-id="315" group-title="Kids" tvg-logo="https://jiotv.catchup.cdn.jio.com/dare_images/images/Hungama.png",Hungama
#KODIPROP:inputstream.adaptive.license_type=clearkey
#KODIPROP:inputstream.adaptive.license_key=454f8353caac500d95d641e0c7cfe048:0aaca46ea0f5096335598781fbe590e4
#EXTHTTP:{"cookie":"__hdnea__=st=1772450931~exp=1772537331~acl=/*~hmac=dc35e4a3c611bfa3bf0e6cd468c9effc4eb8921f4f67a9e339875fb1c6a8dd4f"}
https://jiotvbpkmob.cdn.jio.com/bpk-tv/Hungama_BTS/output/index.mpd
#EXTINF:-1 tvg-id="517" group-title="Kids" tvg-logo="https://jiotv.catchup.cdn.jio.com/dare_images/images/Nickelodeon_Jr.png",Nickelodeon Jr.
#KODIPROP:inputstream.adaptive.license_type=clearkey
#KODIPROP:inputstream.adaptive.license_key=0b04fb6dd388548d93a63f7286a00de4:a32b221fccc548fac94541ff4c1143e1
#EXTHTTP:{"cookie":"__hdnea__=st=1772450931~exp=1772537331~acl=/*~hmac=dc35e4a3c611bfa3bf0e6cd468c9effc4eb8921f4f67a9e339875fb1c6a8dd4f"}
https://jiotvbpkmob.cdn.jio.com/bpk-tv/Nickelodeon_Jr_MOB/WDVLive/index.mpd
#EXTINF:-1 tvg-id="552" group-title="Kids" tvg-logo="https://jiotv.catchup.cdn.jio.com/dare_images/images/Pogo_Hindi.png",Pogo Hindi
#KODIPROP:inputstream.adaptive.license_type=clearkey
#KODIPROP:inputstream.adaptive.license_key=4b967f351139503a88b1d1945203150b:c3e26279cc513e13154958f934141dc0
#EXTHTTP:{"cookie":"__hdnea__=st=1772450931~exp=1772537331~acl=/*~hmac=dc35e4a3c611bfa3bf0e6cd468c9effc4eb8921f4f67a9e339875fb1c6a8dd4f"}
https://jiotvbpkmob.cdn.jio.com/bpk-tv/Pogo_Hindi_BTS/output/index.mpd
#EXTINF:-1 tvg-id="553" group-title="Kids" tvg-logo="https://jiotv.catchup.cdn.jio.com/dare_images/images/Pogo_Tamil.png",Pogo Tamil
#KODIPROP:inputstream.adaptive.license_type=clearkey
#KODIPROP:inputstream.adaptive.license_key=d19984624fc15209b3cb5cf3bf99232f:baca6aa9494ed43cf02975eda742eeab
#EXTHTTP:{"cookie":"__hdnea__=st=1772450931~exp=1772537331~acl=/*~hmac=dc35e4a3c611bfa3bf0e6cd468c9effc4eb8921f4f67a9e339875fb1c6a8dd4f"}
https://jiotvbpkmob.cdn.jio.com/bpk-tv/Pogo_Hindi_MOB/WDVLive/index.mpd
#EXTINF:-1 tvg-id="690" group-title="Kids" tvg-logo="https://jiotv.catchup.cdn.jio.com/dare_images/images/Sonic_Bangla.png",Sonic Bangla
#KODIPROP:inputstream.adaptive.license_type=clearkey
#KODIPROP:inputstream.adaptive.license_key=5d26427bf9a85808bd34848fa7ae1f8a:aac720bb73a9db2b2cb64763d5f8942b
#EXTHTTP:{"cookie":"__hdnea__=st=1772450931~exp=1772537331~acl=/*~hmac=dc35e4a3c611bfa3bf0e6cd468c9effc4eb8921f4f67a9e339875fb1c6a8dd4f"}
https://jiotvbpkmob.cdn.jio.com/bpk-tv/Sonic_Bangla_MOB/WDVLive/index.mpd
#EXTINF:-1 tvg-id="691" group-title="Kids" tvg-logo="https://jiotv.catchup.cdn.jio.com/dare_images/images/sonic_Hindi.png",Sonic Hindi
#KODIPROP:inputstream.adaptive.license_type=clearkey
#KODIPROP:inputstream.adaptive.license_key=fdf348b106045794a5ab265d08c677ef:83f7bddd4290a229e07c62c6b78f1e74
#EXTHTTP:{"cookie":"__hdnea__=st=1772450931~exp=1772537331~acl=/*~hmac=dc35e4a3c611bfa3bf0e6cd468c9effc4eb8921f4f67a9e339875fb1c6a8dd4f"}
https://jiotvbpkmob.cdn.jio.com/bpk-tv/sonic_Hindi_BTS/output/index.mpd
#EXTINF:-1 tvg-id="692" group-title="Kids" tvg-logo="https://jiotv.catchup.cdn.jio.com/dare_images/images/Sonic_Kannada.png",Sonic Kannada
#KODIPROP:inputstream.adaptive.license_type=clearkey
#KODIPROP:inputstream.adaptive.license_key=6cf1045c66ec5b1681bbf34a0971ab86:f0c1edef4ea6b46c8ec0fe04627d8afb
#EXTHTTP:{"cookie":"__hdnea__=st=1772450931~exp=1772537331~acl=/*~hmac=dc35e4a3c611bfa3bf0e6cd468c9effc4eb8921f4f67a9e339875fb1c6a8dd4f"}
https://jiotvbpkmob.cdn.jio.com/bpk-tv/Sonic_Kannada_MOB/WDVLive/index.mpd
#EXTINF:-1 tvg-id="693" group-title="Kids" tvg-logo="https://jiotv.catchup.cdn.jio.com/dare_images/images/Sonic_Malayalam.png",Sonic Malayalam
#KODIPROP:inputstream.adaptive.license_type=clearkey
#KODIPROP:inputstream.adaptive.license_key=e5cee6f28393554c94ed38b0d8a65b88:ed3a9586ece4ac6cd147e784e0ce1fc6
#EXTHTTP:{"cookie":"__hdnea__=st=1772450931~exp=1772537331~acl=/*~hmac=dc35e4a3c611bfa3bf0e6cd468c9effc4eb8921f4f67a9e339875fb1c6a8dd4f"}
https://jiotvbpkmob.cdn.jio.com/bpk-tv/Sonic_Malayalam_MOB/WDVLive/index.mpd
#EXTINF:-1 tvg-id="694" group-title="Kids" tvg-logo="https://jiotv.catchup.cdn.jio.com/dare_images/images/Sonic_Marathi.png",Sonic Marathi
#KODIPROP:inputstream.adaptive.license_type=clearkey
#KODIPROP:inputstream.adaptive.license_key=c329e1a4429c525cad86d4346efcd68a:7c21c2f9cddaa5c084bf1d5b02fb4610
#EXTHTTP:{"cookie":"__hdnea__=st=1772450931~exp=1772537331~acl=/*~hmac=dc35e4a3c611bfa3bf0e6cd468c9effc4eb8921f4f67a9e339875fb1c6a8dd4f"}
https://jiotvbpkmob.cdn.jio.com/bpk-tv/Sonic_Marathi_BTS/output/index.mpd
#EXTINF:-1 tvg-id="695" group-title="Kids" tvg-logo="https://jiotv.catchup.cdn.jio.com/dare_images/images/sonic_Tamil.png",Sonic Tamil
#KODIPROP:inputstream.adaptive.license_type=clearkey
#KODIPROP:inputstream.adaptive.license_key=a62d4ca4ef095564bede0fe525956634:5e34a5126bfe29c18947046513f18cce
#EXTHTTP:{"cookie":"__hdnea__=st=1772450931~exp=1772537331~acl=/*~hmac=dc35e4a3c611bfa3bf0e6cd468c9effc4eb8921f4f67a9e339875fb1c6a8dd4f"}
https://jiotvbpkmob.cdn.jio.com/bpk-tv/sonic_Tamil_MOB/WDVLive/index.mpd
#EXTINF:-1 tvg-id="696" group-title="Kids" tvg-logo="https://jiotv.catchup.cdn.jio.com/dare_images/images/Sonic_Telugu.png",Sonic Telugu
#KODIPROP:inputstream.adaptive.license_type=clearkey
#KODIPROP:inputstream.adaptive.license_key=c5f797fac3ce566c990a2057c99a81c2:a65755a4676a6c2e9d803d5611954b26
#EXTHTTP:{"cookie":"__hdnea__=st=1772450931~exp=1772537331~acl=/*~hmac=dc35e4a3c611bfa3bf0e6cd468c9effc4eb8921f4f67a9e339875fb1c6a8dd4f"}
https://jiotvbpkmob.cdn.jio.com/bpk-tv/Sonic_Telugu_MOB/WDVLive/index.mpd
#EXTINF:-1 tvg-id="716" group-title="Kids" tvg-logo="https://jiotv.catchup.cdn.jio.com/dare_images/images/Sony_Yay_Hindi.png",Sony Yay Hindi
#KODIPROP:inputstream.adaptive.license_type=clearkey
#KODIPROP:inputstream.adaptive.license_key=271a8e6c5d9d5696a11c474a5c18371c:d6e2ece0c28b900dc6a868991cdf2517
#EXTHTTP:{"cookie":"__hdnea__=st=1772450931~exp=1772537331~acl=/*~hmac=dc35e4a3c611bfa3bf0e6cd468c9effc4eb8921f4f67a9e339875fb1c6a8dd4f"}
https://jiotvbpkmob.cdn.jio.com/bpk-tv/SonyYAYHin_MOB/WDVLive/index.mpd
#EXTINF:-1 tvg-id="717" group-title="Kids" tvg-logo="https://jiotv.catchup.cdn.jio.com/dare_images/images/Sony_Yay_Tamil.png",Sony Yay Tamil
#KODIPROP:inputstream.adaptive.license_type=clearkey
#KODIPROP:inputstream.adaptive.license_key=e28fc2f196045ad5a74c7eee8e4973f3:41e9517d0be1f231017a04ad93a866a1
#EXTHTTP:{"cookie":"__hdnea__=st=1772450931~exp=1772537331~acl=/*~hmac=dc35e4a3c611bfa3bf0e6cd468c9effc4eb8921f4f67a9e339875fb1c6a8dd4f"}
https://jiotvbpkmob.cdn.jio.com/bpk-tv/SonyYAYTam_MOB/WDVLive/index.mpd
#EXTINF:-1 tvg-id="718" group-title="Kids" tvg-logo="https://jiotv.catchup.cdn.jio.com/dare_images/images/Sony_Yay_Telugu.png",Sony Yay Telugu
#KODIPROP:inputstream.adaptive.license_type=clearkey
#KODIPROP:inputstream.adaptive.license_key=af022a63d90353d9974d5cc15ce709e1:0db40153e9e2fc30e3949101c87d2ecb
#EXTHTTP:{"cookie":"__hdnea__=st=1772450931~exp=1772537331~acl=/*~hmac=dc35e4a3c611bfa3bf0e6cd468c9effc4eb8921f4f67a9e339875fb1c6a8dd4f"}
https://jiotvbpkmob.cdn.jio.com/bpk-tv/SonyYAYTel_MOB/WDVLive/index.mpd
#EXTINF:-1 tvg-id="798" group-title="Kids" tvg-logo="https://jiotv.catchup.cdn.jio.com/dare_images/images/Super_Hungama.png",Super Hungama
#KODIPROP:inputstream.adaptive.license_type=clearkey
#KODIPROP:inputstream.adaptive.license_key=7a450f0820c4589690eb336c29f18da6:820e84119563b56d6e6f0bf514cbdc3c
#EXTHTTP:{"cookie":"__hdnea__=st=1772450931~exp=1772537331~acl=/*~hmac=dc35e4a3c611bfa3bf0e6cd468c9effc4eb8921f4f67a9e339875fb1c6a8dd4f"}
https://jiotvbpkmob.cdn.jio.com/bpk-tv/Super_Hungama_BTS/output/index.mpd';
    error_log("Failed to fetch M3U, using fallback. HTTP code: $httpCode");
}

// Parse the M3U content
$lines = explode("\n", $m3uContent);
$channels = [];
$currentExtinf = null;
$currentLicense = null;
$currentCookie = null;

foreach ($lines as $line) {
    $line = trim($line);
    if (strpos($line, '#EXTINF:') === 0) {
        preg_match('/#EXTINF:-?\d+.*?tvg-id="([^"]*)".*?tvg-logo="([^"]*)".*?,(.*)$/', $line, $matches);
        if (isset($matches[1], $matches[2], $matches[3])) {
            $currentExtinf = [
                'tvgId' => $matches[1],
                'logo' => $matches[2],
                'name' => $matches[3]
            ];
        }
    } elseif (strpos($line, '#KODIPROP:inputstream.adaptive.license_key=') === 0) {
        $currentLicense = substr($line, strlen('#KODIPROP:inputstream.adaptive.license_key='));
    } elseif (strpos($line, '#EXTHTTP:') === 0) {
        $jsonStr = substr($line, strlen('#EXTHTTP:'));
        $data = json_decode($jsonStr, true);
        if ($data && isset($data['cookie'])) {
            $currentCookie = $data['cookie'];
        }
    } elseif (strpos($line, 'http') === 0 && $currentExtinf) {
        $channels[] = [
            'name' => $currentExtinf['name'],
            'tvgId' => $currentExtinf['tvgId'],
            'logo' => $currentExtinf['logo'],
            'link' => $line,
            'drmLicense' => $currentLicense,
            'cookie' => $currentCookie
        ];
        $currentExtinf = null;
        $currentLicense = null;
        $currentCookie = null;
    }
}

echo json_encode($channels, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
?>