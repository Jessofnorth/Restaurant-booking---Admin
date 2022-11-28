"use strict"
/* @author Jessica Ejelöv - jeej2100@student.miun.se */
// properties
const url = "https://studenter.miun.se/~jeej2100/writeable/johansAPI/menu.php";
const url_booking = "https://studenter.miun.se/~jeej2100/writeable/johansAPI/booking.php";
const bookingsEl = document.getElementById("bookings");
const errorEl = document.getElementById("error");

// init
window.onload = init();

function init() {
    if (bookingsEl != null) {
        getBookingsFromToday();
    }
}

// MENU
// update dish with id and contenteditable
function updateDish(id) {
    // get elements and their content
    const updaterrorEl = document.getElementById('updaterror-' + id);
    const nameEl = document.getElementById("name-edit-" + id);
    const priceEl = document.getElementById("price-edit-" + id);
    const infoEl = document.getElementById("info-edit-" + id);
    let name = nameEl.innerHTML;
    let price = priceEl.innerHTML;
    parseInt(price);
    let info = infoEl.innerHTML;
    //  check if empty
    if (name != "" && price != "" && info != "") {
        // create JSON
        let jsnStr = JSON.stringify({
                name: name,
                price: price,
                info: info
            })
            // fetch with PUT to API with id
        fetch(url + "?id=" + id, {
                method: "PUT",
                headers: {
                    "content-type": "application/json"
                },
                body: jsnStr
            })
            .then(response => response.json())
            .catch(err => console.log(err))
        updaterrorEl.innerHTML = "";
    } else {
        // print error if not all fields are filled
        updaterrorEl.innerHTML = "Alla fält måste vara ifyllda!";
    }
}

// activate update btn when dish is changed thru contenteditable
function activateUpdateBtn(id) {
    document.getElementById('btn' + id).removeAttribute("disabled");
}

// delete the dish with id
function deleteDish(id) {
    // confirm delete
    if (confirm("Radera maträtten?")) {
        // fetch with DELETE and id
        fetch(url + "?id=" + id, {
                method: "DELETE"
            })
            .then(response => response.json())
            .then(data => {
                // reload page so PHP can rewrite the meny list
                document.location.reload();
            })
            .catch(err => {
                console.log(err);
            })
    }
}

// BOOKINGS
// get bookings with todays date and forward
function getBookingsFromToday() {
    // create date and set into format yyyy-mm-dd
    let today = new Date();
    let year = today.getFullYear();
    let month = today.getMonth() + 1;
    let day = today.getDate();
    let fulldate = year + "-" + month + "-" + day;
    fulldate = fulldate.toString();
    // fetch with GET for bookings from date and forward
    fetch(url_booking + "?date=" + fulldate)
        .then(response => {
            if (response.status != 200) {
                errorEl.innerHTML = "Det finns inga bokningar."
            }
            return response.json()
        })
        .then(data => {
            // print bookings if any
            printBookings(data);
        })
        .catch(err => {
            console.log(err);
        })

}
//  print bookings to DOM
function printBookings(booking) {
    // foreach print with conenteditalbe, functions and id:s for UPDATE/DELETE
    booking.forEach((b) => {
        bookingsEl.innerHTML += `
            <div class="display-grid">
            <p>Datum:</p>
            <p id="date-edit-${b.booking_id}" oninput="activateUpdateBtn(${b.booking_id})" contenteditable>${b.date}</p>
            <p>Namn:</p>
            <p id="name-edit-${b.booking_id}" oninput="activateUpdateBtn(${b.booking_id})" contenteditable>${b.name}</p>
            <p>Telefon:</p>
            <p id="phone-edit-${b.booking_id}" oninput="activateUpdateBtn(${b.booking_id})" contenteditable>${b.phone}</p>
            <p>Email:</p>
            <p id="email-edit-${b.booking_id}" oninput="activateUpdateBtn(${b.booking_id})" contenteditable>${b.email}</p>
            <p>Antal gäster:</p>
            <p id="count-edit-${b.booking_id}" oninput="activateUpdateBtn(${b.booking_id})" contenteditable>${b.count}</p>
            <p>Meddelande:</p>
            <p id="msg-edit-${b.booking_id}" oninput="activateUpdateBtn(${b.booking_id})" contenteditable>${b.message}</p>
            <button id="btn${b.booking_id}" onclick="updateBooking(${b.booking_id})" disabled>Spara</button>
            <button id="btn${b.booking_id}" onclick="deleteBooking(${b.booking_id})">Radera</button>
            <p class="error" id="updaterrorbooking"></p>
            </div>
            `

    })
}
// update the booking 
function updateBooking(id) {
    // get elements and their content
    const updaterrorbookingsEl = document.getElementById("updaterrorbooking");
    const nameEl = document.getElementById("name-edit-" + id);
    const dateEl = document.getElementById("date-edit-" + id);
    const phoneEl = document.getElementById("phone-edit-" + id);
    const emailEl = document.getElementById("email-edit-" + id);
    const countEl = document.getElementById("count-edit-" + id);
    const messageEl = document.getElementById("msg-edit-" + id);
    let name = nameEl.innerHTML;
    let date = dateEl.innerHTML;
    let phone = phoneEl.innerHTML;
    let email = emailEl.innerHTML;
    let count = countEl.innerHTML;
    let message = messageEl.innerHTML;
    // check if inputs empty
    if (name != "" && date != "" && phone != "" && email != "" && count != "") {
        // create JSON
        let jsnStr = JSON.stringify({
                name: name,
                phone: phone,
                email: email,
                date: date,
                count: count,
                message: message
            })
            // fetch with PUT to API to update booking
        fetch(url_booking + "?id=" + id, {
                method: "PUT",
                headers: {
                    "content-type": "application/json"
                },
                body: jsnStr
            })
            .then(response => response.json())
            .catch(err => console.log(err))
        updaterrorbookingsEl.innerHTML = "";
    } else {
        // print error if not all fields are filled
        updaterrorbookingsEl.innerHTML = "Alla fält måste vara ifyllda!";
    }
}
// delete booking with id
function deleteBooking(id) {
    // confirm delete
    if (confirm("Radera bokningen?")) {
        fetch(url_booking + "?id=" + id, {
                method: "DELETE"
            })
            .then(response => response.json())
            .then(data => {
                // reload page so PHP can rewrite the meny list
                document.location.reload();
            })
            .catch(err => {
                console.log(err);
            })
    }
}