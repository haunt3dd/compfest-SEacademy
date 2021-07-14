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
        <div class="p-3">{{$appointment['Description']}}</div>

    @if($users->role =='patient')
        @if($appointment['Status'] == 'Not Full' && !$appointment[1])
        <div class="p-5">
            <a href="{{route('appointment.apply',[$appointment[0],$appointment['_id']])}}">
            <button type="button" class="btn btn-primary">Apply for Appointment</button>
            </a>
        </div>
        @elseif($appointment['Status'] == 'Full' && !$appointment[1])
        <div class="p-5">
        <a href="{{route('appointment.apply',[$appointment[0],$appointment['_id']])}}">
            <button type="button" disabled class="btn btn-primary">Apply for Appointment</button>
            </a>
        </div>
        @elseif($appointment['Status'] == 'Full' && $appointment[1])
        <div class="p-5">
            <a href="{{route('appointment.apply',[$appointment[0],$appointment['_id']])}}">
            <button type="button" disabled class="btn btn-primary">Apply for Appointment</button>
            </a>
            <a href="{{route('appointment.cancel',[$appointment[0],$appointment['_id']])}}">
            <button type="button" class="btn btn-danger">Cancel your Appointment</button>
            </a>
        </div>

        @elseif($appointment[1] == true)
            <div class="p-5">
            <a href="{{route('appointment.apply',[$appointment[0],$appointment['_id']])}}">
            <button type="button" disabled class="btn btn-primary">You Already Registered</button>
            </a>
            <a href="{{route('appointment.cancel',[$appointment[0],$appointment['_id']])}}">
            <button type="button" class="btn btn-danger">Cancel your Appointment</button>
            </a>
        </div>
        
        @endif
    @else
    <div class="p-5">
            <a href="{{route('page.update',['appointment' => $appointment])}}">
            <button type="button" class="btn btn-primary">Update Appointment</button>
            </a>
            <a href="{{route('appointment.delete',['id' => $appointment['_id']])}}">
            <button type="button" class="btn btn-danger">Delete Appointment</button>
            </a>
            <a href="{{route('page.see',['appointment' => $appointment])}}">
            <button type="button" class="btn btn-success">See Registrant</button>
            </a>
        </div>

    @endif
    </div>

</div>

@endsection