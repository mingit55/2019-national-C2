<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BIFF2019 | 부산국제영화제</title>
    <script src="/js/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
    <script src="/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/css/common.css">
</head>
<body>
    <input type="checkbox" hidden id="aside-key">
    <div id="visual"<?=$visual_view === false ? " class=\"sub\"" : "" ?>>
        <div class="images">
            <div class="item image-1"></div>
            <div class="item image-2"></div>
            <div class="item image-3"></div>
            <div class="item image-1"></div>
            <div class="black-out"></div>
        </div>
        <?php if($visual_view === true): ?>
        <div class="contents text-center">
            <h5 class="text-white">아시아 최대 규모 영화제</h5>
            <h1 class="text-white">BUSAN INTERNATIONAL</h1>
            <h1 class="text-orange mb-5">FILM FESTIVAL</h1>
            <a href="#biff-2019" class="gradient-btn mt-5"><span>자세히 보기</span></a>
        </div>
        <?php endif;?>
        <header>
            <div class="inline py-3 d-flex">
                <a href="/"><img src="/images/Hlogo.png" alt="#" class="logo" height="55"></a>
                <div id="main-nav" class="mt-3">
                    <div class="item<?=$active_nav === "biff" ? " active" : ""?>">
                        <a href="/">
                            부산국제영화제
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M207.029 381.476L12.686 187.132c-9.373-9.373-9.373-24.569 0-33.941l22.667-22.667c9.357-9.357 24.522-9.375 33.901-.04L224 284.505l154.745-154.021c9.379-9.335 24.544-9.317 33.901.04l22.667 22.667c9.373 9.373 9.373 24.569 0 33.941L240.971 381.476c-9.373 9.372-24.569 9.372-33.942 0z"/></svg>
                        </a>
                        <div class="list list-1">
                            <div class="item"><a href="/biff/hold-info">개최개요</a></div>
                            <div class="item"><a href="/biff/festival-info">행사안내</a></div>
                        </div>
                    </div>
                    <div class="item<?=$active_nav === "apply" ? " active" : ""?>"><a href="/apply">출품신청</a></div>
                    <div class="item<?=$active_nav === "schedules" ? " active" : ""?>"><a href="/schedules">상영일정</a></div>
                    <div class="item<?=$active_nav === "search" ? " active" : ""?>"><a href="/search">상영작검색</a></div>
                    <div class="item<?=$active_nav === "event" ? " active" : ""?>">
                        <a href="#">
                            이벤트
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M207.029 381.476L12.686 187.132c-9.373-9.373-9.373-24.569 0-33.941l22.667-22.667c9.357-9.357 24.522-9.375 33.901-.04L224 284.505l154.745-154.021c9.379-9.335 24.544-9.317 33.901.04l22.667 22.667c9.373 9.373 9.373 24.569 0 33.941L240.971 381.476c-9.373 9.372-24.569 9.372-33.942 0z"/></svg>
                        </a>
                        <div class="list list-2">
                            <div class="item"><a href="/event/contest-list">영화티저 콘테스트</a></div>
                            <div class="item"><a href="/event/participate">콘테스트 참여하기</a></div>
                        </div>
                    </div>       
                    <div class="active-item"></div>             
                </div>
                <div id="sub-nav" class="mt-3">
                    <?php if(user()):?>
                        <div class="item">
                            <a href="/users/logout">로그아웃</a>
                        </div>
                    <?php else:?>   
                        <div class="item">
                            <a href="/users/login">로그인</a>
                        </div>
                        <div class="item">
                            <a href="/users/join">회원가입</a>
                        </div>
                    <?php endif;?>
                </div>
                <label id="hamberger" for="aside-key">
                    <span class="rect-1"></span>
                    <span class="rect-2"></span>
                    <span class="rect-3"></span>
                </label>
            </div>
        </header>
    </div>
    <aside>
        <div class="list d-flex flex-column px-4">
            <div class="item">
                <a href="/">
                    부산국제영화제
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M207.029 381.476L12.686 187.132c-9.373-9.373-9.373-24.569 0-33.941l22.667-22.667c9.357-9.357 24.522-9.375 33.901-.04L224 284.505l154.745-154.021c9.379-9.335 24.544-9.317 33.901.04l22.667 22.667c9.373 9.373 9.373 24.569 0 33.941L240.971 381.476c-9.373 9.372-24.569 9.372-33.942 0z"/></svg>
                </a>
                <div class="sub-list ml-3 mt-2">
                    <div class="item mt-3"><a href="/biff/hold-info">개최개요</a></div>
                    <div class="item mt-3"><a href="/biff/festival-info">행사안내</a></div>
                </div>
            </div>
            <div class="item mt-3"><a href="/apply">출품신청</a></div>
            <div class="item mt-3"><a href="/schedules">상영일정</a></div>
            <div class="item mt-3"><a href="/search">상영작검색</a></div>
            <div class="item mt-3">
                <a href="#">
                    이벤트
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M207.029 381.476L12.686 187.132c-9.373-9.373-9.373-24.569 0-33.941l22.667-22.667c9.357-9.357 24.522-9.375 33.901-.04L224 284.505l154.745-154.021c9.379-9.335 24.544-9.317 33.901.04l22.667 22.667c9.373 9.373 9.373 24.569 0 33.941L240.971 381.476c-9.373 9.372-24.569 9.372-33.942 0z"/></svg>
                </a>
                <div class="sub-list ml-3 mt-2">
                    <div class="item mt-3"><a href="#">영화티저 콘테스트</a></div>
                    <div class="item mt-3"><a href="/event/participate">콘테스트 참여하기</a></div>
                </div>
            </div>
        </div>
    </aside>