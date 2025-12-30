<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Criteria;
use App\Models\Alternative;
use App\Models\Evaluation;

class ArasController extends Controller
{
    public function index()
    {
        // 1. Fetch Data
        $criterias = Criteria::all();
        $alternatives = Alternative::all();
        $evals = Evaluation::all();

        // Build Matrix [alt_id][crit_id] = score
        $matrix = [];
        foreach ($evals as $e) {
            $matrix[$e->alternative_id][$e->criteria_id] = $e->score;
        }

        // 2. Determine Optimal Value (A0)
        $A0 = [];
        foreach ($criterias as $c) {
            $colValues = [];
            foreach ($alternatives as $a) {
                $colValues[] = $matrix[$a->id][$c->id] ?? 0;
            }
            
            // For Benefit: Max is best. 
            // For Cost (Scale 1-5 where 5=Cheap/Good): Max is best.
            // If using Raw Cost (Rp): Min is best. 
            // We use MAX here assuming 5=Cheap (Positive Scale).
            $A0[$c->id] = max($colValues); 
        }

        // Add A0 to data for processing
        $data = $matrix;
        $data[0] = $A0; // ID 0 represents A0

        // 3. Normalize (R)
        $R = [];
        $colSums = [];

        // Calculate Sums
        foreach ($criterias as $c) {
            $sum = 0;
            foreach ($data as $altId => $row) {
                $val = $row[$c->id] ?? 0.0001;
                if ($c->type == 'Cost') {
                    $sum += (1 / $val); // Inverse for Cost
                } else {
                    $sum += $val;
                }
            }
            $colSums[$c->id] = $sum;
        }

        // Calculate Normalized Values
        foreach ($data as $altId => $row) {
            foreach ($criterias as $c) {
                $val = $row[$c->id] ?? 0.0001;
                if ($c->type == 'Cost') {
                    $norm = (1 / $val) / $colSums[$c->id];
                } else {
                    $norm = $val / $colSums[$c->id];
                }
                $R[$altId][$c->id] = $norm;
            }
        }

        // 4. Weighted Matrix (D) & Si
        $D = [];
        $Si = [];
        
        foreach ($R as $altId => $row) {
            $total = 0;
            foreach ($criterias as $c) {
                $weighted = $row[$c->id] * $c->weight;
                $D[$altId][$c->id] = $weighted;
                $total += $weighted;
            }
            $Si[$altId] = $total;
        }

        // 5. Calculate Ki (Utility) & Rank
        $S0 = $Si[0]; // A0 Score
        unset($Si[0]); // Remove A0 from ranking

        $Ki = [];
        foreach ($Si as $altId => $score) {
            $Ki[$altId] = ($S0 != 0) ? ($score / $S0) : 0;
        }
        
        arsort($Ki); // Sort Descending

        return view('dss_result', compact('Ki', 'Si', 'matrix', 'R', 'D', 'A0', 'criterias', 'alternatives'));
    }
}