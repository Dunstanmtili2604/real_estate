<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Requests\User\AdminInfoRequest;
use App\Models\User;
use App\MyHelpers;
use App\Notifications\AgentActivated;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class AdminController extends UserController
{
    public function adminProfile()
    {
        return view("admin.profile");
    }

     /**
     * Update the info of the admin
     * @param AdminInfoRequest $request
     */
    public function updateInfo(AdminInfoRequest $request){
        // validation
        $data = $request->validated();

        // update info in db
        $userId = Auth::id();
        try {
            if(User::findOrFail($userId)->update($data))
                return redirect()->route('profile');
                // return response(['msg' => "Your Info is updated successfully"], 200);
        }catch (ModelNotFoundException $exception){
            toastr()->error('Failed to save changes, try again.');
            return redirect()->route('admin-profile');
        }
    }

    public function userRemove(Request $request){
        try {
            $user = User::findOrFail($request->id);
            MyHelpers::deleteImageFromStorage($user->photo , 'uploads/images/profile/');
            if ($user->delete())
                return redirect()->route('admin-agent-list')->with('success', 'Successfully removed.');
            else
                return redirect('admin-agent-list')->with('error', 'Failed to remove this user.');
        }catch (ModelNotFoundException $exception){
            return redirect('admin-agent-list')->with('error', 'Failed to remove this user.');
        }
    }

    public function agentActivate(Request $request){
        $agent_id = $request->agent_id;

        // check whether activate or de-activate
        if ($request->current_status == "1"){
            return $this->agentDeActivate($agent_id);
        }

        try {
            $agent = User::findOrFail($agent_id);
            $agent->update(['status' => 1]);

            // notify the agent
            Notification::send($agent, new AgentActivated());

            return response(['msg' => 'Agent now is activated.'], 200);
        }catch (ModelNotFoundException $exception){
            return redirect()->route('admin-agent-list')->with('error', 'Failed to activate this agent, try again');
        }
    }

    public function agentDeActivate(int $agent_id){

        try {
            User::findOrFail($agent_id)->update(['status' => 0]);
            return response(['msg' => 'Agent now is disabled.'], 200);
        }catch (ModelNotFoundException $exception){
            return redirect()->route('admin-agent-list')->with('error', 'Failed to activate this agent, try again');
        }
    }
}
