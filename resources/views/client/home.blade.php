@extends('client.layouts.app')
@push('css')
    <style>
        .flickity-button {
            background: #fff;
            width: 40px;
            height: 40px;
            line-height: 40px;
            margin: -17px 0px 0 !important;
            display: block;
            position: absolute;
            top: 38% !important;
            z-index: 10;
            cursor: pointer;
            text-align: center;
            transition: all 0.2s ease 0s;
            color: #9896a6;
            text-align: center;
            z-index: 200;
            border: 0;
            box-sizing: initial;
            opacity: 0;
            border-radius: 50%;
            box-shadow: 0 0px 15px rgb(0 0 0 / 10%);
        }

        .team-members.team-members-shadow .team-member {
            border: 1px solid #eee;
            box-shadow: 0px 3px 16px rgb(0 0 0 / 3%);
        }

        .circular--portrait {
            position: relative;
            width: 220px;
            height: 220px;
            overflow: hidden;
            border-radius: 50%;
        }

        .circular--portrait img {
            width: 100%;
            height: auto;
        }
    </style>
@endpush
@section('content')
    <!--- Start Slide -->
    <div id="home" class="carousel d-none d-sm-block" data-items="1" data-arrows="true" data-dots="true">
        @foreach ($slide as $band)
            @if ($band->links == '')
            @else
                <a href="{{ $band->links }}" target="_blank">
            @endif
            <div class="portfolio-item-wrap">
                <div class="portfolio-image">
                    <img alt="image" style="margin-top: -50px;" width="100%"
                        src="{{ $band->getFirstMediaUrl('banner') }}">
                </div>
            </div>
            </a>
        @endforeach
    </div>
    <div id="home" class="carousel d-block d-sm-none" data-items="1" data-arrows="false" data-dots="true">
        @foreach ($slide as $band)
            @if ($band->links == '')
            @else
                <a href="{{ $band->links }}" target="_blank">
            @endif
            <div class="portfolio-item-wrap">
                <div class="portfolio-image">
                    <img alt="image" width="100%" src="{{ $band->getFirstMediaUrl('banner_mobile') }}">
                </div>
            </div>
            </a>
        @endforeach
    </div>
    <section>
        <div id="aboutus">
            <div class="d-none d-sm-block container text-center">
                <h2 style="color: #045242; font-weight:600;">ABOUT US</h2>
                {!! setting('aboutus_detail') !!}
                <a href="{{ url('/aboutus') }}" class="button-new">ทีมแพทย์จีน</a>
            </div>
            <div class="d-block d-sm-none container text-center">
                <h2 style="color: #045242;">ABOUT US</h2>
                {!! setting('aboutus_detail') !!}
                <a href="{{ url('/aboutus') }}" class="button-new">ทีมแพทย์จีน</a>
            </div>
        </div>
    </section>
    <section id="service" style="background-color: #299B9B;">
        <div class="container">
            <div class="text-center">
                <h2 class="text-white" style="font-weight:600;">SERVICE</h2>
            </div>
            <div class="carousel mt-4" data-items="3" data-arrows="false" data-dots="true">
                @foreach ($service as $item)
                    <div class="portfolio-item-wrap">
                        <div class="portfolio-image center">
                            <div class="circular--portrait" style="display: block; margin-left: auto; margin-right: auto;">
                                <img alt="image" style="border-radius: 50%;"
                                    src="@if ($item->getFirstMediaUrl('service')) {{ $item->getFirstMediaUrl('service') }} @else {{ asset('images/no-image.jpg') }} @endif">
                            </div>
                            <div class="text-center mt-2 mb-2">
                                <a href="{{ route('client.service.show', ['service' => $item->slug]) }}"
                                    class="button-service" style="font-size: 18px;">{{ $item->title }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section style="padding: 0;" class="d-none d-sm-block">
        <a href="https://yuemuyuanclinic.com/service"><img src="{!! setting('promotion_img') !!}" width="100%"></a>
    </section>
    <section style="padding: 0;" class="d-block d-sm-none">
        <a href="https://yuemuyuanclinic.com/service"><img src="{!! setting('promotion_img_mobile') !!}" width="100%"></a>
    </section>
    <section>
        <div class="container">
            <div class="text-center">
                <h2 style="color: #045242; font-weight:600;">REVIEW</h2>
            </div>
            <div class="carousel mt-4" data-items="3" data-arrows="false" data-dots="true">
                @foreach ($reviews as $revieww)
                    <div class="portfolio-item-wrap">
                        <div class="portfolio-image">
                            <img alt="image" width="100%" style="border-radius:6px;"
                                src="{{ $revieww->getFirstMediaUrl('review') }}">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="text-center">
                <h2 style="color: #045242; font-weight:600;">ARTICLE</h2>
            </div>
            <div class="carousel mt-4" data-items="3" data-arrows="false" data-dots="true">
                @foreach ($article as $articles)
                    <a href="{{ route('client.article.show', ['article' => $articles->slug]) }}">
                        <div class="portfolio-item" style="padding:5px;">
                            <div class="post-item border">
                                <div class="post-item-wrap"
                                    style="box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;  border-radius:6px;">
                                    <div class="post-image">
                                        <img class="" src="{{ $articles->getFirstMediaUrl('article') }}"
                                            style="width:100%; border-radius:6px; border-bottom-left-radius: 0px !important; border-bottom-right-radius: 0px !important;">
                                    </div>
                                    <div class="post-item-description text-center">
                                        <h4 class="text-center" style="color: #045242; margin-bottom:0px; overflow: hidden;
                                        display: -webkit-box;
                                        -webkit-line-clamp: 1;
                                        -webkit-box-orient: vertical;">
                                            {{ $articles->title }}</h4>
                                        <h4 class="text-center"
                                            style="font-size:16px; font-weight:400; overflow: hidden;
                                        display: -webkit-box;
                                        -webkit-line-clamp: 3;
                                        -webkit-box-orient: vertical;">
                                            {{ $articles->short_detail }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            {{-- <div class="carousel mt-4" data-items="3" data-arrows="false" data-dots="false">
                @foreach ($news as $item)
                    <div class="polo-carousel-item">
                        <div class="post-item border">
                            <div class="post-item-wrap">
                                <div class="post-image">
                                    <a href="{{ route('client.news.show', ['news' => $item->slug]) }}">
                                        <img alt=""
                                            src="@if ($item->getFirstMediaUrl('news')) {{ $item->getFirstMediaUrl('news') }} @else {{ asset('images/no-image.jpg') }} @endif">
                                    </a>

                                </div>
                                <div class="post-item-description">
                                    <span class="post-meta-date"><i
                                            class="fa fa-calendar-o"></i>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->format('d F Y H:i') }}</span>
                                    <h2>
                                        <a
                                            href="{{ route('client.news.show', ['news' => $item->slug]) }}">{{ $item->title }}</a>
                                    </h2>
                                    <a href="{{ route('client.news.show', ['news' => $item->slug]) }}"
                                        class="item-link">อ่านเพิ่มเติม
                                        <i class="icon-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div> --}}
        </div>
    </section>
    <section style="padding: 0;">
        <div class="text-center" style="margin-bottom: -10px;">
            <h2 style="color: #045242; font-weight:600;">LOCATION</h2>
            {!! setting('map_info') !!}
        </div>
    </section>
@endsection
