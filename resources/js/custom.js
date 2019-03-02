import Axios from "axios";
$(document).ready(function() {
    if($('#ad').length > 0) {

        let data = {
            'ad_id': $('#ad').data('ad'),
            'ad_token': Cookies.get('ad_token')
        }
    
        let headers = {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer '+ Cookies.get('api_token'),
        }
        Axios.post('/api/adsdetail', data, {headers: headers}).then((res) => {
            console.log(res);
        }).catch((err) => {
            console.log(err);
        });
        
    }
});