<section class="features-section">
    <div class="auto-container">
        <div class="sec-title-outer">
            <div class="sec-title">
                <h2>{{ $title }}</h2>
                <div class="text">{{ $sub_title }}</div>
            </div>
            @if(!empty($load_more_url))
                <a href="{{ $load_more_url }}" class="link">{{ $load_more_name }}<span class="fa fa-angle-right"></span></a>
            @endif
        </div>
        <div class="row wow fadeInUp location-row mx-n2">
            @if(!empty($rows))
                @foreach($rows as $key => $row)
                        <div class="column col-lg-3 col-md-3 col-sm-3 col-6 px-2 mb-3">
                            @include("Location::frontend.blocks.list-locations.loop")
                        </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
