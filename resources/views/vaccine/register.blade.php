@extends('app',['title'=> 'Welcome our COVID reg.'])
@section('content')
<div class="w-[700px]  mx-auto px-4">
    <h2 class="text-2xl font-bold mb-4">Register for Vaccination</h2>

    <form action="{{ route('vaccine.register.submit') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium">Name</label>
            <input type="text" id="name" value="{{old('name')}}" name="name" class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            @error('name')
            <p id=""  class="mt-2 text-xs text-red-600 dark:text-red-400">{{$message}}</p>
            @enderror
        
        </div>

        <div class="mb-4">
            <label for="nid" class="block text-sm font-medium">National ID (NID)</label>
            <input type="text" id="nid"  value="{{old('nid')}}" name="nid" class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            @error('nid')
            <p id=""  class="mt-2 text-xs text-red-600 dark:text-red-400">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium">Email</label>
            <input type="email" id="email"  value="{{old('email')}}" name="email" class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            @error('email')
            <p id=""  class="mt-2 text-xs text-red-600 dark:text-red-400">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="center_id" class="block text-sm font-medium">Vaccine Center</label>
            <select id="center_id" name="center_id" class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                @foreach ($centers as $center)
                    <option @selected(old('center_id') == $center->id) value="{{ $center->id }}">{{ $center->name }}</option>
                @endforeach
            </select>
            @error('center_id')
            <p id=""  class="mt-2 text-xs text-red-600 dark:text-red-400">{{$message}}</p>
            @enderror
        </div>

        <button type="submit" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Register</button>

    </form>

    @if (session('message'))
        <div class="mt-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('message') }}
        </div>
    @endif
</div>
@endsection