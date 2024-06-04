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

    if (add_to_cart_button) {
        add_to_cart_button.forEach(function (btn) {
            btn.addEventListener('click', function () {
                btn.classList.add('disabled');
                btn.setAttribute('disabled', 'disabled');
                btn.innerHTML="Added to Cart";
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
