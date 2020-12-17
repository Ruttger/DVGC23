@extends('layouts.app')

@section('marker')
    <div class="topnav">
        <a href="/">Home</a>
        <a href="/forum">Forum</a>
        <a class="active" href="/calendar">Calendar</a>
        <a href="/login">Login</a>
    </div>
@endsection

@section('content')
<thead>
    <title>Calendar</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</thead>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" />

<script src="https://cdn.jsdelivr.net/npm/moment@2.27.0/moment.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>


<tbody>

<div class="container">
    <div class="response"></div>
    <div id='calendar'></div>
</div>

<!-- The Modal use -->
<div id="Modal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <div id="modal-body-id" class="modal-body"> 
    </div>
    <div id="modal-admin-buttons" class="modal-body"> 
    </div>
  </div>
</div>

</tbody>
<script>
    jQuery(document).ready(function () {
        var SITEURL = "{{url('/')}}";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var calendar = $('#calendar').fullCalendar({
            events: "{{URL::to('/calendar')}}",
            eventColor: '#fff6b0',
            eventTextColor: 'black',
            eventBorderColor: 'black',
            displayEventTime: true,
            weekNumbers: true,
            editable: true,
            allDay: false,
            allDayDefault: false,
            defaultAllDayEventDuration: 0,
            forceEventDuration: true,
            defaultTimedEventDuration: '01:00',
            nextDayThreshold: '00:00:10',
            timeFormat: 'H(:mm)',
            eventRender: function (event, element, view) {
                if (event.allDay === 'true') {
                    event.allDay = true;
                } else {
                    event.allDay = false;
                }
                
            },
            selectable: true,
            selectHelper: true,
            
            select: function (start, end, allDay) {
                <!-- Om inloggad och Admin -->

                if(true){
                    var startDate = $.fullCalendar.formatDate(start, "Y-MM-DD");
                    var endDate = $.fullCalendar.formatDate(end, "Y-MM-DD");
                    var modal = displayModal();

                    $('#modal-body-id').html("<label for=\"titel\">For title: </label> <br>" + 
                                            "<input type=\"text\" id=\"titel\"> <br>" + 

                                            "<label for=\"url\">For url: </label> <br>" + 
                                            "<input type=\"text\" id=\"url\"> <br>" +

                                            "<label for=\"description\">For description: </label> <br>" + 
                                            "<textarea id=\"description\"> </textarea>  <br>" + 

                                            "<label for=\"startTime\">Start time: </label> <br>" + 
                                            "<input type=\"time\" id=\"startTime\" min=\"14:00\" max=\"15:59\"> <br>" +

                                            "<label for=\"endTime\">End time: </label> <br>" + 
                                            "<input type=\"time\" id=\"endTime\" min=\"14:00\" max=\"15:59\"> <br>" +

                                            "<button type=\"button\" id=\"create\">Create</button>");



                    $("#create").click(function(){
                        var title = $("#titel").val();
                        var url = $("#url").val();
                        var description = $("#description").val();

                        if (title) {
                            var startTime = $("#startTime").val();
                            var endTime = $("#endTime").val();
                            
                            var start = startDate + " " + startTime + ":00";
                            var end = startDate + " " + endTime + ":00";
                            if(Date.parse(end) > Date.parse(start)){            
                                jQuery.ajax({
                                    url: "{{URL::to('/fullcalendar/create')}}",

                                    type: "POST",
                                    data: {
                                        event_title: title,
                                        start_time: start,
                                        end_time: end,
                                        event_url: url,
                                        description: description
                                    },
                                    success: function (data) {
                                        displayMessage("Added Successfully");
                                    }
                                });
                                calendar.fullCalendar( 'refetchEvents' );
                                hideModal(modal);
                            } else {
                                alert('DUDE invail time');
                            }
                        }
                    });  
                }
                <!-- Slut Om Admin -->
                calendar.fullCalendar('unselect');
            },


            eventDrop: function (event, delta) {
                <!-- Om inloggad och Admin -->
                if(true){
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                    $.ajax({
                        url: "{{URL::to('/fullcalendar/updateDrop')}}",
                        data: {
                            start_time: start,
                            end_time: end,
                            id: event.id},
                            type: "POST",
                        success: function (response) {
                            displayMessage("Updated Successfully");
                        }
                    });
                }
                <!-- Slut Om Admin -->
            },

            eventClick: function (event, jsEvent, start, end, allDay) {
                jsEvent.preventDefault();
                var modal = displayModal();

                $('#modal-body-id').html("<b>" + event.title + 
                                        "</b><br>" + 
                                        event.description +
                                        "<br>Tid för event: <br><b>" + $.fullCalendar.formatDate(event.start, "HH:mm") + " - " + $.fullCalendar.formatDate(event.end, "HH:mm" + "</b>") +
                                        "<br>" + 
                                        " <a href=\"" + event.url + "\">Länk till event</a>");
                
                <!-- Om inloggad och Admin -->
                if(true){

                    $('#modal-admin-buttons').html("<button type=\"button\" id=\"edit\">Edit</button>" + "\t" + 
                                                    "<button type=\"button\" id=\"delete\">Delete</button>")

                    $("#edit").click(function(){
                        hideModal(modal);
                        displayModal();

                        // hämta minuterna från tiden lagrad i databasen
                        var startTime = event.start.toString().substring(16, 21);
                        var endTime = event.end.toString().substring(16, 21);


                        $('#modal-body-id').html("<label for=\"titel\">For title: </label> <br>" + 
                                            "<input type=\"text\" id=\"titel\" value=" + event.title + ">  <br>" + 

                                            "<label for=\"url\">For url: </label> <br>" + 
                                            "<input type=\"text\" id=\"url\" value=" + event.url + "> <br>" +

                                            "<label for=\"description\">For description: </label> <br>" + 
                                            "<textarea id=\"description\" >" + event.description + "</textarea>  <br>" + 
                                            
                                            "<label for=\"startTime\">Start time: </label> <br>" + 
                                            "<input type=\"time\" id=\"startTime\" value=" + startTime + "> <br>" +

                                            "<label for=\"endTime\">End time: </label> <br>" + 
                                            "<input type=\"time\" id=\"endTime\" value=" + endTime + "> <br>" +

                                            "<button type=\"button\" id=\"update\">Update</button>");

                        $("#update").click(function(){
                            var title = $("#titel").val();
                            var url = $("#url").val();
                            var description = $("#description").val();
                            startTime = $("#startTime").val();
                            endTime = $("#endTime").val();
                            
                            var startDate = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                            var endDate = $.fullCalendar.formatDate(event.end, "Y-MM-DD");
                            
                            var start = startDate + " " + startTime + ":00";
                            var end = endDate + " " + endTime + ":00";

                            // var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD hh:mm:ss");
                            // var end = $.fullCalendar.formatDate(event.start, "Y-MM-DD hh:mm:ss");

                            $.ajax({
                                url: "{{URL::to('/fullcalendar/update')}}",
                                data: {
                                    event_title: title,
                                    event_url: url,
                                    description: description,
                                    start_time: start,
                                    end_time: end,
                                    id: event.id},
                                    type: "POST",
                                success: function (response) {
                                displayMessage("Updated Successfully");
                                }
                            });

                            calendar.fullCalendar( 'refetchEvents' );
                            


                            hideModal(modal); 
                        });  
                    });  



                    $("#delete").click(function(){
                        var deleteMsg = confirm("Do you really want to delete?");
                        if (deleteMsg) {
                            $.ajax({
                                type: "POST",
                                url: "{{URL::to('/fullcalendar/delete')}}",
                                data: {id: event.id},
                                success: function (response) {
                                    if(parseInt(response) > 0) {
                                        $('#calendar').fullCalendar('removeEvents', event.id);
                                        displayMessage("Deleted Successfully");
                                    }
                                }
                            });
                         }
                        hideModal(modal);
                    });  

                }
                <!-- Slut Om Admin -->   
            }
        });
    });

    function displayMessage(message) {
        $(".response").html("<div class='success'>"+message+"</div>");
        setInterval(function() { $(".success").fadeOut(); }, 1000);
    }

    function displayModal(){
        // Get the modal
        var modal = document.getElementById("Modal");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on the button, open the modal
        modal.style.display = "block"

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            hideModal(modal);
        }

        return modal;

    }

    function hideModal(modal){
        $('#modal-body-id').html("");
        $('#modal-admin-buttons').html("");
        modal.style.display = "none";
    }

</script>
@endsection
