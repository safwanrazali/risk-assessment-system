<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\JenisAsetRequest;
use App\Models\JenisAset;
use App\Models\KategoriPuncaRisiko;
use App\Services\JenisAsetService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class JenisAsetController extends Controller
{
    public function __construct(private JenisAsetService $service)
    {
    }

    public function index(): View
    {
        $items = $this->service->query()->with('kategoriPuncaRisiko')->latest()->paginate();
        return view('admin.jenis_aset.index', compact('items'));
    }

    public function create(): View
    {
        $jenis = new JenisAset();
        $kategoris = KategoriPuncaRisiko::orderBy('nama')->get();
        return view('admin.jenis_aset.form', compact('jenis','kategoris'));
    }

    public function store(JenisAsetRequest $request): RedirectResponse
    {
        $data = $this->service->fillableOnly($request->validated());
        $this->service->create($data);
        return redirect()->route('admin.jenis_aset.index')->with('success', 'Jenis Aset berjaya ditambah.');
    }

    public function edit(JenisAset $jenis_aset): View
    {
        $jenis = $jenis_aset;
        $kategoris = KategoriPuncaRisiko::orderBy('nama')->get();
        return view('admin.jenis_aset.form', compact('jenis','kategoris'));
    }

    public function update(JenisAsetRequest $request, JenisAset $jenis_aset): RedirectResponse
    {
        $data = $this->service->fillableOnly($request->validated());
        $this->service->update($jenis_aset, $data);
        return redirect()->route('admin.jenis_aset.index')->with('success', 'Jenis Aset berjaya dikemas kini.');
    }

    public function destroy(JenisAset $jenis_aset): RedirectResponse
    {
        $this->service->delete($jenis_aset);
        return redirect()->route('admin.jenis_aset.index')->with('success', 'Jenis Aset berjaya dipadam.');
    }
}
