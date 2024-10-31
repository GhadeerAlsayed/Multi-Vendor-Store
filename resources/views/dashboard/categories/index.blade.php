@extends('layouts.dashboard')

@section('title','Categories')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
@endsection

@section('content')

    <div class="mb-5">
        <a href="{{route('dashboard.categories.create')}}" class="btn btn-sm btn-outline-primary">Create</a>
    </div>

    <x-alert/>

    <table class="table">
        <thead>
        <tr>
            <th>Image</th>
            <th>ID</th>
            <th>Name</th>
            <th>parent</th>
            <th>Create At</th>
            <th colspan="2"></th>
        </tr>
        </thead>

        <tbody>
        @forelse($categories as $category)
        <tr>
            <td>
                @if($category->image)
                    <img src="{{ asset('storage/' . $category->image) }}" height="50">
                @endif
            </td>

            <td>{{$category->id}}</td>
            <td>{{$category->name}}</td>
            <td>{{$category->parent_id}}</td>
            <td>{{$category->created_at}} </td>
            <td>
            <a href="{{route('dashboard.categories.edit',$category->id)}}" class="btn btn-sm btn-outline-success">Edit</a>
            </td>
            <td>
                <form action="{{route('dashboard.categories.destroy',$category->id)}}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7">No categories defined</td>
        </tr>

        @endforelse
        </tbody>
    </table>



@endsection
