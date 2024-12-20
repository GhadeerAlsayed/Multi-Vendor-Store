@extends('layouts.dashboard')

@section('title','Edit Category')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Edit Category</li>
    <li class="breadcrumb-item active">Categories</li>
@endsection

@section('content')

    <form action="{{route('dashboard.categories.update',$category->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('dashboard.categories._form',[
    'button_label' => 'Update'
])
    </form>

@endsection
