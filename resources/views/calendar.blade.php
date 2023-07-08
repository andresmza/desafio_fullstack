<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.css">

    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale/es-us.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"
        integrity="sha512-lbwH47l/tPXJYG9AcFNoJaTMhGvYWhVM9YI43CT+uteTRRaiLCui8snIgyAN8XWgNjNhCqlAUdzZptso6OCoFQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('js/calendar.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body style="background-color: #ececec">

    <nav class="navbar bg-info">
        <div class="container-fluid">
            <span class="navbar-brand">
                Route calendar
            </span>
        </div>
    </nav>


    <div class="container mt-4">
        <div class="row g-2 mt-4 mb-4">
            <h3>Schedules</h3>
            <div class="col-8">
                <div class="p-3 h-100 rounded-3xl" style="border-radius: 20px; background-color: #FFFFFF">
                    <div class="row">
                        <div class="col-sm-4">
                            <h5>Seleccione fecha</h5>
                            <input type="text" id="date-range" class="form-control" />
                        </div>
                        <div class="col-sm-12 mt-4" id="calendar-container">
                            <div id="calendar"></div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-6 mt-2">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <span class="color-sample disabled-day"></span>
                                    Días deshabilitados por calendario
                                </li>
                                <li class="list-group-item">
                                    <span class="color-sample out-of-frequency-day"></span>
                                    Días fuera de frecuencia
                                </li>
                                <li class="list-group-item">
                                    <span class="color-sample reservation-day"></span>
                                    Días Reservados
                                </li>
                                <li class="list-group-item">
                                    <span class="color-sample service-day"></span>
                                    Día con servicio
                                </li>
                                <li class="list-group-item">
                                    <span class="color-sample full-route-capacity-day"></span>
                                    Capacidad de la ruta full
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="p-3 h-100 rounded-3xl" style="border-radius: 20px; background-color: #FFFFFF">
                    <h5>Rutas disponibles</h4>
                        <ul class="mt-4" id="route_list" style="list-style-type: none;"></ul>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
