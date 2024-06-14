<style>
    
    .info-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
        padding: 10px;
        border-radius: 8px;
        background-color: #f8f9fa;
        transition: background-color 0.3s ease;
    }

    .info-item:hover {
        background-color: #e9ecef;
    }

    .info-item span:first-child {
        font-weight: bold;
    }

    .info-item a {
        color: #007bff;
        text-decoration: none;
    }

    .info-item a:hover {
        text-decoration: underline;
    }

</style>
<div class="row mt-4">
    <div class="col-lg-12">
        <div class="booking-details card">
            <h2 class="card-title text-center mb-4">Booking Details</h2>
            <div class="booking-info">
                <div class="info-item">
                    <span>Unique ID:</span>
                    <span>{{ $booking->unique_id }}</span>
                </div>
                <div class="info-item">
                    <span>Name:</span>
                    <span>{{ $booking->name }}</span>
                </div>
                <div class="info-item">
                    <span>Email:</span>
                    <span>{{ $booking->email }}</span>
                </div>
                <div class="info-item">
                    <span>Mobile No:</span>
                    <span>{{ $booking->mobile_no }}</span>
                </div>
                <div class="info-item">
                    <span>Booking Date:</span>
                    <span>{{ date('d M, Y', strtotime($booking->booking_date)) }}</span>
                </div>
                <div class="info-item">
                    <span>Timeslot:</span>
                    <span>{{ date('h:i A', strtotime($booking->timeslot)) }}</span>
                </div>
                <div class="info-item">
                    <span>Amount:</span>
                    <span>Rs.{{ $booking->amount }}</span>
                </div>
                <div class="info-item">
                    <span>Payment Status:</span>
                    <span>{{ $booking->payment_status }}</span>
                </div>
                <div class="info-item">
                    <span>Transaction ID:</span>
                    <span>{{ $booking->transaction_id }}</span>
                </div>
            </div>
        </div>
    </div>
</div>