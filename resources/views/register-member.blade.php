<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Itim&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/register-member.css')}}">

    <!-- JS -->
    <script src="{{ asset('js/register-member.js')}}" defer></script>
</head>

<body>
    <div class="body">
        <div class="card">
            <img class="logoBNCC" src="{{ asset('assets/images/bncc-logo.svg')}}" alt="Logo BNCC">
            <div class="input-box">
                <form class="input-form">
                    <div class="group-wrapper">
                        <label for="groupName">Group Name</label>
                        <input type="text" id="groupName" name="groupName">
                        <div class="requirement">

                        </div>
                    </div>

                    <span class="input-data">Input Data Member</span>

                    <div class="member-wrapper">
                        <div class="member-input" id="member-1">
                            <label for="member1">Member 1</label>
                            <input type="text" id="member1" name="member1">
                        </div>

                        <div class="member-input" id="member-2">
                            <label for="member2">Member 2</label>
                            <input type="text" id="member2" name="member2">
                        </div>

                        <div class="member-input" id="member-3">
                            <label for="member3">Member 3</label>
                            <input type="text" id="member3" name="member3">
                        </div>
                    </div>

                    <button class="register-button" type="submit">Register</button>

                </form>
            </div>
        </div>
    </div>
</body>
</html>
