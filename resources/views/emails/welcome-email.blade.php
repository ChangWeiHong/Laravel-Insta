@component('mail::message')
# Welcome to My First Project

This is the first laravel project of Chang Wei Hong.

@component('mail::button', ['url' => 'http://127.0.0.1:8000/'])
Visit First Project
@endcomponent

Best Regards,<br>
Chang Wei Hong
@endcomponent
