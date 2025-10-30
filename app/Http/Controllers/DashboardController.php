<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Get user dashboard data.
     */
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();

        return response()->json([
            'message' => 'Dashboard data retrieved successfully',
            'user' => $user,
            'data' => [
                'welcome_message' => 'Selamat datang di JTLC Learning Center',
                'dashboard_info' => 'Ini adalah API dashboard',
            ],
        ]);
    }
}
