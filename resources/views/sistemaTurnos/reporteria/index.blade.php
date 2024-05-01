@extends('layouts.app')

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
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary btn-lg"> <i
                                            class="fas fa-street-view">Nuevo</i></button>
                                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                        data-toggle="dropdown" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item " href=" "><i class="fas fa-street-view"></i> Nueva
                                            Alta</a>
                                        <a class="dropdown-item " href=" "><i class="fas fa-business-time"></i> Nueva
                                            baja</a>
                                    </div>
                                </div>
                                <a class="btn btn-primary  btn-lg" id="btn_actualizar"><i class="fas fa-history"></i>
                                    Actualizar</a>
                                <a class="btn btn-danger  btn-lg" id=""><i class="far fa-file-pdf"></i> PDF</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 col-xl-4">
                                    <div class="card bg-c-bla order-card">
                                        <div class="card-block">
                                            <h5>Usuarios</h5>

                                            <div id="piechart" style="width: 100%; height: 100%;"></div>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
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

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['Work', 11],
                ['Eat', 2],
                ['Commute', 2],
                ['Watch TV', 2],
                ['Sleep', 7]
            ]);

            var options = {
                title: 'Grafica cantidad de usuarios',
                backgroundColor: 'black'
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>
@endsection
