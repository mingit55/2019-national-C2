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

function view($filepath, $data = []){
    extract($data);

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