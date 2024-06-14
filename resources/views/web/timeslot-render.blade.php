@foreach($timeslots as $timeslot)
    <div class="col-md-3 mb-3">
        @if(in_array($timeslot->timeslot,$bookedSlots))
            <button class="btn btn-dark w-100 timeslot-click" disabled
                    data-timeslot="{{$timeslot->id}}">{{date('h:i A',strtotime($timeslot->timeslot))}} -
                ₹{{$timeslot->hourly_price}}</button>
        @else
            <button class="btn btn-primary w-100 timeslot-click"
                    data-timeslot="{{$timeslot->id}}">{{date('h:i A',strtotime($timeslot->timeslot))}} -
                ₹{{$timeslot->hourly_price}}</button>
        @endif
    </div>
@endforeach