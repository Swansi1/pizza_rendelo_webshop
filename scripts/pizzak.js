let pizza = {};


// Kosár része
pizza.torolkosar = function(id) {
    /// 
    $.post("../function/kosar.php", { method: "removekosar", pizzaid: id })
        .done(function(data) { console.log(data) });
    $(`#kosar_pizza_${id}`).remove(); // kosárból törlés
};

pizza.addKosar = function(id) { //hozzá adja a pizzát a kosárhoz / ha létezik módosítja a mennyiséget
    $.get("../function/kosar.php", { method: "getPizzaById", pizzaid: id })
        .done(function(data) {

            var cPizza = JSON.parse(data);
            var pizzaDb = 1;
            if ($(`#kosar_pizza_${id}`).length) {
                let e = Number($(`#pizza_input_${id}`).val()) + 1; // lekéri a pizza value-t és hozzáad egyet
                pizzaDb = e;
                $(`#pizza_input_${id}`).val(e);
            } else {
                let e = `<p id="kosar_pizza_${id}"><i class="fa-solid fa-pizza-slice"></i> ${cPizza.nev} <br>
                Mennyiség: <input type="number" name="pizza_${id}" onchange="pizza.modifyKosar(${id},this.value)" id="pizza_input_${id}" value="1"  min="1" max="99">
                <button onclick="pizza.torolkosar(${id})">Törlés</button>
                <hr>
                </p>`;
                $("#kosar-content-append").prepend(e);
            }
            pizza.modifyKosar(id, pizzaDb)
        });
};

pizza.modifyKosar = function(id, mennyiseg) { //ha a kosárban lévő inputban változtatja az uriember a dolgokat
    $.post("../function/kosar.php", { method: "addkosar", pizzaid: id, pizzadb: mennyiseg })
        .done(function(data) { console.log(data) });

};


pizza.rendelesLeadva = function() {
    //TODO ki kell töröltetni vele mindent 
    let kosartartalma = JSON.parse(sessionStorage.getItem('kosar'));
    if (kosartartalma === null) { // ha üres a kosár akkor nem tud mit ráfrissíteni..
        return;
    }
    kosartartalma.forEach(kosar => {
        pizza.torolkosar(kosar[0]);
    })
}