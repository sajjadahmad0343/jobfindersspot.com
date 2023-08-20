<!-- Job Categories -->
<section class="job-categories">
    <div class="auto-container">
        <div class="sec-title text-center">
            <h2>{{ $title }}</h2>
            @if(!empty($sub_title))<div class="text">{{ $sub_title }}</div>@endif
        </div>

        <div class="row wow fadeInUp mx-md-n3 mx-n2">
            @if($job_categories)
                @foreach($job_categories as $category)
                    @php $translation = $category->translateOrOrigin(app()->getLocale()); @endphp
                    <!-- Category Block -->
                    <div class="category-block col-lg-4 col-md-6 col-6 d-flex px-md-3 px-2">
                            <a class="inner-box w-100" href="{{ route('job.search', ['category' => $category->id]) }}">
                                <div class="content @if(empty($category->icon)) no-icon @endif">
                                    @if($category->icon)
                                        <span class="icon d-none d-sm-flex {{ $category->icon }} mr-3"></span>
                                    @endif 
                                    <div>
                                        <h4>{{ $translation->name }}</h4>
                                        @if($category->openJobs->count())
                                            <p class="mt-1">({{ $category->openJobs->count() }} {{ $category->openJobs->count() > 1 ? __("open positions") : __("open position") }})</p>
                                        @endif
                                    </div>
                                </div>
                            </a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
<!-- End Job Categories -->
