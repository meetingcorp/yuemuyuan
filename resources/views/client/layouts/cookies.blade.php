<div id="cookieNotify" class="modal-strip cookie-notify background-dark modal-active" data-delay="3000" data-expire="1"
    data-cookie-name="acceptcookies" data-cookie-enabled="false">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 text-sm-center sm-center sm-m-b-10 m-t-5">ไอยรา ใช้คุกกี้เพื่อเพิ่มประสิทธิภาพในการให้บริการ และส่งมอบประสบการณ์ที่ดีในการใช้งานเว็บไซต์ ตรวจสอบและทำความเข้าใจ
                <a href="{{url('/policies')}}" target="_blank" class="text-light">
                    <span>นโยบายความเป็นส่วนตัว</span>
                </a>
                และ
                <a href="{{url('/cookies')}}" target="_blank" class="text-light">
                    <span>นโยบายคุกกี้
                        <i class="fa fa-info-circle"></i>
                    </span>
                </a>
                หากคุณไม่ปฏิเสธและดำเนินการต่อโดยการคลิกปุ่ม
            </div>
            <div class="col-lg-2 text-right sm-text-center sm-center">
                {{-- <button type="button"
                    class="btn btn-rounded btn-light btn-outline btn-sm m-r-10 modal-close">ปฏิเสธ</button> --}}
                <button type="button" class="btn btn-rounded btn-light btn-outline btn-sm m-r-10 modal-close">ปฏิเสธ</button>
                <button onclick="accept()" type="button" class="btn btn-rounded btn-light btn-sm modal-confirm">
                    ยอมรับ
                </button>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script>
        // set cookie and google analystics in here
        // code by sittipol ^_^
        // deleteCookie('acceptcookies');
        $(document).ready(function(){
            if(getCookie('acceptcookies')){
                let scr = document.createElement('script');
                scr.async = true;
                scr.src = 'https://www.googletagmanager.com/gtag/js?id=UA-236754228-1';
                document.body.appendChild(scr);

                let scrcontent = document.createElement('script');
                scrcontent.text = "window.dataLayer = window.dataLayer || [];";
                scrcontent.text += "function gtag(){dataLayer.push(arguments);}";
                scrcontent.text += "gtag('js', new Date());";
                scrcontent.text += "gtag('config', 'UA-236754228-1');";
                document.body.appendChild(scrcontent);

                $('#cookieNotify').hide();
            }
        });
        function setCookie(cName, cValue, expDays) {
            let date = new Date();
            date.setTime(date.getTime() + (expDays * 24 * 60 * 60 * 1000));
            const expires = "expires=" + date.toUTCString();
            document.cookie = cName + "=" + cValue + "; " + expires + "; path=/";
        }

        function getCookie(cookieName) {
            let cookie = {};
            document.cookie.split(';').forEach(function(el) {
                let [key, value] = el.split('=');
                cookie[key.trim()] = value;
            })
            return cookie[cookieName];
        }

        function deleteCookie(name) {
            document.cookie = name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
        }

        function accept(){
            setCookie('acceptcookies', true, 30);
            location.reload();
        }
    </script>
@endpush
