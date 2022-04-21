<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\archive;
use App\Models\batch;
use App\Models\department;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    //
    public function addNewBatch(Request $request)
    {
        $department = department::firstWhere(['name' => $request->department]);
        $archive = archive::firstWhere(['name' => $request->archive]);
        $newBatch = batch::create([
            'user_id' => Auth()->user()->id,
            'department_id' => $department->id,
            'archive_id' => $archive->id,
            'teller_id' => $request->teller_id,
            'date' => $request->date
        ]);
        return response()->json([
            'batch'=>$newBatch
        ],200);
    }

    public function getBatchFromDate(Request $request)
    {
        $department = department::firstWhere(['name'=>$request->department]);
        $batchs = batch::with('Department','Archive','User')->where(['date'=>$request->date,'department_id'=>$department->id])->get();
        return response()->json(['batchs'=>$batchs]);
    }

    public function updateBatch(Request $request,$id){
        $archive = archive::firstWhere(['name'=>$request->archive]);
        $batch = batch::fistWhere(['id'=>$id]);
        $batch->update([
            'archive_id'=>$archive->id
        ]);
        return response()->json(['message'=>'The batch archive has been successfully updated']);
    }
}
