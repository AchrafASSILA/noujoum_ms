<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Noujoum center</title>
    <link href="{{asset('assets/bs/css/bootstrap.min.css')}}" rel="stylesheet">
    @vite('resources/css/app.css')

</head>

<body>
    <div id="app"></div>
    @vite('resources/js/app.ts')
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> --}}
    <!-- Custom styles for all pages-->
    <script src="{{asset('assets/bs/js/bootstrap.bundle.min.js')}}"></script>
    <link href="{{asset('assets/css/powerfull.css')}}" rel="stylesheet">
</body>
<style>
    .fc-timegrid-slot {
        height: 50px !important
    }

    a {
        text-decoration: none;
    }
</style>

</html>