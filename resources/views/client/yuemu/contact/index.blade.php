@extends('client.layouts.app')

@section('content')
    <section class="content">
        <div class="container">
            <div class="text-center mb-4">
                <h1 style="color: #045242; font-weight:600;">ติดต่อเรา</h1>
                <h2 style="color: #045242;">Contact</h2>
            </div>
            <div class="row">
                <div class="col-lg-6 col-xs-12">
                    <img class="mb-5" src="{{ asset('images/yuemu/map.jpg') }}" width="100%">
                </div>
                <div class="col-lg-6 col-xs-12">
					<div class="d-none d-sm-block">
                    <p class="text-left" style="font-size:1.6rem; padding:20px 20px 0px 20px;  color:#045242; margin-bottom:0px;">ที่ตั้งคลินิก : ประเวศ อเวนิว 8/1 ซ.อ่อนนุช 88/3
                        ข.ประเวศ ข.ประเวศ กรุงเทพ<br>(ใกล้กับโรงพยาบาล สิรินธร)<br>
                        
						<div class="d-none d-sm-block">
						 <div class="row">
                        <div class="col-4" style="padding-right: 0px;">
                            <p class="text-left" style="font-size:1.6rem; padding-left: 20px; color:#045242;">เปิดบริการ :</p>
                        </div>
                        <div class="col-8" style="padding-left: 0px; margin-left:-25px;">
                            <p class="text-left" style="font-size:1.6rem; color:#045242;">{{ setting('time') }}</p>
                            <p class="text-left" style="font-size:1.6rem; color:#045242;">{{ setting('time2') }}</p>
                        </div>
                   		 </div>
						</div>	
							<div class="d-block d-sm-none">
						 <div class="row">
                        <div class="col-4" style="padding-right: 0px;">
                            <p class="text-left" style="font-size:1.6rem; color:#045242;">เปิดบริการ :</p>
                        </div>
                        <div class="col-8" style="padding-left: 0px;">
                            <p class="text-left" style="font-size:1.6rem; color:#045242;">{{ setting('time') }}</p>
                            <p class="text-left" style="font-size:1.6rem; color:#045242;">{{ setting('time2') }}</p>
                        </div>
                   		 </div>
						</div>
					<div class="row">
						<div class="col-lg-6 col-xs-12"><a class="button-contact mt-2" style="color:#fff; margin:auto; display:block; width:80%; padding-top:15px; padding-bottom:15px;" href="tel:{{ setting('tel1') }}"><i class="fa fa-phone-alt"></i>&nbsp;{{ setting('tel1') }}</a></div>
						<div class="col-lg-6 col-xs-12"><a class="button-contact mt-2" style="background-color: #06c755; color:#fff; margin:auto; display:block; width:80%; padding-top:15px; padding-bottom:15px;" href="{{ setting('line_info') }}"><i class="sociali fab fa-line"></i>&nbsp;ADD LINE</a></div>
					</div></p>
                </div>
				
				<div class="d-block d-sm-none">
                    <p class="text-left" style="font-size:1.4rem;  color:#045242; margin-bottom:0px;">ที่ตั้งคลินิก : ประเวศ อเวนิว 8/1 ซ.อ่อนนุช 88/3
                        ข.ประเวศ ข.ประเวศ กรุงเทพ<br>(ใกล้กับโรงพยาบาล สิรินธร)<br>
						 <div class="row">
                        <div class="col-4" style="padding-right: 0px;">
                            <p class="text-left" style="font-size:1.4rem; color:#045242;">เปิดบริการ :</p>
                        </div>
                        <div class="col-8" style="padding-left: 0px; ">
                            <p class="text-left" style="font-size:1.4rem; color:#045242;">&nbsp;{{ setting('time') }}</p>
                            <p class="text-left" style="font-size:1.4rem; color:#045242;">&nbsp;{{ setting('time2') }}</p>
                        </div>
                   		 </div>
					<div class="row">
						<div class="col-lg-6 col-xs-12"><a class="button-contact mt-2" style="color:#fff; margin:auto; display:block; width:80%; padding-top:15px; padding-bottom:15px;" href="tel:{{ setting('tel1') }}"><i class="fa fa-phone-alt"></i>&nbsp;{{ setting('tel1') }}</a></div>
						<div class="col-lg-6 col-xs-12"><a class="button-contact mt-2" style="background-color: #06c755; color:#fff; margin:auto; display:block; width:80%; padding-top:15px; padding-bottom:15px;" href="{{ setting('line_info') }}"><i class="sociali fab fa-line"></i>&nbsp;ADD LINE</a></div>
					</div></p>
                </div>
				 </div>
            </div> 


            {!! setting('map_info') !!}
        </div>
    </section>
@endsection
