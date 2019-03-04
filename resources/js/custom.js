import Axios from "axios";
$(document).ready(function() {
    if($('video#adVid').length > 0) {
        // Add AD details on database
        if(Cookies.get('ad_token') && Cookies.get('api_token')) {
            let data = {
                'ad_id': $('video#adVid').data('ad'),
                'ad_token': Cookies.get('ad_token')
            }
        
            let headers = {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer '+ Cookies.get('api_token'),
            }
            Axios.post('/api/adsdetails', data, {headers: headers}).then((res) => {
                console.log(res);
            }).catch((err) => {
                console.log(err);
            });

            // Update AD detail on Play or Pause video
        }else {
            alert('Something wents wrong try to Refresh this page');
        }

        let player = document.querySelector('.player');
        let viewer = player.querySelector('#adVid');
        let progressBar = player.querySelector('.progress-bar');
        let playToggle = player.querySelector('.playToggle');
        let vol = player.querySelector('.vol');
        let muteToggle = player.querySelector('.muteToggle');
        let fullScreen = player.querySelector('.fullScreen');
        let playbackTime = player.querySelector('.playback-time');

        viewer.controls = false;

        // Video Funcions
        function playVid () {
            const method = viewer.paused ? 'play' : 'pause';
            viewer[method]();
        }

        function btnUpd() {
            let iconPlay = '<i class="fas fa-play"></i>';
            let iconPause = '<i class="fas fa-pause"></i>';
            const icon = viewer.paused ? iconPlay : iconPause;

            playToggle.innerHTML = icon;
        }

        function fullScreenToggle() {
            if(document.fullscreenElement) {
                document.exitFullscreen();
            }else {
                player.requestFullscreen();
            }
        }

        function volumeUpd() {
            viewer.volume = vol.value;

            if(viewer.volume == 0) {
                muteToggle.innerHTML = '<i class="fas fa-volume-mute"></i>';
            }else {
                muteToggle.innerHTML = '<i class="fas fa-volume-up"></i>';
            }
        }

        function timeUpd() {
            if(viewer.paused) {
                viewer.onloadedmetadata = () => {
                    let duration = parseInt(Math.round(viewer.duration) / 60) + ':' + (Math.round(viewer.duration) - (parseInt(Math.round(viewer.duration) / 60) * 60) );
                    let currentTime = parseInt(Math.round(viewer.currentTime) / 60) + ':' + (Math.round(viewer.currentTime) - (parseInt(Math.round(viewer.currentTime) / 60) * 60) )
                    playbackTime.innerHTML = `${currentTime} / ${duration}`;
                }
            }else {
                let duration = parseInt(Math.round(viewer.duration) / 60) + ':' + (Math.round(viewer.duration) - (parseInt(Math.round(viewer.duration) / 60) * 60) );
                let currentTime = parseInt(Math.round(viewer.currentTime) / 60) + ':' + (Math.round(viewer.currentTime) - (parseInt(Math.round(viewer.currentTime) / 60) * 60) )
                playbackTime.innerHTML = `${currentTime} / ${duration}`;
            }
            
        }

        function progressUpd() {
            const progressPercent = ( viewer.currentTime / viewer.duration ) * 100;
            
            progressBar.style.width = `${progressPercent}%`;
            progressBar.dataset.areaValuenow = progressPercent;
        }

        // Video Event Listeners
        playToggle.addEventListener('click', playVid);

        btnUpd();
        viewer.addEventListener('click', playVid);
        viewer.addEventListener('pause', btnUpd);
        viewer.addEventListener('play', btnUpd);
        
        fullScreen.addEventListener('click', fullScreenToggle);

        vol.addEventListener('click', volumeUpd);
        vol.addEventListener('change', volumeUpd);
        vol.addEventListener('mousemove', volumeUpd);

        timeUpd();
        viewer.addEventListener('timeupdate', timeUpd);
        viewer.addEventListener('timeupdate', progressUpd);
    }
});
