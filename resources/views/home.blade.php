@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Dashboard</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 col-xl-4">

                                    <div class="card bg-c-blue order-card">
                                        <div class="card-block">
                                            <h5>Usuarios</h5>
                                            @php
                                                use App\Models\User;
                                                $cant_usuarios = User::count();
                                            @endphp
                                            <h2 class="text-right"><i
                                                    class="fa fa-users f-left"></i><span>{{ $cant_usuarios }}</span></h2>
                                            <p class="m-b-0 text-right"><a href="/usuarios" class="text-white">Ver más</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-xl-4">
                                    <div class="card bg-c-green order-card">
                                        <div class="card-block">
                                            <h5>Roles</h5>
                                            @php
                                                use Spatie\Permission\Models\Role;
                                                $cant_roles = Role::count();
                                            @endphp
                                            <h2 class="text-right"><i
                                                    class="fa fa-user-lock f-left"></i><span>{{ $cant_roles }}</span></h2>
                                            <p class="m-b-0 text-right"><a href="/roles" class="text-white">Ver más</a></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-xl-4">
                                    <div class="card bg-c-pink order-card">
                                        <div class="card-block">
                                            <h5>Blogs</h5>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-xl-12">
                                    <div class="card bg-c-pink order-card">
                                        <div class="card-block">
                                            <h5>Graficas</h5>
                                            <div id="piechart" style="width: 100%; height: 100%;"></div>
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

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
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
                title: 'Grafica cantidad de usuarios'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>
@endsection
