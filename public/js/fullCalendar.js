let calendar = null;
let routeData = null;

$(function () {
    renderCalendar();
});

const renderCalendar = () => {
    calendar = $("#calendar").fullCalendar({
        locale: "es",
        selectable: false,
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

// Función para volver a renderizar el calendario
const reRenderCalendar = () => {
    if (calendar) {
        calendar.fullCalendar("destroy"); // Destruir el calendario existente
        renderCalendar(); // Volver a inicializar el calendario
    }
    routeData = true;
};

function renderDay(date, cell) {
    if (routeData) {
        // console.log(routeData);
        console.log("Con datos de ruta");
    } else {
        console.log("Sin datos de ruta");
    }

    // Obtenemos la fecha actual en formato YYYY-MM-DD
    var currentDate = moment().format("YYYY-MM-DD");

    // Obtenemos la fecha del día actual en formato YYYY-MM-DD
    var dayDate = date.format("YYYY-MM-DD");
    // cell.addClass('disabled');
    if (currentDate === dayDate) {
        cell.addClass('disabled');
        // cell.addClass("color");
        console.log(date, cell);
    }
}
