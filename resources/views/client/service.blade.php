@extends('client.layouts.app')

@section('content')

    <!-- page title -->
    <section id="page-title" class="text-light"
             style="background-image:linear-gradient(0deg, rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.5)), url({{asset(setting('image_page_title_service'))}}); background-size: cover; background-position: center center;">
        <div class="container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="{{route('client.home')}}">หน้าแรก</a></li>
                    <li><a href="#">เกี่ยวกับเรา</a></li>
                </ul>
            </div>
            <div class="page-title">
                <h1>บริการของเรา</h1>
                <!--                    <span>Simple page title with background parallax image</span>-->
            </div>
        </div>
    </section>
    <!-- page title -->

    <section class="container pt-5">
        <div class="tabs tabs-vertical">
            <div class="row">
                <div class="col-md-3">
                    <ul class="nav flex-column nav-tabs" id="myTab4" role="tablist" aria-orientation="vertical">
                        @php $i = 1 @endphp
                        @foreach($services as $service)
                            <li class="nav-item">
                                <a class="nav-link @if(!empty(request()->get('type')===$service->slug)) active @endif  @if(request()->get('type')=='' && $i==1)active @endif" id="" data-toggle="tab" href="#service{{$service->id}}" role="tab"
                                   aria-controls="home" aria-selected="true">{{$service->title}} <span
                                        class="badge badge-primary"></span></a>
                            </li>
                            @php $i++ @endphp
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-9">

                    <div class="tab-content" id="myTabContent4">
                        @php $i = 1 @endphp
                        @foreach($services as $service)
                            <div class="tab-pane fade show @if(!empty(request()->get('type')===$service->slug)) active @endif @if(request()->get('type')=='' && $i==1)active @endif" id="service{{$service->id}}" role="tabpanel"
                                 aria-labelledby="profile-tab">
                                {!! $service->detail !!}
                            </div>
                            @php $i++ @endphp
                        @endforeach
                    </div>
                </div>
            </div>
        </div>


    </section>


@endsection
