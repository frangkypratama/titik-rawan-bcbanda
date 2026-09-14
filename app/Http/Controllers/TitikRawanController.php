<?php

namespace App\Http\Controllers;

use App\Models\TitikRawan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class TitikRawanController extends Controller
{
    public function index(): View
    {
        $titikRawans = TitikRawan::latest()->paginate(15);

        return view('titik-rawan.index', compact('titikRawans'));
    }

    public function show(TitikRawan $titikRawan): View
    {
        return view('titik-rawan.show', compact('titikRawan'));
    }

    public function create(): View
    {
        return view('titik-rawan.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('titik-rawan', 'local');
        }

        TitikRawan::create($data);

        return redirect()->route('titik-rawan.index')->with('status', 'Titik rawan berhasil ditambahkan.');
    }

    public function edit(TitikRawan $titikRawan): View
    {
        return view('titik-rawan.edit', compact('titikRawan'));
    }

    public function update(Request $request, TitikRawan $titikRawan): RedirectResponse
    {
        $data = $this->validateData($request);

        if ($request->hasFile('foto')) {
            if ($titikRawan->foto) {
                Storage::disk('local')->delete($titikRawan->foto);
            }

            $data['foto'] = $request->file('foto')->store('titik-rawan', 'local');
        }

        $titikRawan->update($data);

        return redirect()->route('titik-rawan.index')->with('status', 'Titik rawan berhasil diperbarui.');
    }

    public function destroy(TitikRawan $titikRawan): RedirectResponse
    {
        if ($titikRawan->foto) {
            Storage::disk('local')->delete($titikRawan->foto);
        }

        $titikRawan->delete();

        return redirect()->route('titik-rawan.index')->with('status', 'Titik rawan berhasil dihapus.');
    }

    public function foto(TitikRawan $titikRawan): StreamedResponse
    {
        abort_unless($titikRawan->foto && Storage::disk('local')->exists($titikRawan->foto), 404);

        return Storage::disk('local')->response($titikRawan->foto);
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'kota_kabupaten' => ['nullable', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
            'kategori' => ['nullable', 'string', 'max:255'],
            'foto' => ['nullable', 'image', 'max:4096'],
            'link_maps' => ['nullable', 'url', 'max:255'],
            'akses' => ['nullable', 'string', 'max:255'],
            'jangkauan' => ['nullable', 'string', 'max:255'],
            'tempat_sandar' => ['nullable', 'string', 'max:255'],
            'jenis_kapal' => ['nullable', 'string', 'max:255'],
            'mpm' => ['nullable', 'string', 'max:255'],
        ]);
    }
}
