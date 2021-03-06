<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pool;
use Illuminate\Http\Request;
use App\Models\Voteer;
use Illuminate\Support\Facades\Session;
use App\Models\Result;

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
        if($request->name != null && $request->department != null) :
            if($files = $request->file('files')){
                foreach($files as $file){

                    $name = md5($file->getClientOriginalName());
                    $ext = strtolower($file->getClientOriginalExtension());
                    $imgfullname = $name . '.' . $ext;
                    $path = public_path().'/outfit/';
                    $imageUrl = $path . $imgfullname;
                    $file->move($path, $imgfullname);
                    $images[] = $imgfullname;
                    $voteer = Voteer::create([
                        'name'=>$data['name'],
                        'department'=>$data['department'],
                        'image_url'=>'/outfit/'.$imgfullname,
                    ]);

                    Result::create([
                        'voteer_id'=>$voteer->id,
                        'result'=>0,
                    ]);
                }
            }

            Session::flash('message', 'image has been successfully uploaded');
            return back();
        else:
            Session::flash('error', 'Plz fill all fields');
            return back();
        endif;

    }

    public function result(){
        $result = Result::with('Voteer')->orderBy('result','desc')->limit(6)->get();
        return response()->json($result);
    }

    public function addPool(Request $request){

        $result = Result::where(['voteer_id'=>$request->vote])->first();
        $pool = Pool::where(['user_id'=>$request->user_id])->first();
        if($pool==null){
            Pool::create([
                'user_id'=>$request->user_id,
                'voteer_id'=>$request->vote
            ]);
            $result->update([
                'result'=>$result->result + 1
            ]);
            return response()->json(['message'=>'you have successfully voted']);
        }
        return response()->json(['message'=>'you have already voted']);

    }
}
