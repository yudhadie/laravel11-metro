<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
// use Intervention\Image\Drivers\Imagick\Driver;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.setting.user.index',[
            'title' => 'Users',
            'breadcrumbs' => Breadcrumbs::render('user'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:users|max:255',
        ]);

        $data =  new User();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->save();

        if ($request->role == 'admin') {
            $data->assignRole('admin');
        } else {
            $data->assignRole('user');
        }

        return redirect()->route('user.index')->with('success', 'Data user berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = User::FindOrFail($id);

        return view('admin.setting.user.edit',[
            'title' => 'Edit Users',
            'breadcrumbs' => Breadcrumbs::render('user.edit',$data),
            'data' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'email' => 'required|unique:users,email,'.$id,
        ]);

        $data = User::find($id);
        $photo = $data->photo;

        if ($request->hasFile('photo')) {

            if ($photo != null) {
                Storage::delete($photo);
            }

            $img = $request->file('photo');
            $photo = 'uploads/user/'.time().'.'.$request->photo->extension();

            $image = ImageManager::imagick()->read(file_get_contents($img));
            $image->scale(height: 500);
            $image->save($photo);
        }

        $data->update([
            'name' => $request->name,
            'email' => $request->email,
            'photo' => $photo,
        ]);

        if ($request->role == 'admin') {
            $data->assignRole('admin');
        } else {
            $data->assignRole('user');
        }

        if ($request->password != null) {
            $data->password = bcrypt($request->password);
            $data->update([
                'password' => bcrypt($request->password),
            ]);
        }

        return redirect()->back()->with('success', 'Data user berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = User::find($id);

        $photo = $data->photo;
        if ($photo != null) {
            Storage::delete($photo);
        }
        $data->delete();

        return redirect()->route('user.index')->with('error', 'Data User berhasil dihapus');
    }

    public function profile()
    {
        $id = Auth::user()->id;
        $data = User::FindOrFail($id);

        return view('admin.setting.user.profile',[
            'title' => 'Profile',
            'breadcrumbs' => Breadcrumbs::render('profile'),
            'data' => $data,
        ]);
    }
}
