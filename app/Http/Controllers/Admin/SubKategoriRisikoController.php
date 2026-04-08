<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubKategoriRisikoRequest;
use App\Models\SubKategoriRisiko;
use App\Models\KategoriRisiko;
use App\Services\SubKategoriRisikoService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SubKategoriRisikoController extends Controller
{
    public function __construct(private SubKategoriRisikoService $service)
    {
    }

    public function index(): View
    {
        $items = $this->service->query()->with('kategori')->latest()->paginate();
        return view('admin.sub_kategori_risiko.index', compact('items'));
    }

    public function create(): View
    {
        $subKategori = new SubKategoriRisiko();
        $kategoris = KategoriRisiko::orderBy('nama')->get();
        return view('admin.sub_kategori_risiko.form', compact('subKategori','kategoris'));
    }

    public function store(SubKategoriRisikoRequest $request): RedirectResponse
    {
        $data = $this->service->fillableOnly($request->validated());
        $this->service->create($data);
        return redirect()->route('admin.sub_kategori_risiko.index')->with('success', 'Subkategori Risiko berjaya ditambah.');
    }

    public function edit(SubKategoriRisiko $sub_kategori_risiko): View
    {
        $subKategori = $sub_kategori_risiko;
        $kategoris = KategoriRisiko::orderBy('nama')->get();
        return view('admin.sub_kategori_risiko.form', compact('subKategori','kategoris'));
    }

    public function update(SubKategoriRisikoRequest $request, SubKategoriRisiko $sub_kategori_risiko): RedirectResponse
    {
        $data = $this->service->fillableOnly($request->validated());
        $this->service->update($sub_kategori_risiko, $data);
        return redirect()->route('admin.sub_kategori_risiko.index')->with('success', 'Subkategori Risiko berjaya dikemas kini.');
    }

    public function destroy(SubKategoriRisiko $sub_kategori_risiko): RedirectResponse
    {
        $this->service->delete($sub_kategori_risiko);
        return redirect()->route('admin.sub_kategori_risiko.index')->with('success', 'Subkategori Risiko berjaya dipadam.');
    }
}
