<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\facades\Storage;

use App\Apartment;
use App\Image;
use App\Service;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApartmentController extends Controller
{
    protected $validation = [
        'name'=>'required|string|max:20',
        'description'=>'required|string',
        'rooms'=>'required|integer|min:1|max:99',
        'beds'=>'required|integer|min:1|max:99',
        'bathrooms'=>'required|integer|min:1|max:99',
        'square_meters'=>'required|integer|min:1|max:999',
        'address'=>'required|string|max:80',
        'image'=>'nullable| mimes:jpeg, bmp, png,jpg| max:2048',
        //'image'=>'exists:images,id',
        'services'=>'exists:services,id'
    ];


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments=Apartment::all();
        $images=Image::all();
        $services=Service::all();
        $users=User::all();
        return view('admin.apartments.index',compact('apartments','services','images','users'));
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
        $form_data['lat']=0;
        $form_data['lon']=0;
        if (isset ($request -> visible)) {
            $form_data['visible']=true;
        }else {
            $form_data['visible']=false;
        };
        $form_data['description']="a";
        //validation
        $request->validate($this->validation);

        $apartment = new Apartment(); 
        //image
        if(isset($form_data["image"])){
            // save img 
            $img_path = Storage::put('uploads', $form_data['image']);
            //save img in Database
            $form_data["image"] = $img_path;
        }  

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
        $images = Image::all();
        $services = Service::all();
        return view('admin.apartments.show',compact('apartment','images','services'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        $images = Image::all();
        $services = Service::all();
        return view('admin.apartments.edit',compact('apartment','images','services'));
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
        //fetch user id
        $user_id = $request->user()->id;
        $request['user_id'] = $user_id;

        if (isset ($request -> visible)) {
            $form_data['visible']=true;
        }else {
            $form_data['visible']=false;
        };

        //validation
        $request->validate($this->validation);

        $form_data=$request->all();
        
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
