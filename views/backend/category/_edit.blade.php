<form class="" action="/backend/cms/elements/category/{{ $category->id }}" method="POST">
  {{ csrf_field() }}
  <input type="hidden" name="_method" value="PUT">
  <div class="panel panel-default">
    <div class="panel-heading">Edit Category</div>
    <div class="panel-body">
      <div class="form-group {{ $errors->has('name') ? 'has-error': '' }}">
        <label>Name *</label>
        <input type="text" name="name" class="form-control" value="{{ $category->name }}">
        <small class="help-block">The name is how it appears on your site.</small>
      </div>
      <div class="form-group">
        <label>Slug</label>
        <input type="text" name="slug" class="form-control" value="{{ $category->slug }}">
        <small class="help-block">The "slug" is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.</small>
      </div>
      <div class="form-group">
        <label>Parent</label>
        <select class="form-control" name="parent_id">
          <option value="0">None</option>
          @foreach ($categories as $cat)
            <option value="{{ $cat->id }}" {{ $category->parent_id == $cat->id ? 'selected': ''}}>{{ $cat->name }}</option>
          @endforeach
        </select>
        <small class="help-block">Categories, unlike tags, can have a hierarchy. You might have a Jazz category, and under that have children categories for Bebop and Big Band. Totally optional.</small>
      </div>
      <div class="form-group">
        <label>Description</label>
        <textarea name="description" class="form-control">{{ $category->description }}</textarea>
        <small class="help-block">The description is not prominent by default; however, some themes may show it.</small>
      </div>

      <div class="form-group">
        <label>Language</label>
        <p class="form-control-static">{{ request()->input('locale') }}</p>
      </div>

      <div class="form-group">
        <input type="hidden" name="locale" value="{{ request()->input('locale') }}">
        <button class="btn btn-primary" type="submit">Update</button>
      </div>
    </div>
  </div>
</form>
