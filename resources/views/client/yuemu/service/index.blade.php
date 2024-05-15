@extends('client.layouts.app')

@section('content')
    <section class="content">
        <div class="container">
            <div class="text-center mb-4">
                <h1 style="color: #045242; font-weight:600;">บริการและโปรโมชั่น</h1>
                <h2 style="color: #045242;">Service & Promotion</h2>
            </div>
            <!--<div class="carousel mt-4" data-items="3" data-arrows="false" data-dots="true">
                @foreach ($service as $servicess)
                <a href="{{ route('client.service.show', ['service' => $servicess->slug]) }}">
                    <div class="portfolio-item" style="padding:5px;">
                        <div class="post-item border">
                            <div class="post-item-wrap"
                                style="box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;  border-radius:6px;">
                                <div class="post-image">
                                    <img class="" src="{{ $servicess->getFirstMediaUrl('service') }}"
                                        style="width:100%; border-radius:6px; border-bottom-left-radius: 0px !important; border-bottom-right-radius: 0px !important;">
                                </div>
                                <div class="post-item-description text-center">
                                    <h4 class="text-center" style="color: #045242; margin-bottom:0px;">{{ $servicess->title }}</h4>
                                    <h4 class="text-center" style="font-size:16px; font-weight:400; overflow: hidden;
                                        display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;">
                                        {{ $servicess->short_detail }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
 
            </div>-->
			<div class="grid-layout post-3-columns m-b-30 grid-loaded" data-item="post-item">
				 @foreach ($service as $servicess)
					<a href="{{ route('client.service.show', ['service' => $servicess->slug]) }}">
                        <div class="post-item border">
                            <div class="post-item-wrap"
                                style="box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;  border-radius:6px;">
                                <div class="post-image">
                                    <img class="" src="{{ $servicess->getFirstMediaUrl('service') }}"
                                        style="width:100%; border-radius:6px; border-bottom-left-radius: 0px !important; border-bottom-right-radius: 0px !important;">
                                </div>
                                <div class="post-item-description text-center">
                                    <h4 class="text-center" style="color: #045242; margin-bottom:0px;">{{ $servicess->title }}</h4>
                                    <h4 class="text-center" style="font-size:16px; font-weight:400; overflow: hidden;
                                        display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;">
                                        {{ $servicess->short_detail }}</h4>
                                </div>
                            </div>
                        </div>
                	</a>
				@endforeach
			</div>
            {{-- <div class="carousel mt-4" data-items="4" data-arrows="false" data-dots="true">
                @php
                    $count = 0;
                    $starts = 0;
                    $ends = 1;
                @endphp
                @foreach ($service as $item)
                    @if ($count == $starts)
                        <div class="polo-carousel-item">
                            @php $starts += 2; @endphp
                    @endif
                    <div class="row">
                        <div class="col-12">
                            <div class="post-item border">
                                <div class="post-item-wrap">
                                    <div class="post-image">
                                        <a href="{{ route('client.service.show', ['service' => $item->slug]) }}">
                                            <img alt=""
                                                src="@if ($item->getFirstMediaUrl('service')) {{ $item->getFirstMediaUrl('service') }} @else {{ asset('images/no-image.jpg') }} @endif">
                                        </a>

                                    </div>
                                    <div class="post-item-description">
                                        <span class="post-meta-date"><i
                                                class="fa fa-calendar-o"></i>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->format('d F Y H:i') }}</span>
                                        <h2>
                                            <a href="{{ route('client.service.show', ['service' => $item->slug]) }}">{{$item->title}}</a>
                                        </h2>
                                        <a href="{{ route('client.service.show', ['service' => $item->slug]) }}" class="item-link">อ่านเพิ่มเติม
                                            <i class="icon-chevron-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @if ($count == $ends)
                    </div>
                @php $ends += 2; @endphp
                @endif
                @php $count++; @endphp
                @endforeach
            </div> --}}
    </section>
@endsection
