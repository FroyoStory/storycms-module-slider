@extends('story-theme::layouts.master')

@section('title') Members @stop

@section('heading-elements')
<div class="heading-elements">
  <div class="heading-btn-group">
    <a href="/backend/user/groups/member/add" class="btn btn-link btn-float has-text"><i class="material-icons">add_box</i> <span>ADD NEW</span></a>
  </div>
</div>
@stop

@section('content')
<div class="container-fluid">
  <table class="table">
    <thead>
      <tr>
        <th>Username</th>
        <th>Email</th>
        <th>Role</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
      <tr>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->role->name }}</td>
        <td>
          <a href="/backend/user/groups/member/{{ $user->id }}">
            <i class="material-icons font-size-14">edit</i>
          </a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@stop
