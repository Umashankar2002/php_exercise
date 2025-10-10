
$(document).ready(function() {
    // logout 
    $('#profile-logout').on('click', function(e) {
        e.stopPropagation();
        $('#profile-details-container').toggle();
    });

    $('#profile-details-container').on('click', function(e) {
        e.stopPropagation();
    });
    $('.edit-details-container').on('click', function(e) {
        e.stopPropagation();
    });
    $(document).on('click', function() {
        $('#profile-details-container').hide();
    });

    $(".profile-name").on("click", show_detail_page);
    function show_detail_page() {
        $(".edit-details-container").show();
    }

    // details page
    $(".cross-img, .details-cancel-button").on("click", close_details_page);

    $(".edit-details-container").on("click", function (e) {
        if (!$(e.target).closest('.card').length) {
            close_details_page();
        }
    });

    function close_details_page() {
        $(".edit-details-container").hide();
        $("#profile-details-container").hide();
        $("body").removeClass("modal-open");
    }

    // phone number validation
    $('#phone').on('keyup', function() {
        let phone = $(this).val();
        console.log("Phone input value:", phone);
        if (phone.length === 10 && /^\d+$/.test(phone)) {
            $("#phone-error").text("");
        } else {
            $("#phone-error").text("Invalid phone number");
        }
    });

    // popup closing
    setTimeout(function () {
        $('.message-popup').slideUp(400, function () {
            $('.message-popup').hide();
        });
    }, 400);


    fetch_comments();

    // inserting data function
    $('#commentform').on('submit', function(e) {
        e.preventDefault();

        var comment = $('#comment').val().trim();

        if (comment !== "") {
            $.ajax({
                url: 'insert.php',
                method: 'POST',
                data: { comment: comment },
                success: function(response) {
                    $('#comment').val('');
                    fetch_comments();
                }
            });
        }
    });

    // Fetch function
    function fetch_comments() {
        $.ajax({
            url: 'fetch.php',
            method: 'GET',
            success: function(data) {
                $('#printing-comments-section').html(data);
            }
        });
        $.ajax({
            url: 'fetch_friends.php',
            method: 'GET',
            success: function(data) {
                $('#friends').html(data);
            }
        });
    }

    // for edit page of form visible
    $('.edit-form-control').prop('readonly', true);
    $('.edit-button').on('click', function(e) {
        e.preventDefault();
        const $btn = $(this);
        const $container = $btn.closest('.edit-container');
        const $input = $container.next('.edit-input-field').find('.edit-form-control');
        if ($input.prop('readonly')) {
            $input.data('original-value', $input.val());
            $input.prop('readonly', false)
                .css({'border': '2px solid #ccc'})
                .focus();

            $btn.text('Cancel').css({'color': '#0064D1', 'font-size': '15px'});
        } else {
            const originalValue = $input.data('original-value');
            if (originalValue !== undefined) {
                $input.val(originalValue);
            }
            $input.prop('readonly', true)
                .css({'border': '1px solid transparent'});

            $btn.text('Edit').css({'background-color': '', 'color': ''});
        }
    });

    // desable scrolling
    $('.profile-name').on('click', function () {
        $('.edit-details-container').fadeIn();
        $('body').addClass('modal-open');
    });

    // Close re-enable scroll
    $('.cross-img, .details-cancel-button').on('click', function () {
        $('.edit-details-container').fadeOut();
        $('body').removeClass('modal-open');
    });
   
})
