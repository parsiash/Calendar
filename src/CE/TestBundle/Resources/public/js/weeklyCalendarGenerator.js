/**
 * Created with JetBrains PhpStorm.
 * User: parsia
 * Date: 7/12/13
 * Time: 8:44 PM
 * To change this template use File | Settings | File Templates.
 */

/**
 * global variables
 * */
var dayNames = ["monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday"];
var dayNamesFa = ["دوشنبه", "سه شنبه", "چهارشنبه", "پنچ شنبه", "جمعه", "شنبه", "یک شنبه"];
var timeOffset = 1;
var NO_TITLE = "no title";
var weekDays = new Array();
var timeIntervals = new Array();
var timeUnits = new Array();
var events = new Array();
var timeUnitIndex = 0;
var eventCount = 0;
var isDragging = false;
var eventDragged = null;

/**
 * the main code
 * */
$(document).ready(function(){

    /**
     * set events for time Unit Cells
     * */

     $(".timeUnit").mouseenter(function(){
         var timeUnit = timeUnits[$(this).attr("id").split("-")[1]];
         if( timeUnit.hasEvent ){
             if(isDragging){
                isDragging = false;
             }
             return;
         }
         if(isDragging){
             $(this).html("extend Event to here");
             $(this).css("background-color",eventDragged.color);
             $(this).css("color","#FFF");
             return;
         }
        $(this).html("create Event");
        $(this).css("background-color","#222");
        $(this).css("color","#FFF");
    });

     $(".timeUnit").mouseleave(function(){
        $(this).css("background-color","#FFF");
        if( timeUnits[$(this).attr("id").split("-")[1]].hasEvent )
            return;
        $(this).html("");
    });

    $(".timeUnit").mousedown(function(){
        var timeUnit =   timeUnits[$(this).attr("id").split("-")[1]];
        if( !timeUnit.hasEvent ){
            $(this).html("");
            events[eventCount] = new event(NO_TITLE, timeUnit);
            var newEvent = events[eventCount];
            timeUnit.setEvent(newEvent);
            newEvent.createPanel("blue", eventCount);
            eventCount++;
            $("#weeklyCalendar").append(newEvent.panel);
            newEvent.render();
            if(!ajaxCreateEvent(newEvent)){
                newEvent.panel.parentNode.removeChild(newEvent.panel);
                events.pop();
                eventCount--;
            }
        }
    });

    $(".timeUnit").mouseup(function(){
        var wasDragging = isDragging;
        isDragging = false;
        document.onmousemove = null;
        if(wasDragging){
            var timeUnit = timeUnits[$(this).attr("id").split("-")[1]];
            if(!timeUnit.hasEvent || timeUnit.event == eventDragged){
                timeUnit.setEvent(eventDragged);
                eventDragged.extend(timeUnit);
            }
        }
        eventDragged = null;
    });
});


/**
 *generate a div that contains a weekly calendar table and returns it
 * */
function generateWeeklyCalendar(){

    //generate weekDays
    for(var i=0;i<7;i++){
        weekDays[i] = new day(i,"2010-08-17");
    }

    for(var j=0; j<24; j++){
        timeIntervals[j] = new timeInterval(j);
    }

    //instantiate the div that contains calendar table
    var weeklyCalendarContainer = document.createElement("div");
    weeklyCalendarContainer.id = "weeklyCalendarContainer";

    //instantiate the table
    var weeklyCalendar = document.createElement("table");
    weeklyCalendar.className = "table table-bordered table-hover";
    weeklyCalendar.id = "weeklyCalendar";

    //instantiate and append thead and tbody
    var  weeklyCalendarHead = document.createElement("thead");
    var  weeklyCalendarBody = document.createElement("tbody");
    weeklyCalendar.appendChild(weeklyCalendarHead);
    weeklyCalendar.appendChild(weeklyCalendarBody);

    //add headers to thead
    var hourHead = document.createElement("th")
    hourHead.innerHTML = "time interval";
    weeklyCalendarHead.appendChild(hourHead);
    for(var k=0;k<7;k++){
        var head = document.createElement("th");
        head.innerHTML = dayNamesFa[k];
        weeklyCalendarHead.appendChild(head);
    }

    //this loop add row for time intervals to tbody
    for(var l =0;l<24;l++){
        var row = generateTimeRow(timeIntervals[l]);
        weeklyCalendarBody.appendChild(row);
    }

    //append and return the calendar table div container
    weeklyCalendarContainer.appendChild(weeklyCalendar);
    return weeklyCalendarContainer;
}

