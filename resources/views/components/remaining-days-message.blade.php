@if ($daysRemaining > 0)
@if ($daysRemaining = 1)
<p class="text-md text-green-600 bg-green-100 p-2 rounded-lg">
    Remaining Days: {{ ceil($daysRemaining) }} day
</p>
@else
<p class="text-md text-green-600 bg-green-100 p-2 rounded-lg">
    Remaining Days: {{ ceil($daysRemaining) }} days
</p>
@endif

@else
<p class="text-md text-red-600 bg-red-100 p-2 rounded-lg">
    Overdue by {{ abs(ceil($daysRemaining)) }} days
</p>
@endif
