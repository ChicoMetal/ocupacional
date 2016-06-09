<link rel="stylesheet" href="<?php echo base_url() ?>css/fullcalendar.css" />
<script src="<?php echo base_url() ?>js/fullcalendar.min.js"></script>

<div class="container-fluid">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="alert alert-info">
                            Calendario de  eventos
                            <a href="#" class="close" data-dismiss="alert">×</a>
                        </div>
                        <div class="widget-box widget-calendar">
                            <div class="widget-title">
                                <span class="icon"><i class="icon-calendar"></i></span>
                                <h5>Calendar</h5>
                                <div class="buttons">
                                    <a id="add-event" data-toggle="modal" href="#modal-add-event" class="btn btn-success btn-mini"><i class="icon-plus icon-white"></i> Add new event</a>
                                    <div class="modal hide" id="modal-add-event">
                                         <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">×</button>
                                            <h3>Añadir Evento1</h3>
                                        </div>
                                        <div class="modal-body">
                                            <p>Enter event name:</p>
                                            <p><input id="event-name" type="text" /></p>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="#" class="btn" data-dismiss="modal">Cancel</a>
                                            <a href="#" id="add-event-submit" class="btn btn-primary">Add event</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content nopadding">
                                <div class="panel-left">
                                    <div id="fullcalendar"></div>
                                </div>
                                <div id="external-events" class="panel-right">
                                    <div class="panel-title"><h5>Events</h5></div>
                                    <div class="panel-content">
                                        <div class="external-event ui-draggable label label-inverse">My Event 1</div>
                                        <div class="external-event ui-draggable label label-inverse">My Event 2</div>
                                        <div class="external-event ui-draggable label label-inverse">My Event 3</div>
                                        <div class="external-event ui-draggable label label-inverse">My Event 4</div>
                                        <div class="external-event ui-draggable label label-inverse">My Event 5</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>








    