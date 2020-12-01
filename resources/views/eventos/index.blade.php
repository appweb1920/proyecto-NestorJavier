<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link href="{{ asset('fullcalendar/lib/main.css') }}"z rel='stylesheet' />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="{{ asset('fullcalendar/lib/main.js') }}"></script>
<script>

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
        left: 'prev,next today myCustomButton',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      initialDate: '2020-09-12',
      navLinks: true, // can click day/week names to navigate views
      selectable: true,
      selectMirror: true,
      customButtons:{
          myCustomButton: {
          text: 'custom!',
          click: function() {
            $('#exampleModal').modal('toggle');
          }
        },
      },
      dateClick: function(info) {
        $('#exampleModal').modal('toggle');
        console.log(info)
        calendar.addEvent({
            title: 'title',
            start: info.dateStr,
          })
      },
      eventClick: function(arg) {
        /*if (confirm('Are you sure you want to delete this event?')) {
          arg.event.remove()
        }*/
        console.log(arg.event.title);
        console.log(arg.event.start);
        console.log(arg.event.end);
        console.log(arg.event.textColor);
        console.log(arg.event.backgroundColor);
        console.log(arg.event.extendedProps.descripcion);
      },


      editable: true,
      dayMaxEvents: true, // allow "more" link when too many events
      events: [
        {
          title: 'All Day Event',
          start: '2020-09-01',
          descripcion: 'description',
        },
        {
          title: 'Long Event',
          start: '2020-09-07',
          end: '2020-09-10'
        },
        {
          title: 'Repeating Event',
          start: '2020-09-09 12:00:00',
          end: '2020-09-12 12:00:00',
          color: '#ffccaa',
          textColor: '#000f00'
        },
        {
          title: 'Conference',
          start: '2020-09-11',
          end: '2020-09-13'
        },
        {
          title: 'Meeting',
          start: '2020-09-12T10:30:00',
          end: '2020-09-12T12:30:00'
        },
        {
          title: 'Lunch',
          start: '2020-09-12T12:00:00'
        },
        {
          title: 'Meeting',
          start: '2020-09-12T14:30:00'
        },
        {
          title: 'Happy Hour',
          start: '2020-09-12T17:30:00'
        },
      ]
    });
    calendar.setOption('locale', 'Es');
    calendar.render();
  });

</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>


<style>

  body {
    margin: 0;
    padding: 0;
    font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
    font-size: 1rem;
  }

  #calendar {
    max-width: 80vw;
    margin: 3rem auto;
  }
  
  a {
    color: black;
  }

</style>
</head>
<body>
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <p>Titulo:</p> 
            <input type="text" name="titulo" id="titulo">
            <br>
            <br>
            <p>Inicio:</p> 
            <input type="text" name="start" id="start">
            <br>
            <br>
            <p>Final:</p>
            <input type="text" name="end" id="end">
            <br>
            <br>
            <p>Descripción:</p> 
            <textarea name="txtDescripcion" id="txtDescripcion" cols="30" rows="10"></textarea>
        </div>
        <div class="modal-footer">
            <button class="btn btn-success" id="btnAgregar">Agregar</button>
            <button class="btn btn-warning" id="btnModificar">Modificar</button>
            <button class="btn btn-danger" id="btnBorrar">Borrar</button>
            <button class="btn btn-light" id="btnCancelar">Cancelar</button>
        </div>
      </div>
    </div>
  </div>

  <div id='calendar'></div>
</body>
</html>