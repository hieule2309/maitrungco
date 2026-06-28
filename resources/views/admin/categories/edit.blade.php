@extends('admin.layouts.app')

@section('title', 'Cập nhật Danh mục')

@section('content')
@include('admin.categories.partials.form', [
    'action' => route('admin.categories.update', $category),
    'method' => 'PUT',
    'category' => $category,
    'parentOptions' => $parentOptions,
    'defaultIcon' => $defaultIcon,
])
@endsection
