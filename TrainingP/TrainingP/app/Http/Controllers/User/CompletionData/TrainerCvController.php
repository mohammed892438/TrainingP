<?php

namespace App\Http\Controllers\User\CompletionData;

use App\Http\Controllers\Controller;
use App\Http\Requests\TrainerCvRequests\deleteCvRequest;
use App\Http\Requests\TrainerCvRequests\uploadCv;
use App\Models\TrainerCv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TrainerCvController extends Controller
{

    public function uploafdCv(uploadCv $request)
{
    $path = $request->file('uploadPdf')->store('cvs', 'public');

    $cv = TrainerCv::updateOrCreate(
        ['user_id' => Auth::id()],
        ['cv_file' => $path]
    );

    return redirect()->route('show_trainer_profile')->with('success', 'تم رفع السيرة الذاتية بنجاح.');
}


public function deleteCv(deleteCvRequest $request)
{
    $userId = Auth::id();
    $cv = TrainerCv::where('user_id',$userId)->first();
    Storage::delete($cv->cv_file);
    $cv->delete();

    return redirect()->route('show_trainer_profile')->with('success', 'تم رفع السيرة الذاتية بنجاح.');
}

}
