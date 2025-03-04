function goToSelected() {
    select_val = document.getElementById("input-type-selector").value;
    if (select_val != "none") {
        document.location.href = select_val;
    }
}