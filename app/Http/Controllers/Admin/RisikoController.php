<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RisikoRequest;
use App\Models\Risiko;
use App\Models\SubKategoriRisiko;
use App\Services\RisikoService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RisikoController extends Controller
{
    public function __construct(private RisikoService $service)
    {
    }

    public function index(): View
    {
        $items = $this->service->query()->with('subKategoriRisiko.kategori')->latest()->paginate();
        return view('admin.risiko.index', compact('items'));
    }

    public function create(): View
    {
        $risiko = new Risiko();
        $subKategoris = SubKategoriRisiko::orderBy('nama')->get();
        return view('admin.risiko.form', compact('risiko','subKategoris'));
    }

    public function store(RisikoRequest $request): RedirectResponse
    {
        $data = $this->service->fillableOnly($request->validated());
        $this->service->create($data);
        return redirect()->route('admin.risiko.index')->with('success', 'Risiko berjaya ditambah.');
    }

    public function edit(Risiko $risiko): View
    {
        $subKategoris = SubKategoriRisiko::orderBy('nama')->get();
        return view('admin.risiko.form', compact('risiko','subKategoris'));
    }

    public function update(RisikoRequest $request, Risiko $risiko): RedirectResponse
    {
        $data = $this->service->fillableOnly($request->validated());
        $this->service->update($risiko, $data);
        return redirect()->route('admin.risiko.index')->with('success', 'Risiko berjaya dikemas kini.');
    }

    public function destroy(Risiko $risiko): RedirectResponse
    {
        $this->service->delete($risiko);
        return redirect()->route('admin.risiko.index')->with('success', 'Risiko berjaya dipadam.');
    }
}
