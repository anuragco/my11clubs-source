@extends($activeTemplate.'layouts.master')
@section('content')
<div class="card custom--card">
    <form method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label class="form-label">@lang('Username')</label>
                <input type="text" name="username" class="form-control form--control checkUser">
                <small class="text-danger usernameExist"></small>
                <small class="text-success userNameDisplay"></small> <!-- Display user name here -->
            </div>
            <div class="form-group">
                <label class="form-label">@lang('Amount') 
                    <small class="text--success">
                        ( @lang('Charge'): {{ getAmount(gs('bt_fixed')) }} {{  __(gs('cur_text')) }} + {{ getAmount(gs('bt_percent')) }}% ) 
                        + @lang('Minimum Amount should Be 120')
                    </small>
                </label>
                <div class="input-group">
                    <input type="number" step="any" name="amount" value="{{ old('username') }}" class="form-control form--control" min='120'>
                    <span class="input-group-text">{{  __(gs('cur_text')) }}</span>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">@lang('Amount Will Cut From Your Account')</label>
                <div class="input-group">
                    <input type="text" class="form-control form--control calculation" readonly>
                    <span class="input-group-text">{{  __(gs('cur_text')) }}</span>
                </div>
            </div>
            <button type="submit" class="btn btn--base btn--lg w-100">@lang('Transfer')</button>
        </div>
    </form>
</div>
@endsection

@push('script')
<script type="text/javascript">
    $('input[name=amount]').on('input', function() {
        var amo = parseFloat($(this).val());
        var calculation = amo + (parseFloat({{ gs('bt_fixed') }}) + (amo * parseFloat({{ gs('bt_percent') }}) ) / 100);
        $('.calculation').val(calculation);
    });

    $('.checkUser').on('focusout', function(e) {
        var url = '{{ route('user.checkUser') }}';
        var value = $(this).val();
        var token = '{{ csrf_token() }}';
        var data = {username: value, _token: token};
        
        $.post(url, data, function(response) {
            if (response.data !== false) {
                $('.usernameExist').text('');
                if (response.data.name) {
                    $('.userNameDisplay').text('Name: ' + response.data.name); // Display the user's name
                } else {
                    $('.userNameDisplay').text('Name: Not available');
                }
            } else {
                $('.usernameExist').text('Username not found');
                $('.userNameDisplay').text(''); // Clear the user name display
            }
        }).fail(function() {
            $('.usernameExist').text('An error occurred. Please try again.');
            $('.userNameDisplay').text(''); // Clear the user name display
        });
    });
</script>
@endpush
