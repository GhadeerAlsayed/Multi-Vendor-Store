
@if($errors->any())
    <div class="alert alert-danger">
        <h3>Error is</h3>
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </div>
@endif


<div class="form-group">
    <label> Category Name</label>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name' ,$category->name) }}">
    @error('name')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label>Parent Category</label>
    <select type="text" name="parent_id" class="form-control form-select">
        <option value="">Primary Category</option>
        @foreach($parents as $parent)
            <option value="{{$parent->id}}"  @selected(old('parent_id' ,$category->parent_id) == $parent->id) > {{ $parent->name }} </option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label> Description</label>
    <textarea type="text" name="description" class="form-control">{{old('description' ,$category->description)}}</textarea>
</div>
<div class="form-group">
    <label> Image</label>
    <input type="file" name="image" class="form-control" accept="image/*">
    @if($category->image)
        <img src="{{asset('storage/' . $category->image)}}" height="50">
    @endif
</div>
<div class="form-group">
    <label for="">Status</label>
    <div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" value="active" @checked(old('status' ,$category->stutas) == 'active')>
            <label class="form-check-label">
                Active
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status"  value="archived" @checked(old('status' ,$category->status) == 'archived')>
            <label class="form-check-label" >
                Archived
            </label>
        </div>
    </div>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-sm btn-outline-primary">{{$button_label ?? 'save'}}</button>
</div>
