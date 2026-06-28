@extends('admin.layouts.app')

@section('title', 'Thêm Nhóm Filter')

@section('content')
@include('admin.filter-groups.partials.form', [
    'action'      => route('admin.filter-groups.store'),
    'method'      => 'POST',
    'filterGroup' => null,
])
@endsection
