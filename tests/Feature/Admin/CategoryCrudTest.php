<?php

use App\Models\Category;
use App\Models\User;

it('stores a root category with generated slug and custom icon', function () {
    $user = User::factory()->create(['email_verified_at' => now()]);

    $response = $this->actingAs($user)->post(route('admin.categories.store'), [
        'name' => 'Laptop Gaming',
        'description' => 'Danh muc laptop gaming',
        'icon' => 'fas fa-laptop',
    ]);

    $response->assertRedirect(route('admin.categories.index'));

    $category = Category::first();

    expect($category)->not->toBeNull();
    expect($category->slug)->toBe('laptop-gaming-' . $category->id);
    expect($category->icon)->toBe('fas fa-laptop');
    expect($category->parent_id)->toBeNull();
});

it('stores child categories with the default icon', function () {
    $user = User::factory()->create(['email_verified_at' => now()]);
    $parent = Category::create([
        'name' => 'Laptop',
        'slug' => 'laptop-1',
        'description' => null,
        'icon' => 'fas fa-laptop',
        'parent_id' => null,
    ]);

    $this->actingAs($user)->post(route('admin.categories.store'), [
        'name' => 'Laptop Gaming',
        'parent_id' => $parent->id,
        'icon' => 'fas fa-gamepad',
    ])->assertRedirect(route('admin.categories.index'));

    $category = Category::where('parent_id', $parent->id)->first();

    expect($category->icon)->toBe('fas fa-folder');
});

it('rejects creating a category deeper than level three', function () {
    $user = User::factory()->create(['email_verified_at' => now()]);
    $level1 = Category::create([
        'name' => 'May tinh',
        'slug' => 'may-tinh-1',
        'description' => null,
        'icon' => 'fas fa-desktop',
        'parent_id' => null,
    ]);
    $level2 = Category::create([
        'name' => 'Laptop',
        'slug' => 'laptop-2',
        'description' => null,
        'icon' => 'fas fa-folder',
        'parent_id' => $level1->id,
    ]);
    $level3 = Category::create([
        'name' => 'Gaming',
        'slug' => 'gaming-3',
        'description' => null,
        'icon' => 'fas fa-folder',
        'parent_id' => $level2->id,
    ]);

    $response = $this->actingAs($user)->from(route('admin.categories.create'))->post(route('admin.categories.store'), [
        'name' => 'RTX 50 Series',
        'parent_id' => $level3->id,
    ]);

    $response->assertRedirect(route('admin.categories.create'));
    $response->assertSessionHasErrors('parent_id');
    expect(Category::where('name', 'RTX 50 Series')->exists())->toBeFalse();
});