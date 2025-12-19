<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Visitor;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 1. Data Ringkasan (Card Atas)
        // Pastikan kamu punya Model 'Category' dan 'Visitor' (atau sesuaikan namanya)
        $total_katalog = 0;
        if (class_exists('\App\Product')) {
            $total_katalog = \App\Product::count();
        }

        // Cek total pengunjung (Kalau belum punya tabel visitor, kita set 0 dulu agar tidak error)
        $total_pengunjung = 0;

        // --- LOGIKA GRAFIK ---
        $chartLabels = [];
        $chartValues = [];

        // Kita cek dulu apakah kamu punya tabel/model Visitor untuk grafik
        // Jika kamu belum punya tabel visitor, kode di bawah ini akan error. 
        // Jadi saya buat pengaman:

        try {
            // Asumsi kamu punya model Visitor di App\Models\Visitor
            if (class_exists('\App\Visitor')) {
                $total_pengunjung = \App\Visitor::count();

                $chartData = \App\Visitor::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
                    ->where('created_at', '>=', Carbon::now()->subDays(7))
                    ->groupBy('date')
                    ->orderBy('date', 'ASC')
                    ->get();

                // Loop 7 hari terakhir
                for ($i = 6; $i >= 0; $i--) {
                    $date = Carbon::now()->subDays($i)->format('Y-m-d');
                    $chartLabels[] = Carbon::now()->subDays($i)->format('d M');

                    $visitor = $chartData->where('date', $date)->first();
                    $chartValues[] = $visitor ? $visitor->total : 0;
                }
            } else {
                // JIKA BELUM ADA MODEL VISITOR, KITA PAKAI DATA KOSONG DULU
                // AGAR HALAMAN TIDAK ERROR 500
                for ($i = 6; $i >= 0; $i--) {
                    $chartLabels[] = Carbon::now()->subDays($i)->format('d M');
                    $chartValues[] = 0;
                }
            }
        } catch (\Exception $e) {
            // Fallback jika database error
            $chartLabels = ['Error DB'];
            $chartValues = [0];
        }

        return view('dashboards.index', [
            'total_katalog' => $total_katalog,
            'total_pengunjung' => $total_pengunjung,
            'chartLabels' => $chartLabels,
            'chartValues' => $chartValues
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function settings()
    {
        // PERBAIKAN: Mengarah ke folder dashboards, bukan admin
        return view('dashboards.settings');
    }

    public function updateSettings(Request $request)
    {
        $user = Auth::user();

        // Validasi
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20', // Tambah validasi phone
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
        ]);

        // Update Data Dasar
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone; // Simpan phone

        // Update Foto
        if ($request->hasFile('avatar')) {
            $destinationPath = 'avatars/';
            // Hapus foto lama jika bukan default
            if ($user->avatar && $user->avatar != 'default.jpg' && file_exists(public_path($destinationPath . $user->avatar))) {
                unlink(public_path($destinationPath . $user->avatar));
            }
            
            $imageName = time() . '.' . $request->avatar->extension();
            $request->avatar->move(public_path($destinationPath), $imageName);
            $user->avatar = $imageName;
        }

        // Update Password
        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password saat ini salah!']);
            }
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
