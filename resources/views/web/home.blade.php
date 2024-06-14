@extends('web.layouts.app')

@section('content')
    <!-- Add this line to your HTML file to include Tailwind CSS from a CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <div class="container mx-auto">
        <section id="home" class="py-2">
            <div class="owl-carousel owl-theme">
                <div class="item"><img src="{{ asset('web/assets/img/banner1.jpg') }}" alt="Banner 1"></div>
                <div class="item"><img src="{{ asset('web/assets/img/banner2.jpg') }}" alt="Banner 2"></div>
                <div class="item"><img src="{{ asset('web/assets/img/banner3.jpeg') }}" alt="Banner 3"></div>
                <div class="item"><img src="{{ asset('web/assets/img/banner4.jpeg') }}" alt="Banner 4"></div>
            </div>
            <div class="container mx-auto">
                <div class="text-center">
                    <h1 class="text-4xl font-bold my-4">Welcome to Turf Cricket Box</h1>
                    <p class="text-lg">Your destination for top-quality cricket turfs.</p>
                </div>
            </div>
        </section>

        <section id="about" class="py-5 bg-gray-100">
            <div class="container mx-auto">
                <h2 class="text-3xl font-bold mb-4">About Us</h2>
                <p class="text-lg">We specialize in providing high-quality box cricket turfs that meet the needs of
                    cricket enthusiasts.</p>
            </div>
        </section>

        <section id="services" class="py-5">
            <div class="container mx-auto">
                <h2 class="text-3xl font-bold mb-4">Our Services</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <i class="fas fa-users text-5xl text-blue-500"></i>
                        <h5 class="text-xl font-semibold my-4">Expert Installation</h5>
                        <p class="text-lg">Our team of experts ensures professional installation of cricket turfs,
                            providing you with the best playing experience.</p>
                    </div>
                    <div class="text-center">
                        <i class="fas fa-wrench text-5xl text-blue-500"></i>
                        <h5 class="text-xl font-semibold my-4">Quality Maintenance</h5>
                        <p class="text-lg">We offer comprehensive maintenance services to keep your cricket turfs in top
                            condition, ensuring longevity and durability.</p>
                    </div>
                    <div class="text-center">
                        <i class="fas fa-tools text-5xl text-blue-500"></i>
                        <h5 class="text-xl font-semibold my-4">Efficient Repair</h5>
                        <p class="text-lg">Our efficient repair services address any damages to your cricket turfs
                            promptly, ensuring minimal downtime and maximum playtime.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="image-section" class="py-5 bg-gray-100">
            <div class="container mx-auto">
                <h2 class="text-3xl font-bold mb-4">Our Facilities</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <img src="{{ asset('web/assets/img/fac1.jpeg') }}" alt="Facility 1" class="w-full rounded">
                    </div>
                    <div>
                        <img src="{{ asset('web/assets/img/fac2.jpeg') }}" alt="Facility 2" class="w-full rounded">
                    </div>
                </div>
            </div>
        </section>

        <section id="top-turfs" class="py-5">
            <div class="container mx-auto">
                <h2 class="text-3xl font-bold mb-5">Top Turfs</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8" id="turf_render">
                    @foreach($turfs as $turf)
                        <div class="text-center">
                            <a href="{{ route('company-details', [$turf->id]) }}">
                                @if(isset($turf->images[0]->image))
                                    <img src="{{ asset($turf->images[0]->image) }}" alt="Turf 1" class="w-full rounded">
                                @else
                                    <img src="{{ asset('web/assets/img/turf1.jpeg') }}" alt="Turf 1"
                                         class="w-full rounded">
                                @endif
                            </a>
                            <div class="mt-4">
                                <h3 class="text-xl font-semibold">{{ $turf->name }}</h3>
                                <p class="text-lg">Location: {{ $turf->address }}</p>
                                <p class="text-lg font-semibold">Price: $100 | Ratings: <span class="stars">★★★★☆</span>
                                </p>
                                <a href="{{ route('company-details', [$turf->id]) }}" class="btn btn-primary">View
                                    Details</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-8">
                    <a href="{{route('get-company')}}" class="btn btn-info">View More</a>
                </div>
            </div>
        </section>


        <section id="contact" class="py-5 bg-gray-100">
            <div class="container mx-auto">
                <h2 class="text-3xl font-bold text-center mb-4">Contact Us</h2>
                <p class="text-lg text-center">For inquiries or bookings, please contact us using the form below.</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <form>
                            <div class="mb-4">
                                <input type="text" class="w-full px-4 py-2 border rounded" placeholder="Your Name">
                            </div>
                            <div class="mb-4">
                                <input type="email" class="w-full px-4 py-2 border rounded" placeholder="Your Email">
                            </div>
                            <div class="mb-4">
                                <textarea class="w-full px-4 py-2 border rounded" rows="5"
                                          placeholder="Your Message"></textarea>
                            </div>
                            <button type="submit"
                                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                                Submit
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('scripts')
    <script>
        function getTurf() {
            axios
                .get('/turf-render')
                .then(function (response) {
                    $("#turf_render").html(response.data.data)
                })
                .catch(function (error) {

                })
        }

        getTurf()
    </script>
@endsection
