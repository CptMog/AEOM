let calendarEl;

document.addEventListener('DOMContentLoaded',function(){

    calendarEl = document.querySelector('#calendar');

    let calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
          },
          locale: 'fr',
          navLinks: true, // can click day/week names to navigate views
          editable: true,
          dayMaxEvents: true, // allow "more" link when too many events
          events: 'https://fullcalendar.io/demo-events.json?overload-day'
      });

    calendar.render();

});