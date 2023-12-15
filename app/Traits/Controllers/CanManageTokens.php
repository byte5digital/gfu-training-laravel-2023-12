<?php
namespace App\Traits\Controllers;

use App\Models\PersonalAccessToken;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

trait CanManageTokens
{
    public function createToken()
    {
        $user = Auth::user();
        $name = __('Created on :date', ['date' => Carbon::now()]);
        $newAccessToken = $user->createToken($name);
        $message = __('Create new token "' . $newAccessToken->accessToken . '" successfuly!');
        return redirect()->back()->with('success', $message);
    }


    public function refreshToken(PersonalAccessToken $token)
    {
        $token->refreshExpiry()->save();
        $message = __('Refresh your token "' . $token . '" successfully!');
        return redirect()->back()->with('success', $message);
    }


    public function destroyToken(PersonalAccessToken $token)
    {
        $token->delete();
        $message = __('Destroyed "' . $token . '" successfully!');
        return redirect()->back()->with('success', $message);
    }

}
