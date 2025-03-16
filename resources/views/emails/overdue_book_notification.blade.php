<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Overdue Book Notice</title>
</head>

<body>
    <p> Dear {{$borrowedBook->user->name}}</p>
    <p> This is a reminder that you borrowed the book <strong>{{$borrowedBook->book->title}}</strong>, which was due on <strong>{{$borrowedBook->book->due_date}}</strong> </p>
    <p> Pleas return it as soon as possible to avoid penalties</p>
    <p> Thank you,</p>
    <p> <strong>BMA Library Management System </strong></p>

</body>

</html>
