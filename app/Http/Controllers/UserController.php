<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => [
                'nullable',
                Rule::in(['asc', 'desc']),
            ],
            'name' => [
                'nullable',
                Rule::in(['asc', 'desc']),
            ],
            'email' => [
                'nullable',
                Rule::in(['asc', 'desc']),
            ]
        ]);

        $sortables = $validator->validated();

        $users = User::whereIsNot('superadmin')
            ->when(
                isset($sortables['id']),
                function (Builder $query) use($sortables) {
                    $query->orderBy('id', $sortables['id']);
                }
            )->when(
                isset($sortables['name']),
                function (Builder $query) use($sortables) {
                    $query->orderBy('name', $sortables['name']);
                }
            )->when(
                isset($sortables['email']),
                function (Builder $query) use($sortables) {
                    $query->orderBy('email', $sortables['email']);
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
