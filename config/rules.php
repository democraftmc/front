<?php

return [
    'discord-id' => ['nullable', 'string'],
    'twitter' => ['nullable', 'string'],
    'title' => ['required_with:subtitle', 'nullable', 'string'],
    'subtitle' => ['nullable', 'string'],
    'image_title' => ['nullable', 'string'],
    'footer_links' => 'nullable|array',
    'legal_links' => 'nullable|array',
];
