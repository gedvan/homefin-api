<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TransactionsController extends Controller
{
    /**
     * Return a list of transactions.
     */
    public function index()
    {
        return Transaction::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $transaction = Transaction::create($request->all());
        return new JsonResponse($transaction, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Transaction $transaction
     * @return Transaction
     */
    public function show(Transaction $transaction)
    {
        $transactionArray = $transaction->toArray();
        $transactionArray['category'] = $transaction->category->toArray();
        return $transactionArray;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Transaction $transaction
     * @return JsonResponse
     */
    public function update(Request $request, Transaction $transaction)
    {
        $transaction->update($request->all());
        return new JsonResponse($transaction, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Transaction $transaction
     * @return JsonResponse
     * @throws \Exception
     */
    public function delete(Transaction $transaction)
    {
        $transaction->delete();
        return new JsonResponse(null, 204);
    }
}
