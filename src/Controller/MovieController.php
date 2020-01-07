<?php
namespace Controller;

use App\DB;

class MovieController {
    function applyPage(){
        $movieCount = DB::fetch("SELECT COUNT(*) cnt FROM movies")->cnt;
        view("apply", ["active_nav" => "apply", "movie_count" => $movieCount]);
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

    function schedulePage(){
        $data = [
            "year" => isset($_GET['year']) ? $_GET['year'] : date("Y"),
            "month" => isset($_GET['month']) ? $_GET['month'] : preg_replace("/^0/", "", date("m")),
            "active_nav" => "schedules",
        ];

        view("schedule", $data);
    }

    function addSchedulePage(){
        $no_schedule_movies = DB::query("SELECT M.* FROM movies M LEFT JOIN schedules S ON M.id = S.mid where S.id IS NULL");
        view("schedule-add", ["active_nav" => "schedules", "movieList" => $no_schedule_movies]);
    }

    function addSchedule(){
        isEmpty();
        extract($_POST);

        if(!preg_match("/[0-9]{4}\/[0-9]{1,2}\/[0-9]{1,2}\s[0-9]{1,2}:[0-9]{1,2}/", $viewdate)) return back("상영 일정의 양식이 올바르지 않습니다. [년/월/일 시:분] 으로 구분해서 작성하세요. (예시: 2020년 1월 7일 10시 30분 → 2020/1/7 10:30)");

        if($viewdate !== date("Y/n/j H:i", strtotime($viewdate)) && $viewdate !== date("Y/m/d H:i", strtotime($viewdate))) 
            return back("상영 일정의 날짜가 올바르지 않습니다.");

        $movie = DB::find("movies", $mid);
        if(!$movie) return back("해당 작품은 존재하지 않는 작품입니다.");
        
        $viewstart = $viewdate;
        $viewend = date("Y/m/d H:i", strtotime($viewdate) + ($movie->running_time * 60));

        $overlap = DB::fetch("SELECT * FROM schedules 
                   WHERE (timestamp(?) <= timestamp(viewstart) AND timestamp(viewstart) <= timestamp(?))
                   OR  (timestamp(?) <= timestamp(viewend) AND timestamp(viewend) <= timestamp(?))
                   OR  (timestamp(viewstart) <= timestamp(?) AND timestamp(?) <= timestamp(viewend))
                   OR  (timestamp(viewstart) <= timestamp(?) AND timestamp(?) <= timestamp(viewend))", [$viewstart, $viewend, $viewstart, $viewend, $viewstart, $viewstart, $viewend, $viewend]);

        if($overlap) return back("상영 시간이 겹치는 일정이 존재하여 해당 시간에는 일정을 추가할 수 없습니다.");

        DB::query("INSERT INTO schedules(mid, viewstart, viewend) VALUES (?, ?, ?)", [$mid, $viewstart, $viewend]);

        return go("/schedules", "새로운 상영 일정이 추가되었습니다.");
    }

    function scheduleDetailPage(){
        if(!isset($_GET['date'])) return back("해당 페이지는 존재하지 않는 페이지입니다.");
        $date = $_GET['date'];

        dateValidator($date);

        $rangeStart = date("Y-m-d H:i:s", strtotime($date));
        $rangeEnd = date("Y-m-d H:i:s", strtotime($rangeStart) + 3600 * 24 - 1);

        $scheduleList = DB::fetchAll("SELECT M.*, S.viewstart, S.viewend 
                                      FROM movies M
                                      LEFT JOIN schedules S
                                      ON M.id = S.mid
                                      WHERE timestamp(?) <= timestamp(viewstart)
                                      AND timestamp(viewstart) <= timestamp(?)", [$rangeStart, $rangeEnd]);


        $userList = UserController::takeUserList();
        foreach($scheduleList as $schedule){
            $schedule->user_name = $schedule->uid == "admin" ? $userList[0]->user_name : ($schedule->uid == "user" ? $userList[1]->user_name : null);
        }

        $data = [
            "date" => date("Y-m-d", strtotime($date)),
            "scheduleList" => $scheduleList,
            "active_nav" => "schedules",
        ];

        view("schedule-detail", $data);
    }

    function searchPage(){
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : null;
        $type = isset($_GET['type']) ? $_GET['type'] : null;

        $sql = "SELECT M.*, S.viewstart, S.viewend 
                FROM movies M 
                LEFT JOIN schedules S 
                ON M.id = S.mid
                WHERE 1";
        $params = [];

        if($keyword) {
            $sql .= " AND M.movie_name LIKE ?";
            $params[] = "%{$keyword}%";
        }
        if($type) {
            $sql .= " AND M.type = ?";
            $params[] = $type;
        }

        $result = DB::fetchAll($sql, $params);
        
        foreach($result as $item){
            $item->user_name = takeUser($item->uid)->user_name;
        }

        $data = [
            "keyword" => $keyword,
            "type" => $type,
            "active_nav" => "search",
            "result" => $result,
        ];
        view("schedule-search", $data);
    }


    // API
    function takeSchedules(){
        return json_response(DB::fetchAll("SELECT S.*, M.movie_name FROM schedules S, movies M WHERE M.id = S.mid"));
    }
    
    function downloadSchedules(){
        if(!isset($_GET['date'])) return back("해당 페이지는 존재하지 않는 페이지 입니다.");
        $date = $_GET['date'];
        dateValidator($date);

        $rangeStart = date("Y-m-d H:i:s", strtotime($date));
        $rangeEnd = date("Y-m-d H:i:s", strtotime($rangeStart) + 3600 * 24 - 1);
        $scheduleList = DB::fetchAll("SELECT M.*, S.viewstart, S.viewend 
                                        FROM movies M
                                        LEFT JOIN schedules S
                                        ON M.id = S.mid
                                        WHERE timestamp(?) <= timestamp(viewstart)
                                        AND timestamp(viewstart) <= timestamp(?)", [$rangeStart, $rangeEnd]);

        if(!$scheduleList) return back("해당 스케줄은 존재하지 않습니다.");

        $userList = UserController::takeUserList();
        

        header("Content-Type: text/csv; charset=UTF-8");
        header("Content-Disposition: attachment; filename=" . date("Y-m-d", strtotime($date)). "_상영일정.csv");

        $csvText = "출품자 이름\t아이디\t영화 제목\t러닝타임\t제작연도\t분류\n";
        foreach($scheduleList as $schedule){
            $schedule->user_name = $schedule->uid == "admin" ? $userList[0]->user_name : ($schedule->uid == "user" ? $userList[1]->user_name : null);
            $csvText .= "$schedule->user_name\t$schedule->uid\t$schedule->movie_name\t$schedule->running_time\t$schedule->created_at\t$schedule->type\n";
        }

        echo $csvText;
    }
}