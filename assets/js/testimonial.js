document.addEventListener('DOMContentLoaded', function () {

    if (document.getElementById('hero_section_thumbnails_container')) {
        new Splide('#hero_section_thumbnails_container', {
            type: 'loop',
            perPage: 3,
            rewind: true,
            autoplay: false,
            interval: 2000,
            gap: 40

        }).mount();
    }


    // products
    let add_to_cart_button = document.querySelectorAll('.add_to_cart_button');
    let cpops_cart_item__product_link = document.querySelectorAll('.cpops-cart-item__product--link');
    let cpops_cart_item__image = document.querySelectorAll('.cpops-cart-item__image')
    if (cpops_cart_item__product_link.length > 0) {
        cpops_cart_item__product_link.forEach(function (item) {
            console.log(item.children[0].textContent);
            item.children[0].removeAttribute('href');
        });
    }
    if(cpops_cart_item__image.length>0){
        cpops_cart_item__image.forEach(function (item) {
            item.children[0].removeAttribute('href');
        });   
    }

    if (add_to_cart_button) {
        add_to_cart_button.forEach(function (btn) {
            btn.addEventListener('click', function () {
                btn.classList.add('disabled');
                btn.setAttribute('disabled', 'disabled');
                btn.innerHTML = "Added to Cart";
                btn.style.pointerEvents = 'none';
                btn.style.cursor = 'default';
                btn.style.background = 'gray';

                setTimeout(function () {
                    btn.classList.remove('ajax_add_to_cart');

                }, [1000]);
            });
        });
    }

});
