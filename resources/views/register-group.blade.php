<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Itim&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/register-group.css')}}">
    <script src="{{ asset('js/register-group.js')}}" defer></script>
</head>

<body>  
    <div class="body">
        <div class="card">
            <img class="logoBNCC" src="{{ asset('assets/images/bncc-logo.svg')}}" alt="Logo BNCC">
            <div class="input-box">
                <form class="input-form" id="input-first-form">
                    <div class="group-wrapper">
                        <label for="groupName">Group Name</label>
                        <input type="text" id="groupName" name="team_name" placeholder="group name">
                        <div class="requirement">
                        </div>
                    </div>

                    <div class="password-wrapper">
                        <label for="groupPassword">Password</label>
                        <div class="input-password-wrapper">
                            <input type="password" id="groupPassword" name="password" placeholder="password">
                            <span class="toggle-password" id="togglePassword1">
                                <img class="toggleEye" src="{{ asset('assets/icons/ic-eyes-open.svg')}}" alt="Toggle Button">
                            </span>
                        </div>
                        <div class="requirement">
                            <ul>
                                <li><span class="bullet">* </span>Minimal Panjang 8</li>
                                <li><span class="bullet">* </span>Harus ada Huruf Besar</li>
                                <li><span class="bullet">* </span>Harus ada Huruf Kecil</li>
                                <li><span class="bullet">* </span>Harus ada Angka</li>
                                <li><span class="bullet">* </span>Harus ada Tanda</li>
                            </ul>
                        </div>
                    </div>

                    <div class="confirm-wrapper">
                        <label for="confirmPassword">Confirm Password</label>
                        <div class="input-confirm-wrapper">
                            <input type="password" id="confirmPassword" name="password_confirmation" placeholder="password">
                            <span class="toggle-password" id="togglePassword2">
                                <img class="toggleEye" src="{{ asset('assets/icons/ic-eyes-open.svg')}}" alt="Toggle Button">
                            </span>
                        </div>
                    </div>

                    <div class="statusBinusian">
                        <div class="radio-wrapper">
                            <input type="radio" id="binusian" name="is_binusian" value="1">
                            <label for="binusian">Binusian</label>

                            <input type="radio" id="non-binusian" name="is_binusian" value="0">
                            <label for="non-binusian">Non-Binusian</label>
                        </div>
                    </div>

                    <button class="register-button" type="submit">Register</button>

                </form>
            </div>
        </div>
    </div>
</body>
</html>
