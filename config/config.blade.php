@extends('admin.layouts.admin')

@section('title', 'front config')

@push('footer-scripts')
    <script>
        function addLinkListener(el) {
            el.addEventListener('click', function() {
                const element = el.parentNode.parentNode.parentNode.parentNode;

                element.parentNode.removeChild(element);
            });
        }

        document.querySelectorAll('.link-remove').forEach(function(el) {
            addLinkListener(el);
        });

        document.getElementById('addLinkButton').addEventListener('click', function() {
            let input = '<div class="row"><div class="form-group col-md-6">';
            input +=
                '<input type="text" class="form-control" name="footer_links[{index}][name]" placeholder="{{ trans('messages.fields.name') }}"></div>';
            input += '<div class="form-group col-md-6"><div class="input-group">';
            input +=
                '<input type="url" class="form-control" name="footer_links[{index}][value]" placeholder="{{ trans('messages.fields.link') }}">';
            input +=
                '<div class="input-group-append"><button class="btn btn-outline-danger link-remove" type="button">';
            input += '<i class="bi bi-x-lg"></i></button></div></div></div></div>';

            const newElement = document.createElement('div');
            newElement.innerHTML = input;

            addLinkListener(newElement.querySelector('.link-remove'));

            document.getElementById('links').appendChild(newElement);
        });

        document.getElementById('addLegalLinkButton').addEventListener('click', function() {
            let input = '<div class="row"><div class="form-group col-md-6">';
            input +=
                '<input type="text" class="form-control" name="legal_links[{index}][name]" placeholder="{{ trans('messages.fields.name') }}"></div>';
            input += '<div class="form-group col-md-6"><div class="input-group">';
            input +=
                '<input type="url" class="form-control" name="legal_links[{index}][value]" placeholder="{{ trans('messages.fields.link') }}">';
            input +=
                '<div class="input-group-append"><button class="btn btn-outline-danger link-remove" type="button">';
            input += '<i class="bi bi-x-lg"></i></button></div></div></div></div>';

            const newElement = document.createElement('div');
            newElement.innerHTML = input;

            addLinkListener(newElement.querySelector('.link-remove'));

            document.getElementById('legal_links').appendChild(newElement);
        });

        document.getElementById('configForm').addEventListener('submit', function() {
            let i = 0;

            document.getElementById('links').querySelectorAll('.row').forEach(function(el) {
                el.querySelectorAll('input').forEach(function(input) {
                    input.name = input.name.replace('{index}', i.toString());
                });

                i++;
            });

            let j = 0;

            document.getElementById('legal_links').querySelectorAll('.row').forEach(function(el) {
                el.querySelectorAll('input').forEach(function(input) {
                    input.name = input.name.replace('{index}', j.toString());
                });

                j++;
            });
        });
    </script>
@endpush

@section('content')
    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('admin.themes.config', $theme) }}" method="POST" id="configForm">
                @csrf

                <div class="row g-3">
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="discordInput">{{ trans('theme::front.config.discord') }}</label>
                        <input type="text" class="form-control @error('discord-id') is-invalid @enderror" id="discordInput" name="discord-id" value="{{ old('discord-id', config('theme.discord-id')) }}" aria-describedby="discordLabel">

                        @error('discord-id')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror

                        <small id="discordLabel" class="form-text">{{ trans('theme::front.config.discord_info') }}</small>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="twitterInput">Twitter</label>
                        <input type="text" class="form-control @error('twitter') is-invalid @enderror" id="twitterInput" name="twitter" value="{{ old('twitter', config('theme.twitter')) }}">

                        @error('twitter')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="titleInput">{{ trans('theme::front.config.title') }}</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="titleInput" name="title" value="{{ old('title', config('theme.title')) }}">

                    @error('title')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="subtitleInput">{{ trans('theme::front.config.subtitle') }}</label>
                    <input type="text" class="form-control @error('subtitle') is-invalid @enderror" id="subtitleInput" name="subtitle" value="{{ old('subtitle', config('theme.subtitle')) }}">

                    @error('subtitle')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="image_titleInput">{{ trans('theme::front.config.title_image') }}</label>
                    <input type="text" class="form-control @error('image_title') is-invalid @enderror" id="image_titleInput" name="image_title" value="{{ old('image_title', config('theme.image_title')) }}">

                    @error('subtitle')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <h1>Liens Normaux</h1>

                <div id="links">
                    @foreach (theme_config('footer_links') ?? [] as $link)
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="footer_links[{index}][name]"
                                    placeholder="{{ trans('messages.fields.name') }}" value="{{ $link['name'] }}">
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <input type="url" class="form-control" name="footer_links[{index}][value]"
                                        placeholder="{{ trans('messages.fields.link') }}"
                                        value="{{ $link['value'] }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-danger link-remove" type="button">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mb-2">
                    <button type="button" id="addLinkButton" class="btn btn-sm btn-success">
                        <i class="bi bi-plus-lg"></i> {{ trans('messages.actions.add') }}
                    </button>
                </div>

                <h1>Liens Légaux</h1>

                <div id="legal_links">
                    @foreach (theme_config('legal_links') ?? [] as $link)
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="legal_links[{index}][name]"
                                    placeholder="{{ trans('messages.fields.name') }}" value="{{ $link['name'] }}">
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <input type="url" class="form-control" name="legal_links[{index}][value]"
                                        placeholder="{{ trans('messages.fields.link') }}"
                                        value="{{ $link['value'] }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-danger link-remove" type="button">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mb-2">
                    <button type="button" id="addLegalLinkButton" class="btn btn-sm btn-success">
                        <i class="bi bi-plus-lg"></i> {{ trans('messages.actions.add') }}
                    </button>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> {{ trans('messages.actions.save') }}
                </button>
            </form>
        </div>
    </div>
@endsection
