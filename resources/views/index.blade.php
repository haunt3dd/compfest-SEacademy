@extends('layouts.main')

@section('title','Patient Appointment')



@section('container')
<div class="container-fluid parent">
</div>


<div class="container">
    <div>
        <h2 class="font-weight-bold pt-5 appointment font-typo text-center">List of Appointment</h2>
            <div class="d-flex flex-wrap justify-content-start">

            @foreach($appointments as $appointment)
            <div class="p-1 m-3 container-big border">
                <a class="links" href="{{ route('appointment.detail',$appointment['_id'])}}">
                    <div class="text-center doctor_name">
                            {{$appointment['doctorName']}}
                    </div>
                </a>

                <div class="appointment_description mt-3 text-center mb-3">
                    "{{$appointment['Description']}}"
                </div>
            </div>
            @endforeach

            </div>
    </div>
</div>

@endsection