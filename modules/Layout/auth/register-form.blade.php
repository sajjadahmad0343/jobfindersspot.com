<form class="form bravo-form-register" method="post">
    @csrf
    <form method="post" action="#">
        <div class="form-group mb-3">
            <div class="btn-box form-row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                    <input class="checked register-check position-absolute" type="radio" name="type" id="checkbox1" value="candidate" checked/>
                    <label for="checkbox1" class="theme-btn btn-style-four"><i class="la la-user"></i> {{ __("Candidate") }}</label>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                    <input class="checked register-check position-absolute" type="radio" name="type" id="checkbox2" value="employer"/>
                    <label for="checkbox2" class="theme-btn btn-style-four"><i class="la la-briefcase"></i> {{ __("Employer") }}</label>
                </div>
            </div>
        </div>
        
        <div class="form-row">
            <div class="col-md-6 col-sm-6 col-6 form-group mb-3">
                <label>First name</label>
                <input type="text" name="first_name" placeholder="Add first name" required>
                <span class="invalid-feedback error error-first_name"></span>
            </div>
            <div class="col-md-6 col-sm-6 col-6 form-group mb-3 pb-1">
                <label>Last name</label>
                <input type="text" name="last_name" placeholder="Add last name" required>
                <span class="invalid-feedback error error-last_name"></span>
            </div>

        <div class="col-md-6 col-sm-6 col-12 company-name d-none">
            <div class="form-group mb-3">
                <label>Company name</label>
                <input type="text" name="name" placeholder="Add company name" required>
                <span class="invalid-feedback error error-company_name"></span>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-6 form-group mb-3">
            <label>Phone Number</label>
            <input type="text" name="phone" placeholder="Add phone number" required>
            <span class="invalid-feedback error error-phone"></span>
        </div>
        <div class="col-md-6 col-sm-6 col-6 form-group mb-3">
            <label>{{__('Email address')}}</label>
            <input type="email" name="email" placeholder="{{__('Email address')}}" required>
            <span class="invalid-feedback error error-email"></span>
        </div>

        <div class="col-md-6 col-sm-6 col-6 form-group mb-3">
            <label>{{ __("Password") }}</label>
            <input id="password-field" type="password" name="password" value="" placeholder="{{ __("Password") }}">
            <span class="invalid-feedback error error-password"></span>
        </div>
        <div class="col-md-6 col-sm-6 col-6 form-group mb-3">
            <label>Confirm Password</label>
            <input id="confirm-password-field" type="password" name="password_confirmation" value="" placeholder="Confirm password">
            <span class="invalid-feedback error error-password_confirmation"></span>
        </div>
    </div>

        @if(setting_item("recaptcha_enable"))
            <div class="form-group mb-3">
                {{recaptcha_field($captcha_action ?? 'register')}}
                <span class="invalid-feedback error error-recaptcha"></span>
            </div>
        @endif
        <div class="position-relative">
            <input type="checkbox" name="term" id="terms-and-conditions">
            <label for="terms-and-conditions" class="d-block">
            I agree to accept <a href="/page/privacy-policy">terms and conditions</a> and <a href="/page/privacy-policy">Privacy Policy.</a>
            <span class="invalid-feedback error error-term"></span>
            </label>
        </div>

        <div class="form-group mb-3">
            <button class="theme-btn btn-style-one " type="submit" name="Register">{{ __('Sign Up') }}
                <span class="spinner-grow spinner-grow-sm icon-loading" role="status" aria-hidden="true"></span>
            </button>
        </div>
    </form>
    <div class="bottom-box">
        <div class="text">Already have an account? <a href="/login" class="signup">Login here</a></div>
    </div>
    @if(setting_item('facebook_enable') or setting_item('google_enable') or setting_item('twitter_enable'))
        <div class="bottom-box">
            <div class="divider"><span>or</span></div>
            <div class="btn-box row">
                @if(setting_item('facebook_enable'))
                    <div class="col-lg-6 col-md-12">
                        <a href="{{url('/social-login/facebook')}}" class="theme-btn social-btn-two facebook-btn btn_login_fb_link"><i class="fab fa-facebook-f"></i>{{__('Facebook')}}</a>
                    </div>
                @endif
                @if(setting_item('google_enable'))
                    <div class="col-lg-6 col-md-12">
                        <a href="{{url('social-login/google')}}" class="theme-btn social-btn-two google-btn btn_login_gg_link"><i class="fab fa-google"></i>{{__('Google')}}</a>
                    </div>
                @endif
            </div>
        </div>
    @endif
</form>
