<?php
namespace App\Http\Controllers\API;

use App\Application\Services\WhoisService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class WhoisController extends Controller
{
    public function __construct(private WhoisService $whoisService) {}

    public function lookup(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'domain' => ['required', 'string', 'regex:/^(?!-)(?!.*--)([a-zA-Z0-9-]{1,63})+\.[a-zA-Z]{2,63}$/'],
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => "Некорректний домен! Введіть коректне ім'я, наприклад: example.com"], 400);
        }

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
