<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FilterValueRequest;
use App\Models\FilterValue;
use App\Services\Admin\FilterValueService;

class FilterValueController extends Controller
{
    public function __construct(protected FilterValueService $filterValueService)
    {
    }

    public function index()
    {
        $filterValues = $this->filterValueService->getAll([
            'search'   => request('search'),
            'group_id' => request('group_id'),
        ]);
        $groups = $this->filterValueService->getGroups();
        return view('admin.filter-values.index', compact('filterValues', 'groups'));
    }

    public function create()
    {
        $groups = $this->filterValueService->getGroups();
        return view('admin.filter-values.create', compact('groups'));
    }

    public function store(FilterValueRequest $request)
    {
        $this->filterValueService->store($request->validated());
        return redirect()->route('admin.filter-values.index')
            ->with('success', 'Tạo giá trị filter thành công.');
    }

    public function edit(FilterValue $filterValue)
    {
        $groups = $this->filterValueService->getGroups();
        return view('admin.filter-values.edit', compact('filterValue', 'groups'));
    }

    public function update(FilterValueRequest $request, FilterValue $filterValue)
    {
        $this->filterValueService->update($filterValue, $request->validated());
        return redirect()->route('admin.filter-values.index')
            ->with('success', 'Cập nhật giá trị filter thành công.');
    }

    public function destroy(FilterValue $filterValue)
    {
        $this->filterValueService->delete($filterValue);
        return redirect()->route('admin.filter-values.index')
            ->with('success', 'Xóa giá trị filter thành công.');
    }
}
