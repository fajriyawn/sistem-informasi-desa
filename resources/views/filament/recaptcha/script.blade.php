<?php
<script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>
<script>
    function handlerCaptcha() {
        grecaptcha.ready(function () {
            grecaptcha.execute('{{ config('services.recaptcha.site_key') }}', {action: 'login'}).then(function(token) {
                @this.set('captchaToken', token);
                @this.call('authenticate');
            });
        });
    }
</script>