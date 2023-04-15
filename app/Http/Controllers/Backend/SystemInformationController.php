<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SystemInformation;
use Image;
class SystemInformationController extends Controller
{
    public function index(){



        $ins_details = SystemInformation::latest()->get();

        $user = SystemInformation::first();


       return view('backend.system_information.index',['ins_details'=>$ins_details,'user'=>$user]);
   }



protected function imageUpload($request){
       $productImage = $request->file('logo');
       $imageName = $productImage->getClientOriginalName();
       $directory = 'public/uploads/';
       $imageUrl = $directory.$imageName;

       Image::make($productImage)->save($imageUrl);

       return $imageUrl;
   }



   protected function imageUpload_icon($request){
       $productImage = $request->file('icon');
       $imageName = $productImage->getClientOriginalName();
       $directory = 'public/uploads/';
       $imageUrl = $directory.$imageName;

       Image::make($productImage)->resize(202,202)->save($imageUrl);

       return $imageUrl;
   }

   public function store(Request $request){


       // Validation Data
       $request->validate([
           'logo' => 'required|max:350',

       ]);




         if($request->file('logo')!==null){
       $image=$this->imageUpload($request);
     }else{
        $image=null;
     }


     if($request->file('icon')!==null){
       $icon=$this->imageUpload_icon($request);
     }else{
        $icon=null;
     }

       // Create New User
       $user = new SystemInformation();
       $user->System_Name = $request->System_Name;
       $user->Address = $request->Address;
       $user->Phone = $request->Phone;
       $user->Email = $request->Email;

       $user->logo = $image;
       $user->icon = $icon;




        $user->save();

       return redirect()->route('admin.system_information')->with('success','Created successfully!');


   }


   public function update(Request $request){


       // Create New User
       $user =SystemInformation::find($request->id);
       $user->System_Name = $request->System_Name;
       $user->Address = $request->Address;
       $user->Phone = $request->Phone;
       $user->Email = $request->Email;
    
       if ($request->hasfile('logo')) {
           $file = $request->file('logo');
           $extension = $file->getClientOriginalExtension();
           $filename = time() . '.' . $extension;
           $file->move('public/uploads/', $filename);
           $user->logo = 'public/uploads/' . $filename;
       }

       if ($request->hasfile('icon')) {
           $file = $request->file('icon');
           $extension = $file->getClientOriginalExtension();
           $filename = time() . '.' . $extension;
           $file->move('public/uploads/', $filename);
           $user->icon = 'public/uploads/' . $filename;
       }


       $user->save();

       return redirect()->route('admin.system_information')->with('success','Updated successfully!');


   }


   public function delete($id){

        $user = SystemInformation::find($id);
       if (!is_null($user)) {
           $user->delete();
       }


       return redirect()->route('admin.system_information')->with('error','Deleted successfully!');
   }
}
