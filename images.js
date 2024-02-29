const removeEvent = (button) => {

    if (!confirm('Tem certeza que quer apagar a imagem?')) {
        return
    }

    else{

    const id = $(button).closest('tr').find('.id').val()

    console.log(id);

    $.ajax({
        type: "post",
        url: "App.php",
        data: {
            id: id
        },
        dataType: "json",
        success: function (response) {
            if (response.code === 200) {
                location.reload()
            }
        },
        error: (status, error, xhr) => {
            location.reload()
        }
    });
}
}

$(document).ready(function () {
    $('#imageCarousel').on('slid.bs.carousel', function () {
        const currentIndex = $('.carousel-item.active').index()

        $(`.miniature-button[data-bs-slide-to="${currentIndex}"]`).addClass("active-miniature")

        $(".miniature-image").css("opacity", "0.5")

        $(`.miniature-button[data-bs-slide-to="${currentIndex}"] .miniature-image`).css("opacity", "1")
    });


});


