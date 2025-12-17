<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Pekerjaan;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $data = Pegawai::with('pekerjaan')
            ->when($keyword, function ($q) use ($keyword) {
                $q->where('nama', 'like', "%{$keyword}%")
                  ->orWhere('email', 'like', "%{$keyword}%");
            })
            ->paginate(5)
            ->withQueryString();

        return view('pegawai.index', compact('data'));
    }

    public function create()
    {
        $pekerjaan = Pekerjaan::all();
        return view('pegawai.create', compact('pekerjaan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'                 => 'required|string',
            'email'                => 'required|email|unique:pegawai,email',
            'gender'               => 'required|in:male,female',
            'pekerjaan_id'         => 'required|exists:pekerjaan,id',
            'is_active'            => 'required|boolean',
            'g-recaptcha-response' => 'required',
        ], [
            'g-recaptcha-response.required' => 'Captcha wajib diisi',
        ]);

        Pegawai::create($request->all());

        return redirect()
            ->route('pegawai.index')
            ->with('success', 'Pegawai berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = Pegawai::findOrFail($id);
        $pekerjaan = Pekerjaan::all();

        return view('pegawai.edit', compact('data', 'pekerjaan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'         => 'required|string',
            'email'        => 'required|email|unique:pegawai,email,' . $id,
            'gender'       => 'required|in:male,female',
            'pekerjaan_id' => 'required|exists:pekerjaan,id',
            'is_active'    => 'required|boolean',
        ]);

        Pegawai::findOrFail($id)->update($request->all());

        return redirect()
            ->route('pegawai.index')
            ->with('success', 'Pegawai berhasil diperbarui');
    }

    public function destroy($id)
    {
        Pegawai::findOrFail($id)->delete();

        return redirect()
            ->route('pegawai.index')
            ->with('success', 'Pegawai berhasil dihapus');
    }
}
