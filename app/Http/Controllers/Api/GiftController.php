<?php

namespace App\Http\Controllers\Api;
use App\Models\type;
use App\Models\detail;
use App\Models\gift;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
class GiftController extends Controller
{
    //

    public function store(Request $request){
        
        $gift_type = type::where(['id'=>$request->giftType])->first();
        $url = "";
        if($gift_type!=null){
            $detail = detail::create([
                'recepient_name' => $request->recepientName,
                'receiver_name' => $request->receiverName,
                'donor_name' => $request->donorName,
                'gift_content' => $request->giftContent,
                'gift_element' => $request->giftElement,
                'comment' => $request->deleted_at,
                'pourer_name' => $request->pourerName ? $request->pourerName : '',
                'amount' => $request->amount ? $request->amount : '',
                'file_url' => $request->image ?$request->image :'' ,
                'reception_date' => $request->receptionDate,
                'reception_agency' => $request->receptionAgency,
                'comment' => $request->Comment,
            ]);
            $gift = gift::create([
                'user_id' => $request->user_id,
                'type_id' => $gift_type->id,
                'detail_id' => $detail->id,
            ]);
            return response()->json(['message'=>'Gift created successfully']);
        }
        return responce()->json(['error'=>'Gift type not found'],404);

    
        
    }

    public function getGift(){
        $gifts = gift::with('type','detail','user')->get();
        return response()->json(['gifts'=>$gifts]);
    }

    public function reporting(Request $request){

        $allGifts = gift::with(['detail','type','user'])->get();
        $user = User::where(['group_id'=>2])->count();
        $dailyGift = gift::whereDate('created_at',Carbon::today())->count();
        $dailyHistory = gift::with(['detail','type','user'])->whereDate('created_at',Carbon::today())->limit(2)->get();
        return response()->json([$allGifts,$user,$dailyGift,$dailyHistory], 200);

    }

    public function deleteGift($id){
        $gift = gift::where(['id'=>$id])->first();
        if($gift!=null){
            detail::where(['id'=>$gift->detail_id])->delete();
            $gift->delete();
            return response()->json(['message'=>'Gift deleted successfully']);
        }
        return response()->json(['error'=>'Gift not found'],404);
    }

     public function getTheGift($id){
        $gift = gift::with('type','detail','user')->where(['id'=>$id])->first();
        return response()->json(['gift'=>$gift]);
     }

     public function getFromDate(Request $request){
         
        
        $date =$request->date;
        //return response()->json($date);
        $gifts = gift::with('type','detail','user')->where(['created_at'=>$date])->get();
        return response()->json(['gifts'=>$gifts]);
     }

     public function updateGift(Request $request , $id){
        return response()->json([$request->all()]);
     }


}
