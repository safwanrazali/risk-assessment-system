<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\KategoriRisikoRequest;
use App\Models\KategoriRisiko;
use App\Services\KategoriRisikoService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class KategoriRisikoController extends Controller
{
    public function __construct(private KategoriRisikoService $service)
    {
    }

    public function index(): View
    {
        $items = $this->service->paginate();
        return view('admin.kategori_risiko.index', compact('items'));
    }

    public function create(): View
    {
        $kategori = new KategoriRisiko();
        return view('admin.kategori_risiko.form', compact('kategori'));
    }

    public function store(KategoriRisikoRequest $request): RedirectResponse
    {
        $data = $this->service->fillableOnly($request->validated());
        $this->service->create($data);
        return redirect()->route('admin.kategori_risiko.index')->with('success', 'Kategori Risiko berjaya ditambah.');
    }

    public function edit(KategoriRisiko $kategori_risiko): View
    {
        $kategori = $kategori_risiko;
        return view('admin.kategori_risiko.form', compact('kategori'));
    }

    public function update(KategoriRisikoRequest $request, KategoriRisiko $kategori_risiko): RedirectResponse
    {
        $data = $this->service->fillableOnly($request->validated());
        $this->service->update($kategori_risiko, $data);
        return redirect()->route('admin.kategori_risiko.index')->with('success', 'Kategori Risiko berjaya dikemas kini.');
    }

    public function destroy(KategoriRisiko $kategori_risiko): RedirectResponse
    {
        $this->service->delete($kategori_risiko);
        return redirect()->route('admin.kategori_risiko.index')->with('success', 'Kategori Risiko berjaya dipadam.');
    }
}
