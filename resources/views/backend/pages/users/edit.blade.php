@extends('backend.layouts.master')

@section('title')
    User Edit Form | User Managemnent
@endsection
@push('style')
<style>
    .form-check-label {
        text-transform: capitalize;
    }
</style>
@endpush
@section('admin-content')
     <div class="container">
         <div class="row">
             <div class="col-md-10">
                <div class="card">
                    @include('backend.layouts.partials.message')
                    <div class="card-header">
                        <h3>Add User Form</h3>
                    </div>
                    <div class="mt-3 justify-content-between">
                        <a href="{{ route('users.index') }}" class=" btn btn-warning"><i class="fas fa-long-arrow-alt-right"> Back User List</i></a>
                      </div>
                    <div class="card-body">
                        <form action="{{ route('users.update',$user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">User Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">User Email</label>
                                    <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="password">User Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter a User Password">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="password_confirm">Confirm Password</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter a Confirm Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="role">All User</label>
                                <select class="custom-select" id="select2" name="roles[]" multiple>
                                    <option value="">Select An Option</option>
                                     @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" {{ $user->hasRole($role->name) ? 'selected' : ''}}>{{ $role->name }}</option>
                                     @endforeach
                                  </select>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save Role</button>
                        </form>
                    </div>
                </div>
             </div>
         </div>
     </div>
     
    
@endsection