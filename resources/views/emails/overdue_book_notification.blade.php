<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overdue Book Notice</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 text-gray-800">
    <div class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-bold mb-4">Overdue Book Notice</h1>
        <p class="mb-4">Dear <span class="font-semibold">{{$borrowedBook->user->name}}</span>,</p>
        <p class="mb-4">This is a reminder that you borrowed the book <strong>{{$borrowedBook->book->title}}</strong>, which was due on <strong>{{$borrowedBook->due_date->format('F j, Y')}}</strong></p>
        <p class="mb-4">Please return it as soon as possible to avoid penalties.</p>
        <p class="mb-4">Thank you,</p>
        <p class="font-semibold">{{ config('mail.from.name') }}</p>
    </div>
</body>

</html>
