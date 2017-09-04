@extends('story-theme::layouts.master')

@section('title') Navigation Settings @stop

@section('heading-elements')
<div class="heading-elements">
  <div class="heading-btn-group">
    {{--  <a href="/backend/system/appearance/navigation/create" class="btn btn-link btn-float has-text">
      <i class="material-icons">add_box</i> <span>ADD NEW</span>
    </a>  --}}
  </div>
</div>
@stop

@section('content')
  <div class="container-fluid">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Name</th>
          <th>Link</th>
          <th class='text-center'>Visibility</th>
          <th>Edit</th>
        </tr>
      </thead>
      <tbody>
        @php
          $traverse = function($categories, $prefix = '') use (&$traverse) {
            foreach ($categories as $category) {
              echo "<tr>";
                echo "<td>" . $prefix ." ". $category->name."</td>";
                echo "<td>" . "/" . $category->slug."</td>";
                echo "<td class='text-center'><input readonly type='checkbox' " . ($category->visibility ? 'checked' : '') . "/></td>";
                echo "<td><a href='/backend/system/appearance/navigation/".$category->id."'>Edit </a></td>";
              echo "</tr>";
              $traverse($category->children, $prefix. ' - ');
            }
          }
        @endphp

        {!! $traverse($menus) !!}

      </tbody>
    </table>
  </div>

@stop
