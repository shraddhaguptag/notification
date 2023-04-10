<x-mail::layout>
{{-- Header --}}
<x-slot:header>
<x-mail::header :url="config('app.url')">
<img src="https://media.licdn.com/dms/image/C560BAQFyYMDv48R4lA/company-logo_200_200/0/1519889503390?e=2147483647&v=beta&t=X5qIDcSXqY3rgoIo1yeQ8PqpqziK-rFplAlPD8lAKQs" class="logo" alt="{{config('app.name')}}">

</x-mail::header>
</x-slot:header>

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
<x-slot:subcopy>
<x-mail::subcopy>
{{ $subcopy }}
</x-mail::subcopy>
</x-slot:subcopy>
@endisset

{{-- Footer --}}
<x-slot:footer>
<x-mail::footer>
© {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
</x-mail::footer>
</x-slot:footer>
</x-mail::layout>
