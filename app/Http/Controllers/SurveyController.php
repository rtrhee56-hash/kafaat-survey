<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SurveySubmittedMail;
use App\Models\Survey; // تم إضافة السطر المطلوب

class SurveyController extends Controller
{
    public function show()
    {
        return view('survey');
    }

    public function submit(Request $request)
    {
        // 1. التحقق من صحة البيانات
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|string',
            'ratings' => 'required|array',
            'recommendation' => 'required|string',
            'overall_rating' => 'required|integer', 
            'notes' => 'nullable|string',
        ]);

        // 2. الحفظ في قاعدة البيانات
        Survey::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'ratings' => json_encode($request->ratings),
            'recommendation' => $request->recommendation,
            'overall_rating' => $request->overall_rating,
            'notes' => $request->notes,
        ]);

        // 3. إرسال الإيميل
        Mail::to('kafaattrainning1@gmail.com')->send(new SurveySubmittedMail($validated));

        // 4. العودة برسالة نجاح
        return redirect()->back()->with('success', 'تم إرسال الاستبيان وحفظ البيانات بنجاح!');
    }
}