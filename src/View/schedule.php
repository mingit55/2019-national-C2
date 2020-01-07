<style>

    #calender {
        display: flex;
        align-items: flex-start;
        flex-wrap: wrap;
        width: 100%;
        min-height: 150px;
        border-top: 1px solid #ddd;
        border-left: 1px solid #ddd;
    }

    #calender .head {
        width: calc(100% / 7);
        height: 50px;
        line-height: 50px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }

    #calender .head:nth-child(7n) { border-right: 1px solid #ddd; }

    #calender .day {
        width: calc(100% / 7);
        height: 150px;
        padding-top: 50px;
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-around;
        overflow: hidden;
        border-right: 1px solid #ddd;
        border-bottom: 1px solid #ddd;
    }

    #calender .day.muted {
        opacity: 0.5;
    }

    #calender .day span {
        position: absolute;
        top: 20px; left: 10px;
    }

    #calender .day .events {
        text-align: center;
        margin: 5px 0;
        padding: 5px 10px;
        width: 100%;
        height: 40px;
        line-height: 30px;
        background-color: var(--orange);
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        color: #fff;
    }

    .normal-btn {
        background-color: var(--orange);
    }

    .normal-btn svg {
        width: 15px;
        fill: #fff;
    }
</style>

<div class="container">
    <div class="padding">
        <div class="section-header">
            <h5>등록된 작품의 일정을 확인하기</h5>
            <h1>Schedules</h1>
        </div>
        <div class="col-md-6 d-flex justify-content-between align-items-center margin-auto py-4">
            <button id="prev-date" class="normal-btn">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M34.52 239.03L228.87 44.69c9.37-9.37 24.57-9.37 33.94 0l22.67 22.67c9.36 9.36 9.37 24.52.04 33.9L131.49 256l154.02 154.75c9.34 9.38 9.32 24.54-.04 33.9l-22.67 22.67c-9.37 9.37-24.57 9.37-33.94 0L34.52 272.97c-9.37-9.37-9.37-24.57 0-33.94z"/></svg>
            </button>
            <div id="current_date">
                <h2 class="year d-inline font-weight-bold"><?=$year?>년</h2>
                <h2 class="month d-inline font-weight-bold"><?=$month?>월</h2>
            </div>
            <button id="next-date" class="normal-btn">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
            </button>
        </div>
        <div id="calender">
            <div class="head">일</div>
            <div class="head">월</div>
            <div class="head">화</div>
            <div class="head">수</div>
            <div class="head">목</div>
            <div class="head">금</div>
            <div class="head">토</div>
        </div>
        <?php if(admin()):?>
            <button class="gradient-btn my-5" onclick="location.href='/schedules/add'"><span>일정 추가하기</span></button>
        <?php endif;?>
    </div>
</div>

<script>
    class App {
        constructor(){
            this.$calender = $("#calender")[0];
            this.$current_date = $("#current_date")[0];
            this.year = parseInt(this.$current_date.querySelector(".year").innerText);
            this.month = parseInt(this.$current_date.querySelector(".month").innerText);

            this.loadData().then(() => {
                this.drawCalender(this.year, this.month);
                this.events();
            });
        }

        events(){
            document.querySelector("#next-date").addEventListener("click", () => location.href = this.nextSchedule());
            document.querySelector("#prev-date").addEventListener("click", () => location.href = this.prevSchedule());
        }

        async loadData(){
            this.scheduleList = await this.loadSchedules();
        }
        
        loadSchedules(){
            return new Promise(res => {
                let xhr = new XMLHttpRequest();
                xhr.open("POST", "/api/take-schedules");
                xhr.send();
                xhr.onload = () => {
                    let response = JSON.parse(xhr.responseText);
                    let data = response.map(x => {
                        x.viewstart = new Date(x.viewstart);
                        x.viewend = new Date(x.viewend);
                        return x;
                    });

                    res(data);
                }
            });
        }

        nextSchedule(){
            let date = new Date(this.year, this.month);
            return "/schedules?year=" + date.getFullYear() + "&month=" + (date.getMonth() + 1)
        }
        prevSchedule(){
            let date = new Date(this.year, this.month - 2);
            return "/schedules?year=" + date.getFullYear() + "&month=" + (date.getMonth() + 1)
        }


        drawCalender(year, month){
            let calenderDate = new Date(year, month - 1, 1);
            let prevMonthLastDate = (new Date(year, month - 1, 0));
            let currentMonthLastDate = (new Date(year, month + 1, 0));
            let startDay = calenderDate.getDay();

            let count = 0;
            for(let i = prevMonthLastDate.getDate() - startDay + 1; i <= prevMonthLastDate.getDate(); i++, count++){
                let events = this.scheduleList.filter(x => x.viewstart.getMonth() === prevMonthLastDate.getMonth() && x.viewstart.getDate() === i).slice(0, 2);
                let template = this.dayTemplate(prevMonthLastDate.getFullYear(), prevMonthLastDate.getMonth(), i, events, "muted");
                this.$calender.append(template);
            }

            for(let i = 1; i <= currentMonthLastDate.getDate(); i++, count++){
                let events = this.scheduleList.filter(x => x.viewstart.getMonth() === calenderDate.getMonth() && x.viewstart.getDate() === i).slice(0, 2);
                let template = this.dayTemplate(calenderDate.getFullYear(), calenderDate.getMonth(), i, events);
                this.$calender.append(template);
            }

            let nextMonthDate  = new Date(year, month);
            for(let i = 1; i <= 7 - count % 7; i++){                
                let events = this.scheduleList.filter(x => x.viewstart.getMonth() === nextMonthDate.getMonth() && x.viewstart.getDate() === i).slice(0, 2);
                 let template = this.dayTemplate(nextMonthDate.getFullYear(), nextMonthDate.getMonth(),i, events, "muted");
                this.$calender.append(template);
            }
        }

        dayTemplate(year, month, date, events = [], className = ""){
            let eventHTML = events.reduce((p, c) => p + `<div class="events">${c.movie_name}</div>`, "");
            return $(`<a href="/schedules/detail?date=${year}-${month+1}-${date}" class="day${className ? " "+ className : ""}">
                            <span>${date}</span>
                            ${eventHTML}
                    </a>`)[0];
        }
    }

    window.addEventListener("load", () => {
        const app = new App();
    });

</script>