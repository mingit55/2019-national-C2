<?php
function dump(){
    foreach(func_get_args() as $arg){
        echo "<pre>";
        var_dump($arg);
        echo "</pre>";
    }
}

function dd(){
    call_user_func_array("dump", func_get_args());
    exit;
}

function user(){
    return @isset($_SESSION['user']) ? $_SESSION['user'] : false;
}

function admin(){
    return user() && user()->user_id === "admin" ? user() : false;
}

function go($url, $message = ""){
    echo "<script>";
    echo "location.href='$url';";
    if($message) echo "alert('{$message}');";
    echo "</script>";
}

function back($message = ""){
    echo "<script>";
    echo "history.back();";
    if($message) echo "alert('{$message}');";
    echo "</script>";   
}

function view($filepath, $data = [], $visual_view = false){
    extract($data);

    $active_nav = isset($active_nav) ? $active_nav : "biff";

    require_once VIEW."/template/header.php";
    require_once VIEW."/{$filepath}.php";
    require_once VIEW."/template/footer.php";
}

function isEmpty($message = "모든 정보를 기입해 주세요!"){
    foreach($_POST as $data){
        if($data === "") {
            back($message);
            exit;
        }
    }
}

function json_response($data){
    header("Content-Type: application/json");
    echo json_encode($data);
    return true;
}

function dateValidator($date){
    if($date !== date("Y-m-d", strtotime($date)) && $date !== date("Y-n-j", strtotime($date))) {
        back("알맞은 날짜를 입력해 주십시오."); 
        exit;
    }
}

function takeUser($user_id){
    $userList = [
        "admin" => (object)[
            "user_id" => "admin",
            "password" => 1,
            "user_name" => "김부산"
        ],
        "user" => (object)[
            "user_id" => "user",
            "password" => 2,
            "user_name" => "이코딩"
        ]
    ];

    return $userList[$user_id];
}