<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Transaksi;
use App\Models\Order;
use App\User;
use Exception;
use PDF;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        return redirect()->route('dashboard');
    }

    public function dashboard()
    {
        $check = auth()->user()->role;
        if ($check == 'pelanggan') {
            return redirect()->route('home');
        } else {
            return view('dashboard.dashboard');
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function profile()
    {
        $user = auth()->user()->role;
        if ($user == 'pelanggan') {
            return view('pelanggan.profile');
        } else {
            return view('dashboard.profile');
        }
    }

    public function profileUpdate(Request $request)
    {
        $messages = [
            'required' => ':attribute tidak boleh kosong.',
            'regex'    => ':attribute harus berupa karakter alphabet.',
            'numeric'  => ':attribute harus berupa karakter angka.',
            'alpha'    => ':attribute harus berupa karakter alphabet.',
        ];

        $customAttributes = [
            'name' => 'Nama',
            'phone' => 'Telepon',
            'no_ijin' => 'Nomor Izin Usaha',
        ];

        $valid = $request->validate([
            'name' => 'required|alpha',
            'phone' => 'required|numeric|digits_between:11,13',
            'no_ijin' => 'numeric'
        ], $messages, $customAttributes);

        if ($valid == true) {
            $user = auth()->user();
            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->no_ijin = $request->no_ijin;
            $user->foto = $request->foto;

            if (isset($request->new_password) && $request->new_password == $request->confirm_password) {
                $user->password = bcrypt($request->new_password);
            }
            $user->save();

            return redirect()->route('profile')->with('success', 'Profile updated successfully.');
        }
        return redirect()->route('profile')->with('error', 'Profile updated is failed.');
    }

    public function updateFotoProfile(Request $request)
    {
        $valid = $request->validate([
            'foto' => 'required|mimes:jpg,png,jpeg,gif,svg'
        ]);

        if ($valid == true) {
            //cek foto
            $cover = $request->file('foto');
            $extension = $cover->getClientOriginalExtension();
            Storage::disk('public')->put($cover->getFilename() . '.' . $extension,  File::get($cover));

            $user = auth()->user();
            $user->foto = $cover->getFilename() . '.' . $extension;

            $user->save();

            return redirect()->route('profile')->with('success', 'Profile updated successfully.');
        }
        return redirect()->route('profile')->with('error', 'Profile updated is failed.');
    }

    public function lapPesanan()
    {
        if (auth()->user()->role == 'pemilik') {
            $id = auth()->user()->id;
            $data['pesanan'] = Order::with(['product', 'user_customer', 'store_product'])->select(['id', 'user_id', 'store_id', 'pemilik_id', 'product_id', 'order_number', 'foto', 'jenis_bordir', 'keterangan', 'nama_pelanggan', 'email', 'telepon', 'kabupaten', 'kecamatan', 'desa', 'alamat', 'catatan', 'deadline', 'jumlah', 'harga', 'total', 'status_order', 'status_pembayaran', 'status_pengiriman', 'tipe_pembayaran', 'order_at', 'received_at', 'created_at'])->where('pemilik_id', $id)->get();
        } else {
            $data['pesanan'] = Order::with(['product', 'user_customer', 'store_product'])->select(['id', 'user_id', 'store_id', 'product_id', 'order_number', 'foto', 'jenis_bordir', 'keterangan', 'nama_pelanggan', 'email', 'telepon', 'kabupaten', 'kecamatan', 'desa', 'alamat', 'catatan', 'deadline', 'jumlah', 'harga', 'total', 'status_order', 'status_pembayaran', 'status_pengiriman', 'tipe_pembayaran', 'order_at', 'received_at', 'created_at'])->get();
        }
        return view('dashboard.laporan.lap_pesanan', $data);
    }

    public function lapUser()
    {
        try {
            $role = Auth()->user()->role;
            if ($role !== 'admin') throw new Exception("Hanya admin yang boleh mengakses laporan user");
            $users = User::all();
            return view('dashboard.laporan.lap_user', compact('users'));
        } catch (\Throwable $th) {
            $users = [];
            return view('dashboard.laporan.lap_user', compact('users'))->withError($th->getMessage());
        }
    }

    public function cetak_pesanan()
    {
        if (auth()->user()->role == 'pemilik') {
            $id = auth()->user()->id;
            $pesanan = Order::with(['product', 'user_customer', 'store_product'])->select(['id', 'user_id', 'store_id', 'pemilik_id', 'product_id', 'order_number', 'foto', 'jenis_bordir', 'keterangan', 'nama_pelanggan', 'email', 'telepon', 'kabupaten', 'kecamatan', 'desa', 'alamat', 'catatan', 'deadline', 'jumlah', 'harga', 'total', 'status_order', 'status_pembayaran', 'status_pengiriman', 'tipe_pembayaran', 'order_at', 'received_at', 'created_at'])->where('pemilik_id', $id)->get();
        } else {
            $pesanan = Order::with(['product', 'user_customer', 'store_product'])->select(['id', 'user_id', 'store_id', 'product_id', 'order_number', 'foto', 'jenis_bordir', 'keterangan', 'nama_pelanggan', 'email', 'telepon', 'kabupaten', 'kecamatan', 'desa', 'alamat', 'catatan', 'deadline', 'jumlah', 'harga', 'total', 'status_order', 'status_pembayaran', 'status_pengiriman', 'tipe_pembayaran', 'order_at', 'received_at', 'created_at'])->get();
        }
        $pdf = PDF::loadview('dashboard.laporan.pesanan_pdf', ['pesanan' => $pesanan]);
        return $pdf->stream();
    }

    public function lapTransaksi()
    {
        if (auth()->user()->role == 'pemilik') {
            $id = auth()->user()->id;
            $data['transaksi'] = Transaksi::select(["id", "order_id", "pemilik_id", "pelanggan_id", "product_id", "rekening_id", "toko_id", "bukti_pembayaran", "tanggal_transaksi"])->where('pemilik_id', $id)->get();
        } else {
            $data['transaksi'] = Transaksi::select(["id", "order_id", "pemilik_id", "pelanggan_id", "product_id", "rekening_id", "toko_id", "bukti_pembayaran", "tanggal_transaksi"])->get();
        }
        return view('dashboard.laporan.lap_transaksi', $data);
    }

    public function cetak_transaksi()
    {
        if (auth()->user()->role == 'pemilik') {
            $id = auth()->user()->id;
            $transaksi = Transaksi::select(["id", "order_id", "pemilik_id", "pelanggan_id", "product_id", "rekening_id", "toko_id", "bukti_pembayaran", "tanggal_transaksi"])->where('pemilik_id', $id)->get();
        } else {
            $transaksi = Transaksi::select(["id", "order_id", "pemilik_id", "pelanggan_id", "product_id", "rekening_id", "toko_id", "bukti_pembayaran", "tanggal_transaksi"])->get();
        }
        $pdf = PDF::loadview('dashboard.laporan.transaksi_pdf', ['transaksi' => $transaksi]);
        return $pdf->stream();
    }

    public function cetak_user()
    {
        try {
            $role = Auth()->user()->role;
            if ($role !== 'admin') throw new Exception("Hanya admin yang boleh mengakses laporan user");
            $users = User::all();
            $pdf = PDF::loadview('dashboard.laporan.user_pdf', ['users' => $users]);
            return $pdf->stream();
        } catch (\Throwable $th) {
            return back()->withError($th->getMessage());
        }
    }
}
