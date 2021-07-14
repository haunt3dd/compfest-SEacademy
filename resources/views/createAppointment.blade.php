@extends('layouts.main')

@section('title','Appointment')

@section('container')

<div class="text-center">
    <form action="{{ route('appointment.create') }}" id="createAppointment" class="group" method="POST" >
        @csrf
        <div class="m-5 pl-3 pt-3 content">
            <div class="p-1">
                <input type="text" autocomplete="off" class="form-control" name="doctorName" id="doctor" placeholder="Doctor Name">
                <p>Status:</p>
                <label class="radio-inline">
                    <input type="radio" name="not_full" class='not_full' checked> Not Full
                </label>
                <label class="radio-inline ml-2">
                    <input type="radio" name="full" class='full'> Full
                </label>
            </div>
            
            <img src="{{asset('assets/hospital.jpg')}}" alt="">
            <textarea autocomplete="off" class="form-control" name="Description" id="desc" placeholder="Input Description"></textarea>

            <div class="p-5">
                <button type="submit" class="btn btn-primary">Create Appointment</button>
            </div>

        </div>
    </form>

</div>


@endsection

@push('custom_js')
<script>
    $('.full').click(function(){
        if($('.full')[0].checked){
            setFull();
        }else{
            setNotFull();
        }
        
    })

    $('.not_full').click(function(){
        if($('.not_full')[0].checked){
            setNotFull();
        }else{
            setFull();
        }
        
    })

    function setFull(){
                $('.full').val(1);
                $('.not_full').val(0);
                $('.full').prop('checked', true);
                $('.not_full').prop('checked', false);
    }

    function setNotFull(){
                $('.full').val(0);
                $('.not_full').val(1);
                $('.full').prop('checked', false);
                $('.not_full').prop('checked', true);
    }
</script>

@endpush