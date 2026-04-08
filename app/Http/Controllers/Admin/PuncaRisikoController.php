<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PuncaRisikoRequest;
use App\Models\PuncaRisiko;
use App\Models\KategoriPuncaRisiko;
use App\Services\PuncaRisikoService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PuncaRisikoController extends Controller
{
    public function __construct(private PuncaRisikoService $service)
    {
    }

    public function index(): View
    {
        $items = $this->service->query()->with('kategoriPuncaRisiko')->latest()->paginate();
        return view('admin.punca_risiko.index', compact('items'));
    }

    public function create(): View
    {
        $punca = new PuncaRisiko();
        $kategoris = KategoriPuncaRisiko::orderBy('nama')->get();
        return view('admin.punca_risiko.form', compact('punca','kategoris'));
    }

    public function store(PuncaRisikoRequest $request): RedirectResponse
    {
        $data = $this->service->fillableOnly($request->validated());
        $this->service->create($data);
        return redirect()->route('admin.punca_risiko.index')->with('success', 'Punca Risiko berjaya ditambah.');
    }

    public function edit(PuncaRisiko $punca_risiko): View
    {
        $punca = $punca_risiko;
        $kategoris = KategoriPuncaRisiko::orderBy('nama')->get();
        return view('admin.punca_risiko.form', compact('punca','kategoris'));
    }

    public function update(PuncaRisikoRequest $request, PuncaRisiko $punca_risiko): RedirectResponse
    {
        $data = $this->service->fillableOnly($request->validated());
        $this->service->update($punca_risiko, $data);
        return redirect()->route('admin.punca_risiko.index')->with('success', 'Punca Risiko berjaya dikemas kini.');
    }

    public function destroy(PuncaRisiko $punca_risiko): RedirectResponse
    {
        $this->service->delete($punca_risiko);
        return redirect()->route('admin.punca_risiko.index')->with('success', 'Punca Risiko berjaya dipadam.');
    }
}
