@extends('admin.layouts.app')

@section('title', 'Cập nhật Giá trị Filter')

@section('content')
@include('admin.filter-values.partials.form', [
    'action'      => route('admin.filter-values.update', $filterValue),
    'method'      => 'PUT',
    'filterValue' => $filterValue,
    'groups'      => $groups,
])
@endsection
