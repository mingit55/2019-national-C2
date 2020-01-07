<div class="container">
    <div class="padding">
        <div class="col-md-12 card py-3">
            <div class="card-top-img" style="position: relative; height: 500px;">
                <?= $item->html ?>
            </div>
            <div class="card-body py-5">
                <div class="ml-5 row">
                    <h5 class="font-weight-bold d-inline"><?=$item->user_name?></h5>
                    <span class="pl-3">총점: <?=$item->average?>점</span>
                </div>
                <div class="ml-5 mt-2 row">
                    <small class="text-muted">이 영상에 대한 평점을 매겨주세요!</small>                    
                </div>
                <form action="/api/good-contest" method="post" class="ml-5 mt-3 row">
                    <input type="hidden" name="cid" value="<?=$item->id?>">
                    <input type="number" name="score" class="p-1" min="1" max="10" value="<?=$myscore?>" style="border: #ddd 1px solid;">
                    <span class="ml-2 pt-1">점</span>
                    <button class="ml-5 btn btn-primary">평점 매기기</button>
                </form>
            </div>
        </div>
    </div>
</div>