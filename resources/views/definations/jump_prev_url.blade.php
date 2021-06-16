@php
    if (session()->has('previous_url')) {
        $prev_url = session()->get('previous_url');
        session()->forget('previous_url');
    } else {
        $prev_url = url()->previous();
    }
@endphp