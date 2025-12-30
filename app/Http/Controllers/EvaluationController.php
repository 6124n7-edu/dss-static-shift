<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use App\Models\Criteria;
use App\Models\Evaluation;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    // Show list of alternatives to grade
    public function index()
    {
        $alternatives = Alternative::all();
        return view('evaluations.index', compact('alternatives'));
    }

    // Show form to grade ONE alternative
    public function edit(Alternative $alternative)
    {
        $criterias = Criteria::all();

        // Get existing scores if any
        $existingEvaluations = Evaluation::where('alternative_id', $alternative->id)
            ->pluck('score', 'criteria_id')
            ->toArray();

        return view('evaluations.edit', compact('alternative', 'criterias', 'existingEvaluations'));
    }

    // Save scores
    public function update(Request $request, Alternative $alternative)
    {
        // 1. VALIDATION (The Fix)
        // This ensures every score is selected and is a number between 1 and 5
        $request->validate([
            'scores' => 'required|array',
            'scores.*' => 'required|numeric|min:1|max:5',
        ], [
            'scores.required' => 'Data penilaian tidak boleh kosong.',
            'scores.*.required' => 'Semua kriteria harus diisi nilainya!',
            'scores.*.min' => 'Nilai minimal adalah 1',
            'scores.*.max' => 'Nilai maksimal adalah 5.',
            'scores.*.numeric' => 'Nilai harus berupa angka valid.'
        ]);

        $scores = $request->input('scores');

        // 2. SAVE TO DATABASE
        foreach ($scores as $criteriaId => $score) {
            Evaluation::updateOrCreate(
                [
                    'alternative_id' => $alternative->id,
                    'criteria_id' => $criteriaId
                ],
                [
                    'score' => $score
                ]
            );
        }

        return redirect()->route('evaluations.index')->with('success', 'Penilaian berhasil disimpan!');
    }
}
