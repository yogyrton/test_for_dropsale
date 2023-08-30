<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $data = Http::get('https://randomuser.me/api', [
            'results' => 5000
        ]);

        $users = collect($data['results']);

        $countAllUsers = User::query()->count();
        $newUsersInQuery = $users->count();


        $users->each(function ($user) {
            User::query()->updateOrCreate(
                [
                    'email' => $user['email'],
                ],
                [
                    'first_name' => $user['name']['first'],
                    'last_name' => $user['name']['last'],
                    'age' => $user['dob']['age'],
                ]);
        });


        $countAllUsersAfterUpdate = User::query()->count();
        $updatedUsers = $countAllUsers + $newUsersInQuery - $countAllUsersAfterUpdate;
        $createdUsers = $newUsersInQuery - $updatedUsers;

        return response()->json([
            'count' => $countAllUsersAfterUpdate,
            'updated' => $updatedUsers,
            'created' => $createdUsers
        ]);
    }

}
