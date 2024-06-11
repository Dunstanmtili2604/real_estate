@php
   use App\MyHelpers;
   use Illuminate\Support\Facades\Auth;
@endphp
@php
    $authData = Auth::user();
@endphp

@extends('admin.auth.master')
@section('title')    {{__(config('app.name'))}}
@endsection

@section('content')

@push('css')
<style>

/* CSS variables
   ========================================================================== */

:root {
  --body-font-family: 'Open Sans', sans-serif;
  --body-heading-font-color: #FFF;
  --timeline-content-bg-color: #ECF0F1;
  --timeline-content-font-color: #2C3E50;
  --timeline-content-border-radius: 12px;
  --timeline-content-padding: 14px;
  --timeline-content-spacing: calc(var(--timeline-year-size) / 2 + var(--timeline-year-spacing));
  --timeline-content-width-desktop: calc(100% - var(--timeline-content-spacing));
  --timeline-content-shadow: 0 12px 6px -12px rgba(0,0,0,.3);
  --timeline-arrow-size: 12px;
  --timeline-year-border-radius: 50%;
  --timeline-year-bg-color: rgb(44, 96, 144);
  --timeline-year-font-color: #ECF0F1;
  --timeline-year-size: 48px;
  --timeline-year-spacing: 36px;
  --timeline-line-color: var(--timeline-year-bg-color);
  --timeline-line-width: 3px;
  --timeline-item-spacing: 36px;
}


/* Timeline settings
   ========================================================================== */

.timeline {
  display: flex;
  align-items: flex-start;
  flex-direction: column;
  justify-content: center;
  padding-top: 24px;
  padding-bottom: 24px;
}

@media (min-width: 768px) {
  .timeline {
    align-items: flex-end;
    padding-top: 48px;
    padding-bottom: 48px;
  }
}

.timeline__item {
  display: flex;
  align-items: center;
  position: relative;
  width: 100%;
}

.timeline__item:not(:last-child) {
  margin-bottom: 70px;
}

.timeline__item:before {
  content: "";
  position: absolute;
  top: calc(var(--timeline-item-spacing));
  left: calc(( var(--timeline-year-size) - var(--timeline-line-width) ) / 2);
  width: var(--timeline-line-width);
  height: calc(100% + 35px);
  background-color: var(--timeline-line-color);
}

.timeline__item:first-child:before {
  top: 50%;
  height: calc(50% + 18px);
}

.timeline__item:last-child:before {
  bottom: 50%;
  height: calc(50% + 18px);
}

@media (min-width: 768px) {
  .timeline__item:before {
    left: calc(var(--timeline-line-width) / -2);
  }
}

@media (max-width: 768px) {
  .timeline__item:before {
    display: none;
  }
}


@media (min-width: 768px) {
  .timeline__item {
    width: 50%;
  }
}

.timeline__year {
  position: relative;
  flex: 0 0 var(--timeline-year-size);
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: var(--timeline-year-border-radius);
  margin-right: var(--timeline-item-spacing);
  width: var(--timeline-year-size);
  height: var(--timeline-year-size);
  background-color: var(--timeline-year-bg-color);
  font-size: 0.75rem;
  color: var(--timeline-year-font-color);
}

@media (min-width: 768px) {
  .timeline__year {
    transform: translateX(-50%);
  }
}

@media (max-width: 768px) {
  .timeline__year {
        display: none;
  }
}

.timeline__content {
  flex: 1 0 calc(100% - var(--timeline-year-size) - var(--timeline-year-spacing));
  position: relative;
  border-radius: var(--timeline-content-border-radius);
  padding: var(--timeline-content-padding);
  background-color: var(--timeline-content-bg-color);
  color: var(--timeline-content-font-color);
  box-shadow: var(--timeline-content-shadow);
}

.timeline__content:after {
  content: "";
  position: absolute;
  top: 50%;
  left: calc( var(--timeline-arrow-size) * -1);
  transform: translateY(-50%);
  width: 0; 
  height: 0; 
  border-top: var(--timeline-arrow-size) solid transparent;
  border-bottom: var(--timeline-arrow-size) solid transparent; 
  border-right: var(--timeline-arrow-size) solid var(--timeline-content-bg-color); 
}


