console.log('javaScrpt is start');

// talking form elements
const kisaanForm = document.getElementById("kisaan-form")
const adminForm = document.getElementById("admin-form")
const operatorForm = document.getElementById("operator-form")


// talking alert box
const response = document.getElementsByClassName('alert')

// talking modal and backdrops
const kisaanModal = document.getElementById('tokenBackdrop')
const adminModal = document.getElementById('adminBackdrop')
const operatorModal = document.getElementById('operatorBackdrop')

const backdrop = document.getElementsByClassName('modal-backdrop')

// functions to execute after submitting form - ajax calls
function kisaanScript(ele) {
    const from = ele.id
    kisaanForm.addEventListener("submit", (event) => {
        event.preventDefault()
        console.log("kisaan-form: " + kisaanForm);
        console.log('kisaan form is submitting');
        const formData = new FormData(event.target)

        console.log(formData);
        // Loop through the FormData object and log the values
        for (var pair of formData.entries()) {
            console.log('loop running');
            console.log(pair[0] + ': ' + pair[1]);
        }


        // sending the data,ajax call to insert
        const xhr = new XMLHttpRequest
        xhr.onreadystatechange = () => {
            if (xhr.readyState == 4 && xhr.status == 200) {
                console.log(xhr.responseText);
                response[0].innerHTML = xhr.responseText
                kisaanModal.style.display = 'none'
                backdrop[0].style.display = 'none'

                // response[0].style.display = "none"
                if (from != "fromop") {
                    setTimeout(() => {

                        window.location = "index.php"
                    }, 5000)
                }
                else {
                    setTimeout(() => {
                        window.location = "operator-dash.php"
                    }, 5000)

                }
            }
        }

        xhr.open('POST', 'db/kisaan.php')
        xhr.send(formData)

    })
}

// LOGIN FUNCTIONS FOR ADMIN & OPERATOR
function adminScript() {
    adminForm.addEventListener("submit", (event) => {
        event.preventDefault()
        console.log('admin form is submitting');
        const formData = new FormData(event.target)

        console.log(formData);
        // Loop through the FormData object and log the values
        for (var pair of formData.entries()) {
            console.log('loop running');
            console.log(pair[0] + ': ' + pair[1]);
        }


        // sending the data,ajax call to check login
        const xhr = new XMLHttpRequest
        xhr.onreadystatechange = () => {
            if (xhr.readyState == 4 && xhr.status == 200) {
                console.log(xhr.responseText);
                if (xhr.responseText == "good") {
                    adminModal.style.display = "none"
                    backdrop[0].style.display = "none"
                    response[0].innerHTML = "redirecting please wait"
                    console.log("redirecting please wait");
                    setTimeout(() => {
                        window.location = "admin-dash.php"
                    }, 1000)
                }
            }
        }

        xhr.open('POST', 'db/admin.php')
        xhr.send(formData)

    })
}

function opScript() {
    operatorForm.addEventListener("submit", (event) => {
        event.preventDefault()
        console.log(operatorForm + 'is submitting');
        const formData = new FormData(event.target)

        console.log(formData);
        // Loop through the FormData object and log the values
        for (var pair of formData.entries()) {
            console.log('loop running');
            console.log(pair[0] + ': ' + pair[1]);
        }


        // sending the data,ajax call to check login
        const xhr = new XMLHttpRequest
        xhr.onreadystatechange = () => {
            if (xhr.readyState == 4 && xhr.status == 200) {
                console.log(xhr.responseText);
                if (xhr.responseText == 1) {
                    operatorModal.style.display = "none"
                    backdrop[0].style.display = "none"
                    response[0].innerHTML = "redirecting please wait"
                    console.log("redirecting please wait");

                    window.location = "operator-dash.php"
                }
                else
                    window.location = "index.php"
            }
        }

        xhr.open('POST', 'db/operator.php')
        xhr.send(formData)

    })
}

