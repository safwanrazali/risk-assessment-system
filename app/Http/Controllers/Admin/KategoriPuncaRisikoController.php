<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\KategoriPuncaRisikoRequest;
use App\Models\KategoriPuncaRisiko;
use App\Services\KategoriPuncaRisikoService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class KategoriPuncaRisikoController extends Controller
{
    public function __construct(private KategoriPuncaRisikoService $service)
    {
    }

    public function index(): View
    {
        $items = $this->service->paginate();
        return view('admin.kategori_punca_risiko.index', compact('items'));
    }

    public function create(): View
    {
        $kategori = new KategoriPuncaRisiko();
        return view('admin.kategori_punca_risiko.form', compact('kategori'));
    }

    public function store(KategoriPuncaRisikoRequest $request): RedirectResponse
    {
        $data = $this->service->fillableOnly($request->validated());
        $this->service->create($data);
        return redirect()->route('admin.kategori_punca_risiko.index')->with('success', 'Kategori Punca Risiko berjaya ditambah.');
    }

    public function edit(KategoriPuncaRisiko $kategori_punca_risiko): View
    {
        $kategori = $kategori_punca_risiko;
        return view('admin.kategori_punca_risiko.form', compact('kategori'));
    }

    public function update(KategoriPuncaRisikoRequest $request, KategoriPuncaRisiko $kategori_punca_risiko): RedirectResponse
    {
        $data = $this->service->fillableOnly($request->validated());
        $this->service->update($kategori_punca_risiko, $data);
        return redirect()->route('admin.kategori_punca_risiko.index')->with('success', 'Kategori Punca Risiko berjaya dikemas kini.');
    }

    public function destroy(KategoriPuncaRisiko $kategori_punca_risiko): RedirectResponse
    {
        $this->service->delete($kategori_punca_risiko);
        return redirect()->route('admin.kategori_punca_risiko.index')->with('success', 'Kategori Punca Risiko berjaya dipadam.');
    }
}
