<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonationController extends Controller
{
    public function store(Request $request)
    {
        // Handle the case where the form is submitted
        if ($request->isMethod('post')) {
            $amount = $request->input('amount') ?: $request->input('custom_amount');
            
            // Validation (optional, depending on your needs)
            $validatedData = $request->validate([
                'amount' => 'required|numeric|min:1',
            ]);

            // Save the donation (adjust model and database structure as necessary)
            $donation = new Donation();
            $donation->amount = $amount;
            $donation->user_id = Auth::id();  // Optional: link donation to the logged-in user
            $donation->save();

            // Optionally update the user's total donated amount if applicable
            // No need to update 'amount' in users table anymore

            // Redirect back or to a success page
            return redirect()->route('donate')->with('success', 'Thank you for your donation!');
        }

        // Otherwise, show the form with the default amount if any (else pass null)
        return view('donate');
    }
}
