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

    public function edit(User $user)
    {
        $user->admin = $user->isAn('admin');

        return Inertia::render('User/Edit', [
            'user' => $user
        ]);
    }

    public function update(User $user, Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255'
            ]
        ]);

        $user->fill([
            'name' => $request->name,
            'active' => $request->boolean('active')
        ]);

        $user->save();

        $request->boolean('admin') 
            ? $user->assign('admin') 
            : $user->retract('admin');

        return to_route('users');
    }
}
