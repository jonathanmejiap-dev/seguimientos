@extends('plantilla')
@section('titulo', 'SEGUIMIENTO DE EGRESADOS -IESTP SDM')

@section('contenido')
    <div class="container">
        <div class="py-2 text-center">

            {{-- <div class="title m-b-md font-weight-bold">
                SEGUIMIENTO DE EGRESADOS
            </div> --}}
            <h1>SEGUIMIENTO DE EGRESADOS</h1>
            <p class="lead"><b class="font-weight-bold">IESTP Señor de la divina misericordia</b>.</p>
        </div>


        <div class="row">
            <div class="col-md-8 order-md-1 py-4">
                <div class="card">
                    <div class="card-header text-white bg-primary ">
                        <h4 class="font-weight-bold pt-2">Formulario de seguimiento a egresados</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('egresado.store') }}" method="POST" enctype="multipart/form-data"
                            class="needs-validation">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="font-weight-bold text-primary">Datos del egresado</h4>
                                </div>
                                <div class="col-md-4  mb-3">
                                    <label for="username" class="font-weight-bold">DNI <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-address-card"></i></span>
                                        </div>
                                        <input type="text" class="form-control @error('dni') is-invalid @enderror"
                                            name="dni" id="dni" value="{{ old('dni') }}"
                                            required="required">
                                        @error('dni')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label for="nombres" class="font-weight-bold">Nombres y apellidos <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nombres') is-invalid @enderror"
                                        name="nombres" id="nombres" 
                                        value="{{ old('nombres') }}" required>
                                    {{-- <small class="text-muted">Nombres y apellidos completos.</small> --}}
                                    @error('nombres')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="telefono" class="font-weight-bold">Teléfono <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                                        </div>
                                        <input type="text" class="form-control @error('telefono') is-invalid @enderror"
                                            value="{{ old('telefono') }}" name="telefono" id="telefono"
                                            placeholder="923121314" required>
                                        @error('telefono')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-8 mb-3">
                                    <label for="email" class="font-weight-bold">Email <span
                                            class="text-muted">(Opcional)</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input type="email" class="form-control " value="{{ old('email') }}" 
                                            name="email"
                                            id="email" placeholder="tu@correo.com">

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="genero" class="font-weight-bold">Género <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-male"></i></span>
                                        </div>
                                        <select class="form-control @error('genero') is-invalid @enderror" 
                                            name="genero"
                                            id="genero" required>
                                            <option value="">Seleccionar</option>
                                            <option value="Femenino" >Femenino</option>
                                            <option value="Masculino">Masculino</option>
                                        </select>
                                        @error('genero')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="estado_civil" class="font-weight-bold">Estado civil <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-ring"></i></span>
                                        </div>
                                        <select class="form-control @error('estado_civil') is-invalid @enderror"
                                            name="estado_civil" id="estado_civil" required>

                                            <option value="">Seleccionar</option>
                                            <option value="Soltero" >Soltero</option>
                                            <option value="Casado">Casado</option>
                                            <option value="Viudo">Viudo</option>
                                            <option value="Divorciado">Divorciado</option>
                                        </select>
                                        @error('estado_civil')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror

                                    </div>

                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="fecha_nac" class="font-weight-bold">Fecha de nacimiento </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-birthday-cake"></i></span>
                                        </div>
                                        <input type="date" class="form-control " value="{{ old('fecha_nac') }}"
                                            name="fecha_nac" id="fecha_nac" placeholder="01/01/2000" required>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <hr>
                                    <h4 class="font-weight-bold text-primary">Datos del programa de estudios</h4>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label for="programa_estudios" class="font-weight-bold">Programa de estudios: <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fab fa-firstdraft"></i></span>
                                        </div>
                                        <select class="form-control @error('programa_estudios') is-invalid @enderror"
                                            name="programa_estudios" id="programa_estudios">
                                            <option value="">Seleccionar</option>
                                            <option value="Computación e informática">Computación e informática</option>
                                            <option value="Industrias alimentarias">Industrias alimentarias</option>
                                        </select>
                                        @error('programa_estudios')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror

                                    </div>

                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="anho_egreso" class="font-weight-bold">Año que egreso: <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                                        </div>
                                        <select class="form-control @error('anho_egreso') is-invalid @enderror"
                                            name="anho_egreso" id="anho_egreso">
                                            <option value="">Seleccionar</option>

                                            @for ($i = date('Y'); $i >= 1997; $i--)
                                                <option value="{{ $i }}" {{ $i == old('anho_egreso') ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                        @error('anho_egreso')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror

                                    </div>

                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="titulado" class="font-weight-bold">Titulado: <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-file-invoice"></i></span>
                                        </div>
                                        <select class="form-control @error('titulado') is-invalid @enderror" 
                                            name="titulado"
                                            id="titulado">
                                            <option value="">Seleccionar</option>
                                            <option value="SI">Sí</option>
                                            <option value="NO">No</option>

                                        </select>
                                        @error('titulado')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror

                                    </div>
                                </div>


                                <div class="col-md-6 mb-3">
                                    <div class="anho_titulado" style="display: none">
                                        <label for="anho_titulo" class="font-weight-bold">Año de titulación: </label>
                                        <div class="input-group ">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-calendar-check"></i></span>
                                            </div>
                                            <select class="form-control @error('anho_titulo') is-invalid @enderror"
                                                name="anho_titulo" id="anho_titulo">
                                                <option value="">Seleccionar</option>

                                                {{-- @for ($i = date('Y'); $i >= 1997; $i--)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor --}}
                                            </select>
                                            @error('anho_titulo')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror

                                        </div>
                                        {{-- <small class="text-muted">Seleccionar el trámite que usted realizará.</small> --}}
                                    </div>

                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="archivo" class="font-weight-bold">Adjuntar evidencia </label>
                                    <div class="custom-file">
                                        <input type="file" name="archivo" value="{{ old('archivo') }}"
                                            class="custom-file-input @error('archivo') is-invalid @enderror"
                                            id="customFile">
                                        <label class="custom-file-label" for="customFile">Seleccionar archivo</label>
                                    </div>
                                    @error('archivo')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                    <small class="text-muted">Adjuntar titulo profesional (De tenerlo).</small>

                                </div>

                            </div>

                            {{-- DATOS DONDE LABORA --}}
                            <div class="row">
                                <div class="col-md-12">
                                    <hr>
                                    <h4 class="font-weight-bold text-primary">Datos del centro laboral</h4>
                                </div>
                                <div class="col-md-12  pb-3">
                                    <label for="trabaja" class="font-weight-bold">¿Actualmente trabaja? <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
                                        </div>
                                        <select class="form-control @error('trabaja') is-invalid @enderror" name="trabaja"
                                            id="trabaja">
                                            <option value="">Seleccionar</option>
                                            <option value="SI" >Sí</option>
                                            <option value="NO">No</option>

                                        </select>
                                        @error('trabaja')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror

                                    </div>
                                </div>

                                
                            </div>
                            <div class="row centro_laboral" style="display:none">
                                <div class="col-md-8  mb-3">
                                    <label for="nombre_laboral" class="font-weight-bold">Nombre de la institución donde
                                        laboras</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-building"></i></span>
                                        </div>
                                        <input type="text" class="form-control @error('nombre_laboral') is-invalid @enderror"
                                            name="nombre_laboral" id="nombre_laboral" value="{{ old('nombre_laboral') }}"
                                            placeholder="Hidrandina S.A">
                                        @error('nombre_laboral')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <small class="text-muted">Unimaq S.A | INEI | Municipalidad de Lima | RAGGERX E.I.R.L,
                                        etc. </small>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="sector" class="font-weight-bold">Sector <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-sitemap"></i></span>
                                        </div>
                                        <select class="form-control @error('sector') is-invalid @enderror"
                                            name="sector" id="sector">
                                            <option value="">Seleccionar</option>
                                            <option value="publico" >Público</option>
                                            <option value="privado">Privado</option>
                                        </select>
                                        @error('sector')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror

                                    </div>

                                </div>

                                <div class="col-md-8 mb-3">
                                    <label for="cargo_laboral" class="font-weight-bold">Cargo actual</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                                        </div>
                                        <input type="text" class="form-control @error('cargo_laboral') is-invalid @enderror"
                                            name="cargo_laboral" id="cargo_laboral" placeholder="Técnico informático"
                                            value="{{ old('cargo_laboral') }}">
                                    </div>
                                    <small class="text-muted">Técnico informático | Jefe de informática | Supervisor
                                        Alimentario, etc.</small>
                                    @error('cargo_laboral')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="anho_labor" class="font-weight-bold">Año que laboró</label>
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
                                        </div>
                                        <select class="form-control @error('anho_labor') is-invalid @enderror"
                                            name="anho_labor" id="anho_labor">
                                            <option value="">Seleccionar</option>
                                            @for($i=date('Y'); $i>=1997; $i--)
                                            <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                        @error('anho_labor')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror

                                    </div>

                                </div>

                                

                                <div class="col-md-6 mb-3">
                                    <label for="jefe_laboral" class="font-weight-bold">Jefe inmediato</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-mask"></i></span>
                                        </div>
                                        <input type="text" class="form-control @error('jefe_laboral') is-invalid @enderror"
                                            name="jefe_laboral" id="jefe_laboral" placeholder=""
                                            value="{{ old('jefe_laboral') }}" >
                                    </div>
                                    <small class="text-muted">Jefe inmediato en el centro de trabajo.</small>
                                    @error('jefe_laboral')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="jefe_telefono" class="font-weight-bold">Teléfono Jefe inmediato</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input type="text" class="form-control @error('jefe_telefono') is-invalid @enderror"
                                            name="jefe_telefono" id="jefe_telefono" placeholder=""
                                            value="{{ old('jefe_telefono') }}" >
                                    </div>
                                    <small class="text-muted">Para temas de monitoreo y validación de datos.</small>
                                    @error('jefe_telefono')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="descripcion_laboral" class="font-weight-bold">Descripción de la
                                        expeciencia laboral: </label>
                                    <textarea class="form-control @error('descripcion_laboral') is-invalid @enderror"
                                        name="descripcion_laboral" id="descripcion_laboral"
                                        rows="3">{{ old('descripcion_laboral') }}</textarea>

                                    {{-- <small class="text-muted">descripcion_laboral y apellidos completos.</small> --}}
                                    @error('descripcion_laboral')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="row no_trabaja" style="display:none">
                                <div class="col-md-12  mb-3">
                                    <label for="motivo" class="font-weight-bold">Motivo por el cual no labora: </label>
                                    <textarea class="form-control @error('motivo') is-invalid @enderror"
                                        name="motivo" id="motivo"
                                        rows="3">{{ old('motivo') }}</textarea>

                                    {{-- <small class="text-muted">motivo y apellidos completos.</small> --}}
                                    @error('motivo')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                          



                            {{-- DATOS DE SATISFACCIÓN --}}
                            <div class="row py-3" >
                                <div class="col-md-12">
                                    <hr>
                                    <h4 class="font-weight-bold text-primary">Datos de satisfaccion laboral</h4>
                                </div>
                                <div class="col-md-12  mb-3">
                                    <label for="satisfaccion" class="font-weight-bold">
                                        Asigne según la escala señalada, su grado de satisfacción con su perfil de egreso
                                         profesional técnico del IESTP "SDM".
                                    </label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="satisfecho" id="satisfaccion5"
                                            value="5">
                                        <label class="form-check-label" for="satisfaccion5">
                                            Altamente Satisfecho
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="satisfecho" id="satisfaccion4"
                                            value="4">
                                        <label class="form-check-label" for="satisfaccion4">
                                            Muy Satisfecho
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="satisfecho" id="satisfaccion3"
                                            value="3">
                                        <label class="form-check-label" for="satisfaccion3">
                                            Satisfecho
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="satisfecho" id="satisfaccion2"
                                            value="2">
                                        <label class="form-check-label" for="satisfaccion2">
                                            Poco Satisfecho
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="satisfecho" id="satisfaccion1"
                                            value="1" checked>
                                        <label class="form-check-label" for="satisfaccion1">
                                            Insatisfecho
                                        </label>
                                    </div>


                                    


                                </div>
                                @error('satisfaccion')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror

                            </div>

                            <hr class="mb-4">

                            <h4 class="mb-3 text-primary">Confirmar</h4>

                            <div class="d-block my-3 mb-4">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox"
                                        class="custom-control-input @error('check_ok') is-invalid @enderror" id="check_ok"
                                        name="check_ok" <?php if (old('check_ok') == 'on') {
                                            echo 'checked';
                                        } ?> />
                                    <label class="custom-control-label" for="check_ok">Confirma que todos los datos
                                        registrados, son reales, en caso contrario, atenerse a las restricciones de las
                                        politicas de privacidad del sitio.</label>
                                    <small class="text-muted">En caso de no ser válidos los datos, se bloqueara el registro de seguimiento al egresado.</small>
                                    @error('check_ok')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <button class="btn btn-primary btn-lg btn-block" type="submit">Registrar datos</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center pt-4 mb-3">
                    <span class="text-muted font-weight-bold">Publicidad & enlaces</span>
                    {{-- <span class="badge badge-danger badge-pill small" style="font-size:12px">Importante!!</span> --}}
                </h4>
                Imagenes banners
                {{-- <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0 font-weight-bold"><i class="fas fa-university "></i> Banco de la nación</h6>
                            <small class="text-muted">Transacciones Banco | Agentes</small>
                        </div>
                        <span class="text-muted">S/.</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed bg-light">
                        <div>
                            <h6 class="my-0 font-weight-bold">Nombre: IESTP Señor de la Divina Misericordia</h6>
                            <small class="text-muted">Revisar nombre al hacer la transacción</small>
                        </div>
                        
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed bg-success text-white">
                        <div>
                            <h6 class="my-0 font-weight-bold"># Cuenta Ahorros: 0729585482</h6>
                            <small class="text-light font-weight-bold">En soles</small>
                        </div>
                        
                    </li>

                    <li class="list-group-item d-flex justify-content-between">
                        <div class="row">
                            <div class="col-md-12">
                                <h6 class="font-weight-bold">Consultar operación registrada</h6> <i
                                    class="fas fa-share"></i>
                            </div>
                        </div>
                        <form action="" method="POST" class="row">
                            @csrf

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fab fa-keycdn"></i></span>
                                </div>
                                <input type="text" name="op" id="op" class="form-control" placeholder="# Operación">
                            </div>
                            <button type="button" class="btn btn-primary btn-block" id="consulta" data-toggle="modal"
                                data-target="#consultarOPModal">
                                Consultar
                            </button>
                        </form>


                        <!-- Modal CONSULTA-->
                        <div class="modal fade" id="consultarOPModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Consulta PAGO REGISTRADO</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <h2>#OP: <b id="txt_op"></b></h2>
                                                <h2>Monto: S/.<b id="txt_monto"></b></h2>

                                            </div>
                                            <div class="col-lg-4">
                                                <button type="button" class="btn btn-primary btn-block">
                                                    Estado: <span class="badge badge-light" id="txt_estado">4</span>
                                                </button>
                                                <br>
                                                <b>DNI:</b><span id="txt_dni"></span>
                                                
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <b>Mensaje:</b>
                                               
                                                <div class="alert alert-warning my-2" role="alert">
                                                    <span id="txt_mensaje"></span>
                                                  </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                       <span>------------</span>
                        <strong>-----------</strong>
                    </li>
                </ul> --}}

                {{-- <form class="card p-2">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Promo code">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-secondary">Redeem</button>
                        </div>
                    </div>
                </form> --}}

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="https://isdm.edu.pe/transparencia" target="_blank" class="link"><i
                                        class="fas fa-eye"></i> <b>(TUPA)</b> Texto Unico de
                                    Procedimientos Administrativos </a>
                                <br>
                                <small class="text-muted">El pago se hace de acuerdo al TRÁMITE establecido en el
                                    TUPA</small>
                            </div>
                        </div>
                    </div>

                </div>
            </div>





        </div>


    </div>

@endsection

@push('scripts')
    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

        // $("#tramite").change(function() {
        //     var valor_monto = $(".valor_monto").val()
        //     alert("Handler for .change() called."+valor_monto);
        // });
    </script>


    <script type="text/javascript">
        function actualizar() {
            location.reload(true);
        }
         //Función para actualizar cada 5 segundos(5000 milisegundos)
        // setInterval("actualizar()", 10000);


        $(document).ready(function() {

            //cargar el select
            function select_fecha(){
                //hallar el año
                var fecha = new Date();
                var anho = fecha.getFullYear();
                var fin_fecha = $('#anho_egreso').val();

                $("#anho_titulo").html('<option value="">Seleccionar</option>');
                $("#anho_titulo").append('<option value='+anho+'>'+anho+'</option>');
                // console.log(fin_fecha+" "+anho);
                for(i = anho-1; i>= fin_fecha; i--){
                    // console.log(i)
                    $("#anho_titulo").append('<option value='+i+'>'+i+'</option>');
                }
            }

            $("#anho_egreso").change(function() {
                select_fecha();
            });

            $("#titulado").change(function() {
                var valor = $("#titulado").val();
                // alert( "Handler for .change() called."+valor );
                if (valor == 'SI') {
                    select_fecha();
                    $('.anho_titulado').show();
                    // alert( "Handler for .change() called."+valor );
                } else {
                    $('.anho_titulado').hide();
                }
            });

            $("#trabaja").change(function() {
                var valor = $("#trabaja").val();
                // alert( "Handler for .change() called."+valor );
                if (valor == 'SI') {
                    $('.centro_laboral').show();
                    $('.no_trabaja').hide();
                    // alert( "Handler for .change() called."+valor );
                } 
                if (valor == 'NO') {
                    $('.centro_laboral').hide();
                    $('.no_trabaja').show();

                }

            });



            function contadorNuevosTramites() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var codigo = $("#op").val();
                // alert('codigo'+codigo);
                var estado = '';
                $.ajax({
                    type: "post",
                    url: "{{ route('pago.consulta_ajax') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        codigo: codigo
                    },
                    success: function(data) {
                        // alert("Se ha realizado el POST con exito " + data);
                        $("#txt_op").text(data.num_op);

                        $("#txt_mensaje").text(data.mensaje);
                        $("#txt_dni").text(data.navegante_id);
                        $("#txt_monto").text(data.monto);

                        switch (data.estado) {
                            case "0":
                                estado = 'Enviado';
                                break;
                            case "1":
                                estado = 'Aceptado';
                                break;
                            case "2":
                                estado = 'Rechazado';
                                break;
                            case "3":
                                estado = 'Baja';
                                break;
                        }
                        $("#txt_estado").text(estado);
                        // $("#nuevos_tramites").text(data);

                    }
                });
            }

            $('#consulta').click(function() {
                contadorNuevosTramites();

            });


        });
        //Función para actualizar cada 5 segundos(5000 milisegundos)
        // setInterval("actualizar()", 10000);
    </script>

    @if (Session::has('error'))
        <script type="text/javascript">
            function actualizar() {
                location.reload(true);
            }
            //Función para actualizar cada 5 segundos(5000 milisegundos)
            //setInterval("actualizar()",5000);
            Swal.fire({
                title: 'Registros no encontrados?',
                text: "Lo sentimos, no se encontraron registros de trámites en nuestra institución.",
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Cancelar'
            })
        </script>
    @endif

    @if (Session::has('estado') == 'registro_ok')
        <script type="text/javascript">
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Seguimiento registrado correctamente.',
                showConfirmButton: true,
                timer: 2500
            })
        </script>
    @endif
@endpush
