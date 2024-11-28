<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Token;
use Barryvdh\DomPDF\Facade\Pdf;

class TokenController extends Controller
{
    /**
     * Display the generate token page with existing tokens.
     */
    public function index(Request $request)
    {
        $name = 'Buat Token ';
        $tokens = Token::all();

        // Check for PDF export
        if ($request->get('export') == 'pdf') {
            // Generate PDF using the tokens
            $pdf = Pdf::loadView('pdf.generate', ['tokens' => $tokens]);
            return $pdf->download('CetakToken_Pdf.pdf');
        }

        // Render the generate token view
        return view('generate', compact('tokens', 'name'));
    }

    /**
     * Store new tokens in the database.
     */
    public function store(Request $request)
    {
        $jumlah = (int) $request->input('jumlah', 1); // Default to 1 if not provided
        $allowedCharacters = 'ABCDEFGHJKMNRSTUVWXYZabcdefghjkmnrstuvwxyz23456789'; // Excluding 1, 0, etc.
        $tokens = [];

        // Generate tokens based on the requested count
        for ($j = 0; $j < $jumlah; $j++) {
            $tokenStr = '';
            $length = 6; // Token length

            do {
                // Generate a new token
                $tokenStr = '';
                for ($i = 0; $i < $length; $i++) {
                    $tokenStr .= $allowedCharacters[rand(0, strlen($allowedCharacters) - 1)];
                }

                // Check if the token already exists
                $existingToken = Token::where('token', $tokenStr)->first();
            } while ($existingToken); // Retry if the token already exists

            // Save the token to the database
            Token::create([
                'token' => $tokenStr,
                'id_setting' => 1,
                'is_pakai' => $request->is_pakai ?? 2, // Default is_pakai to 2 if not provided
            ]);

            $tokens[] = $tokenStr;
        }

        return redirect()->route('generate.index')->with('success', 'Tokens created successfully.');
    }

    /**
     * Delete all tokens from the database.
     */
    public function deleteAll(Request $request)
    {
        Token::truncate(); // Removes all records from the tokens table
        return redirect()->route('generate.index')->with('success', 'All tokens have been deleted.');
    }
}
