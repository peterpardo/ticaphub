const MONTH_NAMES = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
const DAYS = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

function app() {
    return {
        month: '',
        year: '',
        no_of_days: [],
        blankdays: [],
        days: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],

        events: [],
        event_id: '',
        event_title: '',
        event_date: '',
        event_theme: 'blue',
        attendees: [],
        current_date: '',
        error: '',

        themes: [
            {
                value: "blue",
                label: "Blue Theme"
            },
            {
                value: "red",
                label: "Red Theme"
            },
            {
                value: "yellow",
                label: "Yellow Theme"
            },
            {
                value: "green",
                label: "Green Theme"
            },
            {
                value: "purple",
                label: "Purple Theme"
            }
        ],

        openEventModal: false,
        showError: false,
        showDelete: false,
        toUpdate: false,

        initDate() {
            let today = new Date();
            this.month = today.getMonth();
            this.year = today.getFullYear();
            this.datepickerValue = new Date(this.year, this.month, today.getDate()).toDateString();
        },

        isToday(date) {
            const today = new Date();
            const d = new Date(this.year, this.month, date);

            return today.toDateString() === d.toDateString() ? true : false;
        },

        showEventModal(date, action) {
            this.event_id = '';
            this.event_title = '';
            this.event_theme = 'blue';
            this.attendees = [];
            this.showDelete = false;
            this.toUpdate = false;
            let today = new Date();

            if(new Date(this.year, this.month, date) < new Date(today.getFullYear(), today.getMonth(), today.getDate())) {
                alert("Can't add event in this date anymore.");
                return;
            }

            if(action == "update") {
                this.showDelete = true;
                this.toUpdate = true;
            }

            this.current_date = date;
            this.openEventModal = true;
            this.event_date = new Date(this.year, this.month, date).toDateString();
        },

        addEvent() {
            if (this.event_title == '') {
                this.showError = true;
                this.error = "Event title is required";
                return;
            } 

            let formData = {
                event_date: new Date(this.year, this.month, this.current_date).toLocaleDateString('en-CA'),
                event_title: this.event_title,
                event_theme: this.event_theme,
                attendees: this.attendees,
            }

            let url = '';
            if(this.toUpdate) {
                url = `/schedules/update/${this.event_id}`;
            } else {
                url = '/schedules/create';
            }

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Content-Type': 'application/json;charset=utf-8',
                },
                body: JSON.stringify(formData),
            })
            .then(response => response.json())
            .then(messages => {
                if(messages.errors) {
                    this.showError = true;
                    let { event_title } = messages.errors;
                    if(event_title) {
                        this.error += event_title;
                    }
                } else {
                    alert(messages.success);
                    this.event_title = '';
                    this.event_date = '';
                    this.attendees = [];
                    this.error = '';
                    this.event_theme = 'blue';
                    this.openEventModal = false;
                }
            })
            .catch(err => console.log(err));

            this.getEvents();
        },

        getNoOfDays() {
            let daysInMonth = new Date(this.year, this.month + 1, 0).getDate();

            // find where to start calendar day of week
            let dayOfWeek = new Date(this.year, this.month).getDay();
            let blankdaysArray = [];
            for ( var i=1; i <= dayOfWeek; i++) {
                blankdaysArray.push(i);
            }

            let daysArray = [];
            for ( var i=1; i <= daysInMonth; i++) {
                daysArray.push(i);
            }
            
            this.blankdays = blankdaysArray;
            this.no_of_days = daysArray;
        },

        getEvents() {
            this.events = [];
            fetch('/schedules/events')
                .then(response => response.json())
                .then(events => { 
                    events.forEach(event => this.events.push(event))
                });
        },

        updateEvent(title, theme, date, attendees, id) {        
            this.showEventModal(date, "update");

            if(attendees) {
                attendees.forEach(attendee => { this.attendees.push(attendee.name) });
            }

            this.event_id = id;
            this.event_title = title;
            this.event_theme = theme;
        },

        deleteEvent() {
            fetch(`/schedules/delete/${this.event_id}`, {
                method: 'POST', 
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
            })
                .then(response => response.json())
                .then(message => alert(message.success))
            this.getEvents();
            this.openEventModal = false;
        }
    }
}