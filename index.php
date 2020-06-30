<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body>
    <div class="row m-2 justify-content-center text-center">
        <div class="website col-5 bg-light m-3" style="border-radius:20px">
        </div>
        <div class="col-5 m-3">
            <span class="btn btn-dark">Status : <b class="status">Waiting</b></span>
            <span class="btn btn-outline-dark">Count User Created : <b class="count_user">0</b> </span>
            <br>
            <br>
            <img src="https://cdn.dribbble.com/users/948184/screenshots/5878985/520_washing_machine_db.gif"
                style="border-radius:10px" width="400px" alt="">

            <div class="row justify-content-center result">

            </div>
            <br>
            <br>
        </div>
    </div>

</body>

</html>

<script>
    window.setInterval(function () {
        $(".status").html('Waiting');
        //Start Generate Name And Password
        function makeid(length) {
            var result = '';
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for (var i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
        }

        var name = makeid(8);
        var password = makeid(8);
        // End Generate Name And Password

        // Start Suffle Operator + - *
        opertator = ['+', '-', '+', '*'];

        function shuffle(array) {
            var currentIndex = array.length,
                temporaryValue, randomIndex;
            while (0 !== currentIndex) {
                randomIndex = Math.floor(Math.random() * currentIndex);
                currentIndex -= 1;
                temporaryValue = array[currentIndex];
                array[currentIndex] = array[randomIndex];
                array[randomIndex] = temporaryValue;
            }
            return array;
        }
        x = shuffle(opertator);
        //End Suffle Operator + - *
        //Start View Status
        var status = $(".status").html();
        var count_user = parseInt($(".count_user").text());
        //End View Status
        $.ajax({
            type: "POST",
            url: "website.php",
            corssDomain: true,
            data: {
                name: name,
                password: password,
                confirm_password: password,
                op1: x[0],
                op2: x[1],
                op3: x[2],
                op4: x[3]
            },
            success: function (response) {
                $(".website").html(response);
                var array = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11];
                $("label").each(function (i, object) {
                    $(this).attr("id", "math" + array[i]);
                });
                $("input[name='name']").val(name);
                $("input[name='password']").val(password);
                $("input[name='confirm_password']").val(password);
                $("input[name='op1']").val(x[0]);
                $("input[name='op2']").val(x[1]);
                $("input[name='op3']").val(x[2]);
                $("input[name='op4']").val(x[3]);
                if ($(".msg p").text() !== "*the equaition is not correct !! ") {
                    count_user++;
                    $(".status").html('Yes !');
                    $(".count_user").html(count_user);
                    $(".result").append(
                        `<div class="card m-2 p-2" style="width: 13rem;">
                    <img src="https://image.freepik.com/free-psd/simple-black-men-s-tee-mockup_53876-57893.jpg" class="card-img-top" alt="...">
                    <div class="card-body text-left">
                        <small class="card-text">Name : ` + name + `</small>
                        <br>
                        <small class="card-text">Password : ` + password + `</small>
                    </div>
                </div>`)
                   
                }
            },
            error: function (err) {
                $(".website").html(response);
            }
        })
    }, 300);
</script>