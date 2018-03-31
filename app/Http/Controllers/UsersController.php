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

    /**
     * Activate and set up account for user
     *
     * @param Illuminate\Http\Request $request The HTTP request
     * @return Illuminate\Http\Response Redirect to home page
     */
    public function activateUser(Request $request)
    {
        $user = Auth::user();

        if ($user->activated) {
            return redirect()->back()->withError('Your account is already activated');
        }

        $rules = [
            'username' => 'required|unique:users,username,' . $user->id,
            'name' => 'required',
            'password' => 'required|confirmed',
            'security_question_id' => 'required|exists:security_questions,id',
            'security_question_answer' => 'required'
        ];

        $messages = [
            'security_question_id.required' => 'A security question must be selected.',
            'security_question_answer.required' => 'Add an answer for security question.'
        ];

        $this->validate($request, $rules, $messages);

        $user->update([
            'username' => $request->username,
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'security_question_id' => $request->security_question_id,
            'security_question_answer' => $request->security_question_answer,
            'activated' => true
        ]);

        return redirect('/');
    }
}
