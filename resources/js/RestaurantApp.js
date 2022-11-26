import './bootstrap';

// search
const orders = document.querySelector('#orders');
if (orders) {

    const restaurant_id = document.querySelector('#res-id').value;

    const restaurantChannel = window.Echo.private(`privateRestaurant_${restaurant_id}`);

    restaurantChannel.listen('.restaurantOrders', (data) => {

        // create row
        const row = document.createElement('div');
        row.className = "order-row row";

        // insert data to it
        row.innerHTML = `<div class="col col-lg-2 col-sm-auto col-xs-auto"><p>${data.order_id}</p></div>
                                <div class="col col-lg-2 col-sm-auto col-xs-auto"><p class="text-break">Delivery: ${data.del_name}</p></div>
                                <div class="col col-lg-2 col-sm-auto col-xs-auto fs-3"><p class="text-break">${data.order_order}</p></div>
                                <div class="col col-lg-2 col-sm-auto col-xs-auto"><p>${data.sum_order}</p></div>
                                <div class="col col-lg-2 col-sm-auto col-xs-auto"><button class="ready-btn btn btn-danger">Ready</button></div>`;

        // append row to orders
        orders.prepend(row);
    });

    document.addEventListener("click", btn => {
        if (btn.target.className === "ready-btn btn btn-danger") {
            btn.target.className = "ready-btn btn btn-success";
        }
    });
}
