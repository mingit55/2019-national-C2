<link rel="stylesheet" href="/css/participate.css">

<script src="/js/participate/Clip.js"></script>
<script src="/js/participate/Curve.js"></script>
<script src="/js/participate/Rect.js"></script>
<script src="/js/participate/Text.js"></script>
<script src="/js/participate/Track.js"></script>
<script src="/js/participate/Viewport.js"></script>
<script src="/js/participate/App.js"></script>

<div class="container">
    <div class="padding">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h1>PARTICIPATE CONTEST</h1>
                </div>
            </div>
        </div>
        <div class="row align-items-start">
            <div class="col-md-2 d-flex flex-column">
                <button id="curve-btn" data-name="curve" class="tool btn my-1">자유곡선</button>
                <button id="rect-btn" data-name="rect" class="tool btn my-1">사각형</button>
                <button id="text-btn" data-name="text" class="tool btn my-1">텍스트</button>
                <button id="select-btn" data-name="select" class="tool btn my-1">선택</button>
                <button id="play-btn" class="tool btn my-1">재생</button>
                <button id="pause-btn" class="tool btn my-1">정지</button>
                <button id="alldel-btn" class="tool btn my-1">전체 삭제</button>
                <button id="seldel-btn" class="tool btn my-1">선택 삭제</button>
                <button id="download-btn" class="tool btn my-1">다운로드</button>
                <button id="merge-btn" class="tool btn my-1">병합하기</button>
                <button id="reset-btn" class="tool btn my-1">초기화</button>
            </div>
            <div class="col-md-8">
                <!-- 동영상이 보여지는 곳 -->
                <div id="viewport"></div>
                <!-- 재생 시간 확인 -->
                <div class="row justify-content-between mt-2 mx-2">
                    <div id="play-time" class="d-flex"> 
                        <p class="current-time">00:00:00:00</p>
                        <span class="mx-2">/</span>
                        <p class="duration">00:00:00:00</p>
                    </div>
                    <div id="clip-time" class="d-flex">
                        <span class="mr-2">시작 시간: </span>
                        <p class="start-time mr-3">00:00:00:00</p>
                        <span class="mr-2">유지 시간: </span>
                        <p class="duration">00:00:00:00</p>
                    </div>
                </div>
                <!-- 클립 목록 확인 -->
                <div id="clip-list" class="d-flex flex-column py-4 my-3"></div>
                <!-- 영화 목록 확인 -->
                <div id="movie-list" class="my-5 d-flex justify-content-between align-items-center">
                    <img src="/images/movie1-cover.jpg" data-id="1" alt="기생충" class="movie" height="200">
                    <img src="/images/movie2-cover.jpg" data-id="2" alt="극한직업" class="movie" height="200">
                    <img src="/images/movie3-cover.jpg" data-id="3" alt="롱리브더킹" class="movie" height="200">
                    <img src="/images/movie4-cover.jpg" data-id="4" alt="나랏말싸미" class="movie" height="200">
                    <img src="/images/movie5-cover.jpg" data-id="5" alt="봉오동전투" class="movie" height="200">
                </div>
            </div>

            <div class="col-md-2 d-flex flex-column">

                <div class="form-group">
                    <label for="color-input">색상</label>
                    <select id="color-input" class="form-control">
                        <option value="gray">gray</option>
                        <option value="blue">blue</option>
                        <option value="green">green</option>
                        <option value="red">red</option>
                        <option value="yellow">yellow</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="width-input">선 두께</label>
                    <select id="width-input" class="form-control">
                        <option value="3">3px</option>
                        <option value="5">5px</option>
                        <option value="10">10px</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="size-input">글자 크기</label>
                    <select id="size-input" class="form-control">
                        <option value="16px">16px</option>
                        <option value="18px">18px</option>
                        <option value="24px">24px</option>
                        <option value="32px">32px</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
