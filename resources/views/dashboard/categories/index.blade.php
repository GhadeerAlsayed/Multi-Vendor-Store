@extends('layouts.dashboard')

@section('title','Categories')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>

@endsection

@section('content')

    <div class="mb-5">
        <a href="{{route('dashboard.categories.create')}}" class="btn btn-sm btn-outline-primary mr-2">Create</a>
        <a href="{{route('dashboard.categories.trash')}}" class="btn btn-sm btn-outline-dark">Trash</a>
    </div>

    <x-alert type="success"/>
{{--    <x-alert type="info"/>--}}

    <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
        <x-form.input name="name" placeholder="Name" class="form-control mx-2" :value="request('name')" />
        <select name="status" class="form-control mx-2">
            <option value="">All</option>
            <option value="active" @selected(request('status') == 'active')>Active</option>
            <option value="archived" @selected(request('status') == 'archived')>Archived</option>
        </select>
        <button class="btn btn-dark mx-2">Filter</button>
    </form>

    <table class="table">
        <thead>
        <tr>
            <th>Image</th>
            <th>ID</th>
            <th>Name</th>
            <th>parent</th>
            <th>status</th>
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
            <td>{{$category->parent_name}}</td>
            <td>{{$category->status}}</td>
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
            <td colspan="8">No categories defined</td>
        </tr>

        @endforelse
        </tbody>
    </table>

{{ $categories->withQueryString()->appends(['search'=>1])->links() }}

@endsection
