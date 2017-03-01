<form class="" action="/backend/cms/elements/category" method="POST">
  {{ csrf_field() }}
  <div class="panel panel-default">
    <div class="panel-heading">Add New Category</div>
    <div class="panel-body">
      <div class="form-group {{ $errors->has('name') ? 'has-error': '' }}">
        <label>Name *</label>
        <input type="text" name="name" class="form-control">
        <small class="help-block">The name is how it appears on your site.</small>
      </div>
      <div class="form-group">
        <label>Slug</label>
        <input type="text" name="slug" class="form-control">
        <small class="help-block">The "slug" is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.</small>
      </div>
      <div class="form-group">
        <label>Parent</label>
        <select class="form-control" name="parent_id">
          <option value="0">None</option>
          @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
          @endforeach
        </select>
        <small class="help-block">Categories, unlike tags, can have a hierarchy. You might have a Jazz category, and under that have children categories for Bebop and Big Band. Totally optional.</small>
      </div>
      <div class="form-group">
        <label>Description</label>
        <textarea name="description" class="form-control"></textarea>
        <small class="help-block">The description is not prominent by default; however, some themes may show it.</small>
      </div>
      <div class="form-group">
        <button class="btn btn-primary" type="submit">Add Category</button>
      </div>
    </div>
  </div>
</form>
