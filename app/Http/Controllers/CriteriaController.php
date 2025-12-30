<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use Illuminate\Http\Request;

class CriteriaController extends Controller
{
    /**
     * Display a listing of the criteria.
     */
    public function index()
    {
        // Get all criteria from the database
        $criterias = Criteria::all();
        
        // Return the view 'criteria.index' (we will create this next)
        return view('criteria.index', compact('criterias'));
    }

    /**
     * Show the form for editing the specified criteria.
     */
    public function edit(Criteria $criterion)
    {
        // Return the edit form view
        // Note: In resource routes, the parameter is singular ($criterion)
        return view('criteria.edit', compact('criterion'));
    }

    /**
     * Update the specified criteria in storage.
     */
    public function update(Request $request, Criteria $criterion)
    {
        // 1. Validate the input
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:Benefit,Cost',
            'weight' => 'required|numeric|between(0,1)', // Ensure weight is decimal (e.g., 0.4)
        ]);

        // 2. Update the data
        $criterion->update([
            'name' => $request->name,
            'type' => $request->type,
            'weight' => $request->weight
        ]);

        // 3. Redirect back with a success message
        return redirect()->route('criteria.index')
                         ->with('success', 'Data kriteria berhasil diperbarui!');
    }
}