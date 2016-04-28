<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //TODO common function to handle uploading
    protected $userRepo; // repository

    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('auth');
        $this->userRepo = $userRepository;
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();
        /** @var $user User */

        if ($request->isMethod('GET')) {
            return view('users.update_profile', [
                'user' => $request->user(),
            ]);
        }

        $this->validate($request, [
            'name'  => 'required|max:255',
            'email' => $user->email != $request['email'] ? 'required|email|max:255|unique:users' : 'required|email|max:255',
        ]);

        $user   = $request->user();
        $status = $user->update([
            'name'  => $request->input('name'),
            'email' => $request->input('email'),
        ]);

        return response()->json(['status' => $status]);

    }

    public function addAvatar(Request $request)
    {
        //todo resize image
        $user = $request->user();
        $file = $request->file('file');

        $fileOriginalName   = $file->getClientOriginalName();
        $fileTargetTempName = "{$user->id}_temp.jpg";

        $file->move(public_path(UserRepository::AVATAR_PATH), $fileTargetTempName);

        return response()->json([
            'fileInfo' => [
                'asset_path'    => asset(UserRepository::AVATAR_PATH . $fileTargetTempName),
                'relative_path' => $fileTargetTempName,
                'original_name' => $fileOriginalName,
            ]
        ]);
    }

    public function changeAvatar(Request $request)
    {
        $user     = $request->user();
        $tempFile = UserRepository::AVATAR_PATH . $user->id . '_temp.jpg';

        if (file_exists($tempFile)) {
            $s = rename(UserRepository::AVATAR_PATH . $user->id . '_temp.jpg', UserRepository::AVATAR_PATH . $user->id . '.jpg');
            if ($s) {
                $status = $user->update([
                    'avatar_path' => UserRepository::AVATAR_PATH . $user->id . '.jpg',
                ]);

                if ($status) {
                    return response()->json([
                        'status' => $status,
                        'avatar' => asset($user['avatar_path']),
                    ]);
                }
            }
        }

    }

    public function clearAvatar(Request $request)
    {
        $tempFile = UserRepository::AVATAR_PATH . $request->user()->id . '_temp.jpg';
        if (file_exists($tempFile)) {
            $status = unlink($tempFile);
            if ($status) {
                return response()->json(['status' => true]);
            }
        }
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|confirmed|min:6',
        ]);

        $status = $request->user()
            ->update([
                'password' => bcrypt($request['password']),
            ]);

        if ($status) {
            return response()->json(['status' => $status]);
        }

    }

    public function activity($userId)
    {
        $user = $this->userRepo->findOne($userId);

        return view('users.activities', [
            'user'  => $user,
            'links' => $user->links,
            'comments' => $user->comments,
            'tags' => $this->userRepo->getTags($user),
        ]);
    }

}
