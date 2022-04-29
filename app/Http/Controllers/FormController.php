<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Contactform;
use Response;
use File;
use App\Models\Banner;
class FormController extends Controller
{
    //

    public function index($id=1)
    {
        //
        $userid = $id;
        return view('form.index',
        [
            'userid'=>$userid
        ]);
    }
    public function thankyou(){
        return view('form.thankyou');
    }
    public function postdata(Request $request){
        $data = $request->all();
        Contactform::create($data);
      
      return  $this->downloadPrice();
       
    }

    public function downloadPrice(){
        $getbanner = Banner::latest('id')->first();
        $filename = $getbanner->name;
     
        $pricelist = $getbanner->filePath;
        $path = "storage/".$pricelist;
        $headers = array(
            'Content-Type: application/pdf',
          );
          return redirect()->to(url($path));
        
    }

}
