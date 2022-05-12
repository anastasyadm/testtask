jQuery(document).ready(function() {
    $('input[type="radio"]').click(function () {
        var target = $(this).val();
        let elem = document.getElementById('result');
        $.ajax({
            URL: "tool.php",
            method: "POST",
            cache: false,
            dataType:"html",
            data: {
                tar: target
            },

            success: function (d) {
                elem.innerHTML = d;
            }

        });

    });
})



