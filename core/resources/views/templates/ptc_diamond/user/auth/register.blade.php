@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @if (gs('registration'))
        @php
            $content = getContent('register.content', true);
            $hasReference = session()->has('reference');
            $referenceId = $hasReference ? session('reference') : null;
            $refUser = null;
            $hasActivePlan = false;

            if ($referenceId) {
                $refUser = \App\Models\User::where('username', $referenceId)->first();
                if ($refUser) {
                    $hasActivePlan = $refUser->plan_id != 0;
                }
            }
        @endphp
        <div class="section login-section">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-lg-6">
                        <img src="{{ frontendImage('register', $content->data_values->image, '1382x1445') }}" alt="images" class="img-fluid" />
                    </div>
                    <div class="col-lg-6 col-xxl-5">
                        <div class="login-form @if (!gs('registration')) form-disabled @endif">
                            @if (!$hasReference)
                                <div class="alert alert-warning" role="alert">
                                    @lang('Please use a referral link to proceed with registration. Direct registration is not allowed.')
                                </div>
                            @endif

                            <div class="mb-3">
                                <h3 class="login-form__title">{{ __($content->data_values->heading) }}</h3>
                                <p>
                                    @lang('Already have an account?') <a href="{{ route('user.login') }}" class="t-link t-link--base text--base">@lang('Login')</a>
                                </p>
                            </div>

                            @if ($hasReference)
                                <div class="form-group col-12">
                                    <label for="referenceBy" class="form-label">@lang('Referred by')</label>
                                    <input type="text" name="referBy" id="referenceBy" class="form-control form--control"
                                        value="{{ $referenceId }}" readonly>
                                </div>

                                @if ($hasActivePlan)
                                    <div class="alert alert-success" role="alert">
                                        @lang('You have been referred by a user with an active subscription.')
                                    </div>
                                @else
                                    <div class="alert alert-warning" role="alert">
                                        @lang('You have been referred by a user who does not have an active subscription. Please contact support.')
                                    </div>
                                @endif
                            @endif

                            <form action="{{ route('user.register') }}" class="row verify-gcaptcha" method="post" @if (!$hasReference) onsubmit="return false;" @endif>
                                @csrf

                                <div class="form-group col-md-12">
                                    <label class="form-label">@lang('First Name')</label>
                                    <input type="text" name="firstname" placeholder="@lang('Full Name')" class="form-control form--control"
                                        value="{{ old('firstname') }}" required>
                                </div>

                                <!--<div class="form-group col-md-6">-->
                                <!--    <label class="form-label">@lang('Last Name')</label>-->
                                <!--    <input type="text" name="lastname" placeholder="@lang('Last Name')" class="form-control form--control"-->
                                <!--        value="{{ old('lastname') }}" required>-->
                                <!--</div>-->

                                <div class="form-group col-md-12">
                                    <label for="email" class="form-label">@lang('Email')</label>
                                    <input type="email" name="email" id="email" placeholder="@lang('Email')"
                                        class="form-control form--control checkUser" value="{{ old('email') }}" required>
                                </div>

                                <div class="form-group col-md-6 form-group mb-0">
                                    <label class="form-label" for="password">@lang('Password')</label>
                                    <input type="password" id="password" name="password"
                                        class="form-control form--control @if (gs('secure_password')) secure-password @endif"
                                        placeholder="@lang('Password')" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="form-label" for="password_confirmation">@lang('Confirm Password')</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control form--control"
                                        placeholder="@lang('Confirm Password')" required>
                                </div>

                                <x-captcha class />

                                @if (gs('agree'))
                                    @php
                                        $policyPages = getContent('policy_pages.element', false, orderById: true);
                                    @endphp
                                    <div class="form-group col-12">
                                        <div class="form-check form--check d-block">
                                            <input type="checkbox" id="agree" @checked(old('agree')) name="agree"
                                                class="form-check-input custom--check" required>
                                            <label class="form-check-label form-label" for="agree">@lang('I agree with ') </label> <span>
                                                @foreach ($policyPages as $policy)
                                                    <a class="t-link t-link--base text--base" href="{{ route('policy.pages', @$policy->slug) }}"
                                                        target="_blank">{{ __($policy->data_values->title) }}</a>
                                                    @if (!$loop->last)
                                                        ,
                                                    @endif
                                                @endforeach
                                            </span>
                                        </div>
                                    </div>
                                @endif

                                <div class="col-12 form-group">
                                    <button type="submit" class="btn btn--lg btn--base w-100 rounded" @if (!$hasReference || ($hasReference && !$hasActivePlan)) disabled @endif>
                                        @lang('Register Now')
                                    </button>
                                    @if (!$hasReference)
                                        <div class="alert alert-warning mt-3" role="alert">
                                            @lang('Registration is only allowed through referral links.')
                                        </div>
                                    @elseif ($hasReference && !$hasActivePlan)
                                        <div class="alert alert-warning mt-3" role="alert">
                                            @lang('Registration disabled. You were referred by a user without an active subscription.')
                                        </div>
                                    @endif
                                </div>

                                <div class="col-12">
                                    @include($activeTemplate . 'partials.social_login')
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade custom--modal" id="existModalCenter" tabindex="-1" role="dialog" aria-labelledby="existModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="existModalLongTitle">@lang('You are with us')</h5>
                        <span type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="las la-times"></i>
                        </span>
                    </div>
                    <div class="modal-body">
                        <h6 class="text-center">@lang('You already have an account please Login ')</h6>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-bs-dismiss="modal">@lang('Close')</button>
                        <a href="{{ route('user.login') }}" class="btn btn--base">@lang('Login')</a>
                    </div>
                </div>
            </div>
        </div>
    @else
        @include($activeTemplate . 'partials.registration_disabled')
    @endif
@endsection

@push('style')
    <style>
        /* Your custom styles here */
    </style>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";
            $('.checkUser').on('focusout', function(e) {
                var url = '{{ route('user.checkUser') }}';
                var value = $(this).val();
                var token = '{{ csrf_token() }}';

                var data = {
                    email: value,
                    _token: token
                }

                $.post(url, data, function(response) {
                    if (response.data != false) {
                        $('#existModalCenter').modal('show');
                    }
                });
            });
            
             $('form').on('submit', function(e) {
            var fullName = $('input[name="firstname"]').val();
            var names = fullName.split(' ');
            
            if (names.length > 1) {
                $('input[name="firstname"]').val(names.shift());
                $('<input>').attr({
                    type: 'hidden',
                    name: 'lastname',
                    value: names.join(' ')
                }).appendTo('form');
            } else {
                $('<input>').attr({
                    type: 'hidden',
                    name: 'lastname',
                    value: ''
                }).appendTo('form');
            }
        });
        })(jQuery);
    </script>
@endpush