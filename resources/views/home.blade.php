@extends('layouts.admin')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/sb-admin-2.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
@endpush
@section('content')
            @php        
                
                $egresados = App\Egresado::orderBy('created_at', 'desc')
                            ->where('estado','0')->get();
                
                
            @endphp

    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between">
            <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-home"></i> Página Principal</h1>
            <div class="card">
                <div class="card-body font-weight-bold ">
                     Total registrados: <i class="fas fa-file-signature"></i> <b class="text-danger" style="font-size: 18px">{{count($egresados)}}</b>
                </div>
            </div>

            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
        </div>
        <div class="row">

            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <hr>
                        <h3 >Egresados que enviaron datos</h3>
                        <p class="mb-4">Corroborar información y admitir</p>
                        <table id="egresados" class="table table-striped table-bordered dt-responsive nowrap"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>DNI</th>
                                    <th>Nombres y Apellidos</th>
                                    <th>Genero y Estado</th>
                                    <th>Telefono</th>
                                    <th>Registrado</th>
                                    <th>Trabaja</th>
                                    <th>Opciones -</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- {{dd($egreedientes)}} --}}
                                @foreach ($egresados as $egre)

                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td class="font-weight-bold">{{ $egre->id }}</td>

                                        <td>
                                            <b><i class="fas fa-user"></i> {{ $egre->nombres }}</b>
                                            <br>
                                            @php
                                                $edad = Carbon\Carbon::parse($egre->fecha_nac)->age;
                                            @endphp
                                            <span class="badge p-2 my-1 badge-light" style="font-size:14px">
                                                <i class="fas fa-hand-holding-heart"></i>
                                                {{ $edad }} años</span>
                                             
                                                @if ($egre->email)
                                                <small>
                                                    <i class="far fa-envelope"></i>
                                                    {{ $egre->email }}
                                                </small>
                                                @endif
                                            </span>
                                        </td>
                                        <td class="text-center ">
                                            <span
                                                class="badge p-2 {{ $egre->genero == 'Femenino' ? 'bg-warning' : 'badge-primary' }}">
                                                <i class="fas fa-dna"></i>
                                                {{ $egre->genero }}
                                            </span>
                                            <br>
                                            <span class="badge p-2 my-1 badge-info"><i class="fas fa-ring"></i>
                                                {{ $egre->estado_civil }}</span>

                                        </td>
                                        <td class="text-center">
                                            <a href="tel:+51{{ $egre->telefono}}" rel="nofollow" 
                                                title="Llamar" 
                                                class="text-white btn btn-success btn-sm font-weight-bold"> 
                                                <i class="fas fa-phone-volume"></i>
                                                    {{ $egre->telefono }}
                                            </a>
                                            
                                        </td>
                                        <td class="text-center">
                                            @php
                                                
                                                Carbon\Carbon::setLocale('es');
                                                $fecha = Carbon\Carbon::parse($egre->updated_at);
                                                echo '<i class="fas fa-calendar-check text-danger"></i> <span class="small font-weight-bold">' . $fecha->diffForHumans() . '</span>';
                                                $fecha = $egre->created_at;
                                                echo '<br>';
                                                $fecha_formateada = $fecha->format('d-m-Y ');
                                                echo '<b>' . $fecha_formateada . '</b>';
                                                
                                            @endphp
                                        </td>

                                        <td
                                            class="text-center text-white {{ $egre->trabaja == 'si' ? 'bg-success' : 'bg-danger' }}">
                                            {!! $egre->trabaja == 'si' ? '<i class="fas fa-check-circle fa-3x"></i>' : '<i class="fas fa-minus-circle fa-3x"></i>' !!}
                                            {{-- {{ dd($egre->titulacions->)}} --}}
                                        </td>

                                        <td class="text-center">

                                            <form action="{{ route('admin.egresado.show', $egre) }}" method="POST">
                                                @csrf
                                                <button class="btn btn-primary btn-sm float-left ml-2" title="Ver detalles"><i
                                                        class="fas fa-info-circle"></i></button>
                                            </form>
                                            <form action="{{ route('admin.egresado.aceptar', $egre) }}" method="POST">
                                                @csrf
                                                <button class="btn btn-info btn-sm float-left ml-2" title="Aceptar"><i class="far fa-check-square"></i></button>
                                            </form>
                                            @can('haveaccess', 'role.index')
                                            {{-- ELIMINAR EGRESADO --}}
                                            <form method="POST" style="display:inline"
                                                action="{{ route('admin.egresado.destroy', $egre) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm float-right mr-2"
                                                    title="Eliminar egresado"
                                                    onclick="return confirm('Estas seguro que deseas eliminar la publicación')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                            @endcan
                                            
                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>DNI</th>
                                    <th>Nombres y Apellidos</th>
                                    <th>Genero y Estado</th>
                                    <th>Telefono</th>
                                    <th>Registrado</th>
                                    <th>Trabaja</th>
                                    <th>Acciones</th>
                                </tr>
                            </tfoot>
                        </table>

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
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>

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



            //scripts table
            $('#egresados').DataTable({
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                // "order": [
                //     [4, "desc"]
                // ],

            });
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
