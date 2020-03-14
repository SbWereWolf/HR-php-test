function savePrice(form, event) {
    event.preventDefault();

    var details = {
        "price": form.elements["price"].value,
        "_token": form.elements["_token"].value,
    };

    var formParameters = [];
    for (var property in details) {
        var encodedKey = encodeURIComponent(property);
        var encodedValue = encodeURIComponent(details[property]);
        formParameters.push(encodedKey + "=" + encodedValue);
    }
    formBody = formParameters.join("&");

    const headers = new Headers({
        "Content-Type":
            "application/x-www-form-urlencoded;charset=UTF-8",
    });
    const id = form.elements["id"].value;
    const request = new Request(`/api/v1/product/price/${id}`, {
        method: "POST",
        headers: headers,
        body: formBody,
    });

    const output = form.elements["status"];
    fetch(request)
        .then((response) => response.json())
        .then((json) => {
            output.value = json.result;
        })
        .catch(() => {
            output.value = "⛔";
        });
}