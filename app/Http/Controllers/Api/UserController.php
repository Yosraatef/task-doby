<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    public function create(UserRequest $request)
    {
        $validated = $request->validated();
        $file = Arr::pull($validated, 'file');
        $info = Arr::pull($validated, 'info');
        $user = User::create($validated);
        $user->info()->create($info);

        $file && moveTempImage($file, $user, 'file');
        return self::apiResponse(200, "done successfully" , UserResource::make($user));
    }

}
