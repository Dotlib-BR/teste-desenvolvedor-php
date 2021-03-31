$(() => {
    const $image = $('#image');


    if ($image) {
        $image.on('change', () => {
            let file = document.querySelector('#image').files[0];

            const render = new FileReader();

            render.onload = function () {
                $(".render__image").attr("src", render.result);
            }

            render.readAsDataURL(file);
        });
    }

});