<?php

namespace App\Services;

use App\Models\Portfolio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PortfolioService
{
    public function showPortfolio(){
        try{
            $userId = Auth::id();
            $protofolio = Portfolio::where('user_id',$userId)->get();
            return [
                'msg' => 'تم جلب البيانات.',
                'success' => true,
                'data' => $protofolio
            ];
        }catch(\Exception $e){
            return [
                'msg' => $e->getMessage(),
                'success' => false,
                'data' => []
            ];
        }
    }

    public function storePortfolio($data)
{
    try {
        $userId = Auth::id();
        $data['user_id'] = $userId;

        // معالجة حقل الملف أو الرابط
        if (request()->hasFile('file')) {
            $uploadedFile = request()->file('file');
            $filePath = $uploadedFile->store('portfolios', 'public');
            $data['file'] = $filePath; // تخزين مسار الملف في قاعدة البيانات
        } else {
            // المستخدم أدخل رابط خارجي
            $data['file'] = $data['file']; // ستُخزن كـ URL نصي كما هي
        }

        if (request()->hasFile('photo')) {
            $photoPath = request()->file('photo')->store('portfolios/photos', 'public');
            $data['photo'] = $photoPath; // مثال: portfolios/photos/image.jpg
        }


        $portfolio = Portfolio::create($data);

        return [
            'msg' => 'تم تخزين البيانات.',
            'success' => true,
            'data' => $portfolio
        ];
    } catch (\Exception $e) {
        return [
            'msg' => $e->getMessage(),
            'success' => false,
            'data' => []
        ];
    }
}

public function updatePortfolio($data, $id)
{
    try {
        $portfolio = Portfolio::findOrFail($id);

        // تحديث الملف أو الرابط
        if (request()->hasFile('file')) {
            // حذف الملف القديم إن لم يكن رابطاً
            if ($portfolio->file && !filter_var($portfolio->file, FILTER_VALIDATE_URL)) {
                Storage::disk('public')->delete($portfolio->file);
            }

            $data['file'] = request()->file('file')->store('portfolios', 'public');
        }

        // تحديث الصورة
        if (request()->hasFile('photo')) {
            if ($portfolio->photo) {
                Storage::disk('public')->delete($portfolio->photo);
            }

            $data['photo'] = request()->file('photo')->store('portfolios/photos', 'public');
        }

        $portfolio->update($data);

        return [
            'msg' => 'تم تعديل البيانات.',
            'success' => true,
            'data' => $portfolio
        ];
    } catch (\Exception $e) {
        return [
            'msg' => $e->getMessage(),
            'success' => false,
            'data' => []
        ];
    }
}

public function deletePortfolio($id)
{
    try {
        $portfolio = Portfolio::findOrFail($id);

        if ($portfolio->photo) {
            Storage::disk('public')->delete($portfolio->photo);
        }

        if ($portfolio->file && !filter_var($portfolio->file, FILTER_VALIDATE_URL)) {
            Storage::disk('public')->delete($portfolio->file);
        }
        $portfolio->delete();

        return [
            'msg' => 'تم مسح البيانات.',
            'success' => true,
            'data' => $portfolio
        ];
    } catch (\Exception $e) {
        return [
            'msg' => $e->getMessage(),
            'success' => false,
            'data' => []
        ];
    }
}

}
