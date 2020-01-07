<?php
namespace Controller;

use App\DB;

class MovieController {
    function applyPage(){
        $movieCount = DB::fetch("SELECT COUNT(*) cnt FROM movies")->cnt;
        view("movie-apply", ["movie_count" => $movieCount]);
    }

    function apply(){
        isEmpty();
        extract($_POST);

        if(!preg_match("/^([0-9]+)$/", $created_at)) return back("러닝 타임은 분 단위로 입력하세요. [예시: 1시간 35분 => 95]");
        if(!preg_match("/^([0-9]{4})$/", $created_at)) return back("제작 년도는 숫자로 연도만 입력하세요. [예시: 2020년 => 2020]");
        
        $data = [
            user()->user_id,
            $movie_name,
            $running_time,
            $created_at,
            $type,
        ];
        DB::query("INSERT INTO movies(uid, movie_name, running_time, created_at, type) VALUES (?, ?, ?, ?, ?)", $data);
        
        go("/", "출품 신청이 완료되었습니다. 관리자 승인 후 일정에 추가됩니다.");
    }

    function calenderPage(){
        view("movie-calender");
    }
}