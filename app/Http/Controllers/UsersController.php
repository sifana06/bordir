<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersStoreRequest;
use App\User;
use DataTables;
use Illuminate\Support\Facades\Mail;
use App\Mail\InviteUsers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class UsersController extends Controller
{
    public function index()
    {
        $data['pengguna'] = User::all();

        return view('dashboard.users.all', $data);
    }

    public function create()
    {
        //
    }

    public function store(UsersStoreRequest $request)
    {
        //buka file UsersStoreRequest untuk liat rule validasi
        $messages = [
            'required' => ':attribute tidak boleh kosong.',
            'regex'    => ':attribute harus berupa karakter alphabet.',
            'unique'   => ':attribute sudah digunakan',
        ];

        $customAttributes = [
            'name' => 'Nama',
            'email' => 'Email',
            'phone' => 'Telepon',
            'role' => 'Role'
        ];

        $posted = $request->validated($messages,$customAttributes);

        $pwd = Str::random(10);

        $posted['password'] = bcrypt($pwd);

        $user = User::create($posted);
        Mail::to($user->email)->send(new InviteUsers($user, $pwd));
            
        return redirect()->route('user.index')->with('success','Users created successfully.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data['user'] = User::find($id);
        return view('dashboard.users.edit',$data);
    }

    public function update(Request $request, $id)
    {
        $valid = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$id,
            'phone' => 'required|numeric|digits_between:11,13',
            'jenis_kelamin' => 'required',
            'role' => 'required'
        ]);
        if($valid == true){
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->jenis_kelamin = $request->jenis_kelamin;
            $user->role = $request->role;
            $user->save();
        }

        return redirect()->route('user.index')->with('success','User deleted successfully.');
    }

    public function destroy($id)
    {
        $rekening = User::find($id);
        $rekening->delete();
        return redirect()->route('user.index')->with('success','User berhasil dihapus');
    }

    public function getData()
    {
        $query = User::select(['id', 'name', 'email', 'role', 'phone', 'alamat', 'created_at']);

        return FacadesDataTables::of($query)
            ->addColumn('name', function($user){
                return ucwords($user->name) . '<span style="color:#3c8dbc;">  (' . $user->role . ')</span>';
            })
            ->addColumn('kontak', function($user){
                return $user->email . '<br><span style="color: #3c8dbc;">' . $user->phone . '</span>';
            })
            ->addColumn('alamat', function($user){
                return $user->alamat;
            })
            ->editColumn('action', function ($user) {
                return '<a href="' . route('user.edit',$user->id) . '"><span class="fa fa-pencil" style="margin-right:5px;"> </span> </a> | <a type="javascript:;" data-toggle="modal" data-target="#konfirmasi_hapus" data-href="' . route('user.delete',['id'=>$user->id]) . '" title="Delete"> <span class="fa fa-trash" style="margin-left:5px;"> </span></a>';
            })
            ->rawColumns(['name', 'kontak', 'alamat', 'action'])
            ->addIndexColumn()
            ->make(true);
    }
}
