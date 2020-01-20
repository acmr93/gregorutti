<section id="carousel" class="">
    <div class="carousel slide" data-ride="carousel" id="carousel-1">
        <div class="carousel-inner" role="listbox">
        	@php $conteo = 0; @endphp
        	@if ($slider->count() > 0)
        		@foreach ($slider as $img)
	                <div class="carousel-item @if($conteo==0) active @endif">
	                    <div class="jumbotron pulse animated carousel-hero d-flex align-items-end" style="min-height: 565px;background-image: url(&quot;{{asset('loaded/'.$seccion.'/'.$img->nombre)}}&quot;)">
	                        <div class="container carousel-hero-container ">
                                {!!$img->texto1!!}
	                        </div>
	                    </div>
	                </div>
        			@php $conteo ++ @endphp
        		@endforeach   
        	@else
        		<div class="carousel-item active">
                    <div class="jumbotron pulse animated carousel-hero" style="background-image: url(&quot;{{asset('images/thumbnails/1365x518.png')}}&quot;)">
                        <div class="container">
                            <div class="container carousel-hero-container">
                                    <spam class="hero-text">TEXTO 1</spam>
                                    <h1 class="hero-title">TEXTO 2</h1>
                            </div>
                        </div>
                    </div>
                </div> 
        	@endif
        </div>
        <div>
        	<a class="carousel-control-prev" href="#carousel-1" role="button" data-slide="prev"><i class="fa fa-chevron-left"></i><span class="sr-only">Anterior</span></a>
        	<a class="carousel-control-next" href="#carousel-1" role="button" data-slide="next"><i class="fa fa-chevron-right"></i><span class="sr-only">Siguiente</span></a>
        </div>
        <ol class="carousel-indicators">
            <li data-target="#carousel-1" data-slide-to="0" class="active"></li>
			@if ($conteo > 1)
				@for ($i = 0; $i < $conteo-1; $i++)
	                <li data-target="#carousel-1" data-slide-to="{{$i+1}}" ></li>
				@endfor   
			@endif
        </ol>
    </div>
</section>