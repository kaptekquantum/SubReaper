<?php
function curl_content($url)
{
    $ch = curl_init(urlencode('http://'.$url));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    return curl_exec($ch);
}
 foreach (array_map("trim", file(argv[1])) as $subsite) {
    $res = curl_content($subsite);
    if(preg_match("/No such App/i", $res)) {
        echo("[+] STO: $subsite ${PHP_EOL}");
        file_put_contents("subs.txt", "http://$subsite/ ${PHP_EOL}", FILE_APPEND);
    }
    if(preg_match("<Name>/i", $res)) {
        echo "[+] S3: $subsite ${PHP_EOL}";
        file_put_contents("s3.txt", "http://$subsite/ ${PHP_EOL}", FILE_APPEND);
    }
}
 echo("[+] Done");
