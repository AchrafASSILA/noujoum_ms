<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\Controller;
use App\Mail\EtatJournalierEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    //
    public function sendEtatJournalierToFounders()
    {
        try {
            $users = User::where('role', 2)->get();
            foreach ($users as $user) {
                Mail::to($user->email)->send(new EtatJournalierEmail());
            }
            return response([
                'success' => true
            ], 200);
        } catch (\Exception $e) {
            //throw $th;
            return response(['msg' => $e->getMessage()], 400);
        }
    }
}
