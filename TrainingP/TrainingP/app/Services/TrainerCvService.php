<?php

namespace App\Services;

use App\Models\TrainerCv;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TrainerCvService
{
    public function UploadTrainerCv(Request $request){
        try{
            $request->validate([
                'uploadPdf' => 'required|file|mimes:pdf|max:2048',
            ]);
    
            $path = $request->file('uploadPdf')->store('cvs');
    
            $cv = TrainerCv::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'cv_file' => $path
                ]
            );
            return [
                'msg' => "تم رفع السيرة الذاتية بنجاح",
                'success' => true,
                'data' => $cv
            ];
        }catch(\Exception $e){
            return [
                'msg' => $e->getMessage(),
                'success' => false,
                'data' => []
            ];
        }
    }
    
    public function getYourCv()
    {
        try{
            $userId = Auth::id();
            $cv = TrainerCv::where('user_id', $userId)->first();
            if (!$cv) {
                return [
                    'msg' => 'لم يتم العثور على السيرة الذاتية',
                    'success' => false, 
                    'data' => []
                ];
            }
    
            return [
                'msg' => 'تم جلب البيانات بنجاح',
                'success' => true, 
                'data' => $cv
            ];
        }catch(\Exception $e){
            return [
                'msg' => $e->getMessage(),
                'success' => false,
                'data' => []
            ];
        }
    }
    
    public function updateCv(Request $request, $id)
{
    try {
        $request->validate([
            'uploadPdf' => 'required|file|mimes:pdf|max:2048',
        ]);

        $cv = TrainerCv::findOrFail($id);
        if ($cv->cv_file && Storage::exists($cv->cv_file)) {
            Storage::delete($cv->cv_file);
        }
        $path = $request->file('uploadPdf')->store('cvs');
        $cv->cv_file = $path;
        $cv->save();

        return [
            'msg' => "تم تحديث السيرة الذاتية بنجاح",
            'success' => true,
            'data' => $cv
        ];
    } catch (\Exception $e) {
        return [
            'msg' => $e->getMessage(),
            'success' => false,
            'data' => []
        ];
    }
}
    
    public function deleteCv($userId)
    {
        try{
            $cv = TrainerCv::where('user_id',$userId)->first();
            Storage::delete($cv->cv_file);
            $cv->delete();
            return [
                'msg' => 'تم حذف السيرة الذاتية بنجاح',
                'success' => true, 
                'data' => $cv
            ];
        }catch(\Exception $e){
            return [
                'msg' => $e->getMessage(),
                'success' => false,
                'data' => []
            ];
        }
    }
    
}
