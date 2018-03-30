<?php
namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\SecurityQuestion;

class UsersController extends Controller
{
    /**
     * Show account activation page where new user can set up his
     * account
     *
     * @return Illuminate\Http\Response Account activation view
     */
    public function showActivationPage()
    {
        $user = Auth::user();
        $questions = SecurityQuestion::all();

        return view('users.activate', compact('user', 'questions'));
    }
}
