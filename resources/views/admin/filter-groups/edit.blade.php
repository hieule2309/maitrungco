@extends('admin.layouts.app')

@section('title', 'Cập nhật Nhóm Filter')

@section('content')
@include('admin.filter-groups.partials.form', [
    'action'      => route('admin.filter-groups.update', $filterGroup),
    'method'      => 'PUT',
    'filterGroup' => $filterGroup,
])
@endsection
