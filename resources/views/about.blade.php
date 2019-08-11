@extends('inicio')
@section('main-content')

    
<link href="{{asset('/css/about.css')}}" rel="stylesheet" id="bootstrap-css">
<!--Informacion del Grupo-->
<section class="parrafo">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="mbr-white col-md-10">
                    <h1 class="mbr-section-title align-center mbr-bold pb-3 mbr-fonts-style display-5">Sistema Estudiantil de Sesiones de Laboratorio</h1>
                    <h1 class="mbr-section-subtitle align-center mbr-light pb-3 mbr-fonts-style display-3">ScrumTroopers</h1>
                    <p class="mbr-text text-justify pb-3 mbr-fonts-style display-5">
                        El grupo fue originalmente formado para cursar la materia de Taller de Ingenieria de Software, y 
                        el Sistema Estudiantil de Sesiones de Laboratorio (<b>SESLAB</b>) fue nuestro proyecto durante la gestión I-2019. 
                        Luego de haber trabajado en este proyecto por mas de un semestre, cada uno de nosotros, como grupo <b>ScrumTroopers</b> 
                        esperamos que el sistema llegue a ser de alguna utilidad para aquellas personas que lleguen a usarlo.
                    </p>
                    <img src="img/casco.png">
                    <div class="mbr-section-btn align-center">
                        <a class="btn btn-md btn-black-outline display-4 btn-primary" href="#form1-4">CONTACTO</a>
                    </div>
                </div>
            </div>
        </div>    
</section>
<!--Imagen del Grupo-->
<section class="imagen">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="mbr-white col-md-10">
                    <section class="parrafo2">
                            <div class="container">
                                <div class="row justify-content-md-center">
                                    <div class="mbr-white col-md-10">
                                        <h1 class="mbr-section-title align-center mbr-bold pb-3 mbr-fonts-style display-5">SESLAB</h1>
                                        <p class="mbr-text text-justify pb-3 mbr-fonts-style display-5">
                                            El Sistema Estudiantil de Sesiones de Laboratorio (SESLAB) fue diseñado según los requerimientos dados en la materia
                                            de Taller de Ingenieria de Software, siendo su objetivo facilitar el control sobre las clases que se realizan en los
                                            laboratorios de la Facultad de Ciencias y Tecnologia. Manteniendo un registro sobre los trabajos realizados y generando
                                            reportes para los docentes de las materias.
                                        </p>
                                    </div>
                                </div>
                            </div>    
                    </section>
            </div>
        </div>
    </div>
</section>

<section class="carousel slide testimonials-slider integrantes">
    <div class="container text-center">
        <div class="carousel slide" data-ride="carousel" role="listbox" id="testimonials-slider1-3-carousel">
            <div class="carousel-inner">    
                <div class="carousel-item">
                    <div class="user col-md-8">
                        <div class="user_image">
                            <img src="img/AlexCardona.png" alt="" title="" media-simple="true">
                        </div>
                        <div class="user_text pb-3">
                            <p class="mbr-fonts-style display-7">
                                Estudiante de Ing. de Sistemas<br>
                                <a href="mailto:alex_cardona_siles@hotmail.com">alex_cardona_siles@hotmail.com</a>
                            </p>
                        </div>
                        <div class="user_name mbr-bold pb-2 mbr-fonts-style display-7">
                            Alex
                        </div>
                        <div class="user_desk mbr-light mbr-fonts-style display-7">
                            DEVELOPER
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="user col-md-8">
                        <div class="user_image">
                            <img src="img/casco.png" alt="" title="" media-simple="true">
                        </div>
                        <div class="user_text pb-3">
                            <p class="mbr-fonts-style display-7">
                                ad occasum
                            </p>
                        </div>
                        <div class="user_name mbr-bold pb-2 mbr-fonts-style display-7">
                            Bernardo 
                        </div>
                        <div class="user_desk mbr-light mbr-fonts-style display-7">
                            DEVELOPER
                        </div>
                    </div>
                </div>
                <div class="carousel-item active">
                    <div class="user col-md-8">
                        <div class="user_image">
                            <img src="img/casco.png" alt="" title="" media-simple="true">
                        </div>
                        <div class="user_text pb-3">
                            <p class="mbr-fonts-style display-7">
                                adsum
                            </p>
                        </div>
                        <div class="user_name mbr-bold pb-2 mbr-fonts-style display-7">
                            Cesar
                        </div>
                        <div class="user_desk mbr-light mbr-fonts-style display-7">
                            DEVELOPER
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="user col-md-8">
                        <div class="user_image">
                            <img src="img/casco.png" alt="" title="" media-simple="true">
                        </div>
                        <div class="user_text pb-3">
                            <p class="mbr-fonts-style display-7">
                                esse quam
                            </p>
                        </div>
                        <div class="user_name mbr-bold pb-2 mbr-fonts-style display-7">
                            William 
                        </div>
                        <div class="user_desk mbr-light mbr-fonts-style display-7">
                            DEVELOPER
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="user col-md-8">
                        <div class="user_image">
                            <img src="img/casco.png" alt="" title="" media-simple="true">
                        </div>
                        <div class="user_text pb-3">
                            <p class="mbr-fonts-style display-7">
                                videri
                            </p>
                        </div>
                        <div class="user_name mbr-bold pb-2 mbr-fonts-style display-7">
                            Wilson 
                        </div>
                        <div class="user_desk mbr-light mbr-fonts-style display-7">
                            DEVELOPER
                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel-controls">
                <a class="carousel-control-prev" role="button" data-slide="prev" href="#testimonials-slider1-3-carousel">
                    <span><</span>
                </a>
                
                <a class="carousel-control-next" role="button" data-slide="next" href="#testimonials-slider1-3-carousel">
                    <span class="carousel-control-next-icon" aria-hidden="true">></span>
                </a>
            </div>
        </div>
    </div>
</section>



<section class="mbr-section form1 contacto" id="form1-4" data-rv-view="791">
    <div class="container">
        <div class="row justify-content-center">
            <div class="title col-12 col-lg-8">
                <h2 class="mbr-section-title align-center pb-3 mbr-fonts-style display-3">CONTACTO</h2>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <span>
                &nbsp;
                Escríbenos a: <a href="mailto:scrumtrooperssc@gmail.com"><b>scrumtrooperssc@gmail.com</b></a>.<br>
        </span>
    </div>
</section>
@endsection