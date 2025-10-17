$(document).ready(function() {
    /* ==================
        logout
     ==================== */
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

    /*===================
        details page
    ====================*/
    $(".cross-img, .details-cancel-button").on("click", function() {

        close_details_page();
        window.location.href = "home.php";
    });
    $(".edit-details-container").on("click", function (e) {
        if (!$(e.target).closest('.card').length) {
            close_details_page();
        }
    });

    /*========================
       Edit form section
    ====================== */
    $("#editProfileForm").on("submit", function(e) {
        e.preventDefault();
        $.ajax({
            url: "updating_details.php",
            type: "POST",
            data: $(this).serialize(),
            success: function(response) {
                $('#popupContainer').html(`
                    <div class="alert alert-success update-message-popup" role="alert">
                        <strong>updated successfully!</strong>
                    </div>
                `);
                setTimeout(function () {
                    $('.update-message-popup').slideUp(400, function () {
                        $(this).remove();
                    });
                }, 400);
                $('.edit-form-control').each(function () {
                    $(this)
                        .prop('readonly', true)
                        .css({'border': '1px solid transparent'});
                });
                $('.edit-button').each(function () {
                    $(this)
                        .text('Edit')
                        .css({'color': '', 'font-size': '', 'background-color': ''});
                });
            },
            error: function(xhr, status, error) {
                $('#popupContainer').html(`
                    <div class="alert alert-danger update-message-popup" role="alert">
                        <strong>Error updating profile:</strong> ${xhr.responseText}
                    </div>
                `);
                setTimeout(function () {
                    $('.update-message-popup').slideUp(400, function () {
                        $(this).remove();
                    });
                }, 3000);
            }
        });
    });

    /*=================
      closing edit form
    ================== */
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

    /*========================
        inserting data function
    ========================== */
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

    /*===========================
       Fetch function
    ============================== */
    function fetch_comments() {
        $.ajax({
            url: 'fetch.php',
            method: 'GET',
            success: function(data) {
                $('#printing-comments-section').html(data);
            }
        });

        // fetch friends list
        $.ajax({
            url: 'fetch_friends.php',
            method: 'GET',
            success: function(data) {
                $('#friends').html(data.html);
                $('#friend-count').text(data.count + " friends");
            }
        });
    }

    /*==========================
       edit page of form visible
    =========================== */
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

            $btn.text('Edit').css({'background-color': '', 'color': '', 'font-size': ''});
        }
    });

    /*=======================
          desable scrolling
    ======================== */
    $('.profile-name').on('click', function () {
        $('.edit-details-container').fadeIn();
        $('body').addClass('modal-open');
    });

    /*==========================
        Close re-enable scroll
    ============================ */
    $('.cross-img, .details-cancel-button').on('click', function () {
        $('.edit-details-container').fadeOut();
        $('body').removeClass('modal-open');
    });
})