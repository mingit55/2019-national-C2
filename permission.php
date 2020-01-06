<?php
function is_user(){
    if(!user()){
        go("/users/login", "로그인 후 이용하실 수 있습니다.");
        exit;
    }
}
function is_guest(){
    if(user()){
        go("/", "로그인 후엔 이용하실 수 없습니다.");
        exit;
    }
}