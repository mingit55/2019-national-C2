class Viewport {
    constructor(app){
        this.app = app;
        this.current_track = null;

        this.$canvas = document.createElement("canvas");
        this.$canvas.width = app.width;
        this.$canvas.height = app.height;

        this.ctx = this.$canvas.getContext("2d");
        this.ctx.lineCap = "round";

        app.$viewport.append(this.$canvas);
        this.app.$video.addEventListener("loadedmetadata", () => this.frame());
    }

    set track(input){
        if(this.current_track){
            this.app.$video.pause();
            this.app.$video.remove();
            this.current_track.$list.remove();
        }
        this.current_track = input;       

        this.app.$cliplist.append(input.$list);
    }

    select(e){
        let clipList = this.current_track.clipList.reverse();
        clipList.forEach(x => x.setActive(false)); // reverse 문제 해결바람
        let clip = this.current_track.clipList.find(x => x.selectDownAll(e));
        if(clip) clip.setActive(true);

        clipList.reverse();

        return clip; // 해당되는 클립을 리턴해야함
    }


    // View Method

    frame(){
        if(this.current_track){
            const {currentTime, duration} = this.app.$video;
            this.app.$playtime.currentTime.innerText = currentTime.parseTimer();
            this.app.$playtime.duration.innerText = duration.parseTimer();
            this.current_track.seekCursor();

            this.render();
        }

        requestAnimationFrame(() => {
            this.frame();
        });
    }

    render(){
        const { currentTime } = this.app.$video;

        this.ctx.clearRect(0, 0, this.app.width, this.app.height);
        this.current_track.clipList.filter(clip => {
            return clip.startTime <= currentTime && currentTime <= clip.startTime + clip.duration;
        }).forEach(clip => {
            clip.mergeList.forEach(clip => clip.redraw(this.ctx));
        });
    }

    play(){
        this.app.$video.play();
    }

    pause(){
        this.app.$video.pause();
    }
}