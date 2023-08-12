<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::when(
                $request->id,
                function (Builder $query, string $id) {
                    $query->orderBy('id', $id);
                }
            )->get()
            ->except($request->user()->id);

        return Inertia::render('User/Index', [
            'users' => $users
        ]);
    }
}
