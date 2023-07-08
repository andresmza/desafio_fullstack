const routes = {
    get_route: "/api/v1/routes/get/:id",
    get_routes: "/api/v1/routes/get",
    get_calendar: "/api/v1/calendar/get",
};

$(function () {

    getRoutes(moment().format('DD/MM/YYYY'), moment().format('DD/MM/YYYY'));

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
        var start = picker.startDate.format("DD/MM/YYYY");
        var end = picker.endDate.format("DD/MM/YYYY");

        getRoutes(start, end);
    });

    // anchor.on('click', function(event) {
    //     var id = $(this).data('id');
    //     // Aquí puedes realizar otra petición al servidor con el ID recuperado
    //     console.log('ID:', id);
    // });

    $('#route_list').on('click', 'li a', function(event) {
        event.preventDefault();
        var id = $(this).data('id');
        // Aquí puedes realizar las acciones necesarias con el ID recuperado
        console.log('ID:', id);

        $.ajax({
            type: "GET",
            url: routes.get_route.replace(':id', id),
            data: {
                // start_date: start,
                // end_date: end,
            },
            success: function(res) {
                
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
        url: routes.get_routes,
        data: {
            start_date: start,
            end_date: end,
        },
        success: function(res) {
            $("#route_list").empty();
            $.each(res, function(k, v) {
                var listItem = $('<li></li>');
                var anchor = $('<a href="#"></a>')
                    .text(v.title)
                    .attr('data-id', v.id)
                    .appendTo(listItem);
                
                $("#route_list").append(listItem);
            });
        },
        // success: function (res) {
        //     $("#route_list").empty();
        //     $.each(res, function (k, v) {
        //         $("#route_list").append(
        //             `<li><a href="#">${v.title}</a></li>`
        //         );
        //     });
        // },
        error: function (xhr, status, error) {
            toastr.error(
                "Se produjo un error al intentar obtener las rutas"
            );
        },
    });
}