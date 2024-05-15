@extends('client.layouts.app')

@section('content')
    <section class="content">
        <div class="container">
            <div class="text-center mb-4">
                <h1 style="color: #045242; font-weight:600;">รีวิว</h1>
                <h2 style="color: #045242;">Review</h2>
            </div>
            <!--<div class="carousel mt-4" data-items="3" data-arrows="false" data-dots="true">
                @foreach ($reviews as $revieww)
                <div class="portfolio-item-wrap">
                    <div class="portfolio-image">
                        <img alt="image" width="100%" style="border-radius:6px;" src="{{ $revieww->getFirstMediaUrl('review') }}">
                    </div>
                </div>
                @endforeach
            </div>-->
			<div class="grid-layout post-3-columns m-b-30 grid-loaded" data-item="post-item">
				 @foreach ($reviews as $revieww)
				<div class="post-item">
					 <div class="portfolio-item-wrap">
                    <div class="portfolio-image">
                        <img alt="image" width="100%" style="border-radius:6px;" src="{{ $revieww->getFirstMediaUrl('review') }}">
                    </div>
                </div>
				</div>
				@endforeach
			</div>
        </div>
    </section>
@endsection
