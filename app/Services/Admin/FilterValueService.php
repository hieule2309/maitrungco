<?php

namespace App\Services\Admin;

use App\Models\FilterGroup;
use App\Models\FilterValue;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FilterValueService
{
    public function getAll(array $filters = []): LengthAwarePaginator
    {
        $query = FilterValue::with('group')->orderBy('filter_group_id')->orderBy('value');

        if (!empty($filters['search'])) {
            $query->where('value', 'like', '%' . $filters['search'] . '%');
        }

        if (!empty($filters['group_id'])) {
            $query->where('filter_group_id', $filters['group_id']);
        }

        return $query->paginate(15);
    }

    public function getById(int $id): FilterValue
    {
        return FilterValue::with('group')->findOrFail($id);
    }

    public function getGroups(): Collection
    {
        return FilterGroup::orderBy('name')->get();
    }

    public function store(array $data): FilterValue
    {
        return DB::transaction(function () use ($data) {
            $filterValue = FilterValue::create([
                'filter_group_id' => $data['filter_group_id'],
                'value'           => $data['value'],
                'slug'            => '',
            ]);

            $filterValue->update([
                'slug' => $this->generateSlug($filterValue->value, $filterValue->id),
            ]);

            return $filterValue->fresh();
        });
    }

    public function update(FilterValue $filterValue, array $data): FilterValue
    {
        $filterValue->update([
            'filter_group_id' => $data['filter_group_id'],
            'value'           => $data['value'],
            'slug'            => $this->generateSlug($data['value'], $filterValue->id),
        ]);

        return $filterValue->fresh();
    }

    public function delete(FilterValue $filterValue): void
    {
        $filterValue->delete();
    }

    private function generateSlug(string $value, int $id): string
    {
        return Str::slug($value) . '-' . $id;
    }
}
