<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Resources\User as UsersResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\User;
use App\Roles;
use App\UserRoles;
use App\UserPermissions;

class AuthController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['login']]);
    // }

    public function login (Request $request) {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string|min:6',
        ]);
        $user = User::where('username', $request->username)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = ['token' => $token];
                return response($response, 200);
            } else {
                $response = ["message" => "Password mismatch"];
                return response($response, 422);
            }
        } else {
            $response = ["message" =>'User does not exist'];
            return response($response, 422);
        }
    }

    public function login2(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        $tokenRequest = $request->create(config('services.passport.login_endpoint'), 'POST', $request->all());

        $request->request->add([
            "client_id"     => config('services.passport.key'),
            "client_secret" => config('services.passport.secret'),
            "grant_type"    => 'password'
        ]);
        $response = Route::dispatch($tokenRequest);
        return $response;
        $response->setContent($response->getContent());
        return $response;
    }

    public function register_all(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:125',
            'lastname' => 'required|string|max:125',
            'role' => 'required|string',
            'zone_id' => 'required',
        ]);

        $username = strtolower($request->firstname . $request->lastname);

        $alreadyexists = User::where('username', $username)->count();

        if ($alreadyexists > 0) {
            $alreadyexists++;
            $username = $username.$alreadyexists;
        }

        return User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'username' => strtolower($request->firstname . $request->lastname),
            'role' => $request->role,
            'zone_id' => $request->zone_id,
            'created_by' => $request->user()->username,
            // 'password' => Hash::make(uniqid()),
            'password' =>'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password
        ]);
    }

    public function update_all(Request $request, $id)
    {
        $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'role' => 'required|integer',
            'username' => 'required|string|unique:users,username,' . $id,
        ]);

        $user = User::findOrFail($id);

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->role = $request->role;
        $user->zone_id = $request->zone_id;
        $user->created_by = $request->user()->username;
        $user->username = $request->username;

        if ($user->save()) {
            return $user;
        }
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'currentPassword' => 'required|string|max:255',
            'newPassword' => 'required|string|max:255',
            'confirmPassword' => 'required|string'
        ]);

        $user = Auth::guard('api')->user();

        $currpass = Hash::make($request->currentPassword);

        $isCurrentPasswordValid = Auth::guard('web')->attempt([
            'username' => $user->username,
            'password' => $request->currentPassword
        ]);

        if ($request->newPassword != $request->confirmPassword) {
            $res = array("isSuccess" => false, "message" => "New Password does not match Confirm Password");
            return response()->json($res);
        }

        if (!$isCurrentPasswordValid) {
            $res = array("isSuccess" => false, "message" => "Current password incorrect");
            return response()->json($res);
        }
        $user->password = Hash::make($request->newPassword);
        $user->token()->revoke();
        $token = $user->createToken('newToken')->accessToken;
        $user->save();

        $res = array("isSuccess" => true, 'access_token' => $token);
        return response()->json($res);
    }

    public function get_roles()
    {
        $roles = Roles::all();
        return $roles;

    }

    public function reset(Request $request)
    {
        $request->validate([
            "id" => "required|integer"
        ]);

        $user = User::findOrFail($request->input('id'));

        $user->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';

        if ($user->save()) {
            return response()->json(["message" => "Successful"]);
        }
    }

    public function logout()
    {
        auth()->user()->tokens->each(function ($token, $key) {
            $token->revoke();
        });
        return response()->json(true);
    }

    public function bounceRequest($id, Request $request)
    {
        abort(401);
        // return json_encode(['status'=>$id,'msg'=>'login']);
    }
    public function getUser(Request $request)
    {
        return $request->user();
    }

    public function getUserById($id)
    {
        $user = User::findOrFail($id);
        return $user;
    }

    public function get_terminated_users()
    {
        $users = User::onlyTrashed();
        return UsersResource::collection($users);
    }

    public function get_active_users()
    {
        $users = User::withoutTrashed()->get();
        return UsersResource::collection($users);
    }

    public function get_both_users()
    {
        $users = User::withTrashed()->get();
        return UsersResource::collection($users);
    }

    public function restore($id)
    {
        $user = User::onlyTrashed()->find($id);
        $user->is_active = true;
        if ($user->restore()) {
            return $user;
        }
    }

    public function block_account($id)
    {
        $user = User::findOrFail($id);
        $user->is_blocked = true;
        if ($user->save()) {
            return $user;
        }
    }

    public function unblock_account($id)
    {
        $user = User::findOrFail($id);
        $user->is_blocked = false;
        if ($user->save()) {
            return $user;
        }
    }

    public function terminate($id)
    {
        $user = User::findOrFail($id);
        $user->is_active = false;
        if ($user->delete()) {
            return $user;
        }
    }

    public function destroy($id)
    {
        $user = User::onlyTrashed()->find($id);
        if ($user->forceDelete()) {
            return $user;
        }
    }
}
