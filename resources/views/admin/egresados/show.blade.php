@extends('layouts.admin')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/sb-admin-2.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
@endpush
@section('content')

    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Detalles del egresado: <i class="far fa-id-card"></i> {{ $egresado->id }}
            </h1>

            @if($egresado->estado == '0')
            <form action="{{ route('admin.egresado.aceptar', $egresado) }}" method="POST">
                @csrf
                <button class="btn btn-success  float-left ml-2" title="Aceptar"><i class="far fa-check-square"></i> AÑADIR A LA LISTA DE EGRESADOS VALIDADOS</button>
            </form>
            @endif
            <a href="{{ route('home') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-arrow-left fa-sm text-white-50"></i> Volver atrás</a>
        </div>
        <div class="row">

            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <hr>
                        <div class="card shadow">

                            <div class="card-body">

                                {{-- DATOS EGRESADO --}}
                                <div class="jumbotron p-3 p-md-5 text-white rounded bg-dark">
                                    <div class="row">
                                        <div class="col-md-6 px-0">
                                            <h1 class="display-4 font-italic">{{ $egresado->nombres }}</h1>
                                            <p class="lead my-3">
                                                @php
                                                    //hallar la edad
                                                    $nac = new DateTime($egresado->fecha_nac);
                                                    $act = new DateTime(date('Y-m-d'));
                                                    $interval = $nac->diff($act);
                                                @endphp


                                                <span><i class="fas fa-hand-holding-heart"></i>
                                                    {{ $interval->format('%Y años') }}</span>
                                                |
                                                <span
                                                    class="badge p-2 {{ $egresado->genero == 'Femenino' ? 'bg-secondary' : 'badge-dark' }}">
                                                    <i class="fas fa-dna"></i>
                                                    {{ $egresado->genero }}
                                                </span>
                                                |
                                                <span class="badge p-2 badge-secondary"><i class="fas fa-ring"></i>
                                                    {{ $egresado->estado_civil }}</span>
                                                |
                                                <a href="tel:+51{{ $egresado->telefono }}" class="badge badge-success p-2"
                                                    title="Llamar"><i class="fas fa-phone-volume"></i>
                                                    {{ $egresado->telefono }} </a>

                                                @if ($egresado->email)
                                                    <br> <i class="far fa-envelope"></i> {{ $egresado->email }}
                                                @endif

                                            </p>
                                        </div>
                                        <div class="col-md-6  text-center px-0 ">
                                            <h3>Estado laboral Actual</h3>
                                            <p class="lead my-3">

                                                @if ($egresado->trabaja == 'si')
                                                    <i class="fas fa-check-circle fa-3x"></i>
                                                    <br>
                                                    Trabajando

                                                @else
                                                    <i class="fas fa-minus-circle text-danger fa-3x"></i>
                                                    <br>
                                                    No Trabaja<br>
                                                    <small><i><b>Motivo:</b> {{ $egresado->motivo }}</i></small>
                                                @endif


                                            </p>
                                        </div>
                                    </div>

                                </div>
                                {{-- TITULACIÓN --}}

                                <div class="row">
                                    <div class="col-md-12 bg-light">
                                        <h3 class="pb-3 float_right">Programas de Estudios <span
                                                class="badge badge-secondary">{{ count($egresado->titulacions) }}
                                                concluido(s)</span></h3>

                                    </div>
                                </div>

                                @foreach ($egresado->titulacions as $titu)

                                    <div class="row mb-2 {{ $loop->index % 2 == 0 ? 'bg-light' : '' }}">
                                        <div class="card col-md-12">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="card mb-4 box-shadow h-md-250">
                                                            <div class="card-header">
                                                                <b
                                                                    class="float-right rounded-circle px-2 text-white  bg-primary">{{ $loop->index + 1 }}</b>
                                                                <strong class="mb-2 text-primary">Programa de
                                                                    estudios</strong>
                                                                <h3 class="">
                                                                    {{ $titu->programa }}
                                                                </h3>
                                                            </div>
                                                            <div class="card-body ">

                                                                <div
                                                                    class="mb-3 text-center  bg-secondary text-white rounded p-2 col-md-12 ">
                                                                    <b>
                                                                        Egreso:
                                                                        {{ $titu->anho_egreso }}
                                                                    </b>
                                                                </div>
                                                                <div class="mb-1 font-weight-bold " style="font-size:18px">
                                                                    @if ($titu->titulado == 'si')

                                                                        <div class="row">
                                                                            <div
                                                                                class="card shadow  mx-auto col-lg-5 col-md-12 col-sm-12 text-center">
                                                                                <div class="card-body">
                                                                                    <i
                                                                                        class="fas fa-check-circle fa-2x text-success"></i>
                                                                                    <br>
                                                                                    Titulado
                                                                                </div>

                                                                            </div>
                                                                            <div
                                                                                class="card shadow mx-auto  col-lg-5  col-md-12 col-sm-12 text-center">
                                                                                <div class="card-body">
                                                                                    <h3
                                                                                        class="font-weight-bold text-success">
                                                                                        {{ $titu->anho_titulado }}</h3>
                                                                                    Año
                                                                                </div>

                                                                            </div>
                                                                        </div>

                                                                    @else
                                                                        <div class="row">
                                                                            <div
                                                                                class="card shadow  mx-auto col-lg-5 col-md-12 col-sm-12 text-center">
                                                                                <div class="card-body">

                                                                                    <i
                                                                                        class="fas fa-check-circle fa-2x text-danger"></i>
                                                                                    <br>
                                                                                    No Titulado
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                </div>

                                                            </div>
                                                            @if ($titu->archivo)
                                                                <a href="{{ asset($titu->archivo) }}" target="_blank"
                                                                    class="btn btn-primary mx-4 mb-4 p-2">
                                                                    <i class="fas fa-file-download"></i> Descargar
                                                                    evidencias</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    {{-- {{dd($titu->centro_laborals)}} --}}
                                                    <div class="col-md-8">
                                                        @foreach ($titu->centro_laborals as $centro)
                                                            <div class="row">
                                                                <div class="card col-md-12 mb-4 box-shadow h-md-250">
                                                                    <div class="card-body ">
                                                                        <div class="row">
                                                                            <div class="col-md-5">
                                                                                <strong
                                                                                    class="d-inline-block text-secondary">Sector:
                                                                                    {{ $centro->sector }}</strong>
                                                                                @can('haveaccess', 'role.index')
                                                                                    {{-- ELIMINAR EGRESADO --}}
                                                                                    <form method="POST" style="display:inline"
                                                                                        action="{{ route('admin.centro.destroy', $centro) }}">
                                                                                        @csrf
                                                                                        @method('DELETE')
                                                                                        <button
                                                                                            class="btn btn-danger float-right mr-3"
                                                                                            title="Eliminar centro laboral"
                                                                                            onclick="return confirm('Estas seguro que deseas eliminar la publicación')">
                                                                                            <i class="fas fa-trash-alt"></i>
                                                                                        </button>
                                                                                    </form>
                                                                                @endcan
                                                                                <h3 class="text-danger">
                                                                                    Empresa: {{ $centro->nombre }}
                                                                                </h3>
                                                                                <p class="card-text mb-auto">
                                                                                    <b>Jefe laboral:</b>
                                                                                    {{ $centro->jefe_laboral }}
                                                                                    <br>
                                                                                    <b>Contacto laboral:</b>
                                                                                    {{ $centro->jefe_telefono }}

                                                                                    <span
                                                                                        class="float-left bg-success text-white rounded p-1 my-2">
                                                                                        <b>Año que labora:
                                                                                            {{ $centro->anho_labor }}</b>
                                                                                    </span>
                                                                                </p>
                                                                            </div>
                                                                            <div class="col-md-7">

                                                                                <b
                                                                                    class="float-right rounded-circle px-2 text-white  bg-secondary">{{ $loop->index + 1 }}</b>

                                                                                <div class="mb-1 text-dark"><b>Cargo actual:
                                                                                        {{ $centro->cargo }}</b></div>
                                                                                <b class="text-primary">Experiencia en la
                                                                                    empresa:</b>
                                                                                <p
                                                                                    class="card-text bg-light font-italic mb-auto p-2 border rounded">
                                                                                    "{{ $centro->descripcion }}"
                                                                                </p>

                                                                            </div>
                                                                        </div>

                                                                        {{-- <a href="#">Continue reading</a> --}}
                                                                    </div>
                                                                    {{-- <img class="card-img-right flex-auto d-none d-md-block"
                                                            data-src="holder.js/200x250?theme=thumb"
                                                            alt="Thumbnail [200x250]"
                                                            src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22200%22%20height%3D%22250%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20200%20250%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_17a984e62dd%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A13pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_17a984e62dd%22%3E%3Crect%20width%3D%22200%22%20height%3D%22250%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2256.1953125%22%20y%3D%22131%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E"
                                                            data-holder-rendered="true"
                                                            style="width: 200px; height: 250px;"> --}}
                                                                </div>

                                                            </div>

                                                        @endforeach

                                                        {{-- mensaje por si no trabaja --}}
                                                        @if (count($titu->centro_laborals) == 0)

                                                            <div class="card col-md-12">
                                                                <div class="card-body text-center">
                                                                    <br>
                                                                    <h4> <i class="fas fa-sad-tear fa-4x text-danger"></i>
                                                                        <br>El egresado no registro información sobre su
                                                                        centro de labores.
                                                                    </h4>
                                                                    <p class="text-muted">Posiblemente no este trabajando
                                                                    </p>
                                                                </div>

                                                            </div>

                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach


                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <!-- Earnings (Monthly) Card Example -->
            {{-- <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <a href="{{ route('admin.pagos.index') }}"
                                    class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Pagos Enviados</a>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <i class="fas fa-thermometer-half"></i>
                                    {{ $c_enviados }} <br>
                                    <span class="text-danger">S/. {{ number_format($s_enviados, 2) }}</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-money-bill-alt  fa-3x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}


            <!-- Earnings (Monthly) Card Example -->
            {{-- <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <a href="{{ route('admin.pagos.index_confirmados') }}"
                                    class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Pagos Confirmados</a>

                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <i class="fas fa-thermometer-half"></i>
                                    {{ $c_aceptados }}
                                    <br>
                                    <span class="text-danger">S/. {{ number_format($s_aceptados, 2) }}</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-check fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            {{-- <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <a href="{{ route('admin.pagos.index_rechazados') }}"
                                    class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Pagos Rechazados</a>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <i class="fas fa-thermometer-half"></i>
                                    {{ $c_rechazados }}
                                    <br>
                                    <span class="text-danger">S/. {{ number_format($s_rechazados, 2) }}</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-ban fa-2x text-gray-300"></i>
                               
                            </div>
                        </div>
                    </div>
                </div>

            </div> --}}

            <!-- Pending Requests Card Example -->
            {{-- <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <a href="{{ route('admin.pagos.index_bajas') }}"
                                    class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Pagos dados de bajas</a>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <i class="fas fa-thermometer-half"></i>
                                    {{ $c_bajas }}
                                    <br>
                                    <span class="text-danger">S/. {{ number_format($s_bajas, 2) }}</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-minus-circle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}



        </div>


        <div class="row d-none">
            <!-- Area Chart -->
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">ESTADISTICA DE PAGOS</h6>
                        <div class="dropdown no-arrow">
                            {{-- <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a> --}}
                            {{-- <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Dropdown Header:</div>
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div> --}}
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="myAreaChart" style="width:100% !important;height:100% !important;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- <script src="{{ asset('js/sb-admin-2.min.js') }}"></script> --}}


    <script src="{{ asset('js/Chart.min.js') }}"></script>


    <script>
        var pagos = [];
        var valores = [];
        var contador = 0;
        var mes = new Intl.DateTimeFormat('es-ES', {
            month: 'long'
        }).format(new Date());

        //actualizar 
        function actualizar() {
            location.reload(true);
        }
        //Función para actualizar cada 5 segundos(5000 milisegundos)
        // setInterval("actualizar()", 5000);

        // var d = new Date(); 
        // var mes = d.getMonth()+1;


        $(document).ready(function() {




            //funcion ajax para contar los nuevos expedientes
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $.ajax({
                type: "POST",
                url: "{{ route('admin.pago.graficos') }}",
                data: {
                    codigo: '1'
                },
                //correcto
                // success: function(data) {
                //     alert("Se ha realizado el POST con exito " + data);
                //     // $("#nuevos_tramites").text(data);
                // }
                //correcto
            }).done(function(data) {
                // alert("hola"+data);
                // console.log(data);
                var arreglo = JSON.parse(data);
                // for (x = 0; x < arreglo.length; x++) {
                //     pagos.push(arreglo[x].tupa_id);
                //     valores.push(arreglo[x].tupa_id);
                // }
                for (x = 0; x < arreglo.length; x++) {
                    contador++;
                }
                pagos.push(mes);
                valores.push(contador);
                generarGrafica();
            });


            //fun de ajax

            //inicio de chart.js



        });

        function generarGrafica() {
            var ctx = document.getElementById('myAreaChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: pagos,
                    datasets: [{
                        label: 'Reporte de pagos ACEPTADOS',
                        data: valores,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,

                        }
                    }
                }
            });

        }
    </script>
@endpush
