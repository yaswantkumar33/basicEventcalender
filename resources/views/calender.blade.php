<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
</head>

<body>
    <div class="navcal d-flex justify-content-between px-3 fw-bold ls-tight my-3 ">
        <h1>Event calender Managemt </h1>
        <ul class="d-flex justify-content-center" style="font-size: 25px">
            <li class="pr-3">{{ auth()->user()->firstname }}</li>
            <li class="ml-3"><a href="/logout">Logout</a></li>
        </ul>
    </div>
    <div class="container">
        <div id="calendar">

        </div>
        <div class=" p-3 cal-hidden">

            <input type="text" id="Eventtitle" name="title" placeholder="Enter Event Title">
            <input type="text" id="EventDescription" name="description" placeholder="Enter Event Description">

        </div>

    </div>
</body>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        var calendar = $('#calendar').fullCalendar({
            editable: true,
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendWeek,agendaDay'
            },
            events: '/calender',
            selectable: true,
            selectHelper: true,
            select: function(start, end, allDay) {
                var title = prompt('Enter The Event Title');
                var description = prompt('Enter The Event Description');
                if (title) {
                    var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');
                    var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');
                    $.ajax({
                        url: "/calender/action",
                        type: "POST",
                        data: {
                            title: title,
                            start: start,
                            end: end,
                            description: description,
                            type: 'add'
                        },
                        success: function(data) {
                            console.log("api was sucess and data has been saved!!")
                            calendar.fullCalendar('refetchEvents');
                            alert("Event Created Sucessfully!")
                        }
                    })
                }
            },
            eventRender: function(event, element) {
                element.find('.fc-title').append("<br/>" + event.description)
            },
            editable: true,
            eventResize: function(event, delta) {
                var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:MM:SS');
                console.log(event)
                var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                var title = event.title;
                var id = event.id;
                $.ajax({
                    url: "/calender/action",
                    type: "POST",
                    data: {
                        title: title,
                        start: start,
                        end: end,
                        id: id,
                        type: 'update'

                    },
                    success: function(response) {
                        calendar.fullCalendar('refectchEvents')
                        alert("Event Updated Sucessfully")
                    }
                })
            },
            eventDrop: function(event, delta) {
                var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:MM:SS');
                console.log(event)
                var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                var title = event.title;
                var id = event.id;
                $.ajax({
                    url: "/calender/action",
                    type: "POST",
                    data: {
                        title: title,
                        start: start,
                        end: end,
                        id: id,
                        type: 'update'

                    },
                    success: function(response) {
                        calendar.fullCalendar('refectchEvents')
                        alert("Event Updated Sucessfully")
                    }
                })
            },
            eventClick: function(event) {
                if (confirm("Are You Sure You want To delete the event ?")) {
                    var id = event.id
                    $.ajax({
                        url: "/calender/action",
                        type: "POST",
                        data: {

                            id: event.id,
                            type: "delete"
                        },
                        success: function(response) {
                            calendar.fullCalendar('refetchEvents')
                            alert("Event Deleted Sucessfully");
                        }
                    })
                }
            }
        });
    })
</script>

</html>
