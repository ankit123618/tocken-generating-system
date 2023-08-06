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
                else
                    window.location = "operator-dash.php"
            }
        }

        xhr.open('POST', 'db/kisaan.php')
        xhr.send(formData)

    })
}

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

    if (bid === "all-data") {

        const show = document.getElementById("data-table")
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
    // else if (bid === "vitrankendra-data") {
    //     const show = document.getElementById("vitran-btn")
    //     if (show.style.display === "none") {
    //         show.style.display = "block"
    //     }
    //     else
    //         show.style.display = "none"
    // }
    // else if (bid === "date-data") {
    //     const show = document.getElementById("date-btn")
    //     if (show.style.display === "none") {
    //         show.style.display = "block"
    //     }
    //     else
    //         show.style.display = "none"
    // }
}

/*
    FUNCTION THAT SEND DATA
    TO VERIFIED TABLE
*/
function status(ele) {
    // accessing button's data attribute value
    const bid = ele.id  //operation value
    const token = ele.dataset.id
    const name = ele.dataset.name
    const phone = ele.dataset.phone
    const tahseel = ele.dataset.tahseel
    const samagra = ele.dataset.samagra
    const bahi = ele.dataset.bahi
    const rakva = ele.dataset.rakva
    const date = ele.dataset.date
    const vitrank = ele.dataset.vitrank
    const status = document.getElementById("status")
    const ta = ele.dataset.ta
    const da = ele.dataset.da

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
    console.log("ta: " + ta);
    console.log("da: " + da);


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
    data.append("kisaanta", ta)
    data.append("kisaanda", da)

    for (const pair of data) {

        console.log(pair[0] + " " + pair[1]);
    }

    // ajax call to update values
    const xhr = new XMLHttpRequest
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log(xhr.responseText);
            response[0].innerHTML = xhr.responseText
            
            // // response shows for 5 seconds
            // setTimeout(() => {
            //     response[0].style.display = "none"
            //     window.location("operator-dash.php");
            // }, 5000);
        }
    }

    xhr.open('POST', 'db/status.php')
    xhr.send(data)

}


function downloadSheet(ele) {
    const id = ele.id

    const data = new FormData()
    data.append("id", id)

    if(id == 'download-all'){

        
        const xhr = new XMLHttpRequest
        xhr.onreadystatechange = () => {
            if (xhr.readyState == 4 && xhr.status == 200) {
                
            }
        }
    
        xhr.open('POST', 'db/download-data.php')
        xhr.send(data)
    
    }
}

