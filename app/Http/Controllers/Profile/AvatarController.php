<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateAvatarRequest;

class AvatarController extends Controller
{
    public function update(UpdateAvatarRequest $request){
        $path = $request -> file('avatar')->store('avatars','public');

        if($oldavatar = $request->user()->avatar){
            Storage::disk('public')->delete($oldavatar);
        }

        auth()->user()->update(['avatar' => $path]);

        return redirect(route('profile.edit'))->with('message','Avatar is updated');
    }
}

?>