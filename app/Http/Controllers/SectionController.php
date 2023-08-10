<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class SectionController extends Controller
{
    public function index()
    {
        return Inertia::render('Section/Index', [
            'sections' => Section::all()
        ]);
    }

    public function create()
    {
        return Inertia::render('Section/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:sections,name'
        ]);

        Section::create([
            'name' => $request->name
        ]);

        return to_route('sections');
    }

    public function edit(Section $section)
    {
        return Inertia::render('Section/Edit', [
            'section' => $section
        ]);
    }

    public function update(Section $section, Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('sections', 'name')->ignore($section->id)
            ]
        ]);

        $section->fill([
            'name' => $request->name
        ]);

        $section->save();

        return to_route('sections');
    }
}
