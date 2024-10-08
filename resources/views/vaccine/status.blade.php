@extends('app',['title'=> 'Welcome our COVID reg.'])
@section('content')
    <div class="container mx-auto px-4 pb-5">
        <h2 class="text-2xl font-bold mb-4">Check Vaccination Status</h2>

        @if ($status)
            <div class="mt-4 p-4 bg-gray-100 text-gray-700 rounded">
                <strong>Status:</strong> {{ $status }}
    
                @if ($status === 'Scheduled')
                    <div>Your vaccination date is {{ $scheduledDate }}</div>
                @elseif ($status === 'Not registered')
                    <a href="{{ route('vaccine.register') }}" class="text-blue-500 underline">Register here</a>
                @endif
            </div>
        @endif
    </div>
@endsection