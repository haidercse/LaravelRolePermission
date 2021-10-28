@extends('backend.layouts.master')

@section('title')
    Admin | Admin Management
@endsection

@section('admin-content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    @include('backend.layouts.partials.message')
                    <div class="card-header">
                        <h3>Admin List</h3>
                    </div>
                    <div class="mt-3 justify-content-between">
                      <a href="{{ route('admins.create') }}" class="float-right btn btn-info"><i class="fas fa-plus-circle"> Add Admin Name</i></a>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="data-table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Roles</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admins as $admin)
                                    <tr>
                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                        <td>{{ $admin->name }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td>
                                            @foreach ($admin->roles as $role)
                                                <span class="badge badge-info">{{ $role->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{ route('admins.edit',$admin->id) }}"
                                                class="btn btn-success"><i class="far fa-edit"> Edit</i></a>
                                               
                                            <a href="#delteModal{{ $admin->id }}" data-toggle="modal"
                                                class="btn btn-danger"><i class="far fa-trash-alt"> Delete</i></a>


                                            <!--Delete  Modal -->
                                            <div class="modal fade" id="delteModal{{ $admin->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Are you sure
                                                                to delete this?</h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('admins.destroy', $admin->id) }}"
                                                                method="POST">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger">Permanent
                                                                    Delete</button>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

