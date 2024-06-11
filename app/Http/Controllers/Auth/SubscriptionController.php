<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notifications\RegisteredNewAgent;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rules;
use App\Models\User;
use App\Models\RentPayment;
use App\Models\PlanPayment;
use App\MyHelpers;
use Carbon\Carbon;
use Image;
use Auth;

class SubscriptionController extends Controller
{
    public function paymentBasic()
    {
        return view("admin.auth.payment-basic");
    }

    // public function store(Request $request)
    // {
    //     // Assuming you receive the total amount paid and monthly rent from the request
    //     $totalAmountPaid = $request->input('total_amount_paid');
    //     $monthlyRent = $request->input('monthly_rent');

    //     // Calculate the months paid using the helper function
    //     $monthsPaid = RentHelper::calculateMonthsPaid($totalAmountPaid, $monthlyRent);

    //     // Save the months paid to the database (you'll need to adjust this part based on your database structure)
    //     // For example:
    //     // $rentPayment = new RentPayment();
    //     // $rentPayment->months_paid = $monthsPaid;
    //     // $rentPayment->save();

    //     // Return a response or redirect as needed
    //     return response()->json(['months_paid' => $monthsPaid]);
    // }

    public function paymentStore(Request $request)
    {
        $imageName = time() . '.' . request()->image->getClientOriginalExtension();
        request()->image->move(public_path('uploads/images/subscribe'), $imageName);
      
        $totalAmountPaid = $request->input('amount_paid');
        $monthlyRent = $request->input('rent');

        // Calculate the months paid using the helper function
        $monthsPaid = MyHelpers::calculateMonthsPaid($totalAmountPaid, $monthlyRent);
        $startDate = Carbon::now();
        $expirationDate = MyHelpers::calculateRentExpirationDate($startDate, $monthsPaid);


        $rentPayment = new RentPayment();
        $rentPayment->user_id = auth()->id();
        $rentPayment->plan = $request->input('plan');
        $rentPayment->amount_paid = $request->input('amount_paid');
        $rentPayment->months_paid = $monthsPaid;
        $rentPayment->method = $request->input('method');
        $rentPayment->expiration_date =  $expirationDate;
        $rentPayment->image = 'uploads/images/subscribe' . $imageName;
        $rentPayment->save();

        $user = auth()->id();
        if ($request->role == 'vendor'){
            self::completeAgentRegistration($user);
        }

        event(new Registered($user));

        Auth::guard('web')->logout();

        // notify the admin
        $admins = User::where('role', 'admin')->get();
        Notification::send($admins, new RegisteredNewAgent());
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function subscribe()
    {
        return view("admin.auth.subscription");
    }


    public static function completeAgentRegistration($user){
        DB::table('agent_shop')->insert([
            'shop_description' => null,
            'shop_name' => null,
            'user_id' => $user->id
        ]);
    }
}
