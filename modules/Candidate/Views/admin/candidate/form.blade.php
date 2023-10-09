    @php
        $candidate = $row->candidate;
    @endphp
    <style>
        .job-title-info{ font-size: 0.85rem
}
.pulse {
animation: pulse-animation 2s infinite;
}
#job-title-info .card-body * {
    font-size: 0.8rem;
    line-height: 1.5;
    font-weight: 400;
}
#job-title-info .card-body {min-width: 16rem;}
@keyframes pulse-animation {
    0% {
        color: #000;
    transform: scale(1, 1);
  }
  50% {
    color: #007bff;
    transform: scale(1.15, 1.15);
  }
  100% {
    color: #000;
    transform: scale(1, 1);
  }
}
    </style>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{-- <label>{{__("Title")}}</label> --}}
                <label>Job Title 
                    <span class="position-relative">
                    <a class="fafainfocircle ml-1 job-title-info pulse rounded-circle" data-toggle="collapse" href="#job-title-info" aria-expanded="true" aria-controls="job-title-info" style="cursor: pointer;">(need help? Click here)</a>
                        <div id="job-title-info" class="bg-white border in position-absolute collapse" role="tabpanel" aria-labelledby="section1HeaderId" style="z-index: 9;">
                            <div class="card-body p-2">
                                <span closs="close-collapse fa fa-close" data-toggle="collapse" href="#job-title-info" aria-expanded="true" aria-controls="job-title-info" style="cursor: pointer; right:0.5rem; top:0.5rem; z-index:10" class="fa fa-times-circle position-absolute text-danger"></span>
                                <p class="mb-2 ">A job title is the name given to your position at work. It helps others understand your role and where you fit in the organization.</p>
                                <p class="mb-2" style="font-weight: 500">Some Common examples are:</p>
                                <ul class="list mb-2 pl-3">
                                    <li>Project Manager</li>
                                    <li>Software Engineer</li>
                                    <li>Marketing Coordinator</li>
                                    <li>Human Resources Specialist</li>
                                    <li>Sales Associate</li>
                                    <li>Accountant</li>
                                    <li>Graphic Designer</li>
                                    <li>and more</li>
                                </ul>
                                 <p class="mb-0">Your job title matters, so choose wisely!</p>
                            </div>
                        </div>
                    </span>
                </label>
                <input type="text" value="{{old('title',@$candidate->title)}}" name="title" placeholder="{{__("Title")}}" class="form-control">
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="form-group">
                <label>{{__("Website")}}</label>
                <input type="text" value="{{old('website',@$candidate->website)}}" name="website" placeholder="{{__("Website")}}" class="form-control">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="gender">{{__("Gender")}}</label>
                <select class="form-control" id="gender" name="gender">
                    <option value="" @if(old('gender',@$candidate->gender) == '') selected @endif >{{ __("Select") }}</option>
                    <option value="male" @if(old('gender',@$candidate->gender) == 'male') selected @endif >{{ __("Male") }}</option>
                    <option value="female" @if(old('gender',@$candidate->gender) == 'female') selected @endif >{{ __("Female") }}</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>{{__("Expected Salary")}}</label>
                <div class="input-group">
                    <input type="text" value="{{ old('expected_salary',@$candidate->expected_salary) }}" placeholder="{{__("Expected Salary")}}" name="expected_salary" class="form-control">
                    <div class="input-group-append">
                        <select class="form-control" name="salary_type">
                            <option value="hourly" @if(old('salary_type',@$candidate->salary_type) == 'hourly') selected @endif > {{ currency_symbol().__("/hourly") }} </option>
                            <option value="daily" @if(old('salary_type',@$candidate->salary_type) == 'daily') selected @endif >{{ currency_symbol().__("/daily") }}</option>
                            <option value="weekly" @if(old('salary_type',@$candidate->salary_type) == 'weekly') selected @endif >{{ currency_symbol().__("/weekly") }}</option>
                            <option value="monthly" @if(old('salary_type',@$candidate->salary_type) == 'monthly') selected @endif >{{ currency_symbol().__("/monthly") }}</option>
                            <option value="yearly" @if(old('salary_type',@$candidate->salary_type) == 'yearly') selected @endif >{{ currency_symbol().__("/yearly") }}</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>{{__("Experience")}}</label>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="{{ __("Experience") }}" name="experience_year" value="{{ old('experience_year',@$candidate->experience_year) }}">
                    <div class="input-group-append">
                        <span class="input-group-text" style="font-size: 14px;">{{ __("year(s)") }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="education_level">{{__("Education Level")}}</label>
                <select class="form-control" id="education_level" name="education_level">
                    <option value="" @if(old('education_level',@$candidate->education_level) == '') selected @endif >{{ __("Select") }}</option>
                    <option value="certificate" @if(old('education_level',@$candidate->education_level) == 'certificate') selected @endif >{{ __("Certificate") }}</option>
                    <option value="diploma" @if(old('education_level',@$candidate->education_level) == 'diploma') selected @endif >{{ __("Diploma") }}</option>
                    <option value="associate" @if(old('education_level',@$candidate->education_level) == 'associate') selected @endif >{{ __("Associate") }}</option>
                    <option value="bachelor" @if(old('education_level',@$candidate->education_level) == 'bachelor') selected @endif >{{ __("Bachelor") }}</option>
                    <option value="master" @if(old('education_level',@$candidate->education_level) == 'master') selected @endif >{{ __("Master") }}</option>
                    <option value="professional" @if(old('education_level',@$candidate->education_level) == 'professional') selected @endif >{{ __("Professional") }}</option>
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>{{__("Language")}}</label>
                <input type="text" value="{{old('languages',@$candidate->languages)}}" name="languages" placeholder="{{__("Language")}}" class="form-control">
            </div>
        </div>

        {{-- <div class="col-md-12">
            <div class="form-group">
                <label class="control-label">{{__("Video Url")}}</label>
                <p><i>{{__("Insert a video, which shows anything about you")}}</i></p>
                <input type="text" name="video" class="form-control" value="{{old('video',@$candidate->video)}}" placeholder="{{__("Youtube link video")}}">
            </div>
        </div> --}}

        {{-- @if(is_default_lang())
            <div class="col-md-12">
                <div class="form-group">
                    <label>{{__("Video Cover Image")}}</label>
                    <div class="form-group">
                        {!! \Modules\Media\Helpers\FileHelper::fieldUpload('video_cover_id',@$candidate->video_cover_id) !!}
                    </div>
                </div>
            </div>
        @endif --}}

        {{-- <div class="col-md-12">
            <div class="form-group">
                <label class="control-label">{{__("Gallery")}} ({{__('Recommended size image:1080 x 1920px')}})</label>
                @php
                    $gallery_id = @$candidate->gallery ?? old('gallery');
                @endphp
                {!! \Modules\Media\Helpers\FileHelper::fieldGalleryUpload('gallery', $gallery_id) !!}
            </div>
        </div> --}}
    </div>



