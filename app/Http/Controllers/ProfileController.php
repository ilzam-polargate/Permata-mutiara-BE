<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function updateProfile(Request $request)
    {
        //validate form
        $this->validate($request, [
            'role'     => 'required',
            'avatar'     => 'image|mimes:jpeg,jpg,png|max:2048',
            'name'   => 'required',
            'email'   => 'required',
            'jekel'   => '',
            'alamat'   => '',
            'number'   => 'required',
            'pekerjaan'   => '',
            'status'   => 'required',
            'password'   => 'required',
        ]);

        //get post by ID
        $user = auth()->user()->id;

        //check if image is uploaded
        if ($request->hasFile('avatar')) {

            //upload new image
            $image = $request->file('avatar');
            $image->storeAs('public/profile', $image->hashName());

            //delete old image
            Storage::delete('public/profile/' . auth()->user()->avatar);

            //update post with new image
            User::where('id', auth()->user()->id)->update([
                'role'     => $request->role,
                'avatar'     => $image->hashName(),
                'name'   => $request->name,
                'email'   => $request->email,
                'jekel'   => $request->jekel,
                'alamat'   => $request->alamat,
                'number'   => $request->number,
                'pekerjaan'   => $request->pekerjaan,
                'status'   => $request->status,
                'password'  => bcrypt($request->password),
            ]);
        } else {
            //update post without image
            User::where('id', auth()->user()->id)->update([
                'role'     => $request->role,
                'name'   => $request->name,
                'email'   => $request->email,
                'jekel'   => $request->jekel,
                'alamat'   => $request->alamat,
                'number'   => $request->number,
                'pekerjaan'   => $request->pekerjaan,
                'status'   => $request->status,
                'password'  => bcrypt($request->password),
            ]);
        }

        return redirect()->back()->with(['success' => 'Berhasil update profile']);
    }
}
