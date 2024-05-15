<!-- start: Footer -->
<footer id="footer">
    <div class="footer-content">
        <div class="container text-center text-white" style="margin-top: -20px; margin-bottom: 30px;">
            <h2 class="d-none d-sm-block headertitle">ปฐมกาล คลินิก 悦木源中医诊所 Yue Mu Yuan Clinic</h2>
            <h2 class="d-block d-sm-none headertitle">ปฐมกาล คลินิก 悦木源中医诊所<br>Yue Mu Yuan Clinic</h2>
        </div>
        <div class="container d-none d-sm-block">
            <div class="row text-white">
                <div class="col-lg-4 col-md-4 col-sm-12" style="padding:0;">
                    <p class="footercompany">ที่ตั้งคลินิก : {{ setting('address') }} <br> {{ setting('address2') }} </p>
                    <div class="row">
                        <div class="col-4" style="padding-right: 0px;">
                            <p class="footercompany">เปิดบริการ :</p>
                        </div>
                        <div class="col-8" style="padding-left: 0px; margin-left:-25px;">
                            <p class="footercompany">{{ setting('time') }}</p>
                            <p class="footercompany">{{ setting('time2') }}</p>
                        </div>
                    </div>
                    <p class="footercompany">โทรศัพท์ : {{ setting('tel1') }}</p>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 text-center">
                    <p class="footercompany" style="margin-bottom: 0px; width:100% !important;">ปรึกษาฟรี</p>
                    <img src="{{ asset(setting('qrcode_facebook')) }}" alt=""
                        style="width: 150px; height: auto; border-radius: 15px;">
                    <p class="footercompany" style="width:100% !important;">@Facebook</p>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 text-center">
                    <p class="footercompany" style="margin-bottom: 0px; width:100% !important;">ปรึกษาฟรี</p>
                    <img src="{{ asset(setting('qrcode_line')) }}" alt=""
                        style="width: 150px; height: auto; border-radius: 15px;">
                    <p class="footercompany" style="width:100% !important;">@LINE</p>
                </div>
            </div>
        </div>
        <div class="container text-white d-block d-sm-none">
            <div class="container text-left">
                <p class="footercompany">ที่ตั้งคลินิก : {{ setting('address') }} <br> {{ setting('address2') }}</p>
                <div class="row">
                    <div class="col-4" style="padding-right: 0px;">
                        <p class="footercompany text-left">เปิดบริการ :</p>
                    </div>
                    <div class="col-8" style="padding-left: 1px;">
                        <p class="footercompany">{{ setting('time') }}</p>
                        <p class="footercompany">{{ setting('time2') }}</p>
                    </div>
                </div>
                <p>โทรศัพท์ : {{ setting('tel1') }}</p>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 text-center">
                <p class="footercompany" style="margin-bottom: 0px;">ปรึกษาฟรี</p>
                <img src="{{ asset(setting('qrcode_facebook')) }}" alt=""
                    style="width: 150px; height: auto; border-radius: 15px;">
                <p class="footercompany">@Facebook</p>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 text-center">
                <p class="footercompany" style="margin-bottom: 0px;">ปรึกษาฟรี</p>
                <img src="{{ asset(setting('qrcode_line')) }}" alt=""
                    style="width: 150px; height: auto; border-radius: 15px;">
                <p class="footercompany">@LINE: Yue Mu Yuan Clinic</p>
            </div>
        </div>
    </div>
        <div class="copyright-content"
            style="background-color: #045242; padding-top:10px; padding-bottom:10px;  min-height:0;">
            <div class="row">
                <div class="col-lg-3">
                    <div class="d-none d-lg-block d-xl-block header-extras" style="height:0;">
                        <div class="social-icons social-icons-border social-icons-colored-hover social-icons-rounded">
                            <ul>
                                <li class="social-facebook"><a class="text-white" target="_blank" href="{{ setting('facebook_info') }}"
                                        style="margin-top:3px; margin-right:3px; margin-left:3px;"><i
                                            class="fab fa-facebook-f" aria-hidden="true"></i></a></li>

                                <li class="social-line"><a class="text-white" target="_blank" href="{{ setting('line_info') }}"
                                        style="margin-top:3px; margin-right:3px; margin-left:3px;"><i
                                            class="fab fa-line" aria-hidden="true"></i></a></li>
                                <li class="social-youtube"><a class="text-white" target="_blank" href="{{ setting('youtube_info') }}"
                                        style="margin-top:3px; margin-right:3px; margin-left:3px;"><i
                                            class="fab fa-youtube" aria-hidden="true"></i></a></li>
                                <li class="social-gplus"><a class="text-white" target="_blank" href="{{ setting('messenger_info') }}"
                                        style="margin-top:3px; margin-right:3px; margin-left:3px;"><i
                                            class="fab fa-facebook-messenger" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xs-12 text-center mt-2">
                    <div class="copyright-text font" style="color: #fff;">
                        © 2022 ALL RIGHTS RESERVED | YUE MU YUAN CLINIC 悦木源中医诊所
                        <a href="https://meeting.co.th/" target="_blank" style="color:#fff;">BY MEETING CREATIVE
                            Co.,Ltd.</a>
                    </div>
                </div>
                <div class="col-lg-3"></div>
            </div>
        </div>

</footer>
<!-- end: Footer -->
{{-- <div id="fb-root"></div>
<script async defer crossorigin="anonymous"
    src="https://connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v14.0&appId=898085854251598&autoLogAppEvents=1"
    nonce="XbX8JIYq"></script> --}}
