
var dayNamesEn = ["monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday"];
var dayNamesFa = ["دوشنبه", "سه‌شنبه", "چهارشنبه", "پنج‌شنبه", "جمعه", "شنبه", "یک‌شنبه"];
var dayDatesIslamic = [];
var dayDatesPersian = [];
var dayDatesGregorian = ["7/22", "7/22", "7/22", "7/22", "7/22", "7/22", "7/22"];
var timeUnitIndex = 0;

var events = [];

var offset = 0;

// resize area
var myY = 0;
var mouseDownEvent = -1;
var originalHeight = 0;

var lastIndex = -1;

$(document).ready(function () {
    generateWeeklyCalendar();
    getDateList();
    loadEvents();
});

$(document).mouseup(function(e) {
    myY = 0;
    originalHeight = 0;
    $().unbind("mousemove", resize);
    if (mouseDownEvent != -1) {
        $("#event-" + events[mouseDownEvent].id).focus();
        snapToGrid(mouseDownEvent);
        mouseDownEvent = -1;
    }
});

$(window).resize(function() {
    for (var i = 0; i < events.length; i++) {
        events[i].render();
    }
});

function snapToGrid(id) {
    var event = $("#event-" + id);
    var height = event.height();
    var numOfUnits = 0;
    var myHeight = 0;
    var timeUnitId = events[mouseDownEvent].timeUnitId;
    while (myHeight < height) {
        timeUnitId += 7;
        myHeight = $("#timeUnit-" + timeUnitId).position().top - events[mouseDownEvent].timeUnit.position().top;
        numOfUnits++;
    }
    timeUnitId += 7;
    event.css("height", $("#timeUnit-" + timeUnitId).position().top - events[mouseDownEvent].timeUnit.position().top);
    events[mouseDownEvent].endTimeUnit = timeUnitId - 7;
    events[mouseDownEvent].updateTimeStamp();

}

function generateWeeklyCalendar() {
    //instantiate the div that contains calendar table
    var weeklyCalendarContainer = document.getElementById("calendar");

    //instantiate the table
    var weeklyCalendar = document.createElement("table");
    weeklyCalendar.className = "table table-bordered table-hover table-condensed table-striped";
    weeklyCalendar.id = "weeklyCalendar";

    //instantiate and append thead and tbody
    var weeklyCalendarHead = document.createElement("thead");
    var weeklyCalendarBody = document.createElement("tbody");
    weeklyCalendar.appendChild(weeklyCalendarHead);
    weeklyCalendar.appendChild(weeklyCalendarBody);

    //add headers to thead
    var hourHead = document.createElement("th");
    hourHead.innerHTML = "&nbsp;";
    hourHead.style.width = "9%";
    weeklyCalendarHead.appendChild(hourHead);
    for (var k = 0; k < 7; k++) {
        var head = document.createElement("th");
        head.style.width = "13%";
        var dayHeader = document.createElement("div");
        var dayHeaderDate = document.createElement("div");
        dayHeaderDate.id = "dayheader-" + (k+1);
        dayHeaderDate.innerHTML = dayDatesGregorian[k];
        var text = document.createTextNode(dayNamesFa[k]);
        dayHeader.style.textAlign = "center";
        dayHeader.appendChild(text);
        dayHeader.appendChild(dayHeaderDate);
        head.appendChild(dayHeader);
        weeklyCalendarHead.appendChild(head);
    }

    //this loop add row for time intervals to tbody
    for (var l = 0; l < 48; l++) {
        var row = generateTimeRow(l);
        weeklyCalendarBody.appendChild(row);
    }

    //append and return the calendar table div container
    weeklyCalendarContainer.appendChild(weeklyCalendar);
    return weeklyCalendarContainer;
}

function generateTimeRow(rowId) {
    //instantiate the <tr> tag for row
    var row = document.createElement("tr");

    //add columns
    var hourColumn = document.createElement("td");
    hourColumn.className = "hourcolumn";
    if (rowId % 2 == 0) {
        hourColumn.innerHTML = rowId / 2 + ":00";
        row.className += "major-row";
    } else {
        hourColumn.innerHTML = "&nbsp;";
        row.className += "minor-row";
    }
    row.appendChild(hourColumn);

    for (var i = 0; i < 7; i++) {
        var timeUnitPanel = timeUnitCellGenerator(timeUnitIndex);
        timeUnitIndex++;
        row.appendChild(timeUnitPanel);
    }
    return row;
}

function timeUnitCellGenerator(index){
    var cell = document.createElement("td");
    cell.className = "timeUnit";
    cell.id = "timeUnit-" + index;
    $(cell).click(function() {
        addNewEvent(index);
    });
    return cell;
}

function addNewEvent(index) {
    $("#myModal").modal('show');
    var item = parseInt(index / 14);
    $("#form_start_hour").val(item);
    $("#form_end_hour").val((item + 1) % 25);
    if (parseInt(index/7) % 2 == 0) {
        $("#form_start_minute").val(0);
        $("#form_end_minute").val(0);
    }
    else {
        $("#form_start_minute").val(30);
        $("#form_end_minute").val(30);
    }
    lastIndex = index;
    $("#dayOfWeek").val(lastIndex % 7);
}

