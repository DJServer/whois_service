<?php
namespace App\Http\Controllers\API;

use App\Application\Services\WhoisService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WhoisController extends Controller
{
    public function __construct(private WhoisService $whoisService) {}

    public function lookup(Request $request)
    {
        $request->validate([
            'domain' => 'required|string'
        ]);

        $whoisResponse = $this->whoisService->lookup($request->domain);

        if (!$whoisResponse) {
            return response()->json(['error' => 'WHOIS not found'], 404);
        }

        return response()->json([
            'domain' => $request->domain,
            'whois_data' => $whoisResponse
        ]);
    }
}
