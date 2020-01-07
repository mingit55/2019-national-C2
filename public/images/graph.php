<?php
require dirname(dirname(__DIR__)) . "/src/App/DB.php";

use App\DB;

header("Content-Type: image/jpeg; charset=UTF-8");

$image = imagecreatetruecolor(600, 500);

$background = imagecolorallocate($image, 255, 255, 255);
$fontColor = imagecolorallocate($image, 0, 0, 0);

imagefilledrectangle($image, 0, 0, 600, 500, $background);


$movieList = DB::fetchAll("SELECT type, COUNT(*) cnt FROM movies GROUP BY type");
$totalCnt = DB::fetch("SELECT COUNT(*) cnt FROM movies")->cnt;

$colors = [
    imagecolorallocate($image, 277, 60, 64), //red
    imagecolorallocate($image, 255, 93, 7), //orange
    imagecolorallocate($image, 40, 167, 69), // green
    imagecolorallocate($image, 0, 123, 255), // blue
];

$total_arc = 0;
$rect_x = 500;
$text_x = 520;

foreach($movieList as $idx => $movie){
    // 그래프
    $end_arc = 360 * $movie->cnt / $totalCnt;
    imagefilledarc($image, 270, 250, 400, 400, $total_arc, $total_arc + $end_arc, $colors[$idx], IMG_ARC_PIE);
    $total_arc += $end_arc;

    // 범례
    $line_y = 25 * ($idx + 1);
    imagefilledrectangle($image, $rect_x, $line_y, $rect_x + 10, $line_y + 10, $colors[$idx]);
    imagettftext($image, 10, 0, $text_x, $line_y + 10, $fontColor, dirname(__DIR__) . "/fonts/NanumSquareR.ttf", $movie->type);
    // imagettftext(<이미지 객체 :: imagecreatetruecolor>, <폰트 크기>, <각도>, <X좌표>, <Y좌표>, <색상:: imagecolorallocate>, "<폰트 파일 :: 절대경로>, "<텍스트>")
    // 대회에서는 폰트 파일을 제공하지 않을 것이므로, C:\Windows\Fonts 폴더에서 직접 뜯어서 사용
}

imagejpeg($image);
imagedestroy($image);
