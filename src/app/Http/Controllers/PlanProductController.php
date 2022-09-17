<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use DB;

class PlanProductController extends Controller
{
    public function index()
    {
        $plans = Plan::all();
        return view('pages.plan-product.index', compact('plans'));
    }

    public function show($slug)
    {
        $intent = auth()->user()->createSetupIntent();
        $plans = Plan::where(['slug' => $slug])->first();
        return view('pages.plan-product.show', compact('plans', 'intent'));
    }

    public function purchase(Request $request, $slug)
    {
        $user          = $request->user();
        $paymentMethod = $request->input('payment_method');
        $plan          =  Plan::where(['slug' => $slug])->first();
        try {
            $user->createOrGetStripeCustomer();
            $user->updateDefaultPaymentMethod($paymentMethod);
            $user->charge($plan->cost, $paymentMethod);        
        } catch (\Exception $exception) {
            $this->payment_logs_inserted( json_encode(['error' => $exception->getMessage()]));
            return back()->with('error', $exception->getMessage());
        }
    
        return back()->with('message', 'Product purchased successfully!');
    }


    protected function payment_logs_inserted($logs)
    {
        DB::table('payment_logs')->insert(['logs' => $logs, 'created_at' => date('Y-m-d H:i:s')]);
    }
}
