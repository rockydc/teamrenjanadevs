<?php

namespace App\Http\Controllers\API;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contactform;
class ClientController extends Controller
{
    //

    public function getallcontactform(Request $request){
        $id = $request->input('id');
        $userid = $request->input('userid');
        $limit = $request->input('limit',6);
  
        
        if($id){
            $data = ContactForm::find($vendor_id);
            if($data){
                return ResponseFormatter::success(
                    $data,
                    'Data client berhasil diambil'
                );
            }else{
                return ResponseFormatter::error(
                    null,
                    'Data Client tidak ada',
                    404
                );
            }

            
        }

        $data = ContactForm::query();
      
        if($userid){
            $data->where('userid','=',$userid);
        }

        return ResponseFormatter::success(

            $data->paginate($limit),
            'Data list Berhasil diambil'
        );
 

    }
    public function postcontactform(Request $request){
        try{

            $request->validate([
                'name' => ['required','string','max:255'],
                'date'=>['required','date'],
                'email'=>'email:rfc,dns',
                'userid' => 'required|exists:users,id'

            ]);
            Contactform::create([
                'userid'=>$request->userid,
                'name'=>$request->name,
                'type'=>$request->type,
                'location'=>$request->location,
                'date'=>$request->date,
                'whatsapp'=>$request->whatsapp,
                'email'=>$request->email
            ]);

            $data = Contactform::where('email',$request->email)->first();
         
       
            return ResponseFormatter::success([
                'data'=>$data
            ],
           'Isi Form success');
        }catch (Exception $error){

            return ResponseFormatter::error([
                'message'=> 'Register Gagal',
                'error'=> $error
            ], 'Authentication Failed',500);
        }
    }
}
