$(document).ready(function() {
    $('#imageCarousel').on('slid.bs.carousel', function() {
        const currentIndex = $('.carousel-item.active').index()

        $(`.miniature-button[data-bs-slide-to="${currentIndex}"]`).addClass("active-miniature")

        $(".miniature-image").css("opacity", "0.5")

        $(`.miniature-button[data-bs-slide-to="${currentIndex}"] .miniature-image`).css("opacity", "1")
    });
});
