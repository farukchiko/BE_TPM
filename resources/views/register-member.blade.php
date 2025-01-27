<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Member</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/register-member.css') }}">
    <script src="{{ asset('js/register-member.js') }}" defer></script>
</head>
<body>
    <div class="body">
        <div class="card">
            <img class="logoBNCC" src="{{ asset('assets/images/bncc-logo.svg') }}" alt="Logo BNCC">

            <div class="card-form">
                <div class="tabs">
                    <div class="tab" id="tab1" onclick="switchTab(1)"><span>Member 1</span></div>
                    <div class="tab" id="tab2" onclick="switchTab(2)"><span>Member 2</span></div>
                    <div class="tab" id="tab3" onclick="switchTab(3)"><span>Member 3</span></div>
                </div>

                <div class="tab-content">
                    <form id="form">
                        <!-- Tab 1 Content -->
                        <div class="tab-pane" id="pane1">
                            <div class="member-input">
                                <label for="memberName1">Member 1</label>
                                <input type="text" id="memberName1" name="members[1][name]" placeholder="Enter name">
                                <span>Nama member harus terisi</span>
                            </div>
                            <div class="member-input">
                                <label for="memberEmail1">Email Member 1</label>
                                <input type="email" id="memberEmail1" name="members[1][email]" placeholder="Enter email">
                                <span>Email member harus terisi dan mengandung <span class="gmail">@gmail.com</span></span>
                            </div>
                        </div>

                        <!-- Tab 2 Content -->
                        <div class="tab-pane" id="pane2">
                            <div class="member-input">
                                <label for="memberName2">Member 2</label>
                                <input type="text" id="memberName2" name="members[2][name]" placeholder="Enter name">
                                <span>Nama member harus terisi</span>
                            </div>
                            <div class="member-input">
                                <label for="memberEmail2">Email Member 2</label>
                                <input type="email" id="memberEmail2" name="members[2][email]" placeholder="Enter email">
                                <span>Email member harus terisi dan mengandung <span class="gmail">@gmail.com</span></span>
                            </div>
                        </div>

                        <!-- Tab 3 Content -->
                        <div class="tab-pane" id="pane3">
                            <div class="member-input">
                                <label for="memberName3">Member 3</label>
                                <input type="text" id="memberName3" name="members[3][name]" placeholder="Enter name">
                                <span>Nama member harus terisi</span>
                            </div>
                            <div class="member-input">
                                <label for="memberEmail3">Email Member 3</label>
                                <input type="email" id="memberEmail3" name="members[3][email]" placeholder="Enter email">
                                <span>Email member harus terisi dan mengandung <span class="gmail">@gmail.com</span></span>
                            </div>
                        </div>

                        <button class="register-button" type="submit" disabled>Register</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</body>
</html>
