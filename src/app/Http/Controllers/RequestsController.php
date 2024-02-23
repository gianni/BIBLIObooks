<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class RequestsController extends Controller
{
    public function valid()
    {

        $currentDateTime = Carbon::now();

        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->post(config('app.bibliobooks_url').'/api/reservations', [
            'requester' => config('app.name'),
            'date_from' => $currentDateTime->toDateTimeString(),
            'date_to' => $currentDateTime->toDateTimeString(),
            'book_id' => 1,
        ]);

        if ($response->successful()) {
            $data = $response->json();

            return response()->json($data);
        } else {
            return response()->json([
                'error' => 'API request failed',
                'response' => $response->json(),
            ], $response->status());
        }
    }

    public function notValid()
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->post(config('app.bibliobooks_url').'/api/reservations', [
            'requester' => config('app.name'),
            'date_from' => '2024-04-22 10:00:00',
            'date_to' => '2024-02-25 10:00:00',
            'book_id' => 1,
        ]);

        if ($response->successful()) {
            $data = $response->json();

            return response()->json($data);
        } else {
            return response()->json([
                'error' => 'API request failed',
                'response' => $response->json(),
            ], $response->status());
        }
    }
}
