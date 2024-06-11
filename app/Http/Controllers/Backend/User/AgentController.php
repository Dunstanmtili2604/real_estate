<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Requests\User\AgentInfoRequest;
use App\Models\User;
use App\MyHelpers;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class AgentController extends UserController
{
    public function agentProfile()
    {
        return view("agent.profile");
    }

     /**
     * Update the info of the admin
     * @param AgentInfoRequest $request
     */
    public function updateInfo(AgentInfoRequest $request)
    {
        // validation
        $data = $request->validated();

        // preparing some needed data
        $userId = Auth::id();
        $userData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'phone_number' => $data['phone_number'],
            'address' => $data['address']
        ];

        $shopData = [
            'shop_description' => $data['shop_description'],
            'shop_name' => $data['shop_name']
        ];

        $agent_id = DB::table('agent_shop')
            ->where('user_id', '=', $userId)
            ->get(['agent_id'])[0];


        if ($this->updateUserData($userId, $userData) && $this->updateShopData((int)$agent_id->agent_id, $shopData))
            return response(['msg' => "Your Info is updated successfully"], 200);
        else{
            toastr()->error('Failed to save changes, try again.');
            return redirect()->route('agent-profile');
        }
    }

     /**
     * @param int $userId
     * @param array $data
     * @return bool
     */
    private function updateUserData(int $userId, Array $data): bool{
        return User::findOrFail($userId)->update($data);
    }

    /**
     * @param int $agentId
     * @param array $data
     * @return bool
     */
    private function updateShopData(int $agentId, Array $data): bool{
        return DB::table('agent_shop')->where('agent_id', '=', $agentId)->update($data);
    }

    /**
     * @param int $userId
     * To return the id of the current user's shop
     */
    public static function getagentId(int $userId){
        return DB::table('agent_shop')->where('user_id', $userId)
            ->select('agent_id')->value('agent_id');
    }
}
