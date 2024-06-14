<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;
use App\Models\Booking;
use App\Models\TempBooking;
use DB;
use Razorpay\Api\Api;

class HomeController extends Controller
{
    public function index()
    {
        $turfs = User::where('user_type', 'company')
            ->where('register_status', 'approved')
            ->where('status', 'active')
            ->limit(3)
            ->get();
        return view('web.home', [
            'turfs' => $turfs
        ]);
    }

    public function render()
    {
        $latitude = Session::get('latitude');
        $longitude = Session::get('longitude');
        if ($latitude && $longitude) {
            $turfs = User::select('*')
                ->selectRaw('(6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance', [$latitude, $longitude, $latitude])
                ->where('user_type', 'company')
                ->where('register_status', 'approved')
                ->where('status', 'active')
                ->having('distance', '<=', 1010) // Filter by distance (in kilometers)
                ->orderBy('distance') // Optional: Order by distance
                ->limit(3)
                ->get();
        } else {
            $turfs = User::select('*')
                ->where('user_type', 'company')
                ->where('register_status', 'approved')
                ->where('status', 'active')
                ->limit(3)
                ->get();
        }
        $view = view('web.company-render', [
            'turfs' => $turfs
        ])->render();
        return response()->json(['data' => $view]);
    }

    public function getTurf()
    {
        $latitude = Session::get('latitude');
        $longitude = Session::get('longitude');
        if ($latitude && $longitude) {
            $turfs = User::select('*')
                ->selectRaw('(6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance', [$latitude, $longitude, $latitude])
                ->where('user_type', 'company')
                ->where('register_status', 'approved')
                ->where('status', 'active')
                ->having('distance', '<=', 1010) // Filter by distance (in kilometers)
                ->orderBy('distance') // Optional: Order by distance
                ->get();
        } else {
            $turfs = User::select('*')
                ->where('user_type', 'company')
                ->where('register_status', 'approved')
                ->where('status', 'active')
                ->get();
        }
        return view('web.turfs', [
            'turfs' => $turfs
        ]);
    }

    public function updateLocation(Request $request)
    {
        Session::put('latitude', $request->latitude);
        Session::put('longitude', $request->longitude);
        return true;
    }

    public function turfDetails($id)
    {
        $turf = User::find($id);
        if (!$turf) {
            abort(404);
        }
        return view('web.company-details', [
            'company' => $turf
        ]);
    }

    public function getBookingSlot(Request $request)
    {
        $user = auth()->user();
        $dayName = Carbon::parse($request->book_date)->dayName;

        $tempBookedSlots = TempBooking::where('user_id', '!=', $user->id)
            ->where('turf_id', $request->turf_id)
            ->where('booking_date', $request->book_date)
            ->pluck('timeslot')
            ->toArray();

        $bookedSlots = Booking::where('turf_id', $request->turf_id)->where('booking_date', $request->book_date)->pluck('timeslot')->toArray();
        $bookedSlots = array_merge($bookedSlots, $tempBookedSlots);
        if ($request->book_date == date('Y-m-d')) {
            $timslots = DB::table('turf_timeslots')->where('user_id', $request->turf_id)->where('timeslot', '>', date('H:i:s'))->where('day', $dayName)->get();
        } else {
            $timslots = DB::table('turf_timeslots')->where('user_id', $request->turf_id)->where('day', $dayName)->get();
        }
        if (count($timslots) === 0) {
            return response()->json(['message' => 'No timeslot found'], 422);
        }
        $view = view('web.timeslot-render', [
            'timeslots' => $timslots,
            'bookedSlots' => $bookedSlots,
        ])->render();
        return response()->json(['data' => $view]);
    }

    public function bookTimeslot(Request $request)
    {
        $timeslot = DB::table('turf_timeslots')->where('id', $request->timeslot)->first();
        $turf = DB::table('users')->where('id', $timeslot->user_id)->first();
        if (!$timeslot) {
            return redirect()->back();
        }
        return view('web.book-timeslot', [
            'timeslot' => $timeslot,
            'company' => $turf,
            'book_date' => $request->book_date,
        ]);
    }

    public function createTempBooking(Request $request)
    {
        $timeslot = DB::table('turf_timeslots')->where('id', $request->time_slot_id)->first();
        if (!$timeslot) {
            return redirect()->back();
        }
        $user = auth()->user();
        $tempBooking = new TempBooking();
        $tempBooking->user_id = $user->id;
        $tempBooking->turf_id = $timeslot->user_id;
        $tempBooking->booking_date = $request->booking_date;
        $tempBooking->timeslot = $timeslot->timeslot;
        $tempBooking->amount = $timeslot->hourly_price;
        $tempBooking->name = $request->name;
        $tempBooking->email = $request->email;
        $tempBooking->mobile_no = $request->mobile_no;
        $tempBooking->save();
        \Session::put('temp_booking', $tempBooking);
        return response()->json(['message' => 'Redirecting to payment page..']);
    }

    public function makePayment()
    {
        $tempBooking = session('temp_booking');
        $api = new Api(env('TEST_RAZORPAY_KEY'), env('TEST_RAZORPAY_SECRET'));
        $order = $api->order->create(array(
            'receipt' => 'order_receipt',
            'amount' => $tempBooking->amount * 100,
            'currency' => 'INR'
        ));
        return view('web.make-payment', [
            'tempBooking' => $tempBooking,
            'id' => $order['id'],
            'amount' => $order['amount']
        ]);
    }

    public function PaymentSuccess(Request $request)
    {
        $payment_id = $request['payment_id'];
        $tempBooking = session('temp_booking');
        $user = auth()->user();

        $booking = new Booking();
        $booking->unique_id = date('YmdHis') . $user->id;
        $booking->user_id = $user->id;
        $booking->turf_id = $tempBooking->turf_id;
        $booking->booking_date = $tempBooking->booking_date;
        $booking->timeslot = $tempBooking->timeslot;
        $booking->amount = $tempBooking->amount;
        $booking->name = $tempBooking->name;
        $booking->email = $tempBooking->email;
        $booking->mobile_no = $tempBooking->mobile_no;
        $booking->transaction_id = $payment_id;
        $booking->payment_status = 'paid';
        $booking->save();

        $tempBooking->delete();

        \Session::forget('temp_booking');
        return redirect()->route('booking-details', [$booking->id]);
    }

    public function bookings()
    {
        $user = auth()->user();
        $bookings = Booking::where('user_id', $user->id)->get();
        return view('web.bookings', [
            'bookings' => $bookings
        ]);
    }

    public function bookingDetails($id)
    {
        $booking = Booking::find($id);
        if (!$booking) {
            abort(404);
        }
        return view('web.booking-details', [
            'booking' => $booking
        ]);
    }
}
