<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class PalindromeController extends Controller
{
    //
    public function CheckPalindrome(Request $request): Response
    {
        try {
            $validator = Validator::make($request->all(), [
                'palindrome' => 'required|string',
            ]);

            $field = $request->all();

            // Convert the input string to lowercase and remove non-alphanumeric characters
            $input = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $field['palindrome']));

            // Reverse the input string
            $reversed = strrev($input);

            // Compare the original input with the reversed input
            $result = $input === $reversed;

            return Response()->json(
                [
                    'is_palindrome' =>  $result,
                    'message' => 'Check Palindrome is successfully',
                    'status' => 200,
                ],
                200
            );

            if ($validator->fails()) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => $validator->errors()->first(),
                        'error' => $validator->errors(),
                        'status' => 406,
                    ],
                    406
                );
            }

        } catch (Exception $error) {
            return Response()->json(
                [
                    'message' => $error->getMessage(),
                    'line' => $error->getLine(),
                    'file' => $error->getFile(),
                ],
                500
            );
        }

    }
}