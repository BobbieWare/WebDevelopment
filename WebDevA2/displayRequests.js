var xhr = createRequest();
function displayAll()
{
    var resultsDiv = document.getElementById("resultsDiv");
    resultsDiv.removeAttribute("hidden");
    
    if (xhr) {

        xhr.open("POST", "getRequests.php", true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var requests = JSON.parse(xhr.responseText);


                var table = document.getElementById("table");

                if (table.firstChild != null) {
                    var badIEBody = table.childNodes[0];
                    table.removeChild(badIEBody);
                }
                var tBody = document.createElement("TBODY");
                table.appendChild(tBody);

                for (var i = 0; i < requests.length; i++) {

                    var row = document.createElement("tr");
                    var td = document.createElement("td");

                    var request = requests[i];
                    var requestNumber = request.BOOKING_NUMBER;
                    var customerName = request.CUSTOMER_NAME;
                    var customerPhone = request.CUSTOMER_PHONE;
                    var datetimeBooked = request.DATETIME_BOOKED;
                    var destination = request.DESTINATION_SUBURB;
                    var pickupDate = request.PICKUP_DATE;
                    var pickupTime = request.PICKUP_TIME;
                    var status = request.STATUS;
                    var streetAddress = request.STREET_ADDRESS;

                    var form = document.createElement("form");
                    var assignButton = document.createElement("input");
                    form.appendChild(assignButton);

                    assignButton.type = "button";
                    assignButton.onClick = "assignOnRequests(" + requestNumber + ")";
//                    .appendChild(assignButton);
                }

            }
        };
        xhr.send(null);
    }
}

