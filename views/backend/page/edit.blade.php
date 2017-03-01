@extends('story-theme::layouts.editor')

@section('title') Post Pages @stop

@section('content')
<div class="page-header">
  <div class="page-header-content">
    <div class="page-title">
      <h1>Create Pages</h1>
    </div>
  </div>
</div>

<div class="container-fluid">
  <div>

    <form action="/backend/cms/elements/pages/{{ $page->id }}" method="POST" accept-charset="UTF-8">
      {{ csrf_field() }}
      <input type="hidden" name="_method" value="PUT">

      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#post-pages" aria-controls="post-pages" role="tab" data-toggle="tab">Post Content</a></li>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="post-pages" style="padding-top: 20px">
          <div class="row">
            <div class="col-md-8">
              <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                <label>Post Title *</label>
                <input type="text" name="title" class="form-control" value="{{ $trans->title }}">
                @if ($errors->has('title'))
                  <small class="help-block">{{ $errors->first('title') }}</small>
                @endif
              </div>
              <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
                <textarea class="editor" name="body">{{ $trans->body }}</textarea>
                @if ($errors->has('body'))
                  <small class="help-block">{{ $errors->first('body') }}</small>
                @endif
              </div>
            </div>
            <div class="col-md-4">
              <div class="panel panel-default">
                <div class="panel-heading">Page Detail</div>
                <div class="panel-body">
                  <div class="form-group">
                    <label>Post Status</label>
                    <select id="post-slug" class="form-control" name="status">
                      <option value="">Select status</option>
                      <option value="DRAFT" {{ $page->status == 'DRAFT' ? 'selected': '' }}>Draft</option>
                      <option value="PUBLISHED" {{ $page->status == 'PUBLISHED' ? 'selected': '' }}>Published</option>
                      <option value="PENDING" {{ $page->status == 'PENDING' ? 'selected': '' }}>Pending</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="panel panel-default">
                <div class="panel-heading">Post Meta Information</div>
                <div class="panel-body">
                  <div class="form-group">
                    <label>Meta Title</label>
                    <input type="text" class="form-control" name="meta_title" value="{{ $trans->meta_title }}">
                  </div>
                  <div class="form-group">
                    <label>Meta Description</label>
                    <textarea class="form-control" name="meta_description">{{ $trans->meta_description }}</textarea>
                  </div>
                  <div class="form-group">
                    <label>Meta Keyword</label>
                    <textarea class="form-control" name="meta_keyword">{{ $trans->meta_keyword }}</textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <hr />

          <div class="from-group">
            <input type="hidden" name="locale" value="{{ request()->input('locale') }}">
            <button class="btn btn-primary" type="submit">Update pages</button>
            <a href="/backend/cms/elements/pages/" class="btn btn-link">Back to articles</a>
          </div>
        </div>
      </div>
      <!-- End panes -->
    </form>
  </div>
</div>
@stop
