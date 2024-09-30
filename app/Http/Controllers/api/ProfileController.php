<?php
namespace App\Http\Controllers\api;

use App\Http\Requests\ForgotPassword\ResetPasswordRequest;
use App\Models\Event\Event;
use App\Models\ServiceProvider\ServiceProvider;
use App\Models\User\MobileUser;
use App\Models\User\Organizer;
use App\Services\api\UserService;
use App\Traits\FileStorageTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    use FileStorageTrait ;
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function profile()
    {
        $user = $this->userService->getUserById(auth()->id());

        if (!$user) {
            return response()->json([
                'status' => true
                , 'message' => 'User not found'
            ]);
        }
        if($user['type'] == 'normal')
        {
            return response()->json(['status' => true
                ,'user' => $user,
                'type' => 'normal'
            ]);
        }
        if($user['type'] == 'private')
        {
            return response()->json(['status' => true
                ,'user' => $user,
                'type' => 'private'
            ]);
        }
        if($user['type'] == 'organizer')
        {
            $organizer = Organizer::where('mobile_user_id',$user['id'])->withoutGlobalScopes()->first() ;

            if($organizer['type'] == 'pending')
                return response()->json(['status' => true
                    ,'user' => $user,
                    'type' => 'normal'
                ]);
            else
                return response()->json(['status' => true
                    ,'user' => $user,
                    'type' => 'organizer'
                ]);
        }

        if($user['type'] == 'service_provider')
        {
            $service_provider = ServiceProvider::where('user_id',$user['id'])->withoutGlobalScopes()->first() ;

            if($service_provider['type']=='pending')
                return response()->json(['status' => true
                    ,'user' => $user,
                    'type' => 'normal'
                ]);
            else
                return response()->json(['status' => true
                    ,'user' => $user,
                    'type' => 'service_provider'
                ]);
        }


    }

    public function GetUser($id)
    {
        $user = $this->userService->getUserById($id);

        if (!$user) {
            return response()->json(['status' => true
                ,'message' => 'User not found']);
        }

        return response()->json(['status' => true
            ,'user' => $user]);
    }

    public function update(Request $request)
    {
        $updatedUser = $this->userService->updateUser($request->all());

        return response()->json([
            'status' => true,
            'message' => 'User updated successfully',
            'user' => $updatedUser
        ]);
    }

    public function destroy()
    {
        $this->userService->deleteUser();

        return response()->json([
            'status' => true,
            'message' => 'User deleted successfully'
        ]);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $result = $this->userService->resetUserPassword($request->old_password, $request->new_password);

        if (isset($result['error'])) {
            return response()->json(['status' => false,
                'message' => 'password is incorrect'
            ]);
        }

        return response()->json([
             'status' => true
             ,$result]);
    }

    public function change_type()
    {
        $message = $this->userService->changeUserType();

        return response()->json([
            'status' => true,
            'message' => $message
        ], 200);
    }

    public function searchFriend(Request $request)
    {
        $result = $this->userService->searchFriend($request->input('Search'));

        return response()->json([
            'status' => true,
            'result' => $result
        ]);
    }
}
