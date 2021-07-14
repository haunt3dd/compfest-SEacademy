@extends('layouts.main')

@section('title','Appointment')

@section('container')


<div class="text-center">
    <div class="m-5 pl-3 pt-3 content">
        <div class="p-1">
            <h2>{{$appointment['doctorName']}}</h2>
            <h2>Status: {{$appointment['Status']}}</h2>
        </div>

        <img src="{{asset('assets/hospital.jpg')}}" alt="">
        <div class="p-3 mt-5"><h1>Registrant:</h1> </div>

        @if(!empty($registrants))
        <div class="d-flex flex-wrap justify-content-center flex-container pb-5">
        
            @foreach($registrants as $registrant)
            <div class="p-1 m-3 container-big border">
                    <div class="text-center registrant_name">
                        {{$registrant['Registrant']}}
                    </div>
            </div>
            @endforeach

        </div>
        @else
        <div class='text-center p-5'>
            <h2>There's No Patient Yet</h2>
        </div>
        @endif
    </div>

</div>

@endsection