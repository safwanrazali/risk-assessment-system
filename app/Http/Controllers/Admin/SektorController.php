<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SektorRequest;
use App\Models\Sektor;
use App\Services\SektorService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SektorController extends Controller
{
    public function __construct(private SektorService $service)
    {
    }

    public function index(): View
    {
        $items = $this->service->paginate();
        return view('admin.sektor.index', compact('items'));
    }

    public function create(): View
    {
        $sektor = new Sektor();
        return view('admin.sektor.form', compact('sektor'));
    }

    public function store(SektorRequest $request): RedirectResponse
    {
        $data = $this->service->fillableOnly($request->validated());
        $this->service->create($data);

        return redirect()->route('admin.sektor.index')->with('success', 'Sektor berjaya ditambah.');
    }

    public function edit(Sektor $sektor): View
    {
        return view('admin.sektor.form', compact('sektor'));
    }

    public function update(SektorRequest $request, Sektor $sektor): RedirectResponse
    {
        $data = $this->service->fillableOnly($request->validated());
        $this->service->update($sektor, $data);

        return redirect()->route('admin.sektor.index')->with('success', 'Sektor berjaya dikemas kini.');
    }

    public function destroy(Sektor $sektor): RedirectResponse
    {
        $this->service->delete($sektor);
        return redirect()->route('admin.sektor.index')->with('success', 'Sektor berjaya dipadam.');
    }
}
