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
                    'userId' => Auth::id(),
                    'cvFile' => $path
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
            $cv = TrainerCv::where('userId', $userId)->first();
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
                'cvFile' => 'required|file|mimes:pdf|max:2048',
            ]);
    
            $cv = TrainerCv::findOrFail($id);
            Storage::delete($cv->cvFile);
            $path = $request->file('uploadPdf')->store('cvs');
            $cv->cvFile = $path;
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
            $cv = TrainerCv::where('userId',$userId)->first();
            Storage::delete($cv->cvFile);
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
