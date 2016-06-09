<link rel="stylesheet" href="<?php echo base_url() ?>css/fullcalendar.css" />
<script src="<?php echo base_url() ?>js/fullcalendar.min.js"></script>
<script type="text/javascript" >

	$(document).ready(function() {
	
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		
		var calendar = $('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			selectable: true,
			selectHelper: true,
			select: function(start, end, allDay) {
				var title = prompt('Event Title:');
				if (title) {
					calendar.fullCalendar('renderEvent',
						{
							title: title,
							start: start,
							end: end,
							allDay: allDay
						},
						true // make the event "stick"
					);
				}
				calendar.fullCalendar('unselect');
			},
			editable: true,
			events: [
				{
					title: 'Cita doto el dia',
					start: new Date(y, m, 1)
				},
				{
					title: 'Cita ordianria',
					start: new Date(y, m, d-5),
					end: new Date(y, m, d-2)
				},
				{
					id: 999,
					title: 'Cita repetida',
					start: new Date(y, m, d-3, 16, 0),
					allDay: false
				},
				{
					id: 999,
					title: 'Cita Lina Gomez',
					start: new Date(y, m, d+4, 16, 0),
					allDay: false
				},
				{
					title: 'Cita de Angy more',
					start: new Date(y, m, d, 10, 30),
					allDay: false
				},
				{
					title: 'Almuerzo',
					start: new Date(y, m, d, 12, 0),
					end: new Date(y, m, d, 14, 0),
					allDay: false
				},
				{
					title: 'Cita Ortopedia montes',
					start: new Date(y, m, d+1, 19, 0),
					end: new Date(y, m, d+1, 22, 30),
					allDay: false
				},
				{
					title: 'Cida Snheidert Smalbach, click para ver',
					start: new Date(y, m, 28),
					end: new Date(y, m, 29),
					url: 'http://google.com/'
				}
			]
		});
		
	});



</script>
<div class="row-fluid">
	<div class="span12">
		<div class="alert alert-info">
			This page demonstrates a jQuery calendar plugin. Try to add a new event!
			<a href="#" class="close" data-dismiss="alert">×</a>
		</div>
		<div class="widget-box widget-calendar">
			<div class="widget-title">
				<span class="icon"><i class="icon-calendar"></i></span>
				<h5>Calendar</h5>
				
			</div>
			<div class="widget-content nopadding">
				<div class="panel-left">
					<div id="fullcalendar">
						<div id='calendar'></div>

					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>