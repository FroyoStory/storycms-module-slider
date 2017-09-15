@extends('cms::layouts.app')

@section('title') Plugin @stop

@section('content')
  <div class="container-fluid">
    <table class="table">
      <thead>
        <tr>
          <th>Plugin</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($plugins as $plugin)
        <tr>
          <td>
            <strong>{{ $plugin->name }}</strong> <br />
            <small>{{ $plugin->description }}</small>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@stop
