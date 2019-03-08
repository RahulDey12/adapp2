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
                const details_id = res.data.data.id;
                sessionStorage.setItem('details_id', details_id);

                // Update AD detail on Play or Pause video
                const ad = document.querySelector('#adVid');
            }).catch((err) => {
                console.log(err);
            });

            
        }else {
            alert('Something wents wrong try to Refresh this page');
        }
    }
});
