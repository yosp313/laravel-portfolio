@extends('layouts.app')

@section('content')
    <div class="max-w-lg mx-auto">
        <h1 class="text-4xl font-bold mb-8 text-center bg-gradient-to-r from-purple-500 via-pink-500 to-blue-500 bg-clip-text text-transparent">Contact</h1>
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="/contact" method="POST" class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 flex flex-col gap-6 border border-gradient-to-tr from-pink-200 via-purple-200 to-blue-200">
            @csrf
            <div>
                <label for="name" class="block mb-1 font-medium">Name</label>
                <input type="text" id="name" name="name" class="w-full rounded border-gray-300 dark:border-gray-700 focus:ring-2 focus:ring-purple-400 p-2" required>
            </div>
            <div>
                <label for="email" class="block mb-1 font-medium">Email</label>
                <input type="email" id="email" name="email" class="w-full rounded border-gray-300 dark:border-gray-700 focus:ring-2 focus:ring-purple-400 p-2" required>
            </div>
            <div>
                <label for="message" class="block mb-1 font-medium">Message</label>
                <textarea id="message" name="message" rows="5" class="w-full rounded border-gray-300 dark:border-gray-700 focus:ring-2 focus:ring-purple-400 p-2" required></textarea>
            </div>
            <button type="submit" class="w-full py-2 px-4 rounded bg-gradient-to-r from-purple-500 via-pink-500 to-blue-500 text-white font-bold hover:opacity-90 transition">Send Message</button>
        </form>
    </div>
@endsection 