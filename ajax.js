
$(document).ready(function() {
    $('#profile-logout').on('click', show_logout);

    function show_logout() {
        console.log($("#profile-details-container").length);
        
        $('#profile-details-container').toggle();
    }

    $(".profile-name").on("click", show_detail_page);
    function show_detail_page() {
        $(".edit-details-container").show();
    }

     $(".cross-img").on("click", close_details_page);
    $(".details-cancel-button").on("click", close_details_page);
    function close_details_page() {
        $(".edit-details-container").hide();
        $('#profile-details-container').hide();
    }

    
    $('#phone').on('keyup', function() {
        let phone = $(this).val();
        console.log("Phone input value:", phone);

        // Example: Check if 10 digits
        if (phone.length === 10 && /^\d+$/.test(phone)) {
            $("#phone-error").text("");
        } else {
            $("#phone-error").text("Invalid phone number");
        }
    });


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


   

    // function fetch_comments() {
    //     $.ajax({
    //         url: 'fetch_login_person_details.php',
    //         method: 'GET',
    //         success: function(data) {
    //             $("#profile-details-page").html(data);
    //         }
    //     });
    // }
})
