$(document).ready(function() {
    $('.rating-star').on('click', function() {
        const rating = $(this).data('rating');
        $('#rating').val(rating);
        $('.rating-star').removeClass('fas').addClass('far');
        $(this).prevAll().addBack().removeClass('far').addClass('fas');
    });

    $('#rating-form').on('submit', function(event) {
        event.preventDefault();
        const form = $(this);
        const formData = form.serialize();
        const feedback = $('.feedback');
        const timer = $('#timer');
        const countdown = $('#countdown');
        let seconds = 5;

        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: formData,
            dataType: 'json',
            complete: function() {
                feedback.show();
                timer.show();
                const interval = setInterval(function() {
                    seconds--;
                    countdown.text(seconds);
                    if (seconds === 0) {
                        clearInterval(interval);
                        window.location.href = '/companies/ratings';
                    }
                }, 1000);
            }
        });
    });
});
