<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class WalletController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "numero" => "required",
            "solde" => "required",
            "transaction_id" => "required",
            "user_id" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => $validator->errors()->first()
            ], 400);
        }

        try {
            $wallet = Wallet::create([
                "numero" => $request->get("numero"),
                "solde" => $request->get("solde"),
                "transaction_id" => $request->get("transaction_id"),
                "user_id" => $request->get("user_id"),
            ]);

            return response()->json([
                "success" => true,
                "wallet" => $wallet
            ], 201);

        } catch (\Exception $exception) {
            return response()->json([
                "error" => true,
                "message" => $exception->getMessage()
            ], 500);
        }
    }


}
