<?php
namespace Controller;

class MainController {
    static function notFound(){
        echo "해당 페이지는 존재하지 않는 페이지 입니다.";
    }

    function homePage(){
        view("home");        
    }

    function holdInfoPage(){
        view("hold-info");
    }

    function festivalInfoPage(){
        view("festival-info");
    }
}