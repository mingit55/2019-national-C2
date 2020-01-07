<?php
namespace Controller;

use App\DB;

class EventController {
    function participatePage(){
        view("event-participate", ["active_nav" => "event"]);
    }
    function participate(){
        isEmpty();
        extract($_POST);
        
        DB::query("INSERT INTO contest_items(uid, mid, html) VALUES (?, ?, ?)", [user()->user_id, $mid, $html]);
        go("/", "콘테스트에 참가되었습니다.");
    }


    function listPage(){
        $itemList = DB::fetchAll("SELECT I.* FROM contest_items I", []);
        foreach($itemList as $item){
            $item->user_name = takeUser($item->uid)->user_name;
            $item->scoreList = json_decode($item->scoreList);
            $sum = 0;
            foreach($item->scoreList as $scoreItem) $sum += $scoreItem->score;
            $item->average = count($item->scoreList) > 0 ? $sum / count($item->scoreList) : 0;
        }

        view("event-list", ["list" => $itemList]);
    }

    function detailPage(){
        if(!isset($_GET['id'])) return back("해당 페이지는 존재하지 않는 페이지입니다.");
        
        $id = $_GET['id'];
        $item = DB::find("contest_items", $id);
        if(!$item) return back("해당 콘테스트 영상이 존재하지 않습니다.");
        $item->user_name = takeUser($item->uid)->user_name;

        $myscore = 5;
        $sum = 0;
        $item->scoreList = json_decode($item->scoreList);
        foreach($item->scoreList as $scoreItem) {
            if(user() && $scoreItem->uid === user()->user_id) $myscore = $scoreItem->score;
            $sum += $scoreItem->score;
        }
        $item->average = count($item->scoreList) > 0 ? $sum / count($item->scoreList) : 0;
        
        $data = [
            "item" => $item,
            "myscore" => $myscore
        ];

        view("event-detail", $data);
    }



    //
    function goodContest(){
        isEmpty();
        extract($_POST);

        $item = DB::find("contest_items", $cid);
        if(!$item) return back("해당 작품이 존재하지 않습니다.");
        
        $scoreList = json_decode($item->scoreList);
        $find = false;
        foreach($scoreList as $item){
            if($item->uid === user()->user_id){
                $item->score = $score;
                $find = true;
            }
        }
        if(!$find) $scoreList[] = (object)["uid" => user()->user_id, "score" => $score];

        $scoreList = json_encode($scoreList);
        
        DB::query("UPDATE contest_items SET scoreList = ? WHERE id = ?", [$scoreList, $cid]);
        go("/event/contest-detail?id=$cid");
    }
}