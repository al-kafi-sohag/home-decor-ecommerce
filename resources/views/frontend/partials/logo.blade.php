{{-- Site logo. Swap public/images/logo.svg (or point $src at a DB-stored
     asset later) to rebrand everywhere it's used. Pass $class for sizing. --}}
@php($class = $class ?? 'h-10 w-auto')
<img src="{{ asset('images/logo.svg') }}" alt="{{ config('app.name', 'Indecor') }}" class="{{ $class }}">
