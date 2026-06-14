<?php

namespace App\Services\Admin;

use App\Models\FilterGroup;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FilterGroupService
{
    public function getAll(array $filters = []): LengthAwarePaginator
    {
        $query = FilterGroup::withCount('values')->orderBy('name');

        if (!empty($filters['search'])) {
            $query->where('name', 'like', '%' . $filters['search'] . '%');
        }

        return $query->paginate(15);
    }

    public function getById(int $id): FilterGroup
    {
        return FilterGroup::with('values')->findOrFail($id);
    }

    public function store(array $data): FilterGroup
    {
        return DB::transaction(function () use ($data) {
            $group = FilterGroup::create([
                'name' => $data['name'],
                'slug' => '',
            ]);

            $group->update([
                'slug' => $this->generateSlug($group->name, $group->id),
            ]);

            return $group->fresh();
        });
    }

    public function update(FilterGroup $group, array $data): FilterGroup
    {
        $group->update([
            'name' => $data['name'],
            'slug' => $this->generateSlug($data['name'], $group->id),
        ]);

        return $group->fresh();
    }

    public function delete(FilterGroup $group): void
    {
        $group->delete();
    }

    private function generateSlug(string $name, int $id): string
    {
        return Str::slug($name) . '-' . $id;
    }
}