@media (min-width: 768px) {
  .timeline__content {
    position: absolute;
    top: 50%;
    left: calc(-50% + var(--timeline-content-spacing) / 2);
    width: var(--timeline-content-width-desktop);
  }
  
  .timeline__item:nth-child(odd) .timeline__content {
    transform: translate(calc(50% + var(--timeline-content-spacing)), -50%);
  }
  
  .timeline__item:nth-child(even) .timeline__content {
    transform: translate(calc(-50% - var(--timeline-content-spacing)), -50%);
  }
  
  .timeline__item:nth-child(even) .timeline__content:after {
    right: calc( var(--timeline-arrow-size) * -1);
    left: auto;
    transform: translateY(-50%) rotateY(180deg);
  }

}
.pricingTable {
    text-align: center;
    background: #fff;
    margin: 0 -1px;
    box-shadow: 0 0 10px #ababab;
    padding-bottom: 40px;
    border-radius: 10px;
    color: #cad0de;
    transition: all .5s ease 0s
}

.pricingTable:hover {
    transform: scale(1.05);
    z-index: 1
}

.pricingTable .pricingTable-header {
    padding: 40px 0;
    background: #f5f6f9;
    border-radius: 10px 10px 50% 50%;
    transition: all .5s ease 0s
}

.pricingTable:hover .pricingTable-header {
    background: #ff9624
}

.pricingTable .pricingTable-header i {
    font-size: 50px;
    color: #858c9a;
    margin-bottom: 10px;
    transition: all .5s ease 0s
}

.pricingTable .price-value {
    font-size: 35px;
    color: #ff9624;
    transition: all .5s ease 0s
}

.pricingTable .month {
    display: block;
    font-size: 14px;
    color: #cad0de
}

.pricingTable:hover .month,
.pricingTable:hover .price-value,
.pricingTable.blue:hover .month,
.pricingTable.blue:hover .price-value,
.pricingTable:hover .pricingTable-header i {
    color: #fff
}

.pricingTable .heading {
    font-size: 24px;
    color: #ff9624;
    margin-bottom: 20px;
    text-transform: uppercase
}

.pricingTable .pricing-content ul {
    list-style: none;
    padding: 0;
    margin-bottom: 30px
}

.pricingTable .pricing-content ul li {
    line-height: 30px;
    color: #a7a8aa
}

.pricingTable .pricingTable-signup a {
    display: inline-block;
    font-size: 15px;
    color: #fff;
    padding: 10px 35px;
    border-radius: 20px;
    background: #ffa442;
    text-transform: uppercase;
    transition: all .3s ease 0s
}

.pricingTable .pricingTable-signup a:hover {
    box-shadow: 0 0 10px #ffa442
}

.pricingTable.blue .heading,
.pricingTable.blue .price-value {
    color: #4b64ff;
}

.pricingTable.blue .pricingTable-signup a,
.pricingTable.blue:hover .pricingTable-header {
    background: #4b64ff;
}

.pricingTable.blue .pricingTable-signup a:hover {
    box-shadow: 0 0 10px #4b64ff;
}

@media screen and (max-width:990px) {
    .pricingTable {
        margin: 0 0 20px
    }
}

</style>
@endpush

<div class="auth-page bg-light">
    <div class="container-xxl py-5">
       <div class="header text-center">
          <h2>{{__("subscribe.hello")}} {{$authData->username}}</h2>
          <p class="fs-4">{{__("subscribe.choose_payment_plan")}}</p>
       </div>
      <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6 offset-md-3">
                    <div class="pricingTable" id="basic">
                        <div class="pricingTable-header">
                            <div class="price-value"> XAF100000 <span class="month">{{__("subscribe.per_month")}}</span> </div>
                        </div>
                        <h3 class="heading">Basic</h3>
                        <div class="pricing-content">
                            <p>Une assurance multirisque sante</p>
                            <ul>
                                <li><b>80%</b>de Couverture</li>
                                <li><b>Zone</b> Pays de Résidence</li>
                            </ul>
                        </div>
                        <div class="pricingTable-signup">
                            <a href="#">{{__("subscribe.payment")}}</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="pricingTable blue" id="premuim">
                        <div class="pricingTable-header">
                            <div class="price-value"> XAF120000 <span class="month">{{__("subscribe.per_year")}}</span> </div>
                        </div>
                        <h3 class="heading">Premuim</h3>
                        <div class="pricing-content">
                            <p>Une assurance pour couple</p>
                            <ul>
                                <li><b>50%</b> de Couverture</li>
                                <li><b>Zone</b> Pays de Résidence</li>
                            </ul>
                        </div>
                        <div class="pricingTable-signup">
                            <a href="#">{{__("subscribe.payment")}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
  $(document).ready(function(){
    $("#basic").click(function(){
      window.location.href = "{{route('paymentBasic')}}";
    });
  });

  $(document).ready(function(){
    $("#premuim").click(function(){
      alert("premuim");
    });
  });
</script>
@endpush
@endsection

