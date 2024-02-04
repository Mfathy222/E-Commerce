<div class="form-group">

    <x-form.input  lable="Category Name" name="name"  :value="$category->name" />
</div>



<div class="form-group">
    <lable for=''>Category Parent</lable>
    <select name="parent_id" class="form-control">
        <option value="">Primary Category</option>
        @foreach ($parents as $parent)
            <option value="{{ $parent->id }}"@selected(old('parent_id',$category->parent_id)==$parent->id)>{{ $parent->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <lable for=''>Descripton</lable>
    <x-form.textarea name="description" :value="$category->description"/>
</div>

<div class="form-group">
    <x-form.lable for='image'>image</x-form.lable>
    <x-form.input type="file" name="image" class="form-control"
    enctype="multipart/form-data"/>
    <br>
    @if ($category->image)
    <img src="{{asset('storage/' . $category->image)}}" alt="" height="100px">
    @endif
</div>

<div class="form-group">
    <lable for=''>Status</lable>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="status" value="active" @checked(old('status',$category->status=='active'))>
        <label class="form-check-label">
            Active
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="status" value="archived" @checked(old('status',$category->status=='archived'))>
        <label class="form-check-label">
            Archived
        </label>
    </div>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">Save</button>
</div>
