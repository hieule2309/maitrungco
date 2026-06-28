@extends('admin.layouts.app')

@section('title', 'Thêm mới Danh mục')

@section('content')
@include('admin.categories.partials.form', [
    'action' => route('admin.categories.store'),
    'method' => 'POST',
    'category' => null,
    'parentOptions' => $parentOptions,
    'defaultIcon' => $defaultIcon,
])
@endsection
