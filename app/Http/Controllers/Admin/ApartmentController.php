<?php

namespace App\Http\Controllers\Admin;

use App\Apartment;
use App\Service;
use App\Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApartmentController extends Controller
{
    protected $validation = [
        'name'=>'required|string|max:60',
        'description'=>'required|string',
        'rooms'=>'required|integer|min:1|max:99',
        'beds'=>'required|integer|min:1|max:99',
        'bathrooms'=>'required|integer|min:1|max:99',
        'square_meters'=>'required|integer|min:1|max:999',
        'address'=>'required|string|max:80',
        // 'images.*'=>'nullable|image|mimes:jpg,jpeg,png,bmp',
        'services'=>'exists:services,id'
    ];


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id= Auth::user()->id;
        $apartments=Apartment::all()->where('user_id',$user_id);
        return view('admin.apartments.index',compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        return view('admin.apartments.create',compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form_data=$request->all();
        // fetch user id
        $user_id = $request->user()->id;
        $form_data['user_id'] = $user_id;
        if (isset ($request -> visible)) {
            $form_data['visible']=true;
        }else {
            $form_data['visible']=false;
        };

        //geocoding 
        $address = $form_data['address'];
        $address = urlencode($address);
        $url = "https://api.tomtom.com/search/2/geocode/{$address}.json?key=5EIy0DQg5tZyBLLvAxNfCI6ei8DPGcte&storeResult=limit=20&countrySet=IT&language=it-IT";
        $response_json = file_get_contents($url);
        $response = json_decode($response_json, true);
        $form_data['lat']=$response['results'][0]['position']['lat'];
        $form_data['lon']=$response['results'][0]['position']['lon'];

        
        //validation
        $request->validate($this->validation);

        $apartment = new Apartment();   

        //slug
        $slugName= Str::slug($form_data['name']);
        $count = 2;
        while(Apartment::where('slug',$slugName)->first()){
            $slugName=Str::slug($form_data['name'])."-".$count;
            $count++;
        }
        $form_data['slug'] = $slugName;

        $apartment->fill($form_data);


        $apartment->save();

        //images
        $imgcount = 1;
        if(isset($form_data['images'])) { 
            foreach($form_data['images'] as $image){
                $new_image = new Image();
                $img_path = Storage::put('uploads', $image);
                $new_image->url = $img_path;
                if($imgcount==1){
                    $new_image->main_image = true;
                }
                else{
                    $new_image->main_image = false;
                }
                $imgcount++;
                $new_image->apartment()->associate($apartment);
                $new_image->save();
            }
        }

        //pivot
        $apartment->services()->sync(isset($form_data['services']) ? $form_data['services'] : [] );

        return redirect()->route('admin.apartments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        return view('admin.apartments.show',compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        $services = Service::all();
        return view('admin.apartments.edit',compact('apartment','services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apartment $apartment)
    {
        $form_data=$request->all();
        
        if (isset ($request -> visible)) {
            $form_data['visible']=true;
        }else {
            $form_data['visible']=false;
        };

        //validation
        $request->validate($this->validation);

        //slug 
        if(!($form_data['name'] == $apartment->name)){
            $count = 2;
            $slugName= Str::slug($form_data['name']);
            while(Apartment::where('slug',$slugName)->first()){
                $slugName=Str::slug($form_data['name'])."-".$count;
                $count++;
            }
            $form_data['slug'] = $slugName;
        }

        $apartment->update($form_data);

        //images
        if(isset($form_data['images'])) { 
            foreach($form_data['images'] as $image){
                $new_image = new Image();
                $img_path = Storage::put('uploads', $image);
                $new_image->url = $img_path;
                $new_image->main_image = false;
                $new_image->apartment()->associate($apartment);
                $new_image->save();
            }
        }

        $apartment->services()->sync(isset($form_data['services']) ? $form_data['services'] : [] );

        return redirect()->route('admin.apartments.show',compact('apartment'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        $apartment->delete();

        return redirect()->route('admin.apartments.index')->with(["message"=>"Il tuo appartamento è stato eliminato!"]);
    }
}
