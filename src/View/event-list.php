<div class="container">
    <div class="padding">
        <div class="section-header">
            <h5>영화 티저 콘테스트</h5>
            <h1>Film Teaser Contest</h1>
        </div>
        <div class="row p-5">
            <?php foreach($list as $item):?>
                <a href="/event/contest-detail?id=<?=$item->id?>" class="card m-2" style="width: 250px;">
                    <img src="/images/movie<?=$item->mid?>-cover.jpg" alt="Cover Image" class="card-img-top">
                    <div class="card-body d-flex justify-content-between">
                        <h5 class="card-title"><?=$item->user_name?></h5>
                        <span class="card-text text-muted ml-3">평점: <?=$item->average?>점</span>
                    </div>
                 </a>
            <?php endforeach;?>
        </div>
    </div>
</div>