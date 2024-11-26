
@if($errors->any())
    <div class="alert alert-danger">
        <h3>Error is</h3>
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </div>
@endif

<div class="form-group">
    <x-form.input label="Category Name" name="name" :value="$category->name" ></x-form.input>
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
    <x-form.textarea  name="description" :value="$category->description"/>
</div>

<div class="form-group">
    <x-form.label for="image">Image</x-form.label>
    <x-form.input type="file" name="image" accept="image/*" />
    @if($category->image)
        <img src="{{ asset('storage/' . $category->image) }}" height="50" alt="Image" />
    @endif
</div>

<div class="form-group">
    <label for="status">Status</label>
    <div>
        <x-form.radio name="status" :checked="$category->status" :options="['active' => 'Active', 'archived' => 'Archived']" />
    </div>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-sm btn-outline-primary">{{$button_label ?? 'save'}}</button>
</div>
