<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

<i class="bi bi-heart text-bg-danger "></i>
xxxxxxxxxxxxxxxxxxxxxx
<div class="container">
@yield('content')


</div>
@include('../../importations/important_bib')


<script src="{{ asset('js/bootstrap.min.js') }}" defer></script>

</body>
</html>

