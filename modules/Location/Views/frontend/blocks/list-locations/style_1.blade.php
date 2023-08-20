<!-- Features Section -->
<section class="features-section">
    <div class="auto-container">
        <div class="sec-title">
            <h2>{{ $title }}</h2>
            <div class="text">{{ $sub_title }}</div>
        </div>

        <div class="row wow fadeInUp location-row">
            @if(!empty($rows))
                @foreach($rows as $key=>$row)
                        <div class="column col-lg-4 col-md-6 col-sm-12">
                            @include("Location::frontend.blocks.list-locations.loop")
                        </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
<!-- End Features Section -->
