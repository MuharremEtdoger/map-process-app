<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Locations;


class LocationsController extends Controller
{
    function addLocation(){
        $pageAssets=[
            'css'=>[
                '/assets/css/spectrum.min.css',
            ],
            'js'=>[
                '/assets/js/spectrum.min.js',
            ],            
        ];
        $site_title='Lokasyon Ekle';
        return view('locations.add',['pageAssets'=>$pageAssets,'site_title'=>$site_title]);        
    }
    static function locationPostValidateControl($request){
        $validated = $request->validate(
            [
                'latitude' => 'required|numeric|between:-90,90',
                'longitude' => 'required|numeric|between:-180,180',
                'color' => 'required|hex_color',
                'name' => 'required|min:3',
            ],
            [
                'latitude.numeric' => 'Enlem numerik değer olmalıdır.',
                'latitude.between' => 'Enlem değeri -90 ile +90 arası olmalıdır',
                'latitude.required' => 'Enlem değeri zorunlu bir alandır',                
                'longitude.numeric' => 'Boylam değeri numerik olmalıdır',
                'longitude.between' => 'Enlem değeri -180 ile +180 arası olmalıdır',
                'longitude.required' => 'Enlem değeri zorunlu bir alandır',  
                'color.required'=>'Renk zorunlu bir alandır',
                'color.hex_color'=>'Renk kodu hexadecimal olmalıdır',
                'name.required'=>'Konumun adı zorunlu alandır',
                'name.min'=>'Konumun adı minimum 3 karakter olmalıdır',
            ]
        );  
    }
    function addLocationPost(Request $request){
        $token = $request->session()->token();
        $_token = $request->post('_token');
        $latitude = $request->post('latitude');
        $longitude = $request->post('longitude');
        $name = $request->post('name');
        $color = $request->post('color');
        self::locationPostValidateControl($request);
        if($token==$_token){
            $inserted = Locations::create([
                'latitude' => $latitude,
                'longitude' => $longitude,
                'name' => $name,
                'color' => $color,
            ]);
            if($inserted){
                $data=json_decode($inserted);
                return redirect('/update-location/'.$data->id.'?redirect=add_after');
            }
        }else{
           echo 'Token Geçersiz';
           exit;
        }       
    }
    static function updateLocation($id){
        $pageAssets=[
            'css'=>[
                '/assets/css/spectrum.min.css',
            ],
            'js'=>[
                '/assets/js/spectrum.min.js',
            ],            
        ];
        $site_title='Lokasyon Düzenle';
        $location = Locations::where('id', $id)->first();  
        if($location){
        }else{
            return redirect('/');
        }      
        return view('locations.update',['location'=>$location,'pageAssets'=>$pageAssets,'site_title'=>$site_title]); 
    }
    static function updateLocationPost(Request $request, $id){
        $token = $request->session()->token();
        $_token = $request->post('_token');
        $latitude = $request->post('latitude');
        $longitude = $request->post('longitude');
        $name = $request->post('name');
        $color = $request->post('color');
        self::locationPostValidateControl($request);
        if($token==$_token){          
            $location = Locations::find($id);
            if($location){
                $location->latitude = $latitude;
                $location->longitude = $longitude;
                $location->name = $name;
                $location->color = $color;
                $location->save();
                return redirect('/update-location/'.$id.'');                
            }else{
                return redirect('/');
            }
        }else{
           echo 'Token Geçersiz';
           exit;
        }       
    }    
}
