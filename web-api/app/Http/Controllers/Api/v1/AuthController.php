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

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:125',
            'last_name' => 'required|string|max:125',
            'username' => 'required|string',
            'dob' => 'required',
            'gender' => 'required',
            'country' => 'required',
            'branch' => 'required',
        ]);

        $imageName ="";
        $imglength = (float)(strlen(request('photo')));
        if($imglength > 500){
            $imageName = $this->generateImage(request('photo'));
        }elseif($imglength == 0){
            $imageName = 'noimage.png';
        }else{
            $imageName = request('photo');
        }

        // $username = strtolower($request->firstname . $request->lastname);

        // $alreadyexists = User::where('username', $username)->count();

        // if ($alreadyexists > 0) {
        //     $alreadyexists++;
        //     $username = $username.$alreadyexists;
        // }

        $psd = uniqid();

        $generated_password = Hash::make($psd);

        return User::create([
            'first_name' => $request->firstname,
            'last_name' => $request->lastname,
            'username' => $request->username,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'country' => $request->country,
            'branch' => $request->branch,
            'photo' => $request->photo,
            'is_active' => $request->is_active,
            'approval_status' => $request->approval_status,
            'decline_reason' => $request->approval_status,
            'created_by' => $request->user(),
            // 'password' => Hash::make(uniqid()),
            'password' => $generated_password,
            'photo' => $imageName
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'username' => 'required|string|unique:users,username,' . $id,
            'dob' => 'required',
            'gender' => 'required',
            'country' => 'required',
            'branch' => 'required'
        ]);

        $imageName ="";
        $imglength = (float)(strlen(request('photo')));
        if($imglength > 500){
            $imageName = $this->generateImage(request('photo'));
        }elseif($imglength == 0){
            $imageName = 'noimage.png';
        }else{
            $imageName = request('photo');
        }

        $user = User::findOrFail($id);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->username = $request->username;
        $user->dob = $request->dob;
        $user->is_active = $request->is_active;
        $user->approval_status = $request->approval_status;
        $user->decline_reason = $request->decline_reason;
        $user->created_by = $request->created_by;
        $user->photo = $imageName;

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
    public function get_otp()
    {
        $otp = mt_rand(111111, 999999);

        return $otp;
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

    public function generateImage($img)
    {
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $imageName = time().'.png';
        \Storage::disk('uploaded_images')->put($imageName, base64_decode($image_parts[1]));
        return $imageName;
    }
}
