Swal.setDefaults({
    backdrop: false // Desactiva el backdrop por defecto
});

document.addEventListener('DOMContentLoaded', function () {
    const tipoReporteSelect = document.getElementById('tipo_reporte');
    const fechaInicioGroup = document.getElementById('fecha_inicio_group');
    const fechaFinGroup = document.getElementById('fecha_fin_group');
    const medicoGroup = document.getElementById('medico_group');
    const tipoServicio = document.getElementById('tipo_servicio');
    const generarReporteBtn = document.getElementById('generar_reporte_btn');

    // Función para obtener el título del reporte según el tipo seleccionado
    function obtenerTituloReporte() {
        const tipoReporte = tipoReporteSelect.value;
        switch (tipoReporte) {
            case 'total_atenciones':
                return 'Reporte de Total de Atenciones';
            case 'consultas_por_medico':
                return 'Reporte de Consultas por Médico';
            case 'consultas_pendientes':
                return 'Reporte de Consultas Pendientes';
            case 'pacientes_por_servicio':
                return 'Reporte de Pacientes por Servicio';
            case 'consultas_por_mes':
                return 'Reporte de Consultas por Mes';
            default:
                return 'Reporte de Consultas';
        }
    }

    // Función para mostrar la tabla con los datos
    function mostrarTabla(data) {
        // Mostrar la tabla
        document.getElementById('tablaConsultas').style.display = 'block';

        // Limpiar la tabla antes de agregar nuevos datos
        $('#consultasTable').DataTable().clear().destroy();

        // Inicializar DataTable con la configuración deseada
        var table = $('#consultasTable').DataTable({
            data: data, // Usar la data devuelta por el servidor
            columns: [{
                data: null, // Cambiar a null para manejar la lógica en render
                title: 'Nombre',
                render: function (data) {
                    return data.nombre_completo ?? data.paciente.nombre_completo;
                }
            },
            {
                data: null, // Cambiar a null para manejar la lógica en render
                title: 'DNI',
                render: function (data) {
                    return data.dni ?? data.paciente.dni;
                }
            },
            {
                data: 'motivo',
                title: 'Motivo',
                render: function (data) {
                    return data ? data : 'Pendiente'; // Si data está vacío, muestra 'Pendiente'
                }
            },
            {
                data: 'diagnosticoprin',
                title: 'Diagnóstico',
                render: function (data) {
                    return data ? data : 'Pendiente'; // Si data está vacío, muestra 'Pendiente'
                }
            },
            {
                data: 'created_at',
                title: 'Fecha',
                render: function (data, type, row) {
                    // Formatear la fecha
                    const fecha = new Date(data);
                    const dia = String(fecha.getDate()).padStart(2, '0');
                    const mes = String(fecha.getMonth() + 1).padStart(2, '0');
                    const año = fecha.getFullYear();
                    const horas = String(fecha.getHours()).padStart(2, '0');
                    const minutos = String(fecha.getMinutes()).padStart(2, '0');
                    const segundos = String(fecha.getSeconds()).padStart(2, '0');
                    return `${dia}/${mes}/${año} ${horas}:${minutos}:${segundos}`;
                }
            }
            ],
            dom: 'Blfrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: 'Exportar a Excel',
                    title: function () {
                        return obtenerTituloReporte(); // Título dinámico según el tipo de reporte
                    },
                    className: 'btn btn-success' // Clase para el botón de Excel
                },
                {
                    extend: 'pdfHtml5',
                    text: 'Exportar a PDF',
                    title: function () {
                        return obtenerTituloReporte(); // Título dinámico según el tipo de reporte
                    },
                    className: 'btn btn-danger',
                }
            ],
            lengthMenu: [
                [10, 20, 30, -1],
                [10, 20, 30, "Todos"]
            ],
            scrollX: true, // Habilita el scroll horizontal
            scrollY: '400px', // Habilita el scroll vertical con una altura fija
            scrollCollapse: true, // Colapsa la tabla si los datos no llenan el espacio
            language: {
                "decimal": "",
                "emptyTable": "Ningún dato disponible en esta tabla",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(Filtrado de un total de _MAX_ registros)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ registros",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "",
                "zeroRecords": "No se encontraron resultados",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
                "aria": {
                    "sortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            },
            initComplete: function () {
                // Personalizar el input de búsqueda
                var searchInput = $('.dataTables_filter input')
                    .attr('placeholder', 'Buscar...')
                    .css({
                        'margin-left': '10px',
                        'flex': '1'
                    });

                // Agregar el ícono de lupa y el texto "Nombre:"
                $('.dataTables_filter label').html(
                    'Nombre: <i class="fas fa-search"></i>'
                ).append(searchInput);

                // Asegurar que el input de búsqueda siga funcionando
                searchInput.on('keyup', function () {
                    table.search(this.value).draw();
                });
            }
        });
    }

    function generarReporteConsultasPorMes() {
        const mes = document.getElementById('mes').value;
        const anio = document.getElementById('anio').value;

        if (!mes || !anio) {
            Swal.fire('Alerta', 'Selecciona un mes y un año válidos.', 'warning');
            return;
        }

        $.ajax({
            url: 'reporteConsultasPorMes',
            type: 'GET',
            data: {
                mes,
                anio
            },
            success: function (response) {
                mostrarTabla(response.data);
            },
            error: function (error) {
                console.error(error);
            }
        });
    }

    // Función para generar reporte de consultas por médico
    function generarReportePorMedico() {
        const medico_id = document.getElementById('medico_id').value;
        const fecha_inicio = document.getElementById('fecha_inicio').value;
        const fecha_fin = document.getElementById('fecha_fin').value;

        if (!medico_id) {
            Swal.fire('Alerta', 'Selecciona un médico.', 'warning');
            return;
        }

        if (!fecha_inicio || !fecha_fin) {
            Swal.fire('Alerta', 'Selecciona un rango de fechas válido.', 'warning');
            return;
        }

        if (new Date(fecha_inicio) > new Date(fecha_fin)) {
            Swal.fire('Alerta', 'La fecha de inicio no puede ser mayor que la fecha de fin.', 'warning');
            return;
        }

        $.ajax({
            url: 'reportePorMedico',
            type: 'GET',
            data: {
                medico_id,
                fecha_inicio,
                fecha_fin
            },
            success: function (response) {
                mostrarTabla(response.data);
            },
            error: function (error) {
                console.error(error);
            }
        });
    }

    function generarReporteTotalAtenciones() {
        const fecha_inicio = document.getElementById('fecha_inicio').value;
        const fecha_fin = document.getElementById('fecha_fin').value;

        if (!fecha_inicio || !fecha_fin) {
            Swal.fire('Alerta', 'Selecciona un rango de fechas válido.', 'warning');
            return;
        }

        if (new Date(fecha_inicio) > new Date(fecha_fin)) {
            Swal.fire('Alerta', 'La fecha de inicio no puede ser mayor que la fecha de fin.', 'warning');
            return;
        }

        $.ajax({
            url: 'reporteTotalAtenciones',
            type: 'GET',
            data: {
                fecha_inicio,
                fecha_fin
            },
            success: function (response) {
                mostrarTabla(response.data);
            },
            error: function (error) {
                console.error(error);
            }
        });
    }

    // Función para generar reporte de consultas pendientes
    function generarReporteConsultasPendientes() {
        $.ajax({
            url: 'reporteConsultasPendientes',
            type: 'GET',
            success: function (response) {
                mostrarTabla(response.data);
            },
            error: function (error) {
                console.error(error);
            }
        });
    }

    function generarReporteTipoServicio() {
        const servicio_id = document.getElementById('servicio_id').value;

        if (!servicio_id) {
            Swal.fire('Alerta', 'Selecciona un tipo de servicio.', 'warning');
            return;
        }

        $.ajax({
            url: 'reporteTipoServicio',
            type: 'GET',
            data: {
                servicio_id
            },
            success: function (response) {
                mostrarTabla(response.data);
            },
            error: function (error) {
                console.error(error);
            }
        });
    }

    tipoReporteSelect.addEventListener('change', function () {
        const selectedOption = tipoReporteSelect.value;

        // Mostrar u ocultar campos de fecha
        if (selectedOption === '' || selectedOption === 'consultas_pendientes') {
            fechaInicioGroup.style.display = 'none';
            fechaFinGroup.style.display = 'none';
            mesGroup.style.display = 'none'; // Ocultar campo de mes
            anioGroup.style.display = 'none'; // Mostrar campo de año
            tipoServicio.style.display = 'none'; // Ocultar campo de tipo de servicio
        } else if (selectedOption === 'consultas_por_mes') {
            fechaInicioGroup.style.display = 'none';
            fechaFinGroup.style.display = 'none';
            mesGroup.style.display = 'block'; // Mostrar campo de mes
            anioGroup.style.display = 'block'; // Mostrar campo de año
            tipoServicio.style.display = 'none'; // Ocultar campo de tipo de servicio
        } else if (selectedOption === 'pacientes_por_servicio') {
            fechaInicioGroup.style.display = 'none';
            fechaFinGroup.style.display = 'none';
            mesGroup.style.display = 'none'; // Ocultar campo de mes
            anioGroup.style.display = 'none'; // Mostrar campo de año
            tipoServicio.style.display = 'block'; // Mostrar campo de tipo de servicio
        } else {
            fechaInicioGroup.style.display = 'block';
            fechaFinGroup.style.display = 'block';
            mesGroup.style.display = 'none'; // Ocultar campo de mes
            anioGroup.style.display = 'none'; // Mostrar campo de año
            tipoServicio.style.display = 'none'; // Ocultar campo de tipo de servicio
        }

        // Mostrar u ocultar select de médicos
        if (selectedOption === 'consultas_por_medico') {
            medicoGroup.style.display = 'block';
        } else {
            medicoGroup.style.display = 'none';
        }

        // Asignar una función diferente al botón según la opción seleccionada
        switch (selectedOption) {
            case 'total_atenciones':
                generarReporteBtn.onclick = generarReporteTotalAtenciones;
                break;
            case 'consultas_por_medico':
                generarReporteBtn.onclick = generarReportePorMedico;
                break;
            case 'consultas_pendientes':
                generarReporteBtn.onclick = generarReporteConsultasPendientes;
                break;
            case 'pacientes_por_servicio':
                generarReporteBtn.onclick = generarReporteTipoServicio;
                break;
            case 'consultas_por_mes':
                generarReporteBtn.onclick = generarReporteConsultasPorMes;
                break;
            default:
                generarReporteBtn.onclick = function () {
                    Swal.fire('Alerta', 'Selecciona un tipo de reporte válido', 'warning');
                };
        }
    });

    // Inicializar la función del botón con un valor por defecto
    generarReporteBtn.onclick = function () {
        Swal.fire('Alerta', 'Selecciona un tipo de reporte válido', 'warning');
    };
});
