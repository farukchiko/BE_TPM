<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page Leader</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Itim&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/register-leader.css')}}">
    <script src="{{ asset('js/register-leader.js')}}" defer></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="body">
        <div class="card">
            <img class="logoBNCC" src="{{ asset('assets/images/bncc-logo.svg')}}" alt="LOGO BNCC">
            <div class="input-box">
                <form class="input-form" action="/register-member" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-step active" id="step-1">
                        <div class="name-wrapper">
                            <label for="leaderName">Full Name</label>
                            <input type="text" id="leaderName" name="leader[name]" required>
                        </div>

                        <div class="line-wrapper">
                            <label for="lineId">Line ID</label>
                            <input type="text" id="lineId" name="leader[line_id]" required>
                        </div>

                        <div class="email-wrapper">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="leader[email]" required>
                            <p class="error-message">Masukkan email yang valid seperti <span class="email-example">user@gmail.com</span></p>
                        </div>

                        <div class="number-wrapper">
                            <label for="whatsappNumber">Whatsapp Number</label>
                            <input type="tel" id="whatsappNumber" name="leader[phone]" required>
                            <p class="error-message">Nomor Whatsapp harus berupa numerik yang valid</p>
                        </div>

                        <div class="git-wrapper">
                            <label for="gitId">Github/Gitlab ID</label>
                            <input type="text" id="gitId" name="leader[github_id]" required>
                        </div>

                        <button type="button" id="nextButton">
                            <img src="{{ asset('assets/icons/ic-chevron-right.svg')}}" alt="Next">
                        </button>

                    </div>

                    <div class="form-step " id="step-2">

                        <div class="place-wrapper">
                            <label for="birthPlace">Birth Place</label>
                            <input list="cities" name="leader[birth_place]" id="birthPlace" placeholder="City" required>
                            <datalist id="cities">
                                <option value="Bandung">
                                <option value="Batam">
                                <option value="Denpasar (Bali)">
                                <option value="Jakarta">
                                <option value="Malang">
                                <option value="Makassar">
                                <option value="Medan">
                                <option value="Surabaya">
                                <option value="Semarang">
                                <option value="Yogyakarta">
                            </datalist>
                        </div>

                        <div class="date-wrapper">
                            <label for="birthDate">Birth Date</label>

                            <div class="input-birth-date">

                                <div class="month-input">
                                    <select name="month" id="month" required>
                                        <option value="" disabled selected>MM</option>
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                </div>

                                <div class="date-input">
                                    <select name="day" id="day" required>
                                        <option class="placeholder" value="" disabled selected>DD</option>
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option value="20">20</option>
                                        <option value="21">21</option>
                                        <option value="22">22</option>
                                        <option value="23">23</option>
                                        <option value="24">24</option>
                                        <option value="25">25</option>
                                        <option value="26">26</option>
                                        <option value="27">27</option>
                                        <option value="28">28</option>
                                        <option value="29">29</option>
                                        <option value="30">30</option>
                                        <option value="31">31</option>
                                    </select>
                                </div>

                                <div class="year-input">
                                    <select name="year" id="year" required>
                                        <option value="" disabled selected>YYYY</option>
                                        <option value="2001">2001</option>
                                        <option value="2002">2002</option>
                                        <option value="2003">2003</option>
                                        <option value="2004">2004</option>
                                        <option value="2005">2005</option>
                                        <option value="2006">2006</option>
                                        <option value="2007">2007</option>
                                        <option value="2008">2008</option>
                                    </select>
                                </div>

                                <img src="{{ asset('assets/icons/ic-calendar.svg')}}" alt="calendar">
                                <input type="hidden" id="birthDate" name="leader[birth_date]">
                            </div>

                            <div class="requirement">
                                <p><span>*</span>Umur peserta minimal 17 tahun</p>
                            </div>

                        </div>

                        <div class="upload-wrapper">
                            <div class="cv-wrapper">
                                <label>Upload CV</label>

                                <div class="upload-cv-wrapper file-input-wrapper">
                                    <input type="file" class="file-input" id="uploadCv" name="files[cv]" accept=".pdf,.jpg,.jpeg,.png" required>
                                    <label class="upload-button" for="uploadCv">
                                    <img src="{{ asset('assets/icons/ic-upload-files.svg')}}" alt="upload">
                                    </label>
                                </div>

                                <div class="requirement">
                                    <p><span>*</span>Format file pdf,jpg,jpeg, dan png</p>
                                </div>
                            </div>

                            <div class="flazz-wrapper">
                                <label>Upload Flazz Card untuk Binusian</label>

                                <div class="upload-flazz-wrapper file-input-wrapper">
                                    <input type="file" class="file-input" id="uploadFlazz" name="uploadFlazz" accept=".pdf,.jpg,.jpeg,.png">
                                    <label class="upload-button" for="uploadFlazz">
                                    <img src="{{ asset('assets/icons/ic-upload-files.svg')}}" alt="upload">
                                    </label>
                                </div>

                                <div class="requirement">
                                    <p><span>*</span>Format file pdf,jpg,jpeg, dan png</p>
                                </div>
                            </div>

                            <div class="id-wrapper">
                                <label>Upload ID Card untuk Non-binusian</label>

                                <div class="upload-id-wrapper file-input-wrapper">
                                    <input type="file" class="file-input" id="uploadId" name="files[id_card]" accept=".pdf,.jpg,.jpeg,.png">
                                    <label class="upload-button" for="uploadId">
                                    <img src="{{ asset('assets/icons/ic-upload-files.svg')}}" alt="upload">
                                    </label>
                                </div>

                                <div class="requirement">
                                    <p><span>*</span>Format file pdf,jpg,jpeg, dan png</p>
                                </div>
                            </div>
                        </div>

                        <div class="buttons">
                            <button type="submit" id="previousButton">
                                <img src="{{ asset('assets/icons/ic-chevron-left.svg')}}" alt="Previous">
                            </button>

                            <button  id="register-button" type="submit">Register</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="teamNameDisplay"></div>
    <div id="passwordDisplay"></div>
    <div id="isBinusianDisplay"></div>

</body>
</html>
