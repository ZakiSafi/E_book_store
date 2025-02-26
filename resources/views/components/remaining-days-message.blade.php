@if ($daysRemaining > 0)
<p class="text-md text-green-600 bg-green-100 p-2 rounded-lg">
    Remaining Days: {{ ceil($daysRemaining) }} days
</p>
@else
<p class="text-md text-red-600 bg-red-100 p-2 rounded-lg">
    Overdue by {{ abs(ceil($daysRemaining)) }} days
</p>
@endif
