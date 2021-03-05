<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Bill;

class AffiliateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $user = Auth::user();
      return view('affiliate.index', compact('user'));
    }

    public function earnings(Request $request)
    {
      $user = Auth::user();
      $bills = $user->bills()->latest()->paginate(50);

      $users_level1 = $user->referrals->pluck('id');
      $referral_level1_count = $user->referrals->count();

      $users_level2 = User::whereIn('referrer_id', $users_level1 )->get()->pluck('id');
      $referral_level2_count = $users_level2->count();

      $users_level3 = User::whereIn('referrer_id', $users_level2 )->get()->pluck('id');
      $referral_level3_count = $users_level3->count();

      // earnings
      $transactions = Bill::where('debtor_id', $user->id)->where('transaction_type_id', 4);
      $l1 = (clone $transactions)->where('level_id', 1)->sum('amount');
      $l2 = (clone $transactions)->where('level_id', 2)->sum('amount');
      $l3 = (clone $transactions)->where('level_id', 3)->sum('amount');

      $referral_count = [ 'level1'=> $referral_level1_count,
                          'level2'=> $referral_level2_count,
                          'level3'=> $referral_level3_count,
                          'total' => $referral_level1_count+$referral_level2_count+$referral_level3_count];
      $commision = ['level1'=> round($l1,2), 'level2'=> round($l2,2), 'level3'=> round($l3,2), 'total' => round($l1+$l2+$l3,2) ];
      return view('affiliate.earnings', compact('user', 'bills', 'referral_count', 'commision'));
    }
}
