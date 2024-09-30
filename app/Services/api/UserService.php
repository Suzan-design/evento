<?php

namespace App\Services\api;

use App\Models\User\MobileUser;
use App\Traits\FileStorageTrait;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UserService
{

    use FileStorageTrait ;

    public function getUserById($id)
    {
        return MobileUser::find($id);
    }

    public function updateUser($data)
    {
        $user = Auth::guard('mobile')->user();

        // Define the fields you want to update
        $fieldsToUpdate = ['first_name', 'last_name', 'phone_number', 'state', 'gender', 'birth_date' , 'image' , 'type'];

        // Check for image in the request and store it
        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $imagePath = $this->storefile($data['image'],'User_images' ); // Storing the image
            $data['image'] = $imagePath;
        }

        // Use Arr::only to get only the fields that are provided in $data
        $updatedData = Arr::only($data, $fieldsToUpdate);

        // Filter out null values
        $updatedData = array_filter($updatedData, function ($value) {
            return !is_null($value);
        });
        $user->update($updatedData);

        return $user;
    }

    public function deleteUser()
    {
        $id = Auth::id();
        $user = MobileUser::find($id);
        if ($user) {
            $user->update(['active_type' => 'blocked']);
            $user->tokens->each(function ($token, $key) {
                $token->delete();
            });

        }
    }

    public function resetUserPassword($oldPassword, $newPassword)
    {
        $user = Auth::guard('mobile')->user();

        if (!Hash::check($oldPassword, $user->password)) {
            return ['error' => 'password is incorrect.'];
        }

        $user->updatePassword($newPassword);
        return ['message' => 'Password has been updated.'];
    }

    public function changeUserType()
    {
        $user = Auth::user();

        if ($user->type == 'normal') {
            $user->update(['type' => 'private']);
            return 'Changed Successfully (Private)';
        } else {
            $user->update(['type' => 'normal']);
            return 'Changed Successfully (Public)';
        }
    }

    public function searchFriend($searchTerm)
    {
        return MobileUser::where(function ($query) use ($searchTerm) {
            $query->where('first_name', 'like', '%' . $searchTerm . '%')
                ->orWhere('last_name', 'like', '%' . $searchTerm . '%');
        })->where('is_verified', true)
            ->where('id', '<>', auth()->id()) // Exclude the authenticated user
            ->paginate(4);
    }

}
