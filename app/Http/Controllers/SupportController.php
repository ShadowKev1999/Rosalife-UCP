<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Account;

class SupportController extends Controller
{
    public function teamlist() {
        $teamList = Account::where('Admin', '!=', 0)->orderBy('Admin', 'DESC')->get();
        return view('support.teamlist', ['teamList' => $teamList]);
    }
}
