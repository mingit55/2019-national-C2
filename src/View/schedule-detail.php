<div class="container py-4">
    <div class="padding">
        <div class="section-title">
            <h1 class="font-weight-bold">상영 일정 (<?=$date?>)</h1>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <td>출품자 명</td>
                    <td>아이디</td>
                    <td>영화 제목</td>
                    <td>러닝타임</td>
                    <td>제작년도</td>
                    <td>분류</td>
                    <td>상영 시작</td>
                    <td>상영 종료</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach($scheduleList as $schedule):?>
                    <tr>
                        <td><?=$schedule->user_name?></td>
                        <td><?=$schedule->uid?></td>
                        <td><?=$schedule->movie_name?></td>
                        <td><?=$schedule->running_time?></td>
                        <td><?=$schedule->created_at?></td>
                        <td><?=$schedule->type?></td>
                        <td><?=date("Y년 m월 d일 H시 i분", strtotime($schedule->viewstart))?></td>
                        <td><?=date("Y년 m월 d일 H시 i분", strtotime($schedule->viewend))?></td>
                    </tr>
                <?php endforeach;?>
                <?php if(count($scheduleList) === 0): ?>
                    <tr>
                        <td colspan="8">상영 일정이 없습니다.</td>
                    </tr>
                <?php endif;?>
            </tbody>
        </table>
        <?php if(count($scheduleList) > 0):?>
            <button class="normal-btn my-5" onclick="location.href='/api/download-schedules?date=<?=$date?>'">일정 내보내기</button>
        <?php endif;?>
    </div>
</div>