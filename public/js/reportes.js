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

    // Función para limpiar los campos y el DataTable
    function limpiarCampos() {
        // Limpiar campos de fecha
        document.getElementById('fecha_inicio').value = '';
        document.getElementById('fecha_fin').value = '';

        // Limpiar campo de mes y año (si existen)
        document.getElementById('mes').value = '';
        document.getElementById('anio').value = '';

        // Limpiar select de médico (si existe)
        document.getElementById('medico_id').value = '';

        // Limpiar select de servicio (si existe)
        document.getElementById('servicio_id').value = '';

        // Limpiar el DataTable
        if ($.fn.DataTable.isDataTable('#consultasTable')) {
            $('#consultasTable').DataTable().clear().destroy();
        }

        // Ocultar la tabla
        document.getElementById('tablaConsultas').style.display = 'none';
    }

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
            columns: [
                {
                    data: null,
                    title: 'Departamento',
                    render: function (data) {
                        return data.paciente?.departamento?.nombre ?? 'Pendiente';
                    }
                },
                {
                    data: null,
                    title: 'Provincia',
                    render: function (data) {
                        return data.paciente?.provincia?.nombre ?? 'Pendiente';
                    }
                },
                {
                    data: null,
                    title: 'Distrito',
                    render: function (data) {
                        return data.paciente?.distrito?.nombre ?? 'Pendiente';
                    }
                },
                {
                    data: null,
                    title: 'Ubicación Geográfica',
                    render: function (data) {
                        return data.paciente?.ubi_geo?.nombre ?? 'Pendiente';
                    }
                },
                {
                    data: null,
                    title: 'Gobierno Local',
                    render: function (data) {
                        return data.paciente?.gob_local?.nombre ?? 'Pendiente';
                    }
                },
                {
                    data: null,
                    title: 'Código Historia',
                    render: function (data) {
                        return data.paciente?.nrohistoria ?? 'Pendiente';
                    }
                },
                {
                    data: null,
                    title: 'Ubicación Historia',
                    render: function (data) {
                        return data.paciente?.ubihistoria ?? 'Pendiente';
                    }
                },
                {
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
                    data: null,
                    title: 'Género',
                    render: function (data) {
                        return data.genero != null
                            ? (data.genero == 'M' ? 'Masculino' : 'Femenino')
                            : (data.paciente?.genero == 'M' ? 'Masculino' : 'Femenino');
                    }
                },
                {
                    data: null,
                    title: 'Fecha de Nacimiento',
                    render: function (data) {
                        // Verificar si la fecha de nacimiento existe
                        if (data.paciente?.fecha_nac) {
                            // Crear un objeto Date a partir de la fecha
                            const fecha = new Date(data.paciente.fecha_nac);

                            // Extraer día, mes y año
                            const dia = String(fecha.getDate()).padStart(2, '0'); // Día con 2 dígitos
                            const mes = String(fecha.getMonth() + 1).padStart(2, '0'); // Mes con 2 dígitos (los meses van de 0 a 11)
                            const año = fecha.getFullYear(); // Año con 4 dígitos

                            // Formatear la fecha como "día/mes/año"
                            return `${dia}/${mes}/${año}`;
                        } else {
                            // Si no hay fecha de nacimiento, mostrar "Pendiente"
                            return 'Pendiente';
                        }
                    }
                },
                {
                    data: null,
                    title: 'Dirección',
                    render: function (data) {
                        return data.paciente?.direccion ?? 'Pendiente';
                    }
                },
                {
                    data: null,
                    title: 'Tipo de Seguro',
                    render: function (data) {
                        return (data.tiposeguro == 1 ? 'Particular' : 'CIS') ?? 'Pendiente';
                    }
                },
                {
                    data: null,
                    title: 'Especialidad',
                    render: function (data) {
                        return data.especialidad?.nombre ?? 'Pendiente';
                    }
                },
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
                    orientation: 'landscape', // Orientación horizontal
                    pageSize: 'A4', // Tamaño de la página
                    customize: function (doc) {
                        // Personalización adicional del PDF
                        doc.defaultStyle.fontSize = 6;
                        doc.styles.tableHeader.fontSize = 6;
                        doc.styles.tableHeader.alignment = 'center';
                        doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                    }
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

        // Limpiar campos y DataTable
        limpiarCampos();

        // Mostrar u ocultar campos de fecha
        if (selectedOption === '' || selectedOption === 'consultas_pendientes') {
            fechaInicioGroup.style.display = 'none';
            fechaFinGroup.style.display = 'none';
            mesGroup.style.display = 'none'; // Ocultar campo de mes
            anioGroup.style.display = 'none'; // Ocultar campo de año
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
            anioGroup.style.display = 'none'; // Ocultar campo de año
            tipoServicio.style.display = 'block'; // Mostrar campo de tipo de servicio
        } else {
            fechaInicioGroup.style.display = 'block';
            fechaFinGroup.style.display = 'block';
            mesGroup.style.display = 'none'; // Ocultar campo de mes
            anioGroup.style.display = 'none'; // Ocultar campo de año
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
