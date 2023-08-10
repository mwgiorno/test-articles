<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
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
}
