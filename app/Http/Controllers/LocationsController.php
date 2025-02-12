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
    static function routePostValidateControl($request){
        $validated = $request->validate(
            [
                'latitude' => 'required|numeric|between:-90,90',
                'longitude' => 'required|numeric|between:-180,180',
            ],
            [
                'latitude.numeric' => 'Enlem numerik değer olmalıdır.',
                'latitude.between' => 'Enlem değeri -90 ile +90 arası olmalıdır',
                'latitude.required' => 'Enlem değeri zorunlu bir alandır',                
                'longitude.numeric' => 'Boylam değeri numerik olmalıdır',
                'longitude.between' => 'Enlem değeri -180 ile +180 arası olmalıdır',
                'longitude.required' => 'Enlem değeri zorunlu bir alandır',  
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
    public static function getYandexApiKey(){
        $_key=env('YANDEX_API_KEY');
        return $_key;
    }     
    function listLocations(){
        $_per_page=10;
        $locations = Locations::paginate($_per_page);
        $site_title='Konum Listesi';
        $pageAssets=[
            'js'=>[
                'https://api-maps.yandex.ru/2.1/?lang=tr_TR&apikey='.self::getYandexApiKey(),
            ],            
        ]; 
        $create_route=0;       
        if(isset($_GET['create_route'])){
            if($_GET['create_route']){
                $site_title='Rota Oluştur';
                $create_route=1;   
            }
        }
        return view('locations.list',['create_route'=>$create_route,'locations'=>$locations,'pageAssets'=>$pageAssets,'site_title'=>$site_title]); 
    } 
    static function getSingleLocation($id){
        
        $location = Locations::where('id', $id)->first();  
        if($location){
        }else{
            return redirect('/');
        }      
        $pageAssets=[
            'js'=>[
                'https://api-maps.yandex.ru/2.1/?lang=tr_TR&apikey='.self::getYandexApiKey(),
            ],            
        ];
        $site_title=$location->name.' - Lokasyon';
        return view('locations.single',['location'=>$location,'pageAssets'=>$pageAssets,'site_title'=>$site_title]);
    } 
    static function createRoute($id){
        $location = Locations::where('id', $id)->first();  
        if($location){

        }else{
            return redirect('/');
        }        
        $site_title='Rota Oluştur';
        return view('locations.route',['location'=>$location,'site_title'=>$site_title]);        
    }
    static function createRoutePost(Request $request, $id){
        self::routePostValidateControl($request);
        $location = Locations::where('id', $id)->first();  
        if($location){

        }else{
            return redirect('/');
        }        
        $site_title='Rota Oluştur';
        $latitude = $request->post('latitude');
        $longitude = $request->post('longitude');
        $post_datas['latitude']=$latitude;
        $post_datas['longitude']=$longitude;
        $distance=self::getDistanceTwoCoordinate($location->latitude,$location->longitude,$latitude,$longitude);
        $pageAssets=[
            'js'=>[
                'https://api-maps.yandex.ru/2.1/?lang=tr_TR&apikey='.self::getYandexApiKey(),
            ],            
        ]; 
        return view('locations.route',['distance'=>$distance,'pageAssets'=>$pageAssets,'post_datas'=>$post_datas,'location'=>$location,'site_title'=>$site_title]);         
    }
    static function getDistanceTwoCoordinate($latitude1, $longitude1, $latitude2, $longitude2) {
        $theta = $longitude1 - $longitude2; 
        $distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta))); 
        $distance = acos($distance); 
        $distance = rad2deg($distance); 
        $distance = $distance * 60 * 1.1515; 
        $distance = $distance * 1.609344;       
        return (round($distance,2));
      }    
}