/*
 * THIS FUNCTION SHOWS THE  
 * DATA OF KISAAN TO OPERATOR & ADMIN
 * ACCORDING TO THEIR FILTERS
*/
function showData(ele) {
    console.log("clicked: " + ele);
    let bid = ele.id
    console.log(bid);

    if (bid === "op-all-data") {

        const show = document.getElementById("op-data-table")

        if (show.style.display === "none") {
            show.style.display = "block"; // Display the table
        }
        else {
            show.style.display = "none"; // Hide the table
        }
    }
    else if (bid === "ad-all-data") {
        const show = document.getElementById("ad-data-table")

        if (show.style.display === "none") {
            show.style.display = "block"; // Display the table
        }
        else {
            show.style.display = "none"; // Hide the table
        }
    }
    else if (bid === "verified-data") {
        const show = document.getElementById("verified-data-table")

        if (show.style.display === "none") {
            show.style.display = "block"
        }
        else
            show.style.display = "none"
    }
    else if (bid === "unverified-data") {
        const show = document.getElementById("unverified-data-table")

        if (show.style.display === "none") {
            show.style.display = "block"
        }
        else
            show.style.display = "none"
    }
    else if (bid === "deleted-data") {
        const show = document.getElementById("deleted-data-table")

        if (show.style.display === "none") {
            show.style.display = "block"
        }
        else
            show.style.display = "none"
    }
    else if (bid === "sms-data") {
        const show = document.getElementById("sms-data-table")

        if (show.style.display === "none") {
            show.style.display = "block"
        }
        else
            show.style.display = "none"
    }
}

    /*
        FUNCTION THAT SEND DATA
        TO VERIFIED TABLE
    */
    function status(ele) {
        // accessing button's data attribute value
        const bid = ele.id  //operation value
        const token = document.getElementById("token").value
        const name = document.getElementById("name").value
        const phone = document.getElementById("phone").value
        const tahseel = document.getElementById("tahseel").value
        const samagra = document.getElementById("samagra").value
        const bahi = document.getElementById("bahi").value
        const rakva = document.getElementById("rakva").value
        const date = document.getElementById("date").value
        const vitrank = document.getElementById("vitrank").value
        const gram = document.getElementById("gram").value
        const status = document.getElementById("status").value
        const reason = document.getElementById("reason").value



        console.log("button is clicked & this kisaan will: " + bid);
        console.log("token: " + token);
        console.log("name: " + name);
        console.log("phone: " + phone);
        console.log("tahseel: " + tahseel);
        console.log("samagra: " + samagra);
        console.log("bahi: " + bahi);
        console.log("rakva: " + rakva);
        console.log("date: " + date);
        console.log("vitrankendra: " + vitrank);
        console.log("status: " + status);
        console.log("reason: " + reason);
        console.log("gram: " + gram);

        const data = new FormData()
        data.append("buttonid", bid)
        data.append("kisaantn", token)
        data.append("kisaanname", name)
        data.append("kisaanphone", phone)
        data.append("kisaantahseel", tahseel)
        data.append("kisaansamagra", samagra)
        data.append("kisaanbahi", bahi)
        data.append("kisaanrakva", rakva)
        data.append("kisaandate", date)
        data.append("kisaanvitrankendra", vitrank)
        data.append("kisaanstatus", status)
        data.append("kisaanreason", reason)
        data.append("kisaangram", gram)

        for (const pair of data.entries()) {

            console.log(pair[0] + " " + pair[1]);
        }

        // ajax call to update values
        const xhr = new XMLHttpRequest
        xhr.onreadystatechange = () => {
            if (xhr.readyState == 4 && xhr.status == 200) {
                console.log(xhr.responseText);
                response[0].innerHTML = xhr.responseText

                // response shows for 5 seconds
                setTimeout(() => {
                    response[0].style.display = "none"
                    window.location("operator-dash.php");
                }, 5000);
            }
        }

        xhr.open('POST', 'db/status.php')
        xhr.send(data)

    }



    function toggleRB() {
        const reasonBox = document.getElementById("reason")
        const status = document.getElementById("status").value
        console.log(reasonBox);
        console.log(status);
        if (status == "verified" && status == "pending") {
            reasonBox.style.background = "red";
        }
    }
