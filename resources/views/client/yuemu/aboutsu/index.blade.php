@extends('client.layouts.app')

@section('content')
    <section style="padding:0;">
				{!! $aboutus->detail !!}
        {{-- <div class="text-center">
            <h1 style="color: #045242;">ทีมแพทย์จีน</h1>
            <h2 style="color: #045242;">Our Doctor</h2>
        </div>
        <div class="mt-4">
            <img src="{{ url('/images/yuemu/doctor1.png') }}" alt="" style="width: 100%; height: 100%;">
        </div>
        <div class="mt-4">
            <img src="{{ url('/images/yuemu/doctor2.png') }}" alt=""style="width: 100%; height: 100%;">
        </div> --}}
    </section>
@endsection
