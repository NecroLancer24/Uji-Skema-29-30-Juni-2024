<?php

namespace App\Http\Controllers;

use App\Models\role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TableController extends Controller
{
    public function index(Request $request)
    {   
        $katakunci = $request->katakunci;
        
            if (strlen($katakunci)) {
                $data = User::with('role')->where('name', 'like', "%$katakunci%")
                ->orderBy('name', 'asc')
                ->paginate(5);
            } else {
                $data = User::with('role')->orderBy('name', 'asc')->paginate(5);
            }
            return view("table.index", compact("data"));
        


    }

    public function updateView($id)
    {
        if (Auth::user()->role_id == 1) {
            $data = User::where("id", $id)->first();
            $role = role::get();
            return view("table.update", compact("data", "role"));
        } else {
            return back()->with('warning', 'Anda Tidak Memiliki Akses Update Data');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required'
        ], [
            'name.required'=>'Nama Wajib Di isi',
            'email.required'=>'Email Wajib Di isi',
            'role'=>'Pilih role yang benar'
        ]);

        if (is_Null($request->password)) {
            User::where("id", $id)->update([
                "name" => $request->name,
                "email" => $request->email,
                "role_id" => $request->role,
            ]);
        } else {
            $request->validate([
                "password"=> "min:8",
            ],[
                "password.min"=> "Password Minimal 8 karakter",
            ]);
            User::where("id", $id)->update([
                "name" => $request->name,
                "email" => $request->email,
                "password"=> bcrypt($request->password),
                "role_id" => $request->role,
            ]);
        }

        
        return redirect(route("home"))->with("success", "Selesai Update");
    }
    public function destroy($id)
    {
        User::where("id", $id)->delete();
        return redirect(route("home"))->with("success", "Data Sudah Di Hapus");
    }
}
