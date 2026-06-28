@extends('admin.layouts.app')

@section('title', 'Thêm Giá trị Filter')

@section('content')
@include('admin.filter-values.partials.form', [
    'action'      => route('admin.filter-values.store'),
    'method'      => 'POST',
    'filterValue' => null,
    'groups'      => $groups,
])
@endsection
