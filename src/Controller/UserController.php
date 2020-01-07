<?php
namespace Controller;

class UserController {
    static function takeUserList(){
        return [
            (object)[
                "user_id" => "admin",
                "password" => 1,
                "user_name" => "김부산"
            ],
            (object)[
                "user_id" => "user",
                "password" => 2,
                "user_name" => "이코딩"
            ]
        ];
    }

    /**
     * 로그인
     */
    function loginPage(){
        view("user-login");
    }

    function login(){
        isEmpty();
        extract($_POST);

        
        $user = $user_id == "admin" ? self::takeUserList()[0] : ($user_id == "user" ? self::takeUserList()[1] : null);
        if(!$user) return back("아이디와 일치하는 유저가 존재하지 않습니다.");
        if($user->password != $password) return back("비밀번호가 일치하지 않습니다.");

        $_SESSION['user'] = $user;

        return go("/", "로그인 되었습니다!");
    }

    /**
     * 회원가입
     */
    function joinPage(){
        back("수정된 경북 경기과제는 회원가입 기능이 존재하지 않습니다.");
    }

    /**
     * 로그아웃
     */
    function logout(){
        unset($_SESSION['user']);
        go("/", "로그아웃 되었습니다.");
    }
}