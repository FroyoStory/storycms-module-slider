@extends('story-theme::layouts.editor')

@section('title') Post Pages @stop

@section('content')
<div class="page-header">
  <div class="page-header-content">
    <div class="page-title">
      <h1>Create Pages</h1>
    </div>
    <div class="heading-elements">
      <div class="heading-btn-group">
        <a href="/backend/cms/elements/pages/add" class="btn btn-link btn-float has-text"><i class="material-icons">add_box</i> <span>ADD NEW</span></a>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid">
  <div>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active"><a href="#post-pages" aria-controls="post-pages" role="tab" data-toggle="tab">Post pages</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="post-pages" style="padding-top: 20px">
        <div class="row">
          <div class="col-md-8">
            <div class="panel panel-default">
              <div class="">

              </div>
              <div class="panel-body">
                <div class="form-group">
                  <label>Title</label>
                  <input type="text" name="title" class="form-control">
                </div>
                <div class="form-group">
                  <label></label>
                  <textarea class="editor" name="editor"></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4"></div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop
