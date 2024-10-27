@extends('admin.layout.appadmin')
@section('content')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif

@foreach ($users as $use)
<h1 class="mt-4">Form Edit User</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
    <li class="breadcrumb-item active">Tables</li>
</ol>

<form method="POST" action="{{url('admin/users/update/'.$use->id)}} " enctype="multipart/form-data"> 
@csrf
  <div class="form-group row">
    <label for="text1" class="col-4 col-form-label">Username</label> 
    <div class="col-8">
      <input id="text1" name="username" type="text" class="form-control" value="{{$use->username}}">
    </div>
  </div>
  <div class="form-group row">
    <label for="text1" class="col-4 col-form-label">Password</label> 
    <div class="col-8">
      <input id="text1" name="password" type="text" class="form-control" value="{{$use->password}}">
    </div>
  </div>
  <div class="form-group row">
    <label for="select" class="col-4 col-form-label">Role</label> 
    <div class="col-8">
    <input id="text1" name="role" type="text" class="form-control" value="{{$use->role}}">
        
    </div>
  </div> 
  <div class="form-group row">
    <div class="offset-4 col-8">
      <button name="submit" type="submit" class="btn btn-primary">Update</button>
    </div>
  </div>
</form>
@endforeach
@endsection