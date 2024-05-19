@extends('layouts.app')

@section('page_css')
    <style>
    </style>
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Modulo Reporteria</h3>
        </div>
        <div class="section-body">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="justify-content-center text-center">

                                <a class="btn btn-primary  btn-lg" id="btn_actualizar"><i class="fas fa-history"></i>
                                    Actualizar</a>
                                <a class="btn btn-danger  btn-lg" id=""><i class="far fa-file-pdf"></i> PDF</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="text-center">
                                <a class="btn btn-primary" id="btn_buscar">Generar</a>
                            </div>
                            <label for="rango_fechas">Fecha:</label>
                            <input class="form-control" type="date" id="fh_control" name="fh_control"><br>
                            <div class="row">
                                <div class="col-lg-6">

                                    <label for="id_area">Hora inicio:</label>
                                    <input class="form-control" type="time" id="inicio_hora" name="inicio_hora"><br>

                                </div>
                                <div class="col-lg-6">
                                    <label for="id_estado">Hora fin:</label>
                                    <input class="form-control" type="time" id="fin_hora" name="fin_hora"><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3  align-items-center justify-content-center">
                    <div class="card">
                        <div class="justify-content-center text-center">
                            <span>Gráfica Circular Horas Ingreso:</span>
                        </div>
                        <div class="card-body">
                            <div id="piechart" style="width: 100%; height: 100%;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card ">
                        <div class="justify-content-center text-center">
                            <span>Gráfica columna Horas Ingreso:</span>
                        </div>
                        <div class="card-body">
                            <div id="piechart2" style="width: 100%; height: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#btn_actualizar").click(function() {
                location.reload();
            });
        });

        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart(dataHoraInicio) {

            if (!Array.isArray(dataHoraInicio)) {
                return;
            }

            var dataHoraInicioCounts = {};
            dataHoraInicio.forEach(function(tipo) {
                dataHoraInicioCounts[tipo] = (dataHoraInicioCounts[tipo] || 0) + 1;
            });

            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Tipo');
            data.addColumn('number', 'Cantidad');
            var colors = [];
            for (var tipo in dataHoraInicioCounts) {
                var color = getRandomColor(); // Obtiene un color aleatorio
                colors.push(color); //
                data.addRow([tipo, dataHoraInicioCounts[tipo]]);
            }

            var options = {
                legend: 'none',
                pieHole: 0.4,
                colors: colors
            };
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }

        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        function drawChart2(dataHoraInicio) {

            if (!Array.isArray(dataHoraInicio)) {
                return;
            }
            var dataHoraInicioCounts = {};
            dataHoraInicio.forEach(function(tipo) {
                dataHoraInicioCounts[tipo] = (dataHoraInicioCounts[tipo] || 0) + 1;
            });

            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Tipo');
            data.addColumn('number', 'Cantidad');
            for (var tipo in dataHoraInicioCounts) {
                data.addRow([tipo, dataHoraInicioCounts[tipo]]);
            }

            var options = {
                title: 'Gráfica columna Horas Ingreso',
                legend: 'none',
            };
            var chart = new google.visualization.ColumnChart(document.getElementById('piechart2'));
            chart.draw(data, options);
        }


        $('#btn_buscar').click(function() {
            var inicio_hora = document.getElementById('inicio_hora').value;
            var fin_hora = document.getElementById('fin_hora').value;
            var fh_control = document.getElementById('fh_control').value;
            $.ajax({
                url: '{{ route('reporte_horas') }}',
                method: 'POST',
                data: {
                    inicio_hora: inicio_hora,
                    fin_hora: fin_hora,
                    fh_control: fh_control,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    var dataHoraInicio = data.map(function(item) {
                        return [item.inicio_hora, 0];
                    });
                    drawChart(dataHoraInicio);
                    drawChart2(dataHoraInicio);
                }
            });
        });
    </script>
@endsection
