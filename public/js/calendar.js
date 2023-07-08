const routes = {
    getRoute: "/api/v1/routes/get/:id",
    getRoutes: "/api/v1/routes/get",
    getCalendar: "/api/v1/calendar/get",
};

let calendar = null;
let routeData = null;

$(function () {
    renderCalendar();
    getRoutes(moment().format("DD/MM/YYYY"), moment().format("DD/MM/YYYY"));

    $("#date-range").daterangepicker({
        todayHighlight: true,
        minViewMode: 1,
        maxViewMode: 1,
        opens: "left",
        locale: {
            format: "DD/MM/YYYY",
            separator: " - ",
            applyLabel: "Aplicar",
            cancelLabel: "Cancelar",
            fromLabel: "Desde",
            toLabel: "Hasta",
            customRangeLabel: "Rango personalizado",
            weekLabel: "W",
            daysOfWeek: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
            monthNames: [
                "Enero",
                "Febrero",
                "Marzo",
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Septiembre",
                "Octubre",
                "Noviembre",
                "Diciembre",
            ],
            firstDay: 0,
        },
    });

    $("#date-range").on("apply.daterangepicker", function (ev, picker) {
        let start = picker.startDate.format("DD/MM/YYYY");
        let end = picker.endDate.format("DD/MM/YYYY");

        getRoutes(start, end);
    });

    $("#route_list").on("click", "li a", function (event) {
        event.preventDefault();
        let id = $(this).data("id");
        refreshCalendar();

        $.ajax({
            type: "GET",
            url: routes.getRoute.replace(":id", id),
            data: {},
            success: function (res) {
                routeData = res.route;
                renderCalendar();
            },
            error: function (xhr, status, error) {
                toastr.error(
                    "Se produjo un error al intentar obtener los detalles de la ruta"
                );
            },
        });
    });
});

const getRoutes = (start, end) => {
    $.ajax({
        type: "GET",
        url: routes.getRoutes,
        data: {
            start_date: start,
            end_date: end,
        },
        success: function (res) {
            $("#route_list").empty();
            $.each(res, function (k, v) {
                let listItem = $("<li></li>");
                let anchor = $('<a href="#"></a>')
                    .text(v.title)
                    .attr("data-id", v.id)
                    .appendTo(listItem);

                $("#route_list").append(listItem);
            });
        },
        error: function (xhr, status, error) {
            toastr.error("Se produjo un error al intentar obtener las rutas");
        },
    });
};

const initializeCalendar = () => {
    let initDate;

    if (routeData) {
        initDate = moment(routeData.range.date_init);
    } else {
        initDate = moment().format("YYYY-MM-DD");
    }
    calendar = $("#calendar").fullCalendar({
        locale: "es",
        selectable: false,
        defaultDate: initDate,
        buttonText: {
            today: "Hoy",
        },
        dayNames: [
            "Domingo",
            "Lunes",
            "Martes",
            "Miércoles",
            "Jueves",
            "Viernes",
            "Sábado",
        ],
        dayNamesShort: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"],
        monthNames: [
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Septiembre",
            "Octubre",
            "Noviembre",
            "Diciembre",
        ],
        monthNamesShort: [
            "Ene",
            "Feb",
            "Mar",
            "Abr",
            "May",
            "Jun",
            "Jul",
            "Ago",
            "Sep",
            "Oct",
            "Nov",
            "Dic",
        ],
        dayRender: function (date, cell) {
            renderDay(date, cell);
        },
    });
};

const refreshCalendar = () => {
    // Destruye el calendario existente antes de volver a inicializarlo
    if (calendar) {
        calendar.fullCalendar("destroy");
    }
};

const renderCalendar = () => {
    initializeCalendar();
    // Realizar renderizado adicional del calendario según los datos de la ruta
};

const renderDay = (date, cell) => {
    date.locale("en");

    if (routeData) {

        const day = moment(date).format("YYYY-MM-DD");
        const date_init = moment(routeData.range.date_init);
        const date_end = moment(routeData.range.date_finish);

        if (moment(day).isBetween(date_init, date_end, "day", [])) {
            cell.addClass("route");
            console.log(day)

            //Days disabled
            const daysDisabled = routeData.days_disabled;
            if (daysDisabled.includes(day)) {
                cell.addClass("disabled-day");
            }

            //Frequency days
            let dayOfWeek = date.format("ddd").toLowerCase();
            if (routeData.frequency_days[dayOfWeek] === 0) {
                cell.addClass("out-of-frequency-day");
            }

            //Reservation days
            const reservationDays = routeData.reservation_days;
            reservationDays.forEach((day) => {
                const date_init = moment(day.start);
                const date_end = moment(day.end);

                if (date.isSameOrAfter(date_init, "day") && date.isSameOrBefore(date_end, "day")) {
                    cell.addClass("reservation-day");
                }
            });

            //Service days
            const serviceDays = routeData.service_days;
            if (serviceDays.includes(day)) {
                cell.addClass("service-day");
            }

            //Full route capacity days
            const fullRouteCpacityDays = routeData.full_route_capacity_days;
            if (fullRouteCpacityDays.includes(day)) {
                // console.log(day, "disabled");
                cell.addClass("full-route-capacity-day");
            }

            moment(day).isBetween(date_init, date_end, "day");

        }

        const currentDate = moment().format("YYYY-MM-DD");
        const dayDate = date.format("YYYY-MM-DD");

        if (currentDate === dayDate) {
        }
    }
};
