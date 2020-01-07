<div class="container">
    <div class="padding">
        <div class="section-header">
            <h5>작품을 등록하기 위한 출품신청</h5>
            <h1>APPLY ENTRY</h1>
        </div>
        <div class="row">
            <div class="col-md-6">
                <form method="post" autocomplate="false">
                    <div class="form-group">
                        <label for="user_name">출품자 명</label>
                        <input type="text" id="user_name" class="form-control" value="<?=user()->user_name?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="user_id">아이디</label>
                        <input type="text" id="user_id" class="form-control" value="<?=user()->user_id?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="movie_name">영화 제목</label>
                        <input type="text" id="movie_name" class="form-control" name="movie_name">
                    </div>
                    <div class="form-group">
                        <label for="running_time">러닝 타임</label>
                        <input type="text" id="running_time" class="form-control" name="running_time" placeholder="분 단위로 입력하세요. [예시: 1시간 35분 => 95]">
                    </div>
                    <div class="form-group">
                        <label for="created_at">제작 년도</label>
                        <input type="text" id="created_at" class="form-control" name="created_at" placeholder="숫자로 연도만 입력하세요. [예시: 2020년 => 2020]">
                    </div>
                    <div class="form-group">
                        <label for="type">분류</label>
                        <select name="type" id="type" class="form-control">
                            <option value="극영화">극영화</option>
                            <option value="다큐멘터리">다큐멘터리</option>
                            <option value="애니메이션">애니메이션</option>
                            <option value="기타">기타</option>
                        </select>
                    </div>
                    <button type="submit" class="normal-btn mt-5">신청하기</button>
                </form>
            </div>
            
            <?php if($movie_count > 0):?>
                <div class="col-md-6" style="background: url(/images/graph.php) no-repeat; background-size: 100% auto;">
                </div>
            <?php endif;?>
            
        </div>
    </div>
</div>