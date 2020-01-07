<div class="container">
    <div class="padding">
        <div class="section-title">
            <h3 class="font-weight-bold">새로운 작품의 상영일정을 등록하기</h3>
        </div>
        <form method="post" class="mt-5 col-md-7">
            <div class="form-group">
                <label for="viewdate">상영 일정</label>
                <small class="text-muted ml-2">[년/월/일/시/분] 으로 구분해서 작성하세요. (예시: 2020년 1월 7일 10시 30분 → 2020/1/7 10:30)</small>
                <input type="text" id="viewdate" class="form-control" name="viewdate">
            </div>
            <div class="form-group">
                <label for="mid">출품작 선택</label>
                <select name="mid" id="mid" class="form-control">
                    <?php foreach($movieList as $item): ?>
                        <option value="<?=$item->id?>"><?=$item->movie_name?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button class="normal-btn mt-3 mb-5" type="submit">등록하기</button>
        </form>
    </div>
</div>