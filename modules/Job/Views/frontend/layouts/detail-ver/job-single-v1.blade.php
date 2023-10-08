<!-- Job Detail Section -->
<section class="job-detail-section">

    <!-- Upper Box -->
    <div class="upper-box">
        <div class="auto-container">
            <!-- Job Block -->
            <div class="job-block-seven">
                <div class="inner-box">
                    @include("Job::frontend.layouts.details.upper-box")
                    @include("Job::frontend.layouts.details.apply-button")
                </div>
            </div>
        </div>
    </div>

    <div class="job-detail-outer">
        <div class="auto-container">
            <div class="row">
   @auth
    @if(auth()->user()->role_id == 1)
    <div class="d-flex flex-column m-5 mx-auto position-relative" style="max-width: 560px;min-height: 400px;border: 3px solid #fe872c;">
        
        <figure class="mb-0 mt mt-4 position-absolute start-50 top-50 translate-middle" style="
    opacity: 0.15;">
            <img src="https://jobfindersspot.com/uploads/0000/1/2023/08/18/logo.jpg" alt="" class="d-block mt-5 mx-auto rounded-circle" style="width: 180px;">
        </figure><h3 src="" alt="" style="" class="fw-bold my-3 text-center">Hiring
</h3><h1 class="mb-4 px-3 py-3 text-center text-uppercase" style="background: #fe872c;color: white;" text="">{{ $translation->title }}</h1><div class="job-body pt-3 px-3">
     
    <script>
        var currentUrl = window.location.href;
        var getjoblink = document.getElementById('get-joblink')
        getjoblink.innerHTML = currentUrl
    </script>
        
        <table class="fs-6">
            <tbody>
                @if($row->location)
                <tr>
                    @php $location_translation = $row->location->translateOrOrigin(app()->getLocale()) @endphp
                    <th class="fw-bold pe-3 pb-3">Location:</th>
                    <td class="fw-semibold pb-3">{{ $location_translation->name }}</td>
                </tr>
                @endif
                <tr>
                    <th class="fw-bold pe-3 pb-3">Job Title:</th>
                    <td class="fw-semibold pb-3">{{ $translation->title }}</td>
                </tr>
                
                <tr>
                    <th class="fw-bold pe-3 pb-3">Apply here:</th>
                    <td class="fw-semibold pb-3" id="get-joblink"></td>
                </tr>
            </tbody>
        </table>
        </div>
        <div class="job-footer mt-auto pb-3 pt-4 px-3 text-center">
            <p class="mb-0 small">For More Jobs Visit:</p>
            <p class="fw-semibold link-primary mb-0 small">www.jobfindersspot.com</p>
        </div>
    </div>

    @endif
@endauth
            </div>
            <div class="row">
                <div class="content-column col-lg-8 col-md-12 col-sm-12">

                    <div class="job-detail">
                        {!! @clean($translation->content) !!}
                    </div>
                    <div class="sidebar-column col-lg-4 col-md-12 col-sm-12  d-lg-none">
                        <aside class="sidebar">
                            <div class="sidebar-widget">
    
                                @include("Job::frontend.layouts.details.overview")
    
                                @if($row->map_lat && $row->map_lng)
                                    <h4 class="widget-title">{{ __("Job Location") }}</h4>
                                    <div class="widget-content">
                                        @include("Job::frontend.layouts.details.location")
                                    </div>
                                @endif
    
                                @include("Job::frontend.layouts.details.skills")
    
                            </div>
    
                            @include("Job::frontend.layouts.details.company")
    
                        </aside>
                    </div>

                    @include("Job::frontend.layouts.details.gallery")

                    @include("Job::frontend.layouts.details.video")

                    @include("Job::frontend.layouts.details.social-share")

                    @include("Job::frontend.layouts.details.related")

                </div>

                <div class="sidebar-column col-lg-4 col-md-12 col-sm-12 d-none d-lg-block">
                    <aside class="sidebar">
                        <div class="sidebar-widget">

                            @include("Job::frontend.layouts.details.overview")

                            @if($row->map_lat && $row->map_lng)
                                <h4 class="widget-title">{{ __("Job Location") }}</h4>
                                <div class="widget-content">
                                    @include("Job::frontend.layouts.details.location")
                                </div>
                            @endif

                            @include("Job::frontend.layouts.details.skills")

                        </div>

                        @include("Job::frontend.layouts.details.company")

                    </aside>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Job Detail Section -->
