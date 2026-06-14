<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FilterGroupRequest;
use App\Models\FilterGroup;
use App\Services\Admin\FilterGroupService;

class FilterGroupController extends Controller
{
    public function __construct(protected FilterGroupService $filterGroupService)
    {
    }

    public function index()
    {
        $filterGroups = $this->filterGroupService->getAll(['search' => request('search')]);
        return view('admin.filter-groups.index', compact('filterGroups'));
    }

    public function create()
    {
        return view('admin.filter-groups.create');
    }

    public function store(FilterGroupRequest $request)
    {
        $this->filterGroupService->store($request->validated());
        return redirect()->route('admin.filter-groups.index')
            ->with('success', 'Tạo nhóm filter thành công.');
    }

    public function edit(FilterGroup $filterGroup)
    {
        return view('admin.filter-groups.edit', compact('filterGroup'));
    }

    public function update(FilterGroupRequest $request, FilterGroup $filterGroup)
    {
        $this->filterGroupService->update($filterGroup, $request->validated());
        return redirect()->route('admin.filter-groups.index')
            ->with('success', 'Cập nhật nhóm filter thành công.');
    }

    public function destroy(FilterGroup $filterGroup)
    {
        $this->filterGroupService->delete($filterGroup);
        return redirect()->route('admin.filter-groups.index')
            ->with('success', 'Xóa nhóm filter thành công.');
    }
}
