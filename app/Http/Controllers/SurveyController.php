<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SurveySubmittedMail;
use App\Models\Survey;

class SurveyController extends Controller
{
    public function show()
    {
        return view('survey');
    }

    public function submit(Request $request)
    {
        // التحقق من صحة البيانات
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|string',
            'ratings' => 'required|array',
            'recommendation' => 'required|string',
            'overall_rating' => 'required|integer',
            'notes' => 'nullable|string',
        ]);

        // اختبار البيانات القادمة من الفورم
        dd($request->all());

        // سيتم تنفيذ الكود التالي بعد إزالة dd()

        Survey::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'ratings' => json_encode($request->ratings),
            'recommendation' => $request->recommendation,
            'overall_rating' => $request->overall_rating,
            'notes' => $request->notes,
        ]);

        Mail::to('kafaattrainning1@gmail.com')
            ->send(new SurveySubmittedMail($validated));

        return redirect()->back()->with('success', 'تم إرسال الاستبيان وحفظ البيانات بنجاح!');
    }
}