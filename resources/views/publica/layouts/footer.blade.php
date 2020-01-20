<footer class="fondos" id="non-printable">
    <div class="container" >
        <div class="row ">
            <div class="col-12 col-md-4 my-5 ">
                <img class="img-fluid d-block mx-auto" src="{{asset('images/logos/footer.png')}}">
            </div>
            <div class="col-12 col-md-4 my-5 ">
                <div class="row">
                    <div class="col-12 border-footer">
                        <h5 class=" pl-5 titulo-footer">SECCIONES</h5>
                        <ul class=" pl-5 pl-0 mt-3">
                            <li><a class="text-center" href="{{route('home')}}">Home</a></li>
                            <li><a class="text-center" href="{{route('empresa')}}">Empresa</a></li>
                            <li><a class="text-center" href="{{route('servicios')}}">Servicios</a></li>
                            <li><a class="text-center" href="{{route('productos')}}">Productos</a></li>
                            <li><a class="text-center" href="{{route('proyectos')}}">Proyectos</a></li>
                            <li><a class="text-center" href="{{route('clientes')}}">Clientes</a></li>
                            <li><a class="text-center" href="{{route('sectores')}}">Sectores</a></li>
                            <li><a class="text-center" href="{{route('contacto')}}">Contacto</a></li>
                        </ul>
                    </div>
                    <div class=" col-12 mt-2"><span class="pl-5" style="color: #AAAAAA;font-size: 12px;">By Osole</span></div>
                </div>
            </div>
            <div class="col-12 col-md-4 my-5  pl-5">
                <h5 class="titulo-footer">WALTER GREGORUTTI</h5>
                <div class="row align-items-center">
                    <div class="col-2 text-center icon-footer"><i class="fa fa-map-marker"></i></div>
                    <div class="col-8">
                           <a class="enlace-footer" target="_blank" href="{{$empresa_->enlance_maps}}" target="_blank">
                            {{$empresa_->domicilio[0]['calle']}} {{$empresa_->domicilio[0]['altura']}}, {{$empresa_->domicilio[0]['provincia']}}, {{$empresa_->domicilio[0]['pais']}}
                           </a>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-2 text-center icon-footer"><i class="fa fa-phone"></i></div>
                    <div class="col-10">
                        @php $i = 0; @endphp
                        @if ($empresa_->telefonos != null)
                        @foreach($empresa_->telefonos as $telefono => $value)
                        @if ($value['tipo'] == 'telefono')
                            {{($i>0?' / ':'')}}<a class="enlace-footer" href="tel:{{$value['numero']}}" target="_blank">
                                {{(isset($value['visible'])?$value['visible']:$value['numero'])}}
                            </a>
                            @php $i++; @endphp
                        @endif
                        @endforeach
                        @endif

                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-2 text-center icon-footer"><i class="fa fa-paper-plane"></i></div>
                    <div class="col-8">
                        @if ($empresa_->emails != null)
                        @foreach($empresa_->emails as $email)
                            <a class="enlace-footer" href="mailto:{{$email}}" target="_blank">{{$email}}</a> <br>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>