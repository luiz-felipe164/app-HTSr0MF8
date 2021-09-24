<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use App\Services\HistoryProductService;

class HistoryController extends Controller
{
    protected $historyService;

    public function __construct(HistoryProductService $historyService)
    {
        $this->historyService = $historyService;
    }
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        try {

            $histories = $this->historyService->getAll();

            if (empty($histories)) {
                response()->json(['message' => 'History is empty'], 404);
            }

            return response()->json($histories, 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'An error occurred, please contact our support',
                'code' => $e->getCode()
            ], 500);
        }
    }
}