/**
* return a row of the weekly calendar table
* */

 function generateTimeRow(timeInterval){
    //instantiate the <tr> tag for row
    var row  = document.createElement("tr");

    //add columns
    var hourColumn = document.createElement("td");
    hourColumn.innerHTML = timeInterval.beginHour + " تا " + (timeInterval.lastHour);
    row.appendChild(hourColumn);

    for(var i=0;i<7;i++){
        timeUnits[timeUnitIndex] = new timeUnit(weekDays[i], timeInterval);
        var timeUnitPanel = timeUnitCellGenerator(timeUnitIndex);
        timeUnitIndex++;
        row.appendChild(timeUnitPanel);
    }

    return row;
}


/**
 * objects constructors
 * */


//timeUnit object is for store data related to each table cell
function timeUnit(weekDay, timeInterval){

    this.timeInterval = timeInterval;
    this.weekDay = weekDay;
    this.hasEvent = false;
    this.event;

    this.setEvent = function(event){
        this.event = event;
        this.hasEvent = true;
    }
    this.deleteEvent = function(){
        this.event = null;
        this.hasEvent = false;
    }
    return this;
}

//day object defined for store data about each column of calendar table that related to a real day
function day(weekIndex,date){
    this.weekIndex = weekIndex;
    this.date = date;
    return this;
}

//data related to each row
function timeInterval(beginHour){
    this.beginHour = beginHour;
    this.lastHour = beginHour + timeOffset;
    return this;
}

//data related to each event
function event(title,timeUnit){
    this.title = title;
    this.weekDay = timeUnit.weekDay;
    this.panel;
    this.color;
    this.beginTimeUnit = timeUnit;
    this.endTimeUnit = timeUnit;

    this.createPanel = function(color, eventIndex){
        this.color = color;
        this.panel = eventPanelGenerator(eventIndex);
    }

    this.render = function(){
        this.panel.style.height = ((this.endTimeUnit.timeInterval.beginHour - this.beginTimeUnit.timeInterval.beginHour + 1)/26)*100 + "%";
        this.panel.style.top = ( ((this.beginTimeUnit.timeInterval.beginHour+1)/25)*100) + "%";
        this.panel.style.right = ( ((this.beginTimeUnit.weekDay.weekIndex + 1)/8)*100 + 0.50) + "%";
        this.panel.firstChild.style.backgroundColor  = this.color;
    }

    this.extend = function(endTimeUnit){
        if( endTimeUnit.timeInterval.beginHour < this.beginTimeUnit.timeInterval.beginHour || this.endTimeUnit == endTimeUnit)
            return;
        var lastTimeUnit = this.endTimeUnit;
        this.endTimeUnit = endTimeUnit;
        this.render();
        if(!this.ajaxExtend()){
            this.endTimeUnit = lastTimeUnit;
            this.render();
        }
    }

    this.ajaxExtend = function(){
        return true;
    }

    return this;
}

function weeklyCalendar(){
    this.id;
    this.name;
    this.bedginDate;

}


/**
 * UI generators
 * */
function eventPanelGenerator(eventIndex){
    var panel = document.createElement("div");
    panel.className = "eventPanel";
    panel.id = "event-" + eventIndex;

    //init title container for event title
    var titleContainer = document.createElement("div");
    titleContainer.className = "eventTitleContainer";
    titleContainer.innerHTML = events[eventIndex].title;
    panel.appendChild(titleContainer);
    titleContainer.style.backgroundColor = events[eventIndex].color;

    //init resize area for resizing event panel
    var resizeArea = document.createElement("div");
    resizeArea.className = "resizeArea";
    panel.appendChild(resizeArea);
    resizeArea.onmousedown = function(){
        document.onmousemove = function(){
            isDragging = true;
            eventDragged = events[eventIndex];
            document.onmousemove = null;
        }

        return this;
    }

    return panel;
}

function timeUnitCellGenerator(timeUnitIndex){
    var cell = document.createElement("td");
    cell.className = "timeUnit";
    cell.style.backgroundColor = "white";
    cell.id = "timeUnit-" + timeUnitIndex;
    return cell;
}



/**
 * ajax functions
 * */
function ajaxLoadCalendar(){

}

function ajaxCreateEvent(event){
    $(document).ready(function(){
        $.post("../createevent",{title: event.title, color: event.color, start: (event.beginTimeUnit.weekDay.date + " " + event.beginTimeUnit.timeInterval.beginHour + ":00:00"), end: (event.endTimeUnit.weekDay.date + " " + event.endTimeUnit.timeInterval.lastHour + ":00:00"), calendar_id: 3}, function(data, status){
            $("#side").html(data);
        });
    });
    return true;
}