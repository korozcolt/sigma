@extends('votations.layouts.app')
@section('content')
    <h1><a class="slide-in-blurred-top">LOGIN</a></h1>
    <form action="{{ route('votations.token') }}" method="post">
        @csrf
        <div class="mb-4">
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña</label>
            <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Password" required>
        </div>
        <div class="btn-container mt-4">
            <button type="submit" class="btn puff-in-center">Login</button>
        </div>
    </form>
@endsection
