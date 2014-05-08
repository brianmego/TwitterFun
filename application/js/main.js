window.onload = function() {
    $( "#submit" ).click(
        function() {
            var handle = $( "#username" ).val();
            var password = $( "password" ).val();
            $.ajax("/index.php/twitter/get_followers/" + handle + "/" + password )
            .done(function( result ) {
                $("#username").val(result['handle'] + result['handle']);
            })
        })
}