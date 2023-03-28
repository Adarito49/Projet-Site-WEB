function generateStarRating(rating) {
    let stars = '';
    for (let i = 1; i <= 5; i++) {
        if (rating >= i) {
            stars += '<i class="fas fa-star"></i>';
        } else if (rating >= i - 0.5) {
            stars += '<i class="fas fa-star-half-alt"></i>';
        } else {
            stars += '<i class="far fa-star"></i>';
        }
    }
    return stars;
}

$(document).ready(function() {
    $('.star-rating').each(function() {
        const rating = parseFloat($(this).data('rating'));
        $(this).html(generateStarRating(rating));
    });
});
