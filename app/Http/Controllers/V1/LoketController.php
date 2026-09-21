<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Loket;
use App\Models\User;
use Illuminate\Http\Request;

class LoketController extends Controller
{
    public function index()
    {
        $data = Loket::with('user')->get();
        // جلب المستخدمين برتبة staff أو user لضمان ظهور كل الموظفين الجدد في القائمة
        $user = User::whereIn('role', ['staff', 'user'])->get();
        return view('backend.loket.index', compact('data', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'kode' => 'required',
            'user' => 'required|numeric'
        ]);

        $check = Loket::where([
            'user_id' => $request->user
        ])->get();

        if (count($check) >= 1) {
            return back()->with('galat', 'هذا الموظف مرتبط بالفعل بشباك آخر');
        }

        Loket::create([
            'tujuan' => $request->title,
            'kode' => $request->kode,
            'user_id' => $request->user,
            'status' => $request->status == true ? true : false
        ]);

        return back()->with('success', 'تمت إضافة الشباك بنجاح');
    }

    public function update(Request $request)
    {
        $data = Loket::find($request->loket);
        if (empty($data)) {
            return back()->with('galat', 'الشباك غير موجود');
        }

        $check = Loket::where([
            'user_id' => $request->user_id
        ])->get();

        if (count($check) >= 1) {
            if ($check[0]->id == $request->loket) {
                $data->update([
                    'user_id' => $request->user_id,
                    'status' => $request->status == true ? true : false
                ]);
            } else {
                return back()->with('galat', 'هذا الموظف مرتبط بالفعل بشباك آخر');
            }
        } else {
            $data->update([
                'user_id' => $request->user_id,
                'status' => $request->status == true ? true : false
            ]);
        }
        
        return back()->with('success', 'تم تحديث بيانات الشباك بنجاح');
    }

    public function destroy(Request $request)
    {
        $data = Loket::find($request->loket);
        if (empty($data)) {
            return back()->with('galat', 'الشباك غير موجود');
        }

        $data->delete();
        return back()->with('success', 'تم حذف الشباك بنجاح');
    }
}