function saveEvent() {
    var e = new CalendarEvent($("#form_title").val(), lastIndex);
    e.id = events.length;
    var hour = parseInt($("#form_end_hour").val());
    var minute = parseInt($("#form_end_minute").val());
    e.endTimeUnit = hour * 14 + (minute == 30 ? 7 : 0) + (lastIndex % 7) - 7;
    e.createPanel($("#form_color option:selected").text());
    events.push(e);

    $.post(
        '/calendar/app_dev.php/createevent',
        $('form').serialize(),
        function(data) {
            console.log(data);
        }
    );
    $("#myModal").modal('hide');
}

function resize(e) {
    if(mouseDownEvent != -1) {
        $(events[mouseDownEvent].panel).height(originalHeight + e.pageY - myY);
    }
}

//data related to each event
function CalendarEvent(title, timeUnitId) {
    this.id = 0;
    this.title = title;
    this.panel = null;
    this.color = null;
    this.timeUnitId = timeUnitId;
    this.timeUnit = $("#timeUnit-" + timeUnitId);
    this.endTimeUnit = timeUnitId;

    this.generate = function() {
        var id = this.id;

        var eventDiv = document.createElement("div");
        eventDiv.id = "event-" + id;
        eventDiv.className = "event";

        var innerDiv = document.createElement("div");
        var eventTimeDiv = document.createElement("div");
        var eventTitleDiv = document.createElement("div");
        var resizeHandleDiv = document.createElement("div");

        innerDiv.id = "inner-" + id;
        eventTimeDiv.id = "eventtime-" + id;
        eventTitleDiv.id = "eventtitle-" + id;
        resizeHandleDiv.id = "resizehandle-" + id;

        innerDiv.className = "event-inner";
        eventTimeDiv.className = "event-time";
        eventTitleDiv.className = "event-title";
        resizeHandleDiv.className = "resize-handle";

        eventTitleDiv.appendChild(document.createTextNode(this.title));
        resizeHandleDiv.appendChild(document.createTextNode("="));
        eventTimeDiv.appendChild(document.createTextNode(""));

        innerDiv.appendChild(eventTimeDiv);
        innerDiv.appendChild(eventTitleDiv);
        eventDiv.appendChild(innerDiv);
        eventDiv.appendChild(resizeHandleDiv);

        $(resizeHandleDiv).mousedown(function(e) {
            myY = e.pageY;
            originalHeight = $(eventDiv).height();
            mouseDownEvent = id;
            $(document).bind("mousemove", resize);
        });

        this.panel = eventDiv;
    };

    this.createPanel = function(color) {
        this.color = color;
        this.generate();
        document.body.appendChild(this.panel);
        this.render();
    };

    this.render = function() {
        var endUnit = $("#timeUnit-" + this.endTimeUnit);
        var height = endUnit.position().top + endUnit.height() - this.timeUnit.position().top;//((this.endTimeUnit - this.timeUnitId) / 7 + 1) * 2;
        $(this.panel).css("width", this.timeUnit.width())
            .css("top", this.timeUnit.position().top)
            .css("left", this.timeUnit.position().left)
//            .addClass("well")
            .css("height", height)
            .css("background-color", this.color);
//        console.log("st: " + this.timeUnitId + " end: " + this.endTimeUnit + " height: " + height);
        this.updateTimeStamp();
    };

    this.updateTimeStamp = function() {
        var time = parseInt(this.timeUnitId / 7);
        var timestamp = "";
        if (time % 2 == 0)
            timestamp = time/2 + ":00";
        else
            timestamp = parseInt(time/2) + ":30";

        var end = parseInt(this.endTimeUnit / 7) + 1;
        timestamp += " - ";
        if (end % 2 == 0)
            timestamp += end/2 + ":00";
        else
            timestamp += parseInt(end/2) + ":30";
//        console.log(timestamp);
        $("#eventtime-" + this.id).html(timestamp);
    };

    return this;
}

function getDateList() {
    $.get(
        '/calendar/app_dev.php/getdates',
        { "offset" : offset},
        function(data) {
            dayDatesGregorian = JSON.parse(data);
            console.log(data);
            updateDates();
        }
    );
}

function updateDates() {
    for (var i = 0; i < 7; i++) {
        $("#dayheader-" + (i+1)).html(dayDatesGregorian[i]);
    }
}

function prevWeek() {
    offset--;
    getDateList();
    loadEvents();
}

function currWeek() {
    offset = 0;
    getDateList();
    loadEvents();
}

function nextWeek() {
    offset++;
    getDateList();
    loadEvents();
}

function loadEvents() {
    events = [];
    mouseDownEvent = -1;
    $(".event").remove();

    $.get(
        '/calendar/app_dev.php/event',
        {
            "offset" : offset
        },
        function(data) {
            console.log(data);
            var es = JSON.parse(data);
            for (var i = 0; i < 7; i++) {
                for (var j = 0; j < es[i].length; j++) {
                    var s_date = new Date(es[i][j].start.date);
                    var s_h = s_date.getHours();
                    var s_m = s_date.getMinutes();
                    var e_date = new Date(es[i][j].end.date);
                    var e_h = e_date.getHours();
                    var e_m = e_date.getMinutes();
                    var timeUnit = s_h * 14 + i + (s_m == 30 ? 7 : 0);

                    console.log(es[i][j]);

                    var e = new CalendarEvent(es[i][j].title, timeUnit);
                    e.id = events.length;
                    e.endTimeUnit = e_h * 14 + (e_m == 30 ? 7 : 0) + i - 7;
                    e.createPanel(es[i][j].color);

                    events.push(e);
                }
            }
        }
    );
}