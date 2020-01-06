<?php


require dirname(dirname(__DIR__)) . "/src/App/DB.php";

use App\DB;

header("Content-Type: image/jpeg; charset=UTF-8");

$image = imagecreatetruecolor(600, 500);

$background = imagecolorallocate($image, 255, 255, 255);
$fontColor = imagecolorallocate($image, 221, 221, 221);

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
    imagefilledarc($image, 250, 250, 450, 450, $total_arc, $total_arc + $end_arc, $colors[$idx], IMG_ARC_PIE);
    $total_arc += $end_arc;

    // 범례
    $line_y = 25 * ($idx + 1);
    imagefilledrectangle($image, $rect_x, $line_y, $rect_x + 10, $line_y + 10, $colors[$idx]);
    imagestring($image, 5, $text_x, $line_y, $movie->type, $fontColor);
}

imagejpeg($image);
imagedestroy($image);

