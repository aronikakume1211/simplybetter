
document.addEventListener('DOMContentLoaded', function () {


    function getCookie(name) {
        let cookieArr = document.cookie.split(';');

        for (let i = 0; i < cookieArr.length; i++) {
            let cookiePair = cookieArr[i].split('=');

            /* Removing whitespace at the beginning of the cookie name
            and compare it with the given string */
            let cookieName = cookiePair[0].trim();
            if (cookieName === name) {
                // Decode the cookie value and return it
                return decodeURIComponent(cookiePair[1]);
            }
        }

        // Return null if not found
        return null;
    }

    // Usage
    let country_name = "a2simplybetter_country_name";
    let cookieValue = getCookie(country_name);

    let selected_country = document.getElementById('selected_country');
    let selected_country_name = document.getElementById('selected_country_name');
    let billing_city = document.getElementById('shipping-city');
    // return_to_cart.removeAttribute('href');

    setTimeout(function () {
        let return_to_cart = document.querySelector('.wc-block-components-checkout-return-to-cart-button');
        let cpops_modal_sidebar = document.querySelector('.cpops-modal');
        console.log(cpops_modal_sidebar);
        console.log('Return', return_to_cart);
        return_to_cart.style.cursor = 'pointer';
        return_to_cart.removeAttribute('href');
        return_to_cart.addEventListener('click', () => {
            cpops_modal_sidebar.classList.add('cpops-show');
            cpops_modal_sidebar.style.display = 'block';
            cpops_modal_sidebar.style.paddingRight = '15px';
        })
    }, [5000]);
    if (cookieValue) {
        if (selected_country_name) {
            selected_country_name.innerHTML = cookieValue;
        }
        if (billing_city) {
            billing_city.setAttribute('value', cookieValue);
            // billing_city.value = cookieValue;
        }
        console.log('Hello Value', billing_city);
    }



    let location_popup_container_overlay = document.querySelector('.location_popup_container_overlay');
    let popular_city_list_item = document.querySelectorAll('.popular_city_list_item');
    let other_city_list_item = document.querySelectorAll('.other_city_list_item');

    setTimeout(function () {
        if (!cookieValue) {
            location_popup_container_overlay.style.display = 'flex';
            location_popup_container_overlay.classList.add('show_popup');
        }
    }, [2000]);

    selected_country.addEventListener('click', () => {
        location_popup_container_overlay.style.display = 'flex';
        location_popup_container_overlay.classList.add('show_popup');
    })


    if (popular_city_list_item) {
        popular_city_list_item.forEach(function (item) {
            item.addEventListener('click', function () {
                // location_popup_container_overlay.style.display = 'none';
                location_popup_container_overlay.classList.remove('show_popup');
                let country_name = "a2simplybetter_country_name";
                let value = item.textContent.trim(' ');
                let days = 7;
                let expires = "";
                if (days) {
                    const date = new Date();
                    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                    expires = "; expires=" + date.toUTCString();
                }
                document.cookie = country_name + "=" + (value || "") + expires + "; path=/";
                selected_country_name.innerHTML = value;
            });
        });
    }

    if (other_city_list_item) {
        other_city_list_item.forEach(function (item) {
            item.addEventListener('click', function () {
                // location_popup_container_overlay.style.display = 'none';
                location_popup_container_overlay.classList.remove('show_popup');
                let country_name = "a2simplybetter_country_name";
                let value = item.textContent.trim(' ');
                let days = 7;
                let expires = "";
                if (days) {
                    const date = new Date();
                    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                    expires = "; expires=" + date.toUTCString();
                }
                document.cookie = country_name + "=" + (value || "") + expires + "; path=/";
                selected_country_name.innerHTML = value;
            });
        });
    }


});