@extends('user.layouts.app')
@section('content')
<div class="container-fluid p-0">
  <h1 class="h3 mb-3">Settings</h1>
  <div class="row">
    <div class="col-md-3 col-xl-3">
      <div class="card">
        <div class="list-group list-group-flush" role="tablist">
          <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account" role="tab">
            Account
          </a>
          <a class="list-group-item list-group-item-action" data-toggle="list" href="#password" role="tab">
            Password
          </a>
        </div>
      </div>
    </div>
    <div class="col-md-9 col-xl-9">
      <div class="tab-content">
        <div class="tab-pane fade show active" id="account" role="tabpanel">
          <div class="card">
            <div class="card-body">
              <form method="POST" action="{{ route('user.settings.update') }}">
                @method('PUT')
                @csrf
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="username">Username</label>
                      <input type="text" name="username" class="form-control" value="{{ old('username') ?? auth()->user()->username }}">
                      @error('username')
                        <small class="form-text text-danger"><b>{{ $message }}</b></small>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="firstname">First name</label>
                      <input type="text" name="firstname" class="form-control" value="{{ old('firstname') ?? auth()->user()->firstname }}">
                       @error('firstname')
                        <small class="form-text text-danger"><b>{{ $message }}</b></small>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="lastname">Last name</label>
                      <input type="text" name="lastname" class="form-control" value="{{ old('lastname') ?? auth()->user()->lastname }}">
                       @error('lastname')
                        <small class="form-text text-danger"><b>{{ $message }}</b></small>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="text" name="email" class="form-control" value="{{ old('email') ?? auth()->user()->email }}">
                       @error('email')
                        <small class="form-text text-danger"><b>{{ $message }}</b></small>
                      @enderror
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </form>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="password" role="tabpanel">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Password</h5>
              <form>
                <div class="form-group">
                  <label for="inputPasswordCurrent">Current password</label>
                  <input type="password" name="" class="form-control" id="inputPasswordCurrent">
                  <small><a href="#">Forgot your password?</a></small>
                </div>
                <div class="form-group">
                  <label for="inputPasswordNew">New password</label>
                  <input type="password" name="" class="form-control" id="inputPasswordNew">
                </div>
                <div class="form-group">
                  <label for="inputPasswordNew2">Verify password</label>
                  <input type="password" name="" class="form-control" id="inputPasswordNew2">
                </div>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection