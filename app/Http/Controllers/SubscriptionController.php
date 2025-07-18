<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscribeUserRequest;
use App\Models\Subscription;
use App\UseCases\SubscribeUserUseCase;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Log;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubscribeUserRequest $request, SubscribeUserUseCase $useCase): ?JsonResponse
    {
        try {

            $useCase->execute($request->validated());

            return response()->json([
                'message' => 'Congratulations, You are now subscribed!'
            ]);

        } catch (Exception $e) {

            Log::debug($e->getMessage());

            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscription $subscription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subscription $subscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subscription $subscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscription $subscription)
    {
        //
    }
}
