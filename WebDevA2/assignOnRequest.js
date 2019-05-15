xhr = createRequest();
function assignOnRequests(bookingNumber) {
    if (xhr) {

        xhr.open("POST", "assignToRequests.php", true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                               

            }
        };
        xhr.send(null);

    }
}