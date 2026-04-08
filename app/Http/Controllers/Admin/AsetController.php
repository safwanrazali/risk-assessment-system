<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AsetRequest;
use App\Models\Aset;
use App\Models\Agensi;
use App\Models\JenisAset;
use App\Services\AsetService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AsetController extends Controller
{
    public function __construct(private AsetService $service)
    {
    }

    public function index(): View
    {
        $items = $this->service->query()->with(['agensi','jenisAset'])->latest()->paginate();
        return view('admin.aset.index', compact('items'));
    }

    public function create(): View
    {
        $aset = new Aset();
        $agensis = Agensi::orderBy('nama_agensi')->get();
        $jenisAsets = JenisAset::orderBy('nama')->get();
        return view('admin.aset.form', compact('aset','agensis','jenisAsets'));
    }

    public function store(AsetRequest $request): RedirectResponse
    {
        $data = $this->service->fillableOnly($request->validated());
        $this->service->create($data);
        return redirect()->route('admin.aset.index')->with('success', 'Aset berjaya ditambah.');
    }

    public function edit(Aset $aset): View
    {
        $agensis = Agensi::orderBy('nama_agensi')->get();
        $jenisAsets = JenisAset::orderBy('nama')->get();
        return view('admin.aset.form', compact('aset','agensis','jenisAsets'));
    }

    public function update(AsetRequest $request, Aset $aset): RedirectResponse
    {
        $data = $this->service->fillableOnly($request->validated());
        $this->service->update($aset, $data);
        return redirect()->route('admin.aset.index')->with('success', 'Aset berjaya dikemas kini.');
    }

    public function destroy(Aset $aset): RedirectResponse
    {
        $this->service->delete($aset);
        return redirect()->route('admin.aset.index')->with('success', 'Aset berjaya dipadam.');
    }
}
