<style>
    .btn {
        width: 100px;
        height: 50px;
        line-height: 30px;
        background-color: var(--orange);
    }
</style>

<div class="container">
    <div class="padding">
        <div class="section-header">
            <h5>등록된 상영작품들을 검색해 보세요!</h5>
            <h1>Search Form</h1>
        </div>
        <form class="row align-items-center my-3">
            <div class="form-group col-md-3">
                <label for="keyword">검색어</label>
                <input type="text" id="keyword" name="keyword" class="form-control" value="<?=$keyword?>">
            </div>
            <div class="form-group col-md-3">
                <label for="type">분류</label>
                <select name="type" id="type" class="form-control">
                    <option value="">전체</option>
                    <option <?=$type === "극영화" ? "selected": ""?> value="극영화">극영화</option>
                    <option <?=$type === "다큐멘터리" ? "selected": ""?> value="다큐멘터리">다큐멘터리</option>
                    <option <?=$type === "애니메이션" ? "selected": ""?> value="애니메이션">애니메이션</option>
                    <option <?=$type === "기타" ? "selected": ""?> value="기타">기타</option>
                </select>
            </div>
            <button class="btn" type="submit">검색</button>
        </form>
        <p>검색 결과: <?=count($result)?>개</p>
        <table class="table">
            <thead>
                <tr>
                    <td>출품자 명</td>
                    <td>아이디</td>
                    <td>영화 제목</td>
                    <td>러닝타임</td>
                    <td>제작년도</td>
                    <td>분류</td>
                    <td>상영시작</td>
                    <td>상영종료</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach($result as $item):?>
                    <tr>
                        <td><?=$item->user_name?></td>
                        <td><?=$item->uid?></td>
                        <td><?=$item->movie_name?></td>
                        <td><?=$item->running_time?></td>
                        <td><?=$item->created_at?></td>
                        <td><?=$item->type?></td>
                        <td><?=$item->viewstart?></td>
                        <td><?=$item->viewend?></td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>