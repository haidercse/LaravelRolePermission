@extends('errors.error_layout')

@section('error_title')
    500 - Internal Server Error! 
@endsection

@section('error-content')
    <h2>500</h2>
    <p>Internal Server Error!</p>
    
    <a href="{{ route('admin.dashboard') }}">Back to Dashboard</a>
    {{-- <a href="{{ route('login') }}">Logout Now!</a>
    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <button type="submit" class="dropdown-item underline text-sm text-gray-600 hover:text-gray-900">
            {{ __('Log Out') }}
        </button>
    </form> --}}
@endsection
