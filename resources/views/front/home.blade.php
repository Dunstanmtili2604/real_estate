@extends('front.layouts.master')
@push('css')
@endpush

@section('content')
<!-- ======= About Section ======= -->
<section id="about" class="about">
    <div class="container-xxl">
        <div class="container">   
            <div class="section-title">
                <span>Property Listings</span>
                <h2>Property Listings</h2>
                <p>View properties in our most prominent cities</p>
            </div>
            <div class="row" data-aos="fade-up">
                <div class="col-lg-12 d-flex justify-content-center">
                    <ul id="portfolio-flters">
                    <li data-filter="*" class="filter-active">All</li>
                    <li data-filter=".buy">For Sell</li>
                    <li data-filter=".rent">For Rent</li>
                    </ul>
                </div>
            </div>
            <div class="row g-0 gx-5 align-items-center">
                <div class="col-lg-12 text-start text-lg-center wow slideInRight" data-wow-delay="0.1s">
                    <ul class="nav nav-pills d-inline-flex justify-content-end mb-5">
                        <li class="nav-item me-2">
                            <a class="btn btn-outline-primary active" data-bs-toggle="pill" href="#tab-1" data-filter="*">Featured</a>
                        </li>
                        <li class="nav-item me-2">
                            <a class="btn btn-outline-primary" data-bs-toggle="pill" href="#tab-2" data-filter=".buy">For Sell</a>
                        </li>
                        <li class="nav-item me-0">
                            <a class="btn btn-outline-primary" data-bs-toggle="pill" href="#tab-3" data-filter=".rent">For Rent</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content">
                <div class="row g-4">
                    @foreach($favorites as $favorite)
                        @if($favorite->property->type == 'House')
                            <div class="col-lg-4 col-md-6 wow fadeInUp {{$favorite->action}}" data-wow-delay="0.1s">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <a href="">
                                            @if($favorite->house->type == 'Room')
                                            <img class="img-fluid" src="/uploads/images/property/house/room/{{json_decode($favorite->property->image)[0]}}" alt="">
                                            @elseif($favorite->house->type == 'Studio')
                                            <img class="img-fluid" src="/uploads/images/property/house/studio/{{json_decode($favorite->property->image)[0]}}" alt="">
                                            @elseif($favorite->house->type == 'Apartment')
                                            <img class="img-fluid" src="/uploads/images/property/house/apartment/{{json_decode($favorite->property->image)[0]}}" alt="">
                                            @endif
                                        </a>
                                        <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">{{$favorite->property->action}}</div>
                                        <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">{{$favorite->house->type}}</div>
                                    </div>
                                    <div class="p-4 pb-0">
                                        <h5 class="text-primary mb-3">XAF{{$favorite->property->amount}}</h5>
                                        <a class="d-block h5 mb-2" href="">{{$favorite->property->name}}</a>
                                        <p><i class="fa fa-map-marker-alt text-primary me-2"></i>{{$favorite->property->quater}}, {{$favorite->property->city}}, {{$favorite->property->region}}</p>
                                    </div>
                                    <div class="d-flex border-top">
                                        @if($favorite->house->type == 'Room')
                                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-bed text-primary me-2"></i>{{$favorite->room->type}}</small>
                                            <small class="flex-fill text-center border-end py-2"></small>
                                            <small class="flex-fill text-center py-2"></small>
                                        @elseif($favorite->house->type == 'Studio')
                                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-bed text-primary me-2"></i>{{$favorite->studio->type}}</small>
                                            <small class="flex-fill text-center border-end py-2"></small>
                                            <small class="flex-fill text-center py-2"></small>
                                        @elseif($favorite->house->type == 'Apartment')
                                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-ruler-combined text-primary me-2"></i>{{$favorite->apartment->livingroom}} Palours</small>
                                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-bed text-primary me-2"></i>{{$favorite->apartment->bedroom}} Beds</small>
                                            <small class="flex-fill text-center py-2"><i class="fa fa-bath text-primary me-2"></i>{{$favorite->apartment->bathroom}} Baths</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @elseif($favorite->property->type == 'Land')
                            <div class="col-lg-4 col-md-6 wow fadeInUp {{$favorite->action}}" data-wow-delay="0.1s">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <a href=""><img class="img-fluid" src="/uploads/images/property/land/{{json_decode($favorite->property->image)[0]}}" alt=""></a>
                                        <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">{{$favorite->property->action}}</div>
                                        <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">{{$favorite->property->type}}</div>
                                    </div>
                                    <div class="p-4 pb-0">
                                        <h5 class="text-primary mb-3">XAF{{$favorite->property->amount}}</h5>
                                        <a class="d-block h5 mb-2" href="">{{$favorite->property->name}}</a>
                                        <p><i class="fa fa-map-marker-alt text-primary me-2"></i>{{$favorite->property->quater}}, {{$favorite->property->city}}, {{$favorite->property->region}}</p>
                                    </div>
                                    <div class="d-flex border-top">
                                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-ruler-combined text-primary me-2"></i>{{$favorite->land->size}} Sqft</small>
                                        <small class="flex-fill text-center border-end py-2"></small>
                                        <small class="flex-fill text-center py-2"></small>
                                    </div>
                                </div>
                            </div>
                        @elseif($favorite->property->type == 'Vehicle')
                            <div class="col-lg-4 col-md-6 wow fadeInUp {{$favorite->action}}" data-wow-delay="0.1s">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <a href="">
                                            @if($favorite->vehicle->type == 'Car')
                                            <img class="img-fluid" src="/uploads/images/property/vehicle/car/{{json_decode($favorite->property->image)[0]}}" alt="">
                                            @elseif($favorite->vehicle->type == 'Bike')
                                            <img class="img-fluid" src="/uploads/images/property/vehicle/bike/{{json_decode($favorite->property->image)[0]}}" alt="">
                                            @endif
                                        </a>
                                        <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">{{$favorite->property->action}}</div>
                                        <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">{{$favorite->vehicle->type}}</div>
                                    </div>
                                    <div class="p-4 pb-0">
                                        <h5 class="text-primary mb-3">XAF{{$favorite->property->amount}}</h5>
                                        <a class="d-block h5 mb-2" href="">{{$favorite->property->name}}</a>
                                        <p><i class="fa fa-map-marker-alt text-primary me-2"></i>{{$favorite->property->quater}}, {{$favorite->property->city}}, {{$favorite->property->region}}</p>
                                    </div>
                                    <div class="d-flex border-top">
                                            @if($favorite->vehicle->type == 'Car')
                                                <small class="flex-fill text-center border-end py-2"><i class="fa fa-ruler-combined text-primary me-2"></i>{{$favorite->vehicle->sits}} Seats</small>
                                                <small class="flex-fill text-center border-end py-2"><i class="fa fa-bed text-primary me-2"></i>{{$favorite->vehicle->color}}</small>
                                                <small class="flex-fill text-center py-2"><i class="fa fa-bath text-primary me-2"></i>{{$favorite->car->brand}}</small>
                                            @elseif($favorite->vehicle->type == 'Bike')
                                                <small class="flex-fill text-center border-end py-2"><i class="fa fa-ruler-combined text-primary me-2"></i>{{$favorite->bike->model}}</small>
                                                <small class="flex-fill text-center py-2"><i class="fa fa-bath text-primary me-2"></i>{{$favorite->bike->brand}}</small>
                                                <small class="flex-fill text-center border-end py-2"><i class="fa fa-bed text-primary me-2"></i>{{$favorite->bike->color}}</small>
                                            @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section><!-- End About Section -->

