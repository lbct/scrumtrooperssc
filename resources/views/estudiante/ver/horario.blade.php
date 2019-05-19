<!--Vista de Horario de Estudiante-->

<link href="{{asset('css/horario-style.css')}}" rel="stylesheet" type="text/css">

<div class="cd-schedule cd-schedule--loading margin-top--lg margin-bottom--lg js-cd-schedule">
    <div class="cd-schedule__timeline">
        <ul>
        <li><span>06:45</span></li>
        <li><span>08:15</span></li>
        <li><span>09:45</span></li>
        <li><span>11:15</span></li>
        <li><span>12:45</span></li>
        <li><span>14:15</span></li>
        <li><span>15:45</span></li>
        <li><span>17:15</span></li>
        <li><span>18:45</span></li>
        <li><span>20:15</span></li>
        <li><span>21:45</span></li>
        <!-- additional elements here -->
        </ul>
    </div> <!-- .cd-schedule__timeline -->
    
    <div class="cd-schedule__events">
        <ul>
        <li class="cd-schedule__group">
            <div class="cd-schedule__top-info"><span>Lunes</span></div>
    
            <ul>
            <li class="cd-schedule__event">
                <a data-start="08:15" data-end="9:45" data-content="event-abs-circuit" data-event="event-1" href="#0">
                <em class="cd-schedule__name">Abs Circuit</em>
                </a>
            </li>
    
            <!-- other events here --> 
            </ul>
        </li>
    
        <li class="cd-schedule__group">
            <div class="cd-schedule__top-info"><span>Martes</span></div>
    
            <ul>
            <!-- events here --> 
            </ul>
        </li>
        <li class="cd-schedule__group">
            <div class="cd-schedule__top-info"><span>Miercoles</span></div>
    
            <ul>
            <!-- events here --> 
            </ul>
        </li>
        <li class="cd-schedule__group">
            <div class="cd-schedule__top-info"><span>Jueves</span></div>
    
            <ul>
            <!-- events here --> 
            </ul>
        </li>
        <li class="cd-schedule__group">
            <div class="cd-schedule__top-info"><span>Viernes</span></div>
            
            <ul>
            <!-- events here --> 
            </ul>
        </li>
        <li class="cd-schedule__group">
            <div class="cd-schedule__top-info"><span>Sabado</span></div>
    
            <ul>
            <!-- events here --> 
            </ul>
        </li>

        <!-- additional li.cd-schedule__group here --> 
        </ul>
    </div>
    
    <div class="cd-schedule-modal">
        <header class="cd-schedule-modal__header">
        <div class="cd-schedule-modal__content">
            <span class="cd-schedule-modal__date"></span>
            <h3 class="cd-schedule-modal__name"></h3>
        </div>
    
        <div class="cd-schedule-modal__header-bg"></div>
        </header>
    
        <div class="cd-schedule-modal__body">
        <div class="cd-schedule-modal__event-info"></div>
        <div class="cd-schedule-modal__body-bg"></div>
    </div>
    
        <a href="#0" class="cd-schedule-modal__close text--replace">Close</a>
    </div>
</div> <!-- .cd-schedule -->

<script>document.getElementsByTagName("html")[0].className += " js";</script>
<script src="{{asset('js/horario-util.js')}}"></script>
<script src="{{asset('js/horario-main.js')}}"></script>
