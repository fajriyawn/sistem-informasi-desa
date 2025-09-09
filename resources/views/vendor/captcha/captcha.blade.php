<style>
    html.dark #captcha {
        color: #fff; 
        background-color: #1f2937; 
        border-color: #4b5563; 
    }
</style>
<div class="form-group{{ $errors->has('captcha') ? ' has-error' : '' }}">
    <div style="display: flex; align-items: center; gap: 1rem;">
        <span>{!! captcha_img('flat') !!}</span>
        <button type="button" class="btn btn-sm btn-info refresh-captcha">
            &#x21bb;
        </button>
    </div>
    <input id="captcha" type="text" class="form-control mt-2" placeholder="Masukkan Captcha" name="captcha">

    @if ($errors->has('captcha'))
        <span class="help-block text-danger">
            <strong>{{ $errors->first('captcha') }}</strong>
        </span>
    @endif
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const refreshButton = document.querySelector('.refresh-captcha');
        if (refreshButton) {
            refreshButton.addEventListener('click', function (e) {
                e.preventDefault();
                fetch('{{ url("captcha/flat") }}', { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                    .then(response => response.json())
                    .then(data => {
                        document.querySelector('span[data-captcha-image]').innerHTML = `<img src="${data.img}" alt="captcha">`;
                    });
            });
        }
    });
</script>
@endpush