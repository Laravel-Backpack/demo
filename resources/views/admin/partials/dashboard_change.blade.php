{{-- A small up/down badge for a percentage change. $change may be null when there is nothing to compare against. --}}
@if($change !== null)
    <span class="badge {{ $change >= 0 ? 'bg-green-lt' : 'bg-red-lt' }}">
        <i class="la {{ $change >= 0 ? 'la-arrow-up' : 'la-arrow-down' }}"></i> {{ abs($change) }}%
    </span>
@endif
