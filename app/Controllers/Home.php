<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }

    public function show_hotels(){
        return view('show_hotels');
    }

    public function hotels(){
        $db = db_connect();

        $sq1 = "SELECT h.Id, h.HotelName, h.Description, h.Stars, ci.City FROM hotels h LEFT JOIN cities ci ON ci.Id = h.CityId";
        $res = $db->query($sq1);
        $data['hotels'] = $res->getResultArray();

        if($this->request->getMethod() =='get'){
            $cityId = $this->request->getVar('cityId');
            $stars = $this->request->getVar('stars');

            if(!empty($cityId) && !empty($stars)){
                $sq2 = "SELECT h.Id, h.HotelName, h.Description, h.Stars, ci.City FROM hotels h LEFT JOIN cities ci ON ci.Id = h.CityId WHERE ci.Id = :cityId: and h.Stars = :stars:";
                $res = $db->query($sq2, ['cityId' => $cityId, 'stars' => $stars]);
                $data['hotels'] = $res -> getResultArray();
            }
            else if(empty($cityId) && !empty($stars)){
                $sq3 = "SELECT h.Id, h.HotelName, h.Description, h.Stars, ci.City FROM hotels h LEFT JOIN cities ci ON ci.Id = h.CityId WHERE h.Stars = :stars:";
                $res = $db->query($sq3, ['stars' => $stars]);
                $data['hotels'] = $res -> getResultArray();
            }
            else if(!empty($cityId) && empty($stars)){
                $sq4 = "SELECT h.Id, h.HotelName, h.Description, h.Stars, ci.City FROM hotels h LEFT JOIN cities ci ON ci.Id = h.CityId WHERE ci.Id = :cityId:";
                $res = $db->query($sq4, ['cityId' => $cityId]);
                $data['hotels'] = $res -> getResultArray();
            }
        }

        return view('hotels', $data);
    }
}
