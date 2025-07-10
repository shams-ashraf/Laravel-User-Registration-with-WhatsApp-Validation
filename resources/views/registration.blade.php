@extends('app')

@section('title', __('messages.registration_title'))

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('messages.registration_form') }}</div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <div class="language-switcher">
                        <a href="?lang=en" class="{{ app()->getLocale() === 'en' ? 'active' : '' }}">English</a>
                        <a href="?lang=ar" class="{{ app()->getLocale() === 'ar' ? 'active' : '' }}">العربية</a>
                    </div>

                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" id="registrationForm">
                        @csrf

                        <div class="mb-3">
                            <label for="full_name" class="form-label">{{ __('messages.full_name') }}</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" required>
                            
                            @error('full_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        
                        </div>

                        <div class="mb-3">
                            <label for="user_name" class="form-label">{{ __('messages.user_name') }}</label>
                            <input type="text" class="form-control" id="user_name" name="user_name" required>
                            <div id="usernameFeedback" class="text-danger"></div>
                            @error('user_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('messages.email') }}</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="phone_number" class="form-label">{{ __('messages.phone_number') }}</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" required>
                                @error('phone_number')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="whatsapp_number" class="form-label">{{ __('messages.whatsapp_number') }}</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="whatsapp_number" name="whatsapp_number" required>
                                    <button class="btn btn-outline-secondary" type="button" id="validateWhatsApp">{{ __('messages.validate_whatsapp') }}</button>
                                </div>
                                <div id="whatsappFeedback"></div>
                                @error('whatsapp_number')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">{{ __('messages.address') }}</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                            @error('address')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">{{ __('messages.password') }}</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                                <small class="text-muted">{{ __('messages.password_requirements') }}</small>
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label">{{ __('messages.confirm_password') }}</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="profile_picture" class="form-label">{{ __('messages.profile_picture') }}</label>
                            <input type="file" class="form-control" id="profile_picture" name="profile_picture" required>
                            @error('profile_picture')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('messages.register') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Username availability check
    document.getElementById('user_name').addEventListener('blur', function() {
        const username = this.value;
        if (username.length > 0) {
            fetch(`/check-username?username=${encodeURIComponent(username)}`)
                .then(response => response.json())
                .then(data => {
                    const feedback = document.getElementById('usernameFeedback');
                    if (data.exists) {
                        feedback.textContent = '{{ __("messages.username_taken") }}';
                    } else {
                        feedback.textContent = '{{ __("messages.username_available") }}';
                    }
                });
        }
    });

    // WhatsApp validation
    document.getElementById('validateWhatsApp').addEventListener('click', function() {
        const whatsappNumber = document.getElementById('whatsapp_number').value;
        if (whatsappNumber) {
            fetch('https://whatsapp-number-validator3.p.rapidapi.com/WhatsappNumberHasItBulkWithToken', {
                method: 'POST',
                headers: {
                    'x-rapidapi-key': '0e95d8075bmsh8bbfe35ba552e46p1b4e74jsna5c641c772b7',
                    'x-rapidapi-host': 'whatsapp-number-validator3.p.rapidapi.com',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ phone_numbers: [whatsappNumber] })
            })
            .then(response => response.json())
            .then(data => {
                const feedback = document.getElementById('whatsappFeedback');
                if (data[0]?.status === "valid") {
                    feedback.textContent = '{{ __("messages.valid_whatsapp") }}';
                    feedback.className = 'text-success';
                } else {
                    feedback.textContent = '{{ __("messages.invalid_whatsapp") }}';
                    feedback.className = 'text-danger';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('whatsappFeedback').textContent = '{{ __("messages.validation_error") }}';
            });
        } else {
            document.getElementById('whatsappFeedback').textContent = '{{ __("messages.invalid_number_format") }}';
        }
    });
</script>
@endpush