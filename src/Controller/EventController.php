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
        $itemList = DB::fetchAll("SELECT I.* FROM contest_items", []);
        foreach($itemList as $item){
            $item->user_name = takeUser($item->uid)->name;
        }

        view("event-list", ["list" => $itemList]);
    }
}