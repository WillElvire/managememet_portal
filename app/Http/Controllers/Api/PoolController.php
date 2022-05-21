<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pool;
use Illuminate\Http\Request;
use App\Models\Voteer;
use Illuminate\Support\Facades\Session;

class PoolController extends Controller
{
    //

    public function getVoteer(){
        $voteer = Voteer::all();
        return response()->json($voteer);
    }

    public function verify($id){
        $pool = Pool::where(['user_id'=>$id])->get();
        return response()->json($pool->count());
    }

    public function upload(Request $request){

        $data = $request->except('token','files');
        $images = array();
        if($files = $request->file('files')){
            foreach($files as $file){

                $name = md5($file->getClientOriginalName());
                $ext = strtolower($file->getClientOriginalExtension());
                $imgfullname = $name . '.' . $ext;
                $path = public_path().'/outfit/';
                $imageUrl = $path . $imgfullname;
                $file->move($path, $imgfullname);
                $images[] = $imgfullname;
                Voteer::create([
                    'name'=>$data['name'],
                    'department'=>$data['department'],
                    'image_url'=>'/outfit/'.$imgfullname,
                ]);
            }
        }

       Session::flash('message', 'image has been successfully uploaded');
       return back();


    }
}