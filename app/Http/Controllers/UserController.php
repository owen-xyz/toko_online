<?php

namespace App\Http\Controllers;

use App\Helpers\ImageHelper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('updated_at', 'desc')->get();
        return view('backend.v_user.index', [
            'judul' => 'Data User',
            'index' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.v_user.create', [
            'judul' => 'Tambah User',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'email' => 'required|max:255|email|unique:users,email',
            'role' => 'required',
            'hp' => 'required|min:10|max:13',
            'password' => 'required|min:4|confirmed',
            'foto' => 'image|mimes:jpeg,jpg,png,gif|file|max:1024',
        ], [
            'foto.image' => 'Format gambar harus menggunakan file dengan ekstensi jpeg, jpg, png, atau gif.',
            'foto.max' => 'Ukuran file gambar maksimal adalah 1024 KB.',
        ]);

        $validatedData['status'] = 0;

        // Proses upload foto
        if ($request->file('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;
            $directory = 'storage/img-user/';
            ImageHelper::uploadAndResize($file, $directory, $originalFileName, 385, 400);
            $validatedData['foto'] = $originalFileName;
        }

        // Validasi kombinasi password
        $password = $request->input('password');
        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/';

        if (preg_match($pattern, $password)) {
            $validatedData['password'] = Hash::make($validatedData['password']);
            User::create($validatedData);
            return redirect()->route('user.index')->with('success', 'Data berhasil tersimpan');
        }

        return redirect()->back()->withErrors([
            'password' => 'Password harus terdiri dari kombinasi huruf besar, huruf kecil, angka, dan simbol.',
        ])->withInput();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);

        return view('backend.v_user.edit', [
            'judul' => 'Ubah User',
            'edit' => $user,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    /**
     * Update data user berdasarkan ID.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $id ID user yang akan diperbarui.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, string $id)
    {
        // Cari user berdasarkan ID, jika tidak ditemukan akan melempar 404
        $user = User::findOrFail($id);

        // Aturan validasi
        $rules = [
            'nama' => 'required|max:255',
            'role' => 'required',
            'status' => 'required',
            'hp' => 'required|min:10|max:13',
            'foto' => 'image|mimes:jpeg,jpg,png,gif|file|max:1024',
        ];

        // Pesan error custom untuk validasi
        $messages = [
            'foto.image' => 'Format gambar harus berupa file dengan ekstensi jpeg, jpg, png, atau gif.',
            'foto.max' => 'Ukuran file gambar maksimal adalah 1024 KB.',
        ];

        // Validasi email jika berbeda dengan data sebelumnya
        if ($request->email != $user->email) {
            $rules['email'] = 'required|max:255|email|unique:users,email';
        }

        // Validasi data request
        $validatedData = $request->validate($rules, $messages);

        // Proses upload dan resize gambar jika ada file foto yang diunggah
        if ($request->file('foto')) {
            // Hapus gambar lama jika ada
            if ($user->foto) {
                $oldImagePath = public_path('storage/img-user/') . $user->foto;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Upload gambar baru
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;
            $directory = 'storage/img-user/';

            // Gunakan ImageHelper untuk resize dan simpan gambar
            ImageHelper::uploadAndResize($file, $directory, $originalFileName, 385, 400);

            // Simpan nama file baru ke dalam data validasi
            $validatedData['foto'] = $originalFileName;
        }

        // Update data user
        $user->update($validatedData);

        // Redirect dengan pesan sukses
        return redirect()->route('backend.user.index')->with('success', 'Data berhasil diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        if ($user->foto) {
            $oldImagePath = public_path('storage/img-user/') . $user->foto;
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        $user->delete();
        return redirect()->route('user.index')->with('success', 'Data berhasil dihapus');
    }
}
