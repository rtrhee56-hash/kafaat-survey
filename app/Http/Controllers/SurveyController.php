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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|string',
            'ratings' => 'required|array',
            'recommendation' => 'required|string',
            'overall_rating' => 'required|integer',
            'notes' => 'nullable|string',
        ]);

        try {

            $survey = Survey::create([
                'name' => $validated['name'],
                'gender' => $validated['gender'],
                'ratings' => json_encode($validated['ratings']),
                'recommendation' => $validated['recommendation'],
                'overall_rating' => $validated['overall_rating'],
                'notes' => $validated['notes'] ?? null,
            ]);

            dd($survey);

        } catch (\Exception $e) {

            dd($e->getMessage());

        }

        Mail::to('kafaattrainning1@gmail.com')
            ->send(new SurveySubmittedMail($validated));

        return redirect()->back()->with('success', 'تم إرسال الاستبيان وحفظ البيانات بنجاح!');
    }
}