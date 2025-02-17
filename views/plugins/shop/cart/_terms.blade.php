@if(! empty($terms))
    <div class="form-check d-inline-block">
        <input class="checkbox checkbox-success @error('terms') checkbox-error @enderror" type="checkbox" name="terms" id="terms" required @checked(old('terms'))>

        <label class="form-check-label" for="terms">
            {{ $terms }}
        </label>

        @error('terms')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
@endif
