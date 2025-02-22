<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WhoisCheck;

class WhoisHistoryController extends Controller
{
    public function index()
    {
        $whoisChecks = WhoisCheck::orderBy('created_at', 'desc')->paginate(10);

        return view('whois.history', compact('whoisChecks'));
    }
}
