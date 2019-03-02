<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdsDetails extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id'   =>  $this->user_id,
            'ad_id' =>  $this->ad_id,
            'session_data'  =>  $this->session_data,
            'session_satus' =>  $this->session_status,
        ];
    }
}