<!-- ======= Cta Section ======= -->
<section id="cta" class="cta">
    <div class="container" data-aos="zoom-in">

    <div class="text-center">
        <h3>Call To Action</h3>
        <p> Become a real agent. Get registered and for a very little fee access our millions of clients and improve your business</p>
        <a class="cta-btn" href="#">Call To Action</a>
    </div>

    </div>
</section><!-- End Cta Section -->

 <!-- ======= Portfolio Section ======= -->
<section id="portfolio" class="portfolio">
    <div class="container">

    <div class="section-title">
        <span>Major Cities</span>
        <h2>Major Cities</h2>
        <p>View properties in our most prominent cities</p>
    </div>

    <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="150">

        <div class="col-lg-4 col-md-6 portfolio-item filter-app">
        <img src="{{asset('frontend/assets/img/portfolio/yaounde.jpg')}}" class="img-fluid" alt="">
        <div class="portfolio-info text-center">
            <h4>Yaounde</h4>
            <a href="{{asset('frontend/assets/img/portfolio/yaounde.jpg')}}" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link btn btn-sm text-white bg-primary" title="Yaounde">Preview</a>
            <a href="portfolio-details.html" class="details-link btn btn-sm text-white bg-warning" title="More Details">Details</a>
        </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-web">
        <img src="{{ asset('frontend/assets/img/portfolio/douala.jpg') }}" class="img-fluid" alt="">
        <div class="portfolio-info text-center">
            <h4 style="margin-top: 40%;">Douala</h4>
            <a href="{{ asset('frontend/assets/img/portfolio/douala.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link btn btn-sm text-white bg-primary" title="Douala">Preview</a>
            <a href="portfolio-details.html" class="details-link btn btn-sm text-white bg-warning" title="More Details">Details</a>
        </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-app">
        <img src="{{ asset('frontend/assets/img/portfolio/buea.jpg') }}" class="img-fluid" alt="">
        <div class="portfolio-info text-center">
            <h4>Buea</h4>
            <a href="{{ asset('frontend/assets/img/portfolio/buea.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link btn btn-sm text-white bg-primary" title="Buea">Preview</a>
            <a href="portfolio-details.html" class="details-link btn btn-sm text-white bg-warning" title="More Details">Details</a>
        </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-card">
        <img src="{{ asset('frontend/assets/img/portfolio/bamenda.jpeg') }}" class="img-fluid" alt="">
        <div class="portfolio-info text-center">
            <h4>Bamenda</h4>
            <a href="{{ asset('frontend/assets/img/portfolio/bamenda.jpeg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link btn btn-sm text-white bg-primary" title="Bamenda">Preview</a>
            <a href="portfolio-details.html" class="details-link btn btn-sm text-white bg-warning" title="More Details">Details</a>
        </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-web">
        <img src="{{ asset('frontend/assets/img/portfolio/limbe.png') }}" class="img-fluid" alt="">
        <div class="portfolio-info text-center">
            <h4>Limbe</h4>
            <a href="{{ asset('frontend/assets/img/portfolio/limbe.png') }}" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link btn btn-sm text-white bg-primary" title="Limbe">Preview</a>
            <a href="portfolio-details.html" class="details-link btn btn-sm text-white bg-warning" title="More Details">Details</a>
        </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-app">
        <img src="{{ asset('frontend/assets/img/portfolio/baffoussam.jpeg') }}" class="img-fluid" alt="">
        <div class="portfolio-info text-center">
            <h4>Baffoussam</h4>
            <a href="{{ asset('frontend/assets/img/portfolio/baffoussam.jpeg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link btn btn-sm text-white bg-primary" title="Baffoussam">Preview</a>
            <a href="portfolio-details.html" class="details-link btn btn-sm text-white bg-warning" title="More Details">Details</a>
        </div>
        </div>
        <!-- <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <img src="{{ asset('frontend/assets/img/portfolio/portfolio-7.jpg') }}" class="img-fluid" alt="">
            <div class="portfolio-info text-center">
            <h4>Card 1</h4>
            <p>Card</p>
            <a href="{{ asset('frontend/assets/img/portfolio/portfolio-7.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Card 1">Preview</a>
            <a href="portfolio-details.html" class="details-link" title="More Details">Details</a>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <img src="{{ asset('frontend/assets/img/portfolio/portfolio-8.jpg') }}" class="img-fluid" alt="">
            <div class="portfolio-info text-center">
            <h4>Card 3</h4>
            <p>Card</p>
            <a href="{{ asset('frontend/assets/img/portfolio/portfolio-8.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Card 3">Preview</a>
            <a href="portfolio-details.html" class="details-link" title="More Details">Details</a>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <img src="{{ asset('frontend/assets/img/portfolio/portfolio-9.jpg') }}" class="img-fluid" alt="">
            <div class="portfolio-info text-center">
            <h4>Web 3</h4>
            <p>Web</p>
            <a href="{{ asset('frontend/assets/img/portfolio/portfolio-9.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Web 3">Preview</a>
            <a href="portfolio-details.html" class="details-link" title="More Details">Details</a>
            </div>
        </div> -->

    </div>

    </div>
</section><!-- End Portfolio Section -->
@endsection

@push('js')
@endpush