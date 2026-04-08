<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AgensiRequest;
use App\Models\Agensi;
use App\Models\Sektor;
use App\Services\AgensiService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AgensiController extends Controller
{
    public function __construct(private AgensiService $service)
    {
    }

    public function index(): View
    {
        $items = $this->service->query()->with('sektor')->latest()->paginate();
        return view('admin.agensi.index', compact('items'));
    }

    public function create(): View
    {
        $agensi = new Agensi();
        $sektors = Sektor::orderBy('nama')->get();
        return view('admin.agensi.form', compact('agensi','sektors'));
    }

    public function store(AgensiRequest $request): RedirectResponse
    {
        $data = $this->service->fillableOnly($request->validated());
        $this->service->create($data);
        return redirect()->route('admin.agensi.index')->with('success', 'Agensi berjaya ditambah.');
    }

    public function edit(Agensi $agensi): View
    {
        $sektors = Sektor::orderBy('nama')->get();
        return view('admin.agensi.form', compact('agensi','sektors'));
    }

    public function update(AgensiRequest $request, Agensi $agensi): RedirectResponse
    {
        $data = $this->service->fillableOnly($request->validated());
        $this->service->update($agensi, $data);
        return redirect()->route('admin.agensi.index')->with('success', 'Agensi berjaya dikemas kini.');
    }

    public function destroy(Agensi $agensi): RedirectResponse
    {
        $this->service->delete($agensi);
        return redirect()->route('admin.agensi.index')->with('success', 'Agensi berjaya dipadam.');
    }
}
