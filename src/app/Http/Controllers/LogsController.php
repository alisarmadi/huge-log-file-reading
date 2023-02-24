<?php

namespace App\Http\Controllers;

use App\Http\Requests\LogsCountRequest;
use App\Services\LogInventoryService;
use Illuminate\Http\Response;

class LogsController extends Controller
{
    public function count(LogsCountRequest $request, LogInventoryService $logInventoryService)
    {
        $filters = $request->validated();
        $inventoryCount = $logInventoryService->inventoryCount($filters);
        $result = collect(['count' => $inventoryCount]);

        return response()->json(['count' => $inventoryCount], Response::HTTP_OK);
    }
}
