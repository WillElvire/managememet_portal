<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\archive;
use App\Models\batch;
use App\Models\department;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BatchController extends Controller
{
    //
    public function addNewBatch(Request $request)
    {
        
        $archives = $request->archive;
        $date = $request->date;
        $teller = $request->teller;
        $department = $this->getDepartment($request);
        for($i = 0; $i < count($teller); $i++) :
            $archive = archive::firstWhere(['name'=>$archives]);
            batch::create([
                'user_id' => Auth()->user()->id,
                'department_id' => $department->id,
                'archive_id' => $archive->id,
                'teller_id' => $teller[$i],
                'date' => Carbon::createFromFormat('Y-m-d',$date)->format('Y/m/d'),
            ]);
        endfor;
        return response()->json([
            'message'=>true
        ],200);
    }
    
    /**
     * 
     */
    public function getBatchFromDate(Request $request)
    {
        $date = Carbon::createFromFormat('d/m/Y',$request->date)->format('Y/m/d');

        $department = $this->getDepartment($request);
    
        $batchs = batch::with('Department','Archive','User')->where(['date'=>$date,'department_id'=>$department->id])->get();

        return response()->json(['batchs'=>$batchs]);
    }
    /**
     * 
     */
    public function updateBatch(Request $request,$id){

        $archive = archive::firstWhere(['name'=>$request->archive]);

        $batch = batch::firstWhere(['id'=>$id]);

        $batch->update([
            'archive_id'=>$archive->id
        ]);
        
        return response()->json(['message'=>'The batch archive has been successfully updated']);
    }

    /**
     * 
     */
    public function reporting(){
        $allBatchs = batch::count();
        $userDailyBatch = batch::where(['user_id'=>Auth()->user()->id])->count();
        $dailyBatchs = batch::whereDate('created_at', Carbon::today())->count();
        return response()->json(['allBatchs'=>$allBatchs,'dailyBatchs'=>$dailyBatchs,'userDailyBatch'=>$userDailyBatch]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $batchs = batch::with('Department','Archive','User')->orderBy('created_at','desc')->get();
        return response()->json([...$batchs]);
    }
    /**
     * Display the specified resource.
     */
    public function interval(Request $request){
      
        $from = $date = Carbon::createFromFormat('d/m/Y',$request->from)->format('Y/m/d');
        $to = $date = Carbon::createFromFormat('d/m/Y',$request->to)->format('Y/m/d');
        $batchs = batch::with('Department','Archive','User')->whereBetween('date',[$from,$to ])->get();
        return response()->json([...$batchs]);
    }
    /**
     * encrypt message using openSSL
     */
    public function encrypt($message) : string {
        return openssl_encrypt($message, 'AES-128-ECB', 'secret');
    }
    /**
     * decrypt message using openSSL
     
     */
    public function decrypt($message) : string {
        return openssl_decrypt($message, 'AES-128-ECB', 'secret');
    }
    /**
     * get department
     */
    public function getDepartment(Request $request){
        return  $request->department ==='TSG' ?  
        department::firstWhere(['name' => $request->department.' '.$request->subsection]) 
        :  department::firstWhere(['name'=>$request->department]);
    }
}
