@php
    $translation = $row->translateOrOrigin(app()->getLocale());
@endphp
<!-- Feature Block -->
<div class="feature-block d-none">
    <div class="inner-box">
        <figure class="image d-none">
            <img src="{{ $row->getImageUrl() }}" alt="{{ $row->name }}">
        </figure>
        <div class="overlay-box">
            <div class="content">
                <h5>{{ $translation->name }}</h5>
                <span class="total-jobs">{{ $row->openJobs->count() }} {{ $row->openJobs->count() == 1 ? __("Job") : __("Jobs") }}</span>
                <a href="{{ route('job.location.index', ['slug' => $row->slug]) }}" class="overlay-link"></a>
            </div>
        </div>
    </div>
</div> 
<div class="location-content">
    <h5>{{ $translation->name }}</h5>
    <span class="total-jobs">{{ $row->openJobs->count() }} {{ $row->openJobs->count() == 1 ? __("Job") : __("Jobs") }}</span>
    <a href="{{ route('job.location.index', ['slug' => $row->slug]) }}" class="overlay-link"></a>
</div>
 