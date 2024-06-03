@if (session('email'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var emailInput = document.getElementById('email');
            if (emailInput) {
                emailInput.value = "{{ session('email') }}";
            }
        });
    </script>
@endif

<x-guest-layout>
    <style>
        .reload {
            font-family: Lucida Sans Unicode
        }

        /* .captcha label {
            display: block;
            font-size: 15px;
            color: #111;
            margin-bottom: 10px;
        }

        .login-form .form-input input {
            width: 100%;
            padding: 10px;
            outline: none;
            border-radius: 4px;
            border: 1px solid #888;
            font-size: 15px;
        }

        .captcha {
            margin: 15px 0px;
        }

        .captcha .preview {
            color: #555;
            width: 100%;
            text-align: center;
            height: 40px;
            line-height: 40px;
            letter-spacing: 8px;
            border: 1px dashed #888;
            border-radius: 4px;
            font-family: "monospace";
        }

        .captcha .preview span {
            display: inline-block;
            user-select: none;
        }

        .captcha .captcha-form {
            display: flex;
        }

        .captcha .captcha-form input {
            width: 100%;
            outline: none;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #888;
        }

        .captcha .captcha-form .captcha-refresh {
            width: 40px;
            border: none;
            outline: none;
            background: #888;
            border-radius: 4px;
            color: #eee;
            cursor: pointer;
        }

        #login-btn {
            margin-top: 5px;
            width: 100%;
            padding: 12px;
            border: none;
            outline: none;
            font-size: 15px;
            text-transform: uppercase;
            background: #4c81ff;
            border-radius: 5px;
            color: #fff;
            transition: .3s;
            cursor: pointer;
        }

        #login-btn:hover {
            opacity: .8;
        } */

        /* #em{color: red;
    background-color: blue;

  } */
    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    @php
        $routeName = Route::currentRouteName();
    @endphp

    <h1 class="text-5xl font-semibold text-gray-800 leading-tight text-center">
        @if ($routeName == 'guest.web_login')
            Admin Login
        @elseif ($routeName == 'guest.bank_nodals_login')
            Bank Nodal Login
        @elseif ($routeName == 'guest.bank_branches_login')
            Bank Branch Login
        @elseif ($routeName == 'guest.departments_login')
            Department Login
        @elseif ($routeName == 'guest.applicants_login')
            Applicant Login
        @endif
    </h1>

    <form method="POST" action="{{ route($routeName . '.submit', ['guard' => $guard]) }}">

        @csrf

        <!-- Email Address -->
        <div id="em" class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
             autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- specify the guard to use for authentication -->
        <input type="hidden" name="guard" value="{{ $guard }}">

        <div class="mt-4">
            <x-input-label for="Enter Captcha" :value="__('Enter Captcha')" />
            <div class="captcha">
                <span>{!! captcha_img() !!}</span>
                <button type="button" class="btn btn-danger reload" id="reload">
                    &#x21bb;
                </button>
            </div>
        </div>
        <div class="form-group mt-2">
            <x-text-input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha"/>
        </div>
        <x-input-error :messages="$errors->get('captcha')" class="mt-2" />


        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3" id="loginbtn">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
{{-- <script>
    (function() {
        const fonts = ["cursive", "sans-serif", "serif", "monospace"];
        let captchaValue = "";

        function generateCaptcha() {
            let value = btoa(Math.random() * 1000000000);
            value = value.substr(0, 5 + Math.random() * 5);
            captchaValue = value;
        }

        function setCaptcha() {
            let html = captchaValue.split("").map((char) => {
                const rotate = -20 + Math.trunc(Math.random() * 30);
                const font = Math.trunc(Math.random() * fonts.length);
                return `<span
          style="
            transform:rotate(${rotate}deg);
            font-family:${fonts[font]}
          "
        >${char}</span>`;
            }).join("");
            document.querySelector(".captcha .preview").innerHTML = html;
        }

        function initCaptcha() {
            document.querySelector(".captcha .captcha-refresh").addEventListener("click", function() {
                generateCaptcha();
                setCaptcha();
            });
            generateCaptcha();
            setCaptcha();
        }
        initCaptcha();

        document.querySelector("#loginbtn").addEventListener("click", function(event) {
            let inputCaptchaValue = document.querySelector(".captcha input").value
        .trim(); // Trim whitespace
            let captchaErrorDiv = document.querySelector("#captchaError");

            console.log("Captcha Input:", inputCaptchaValue);
            console.log("Expected Captcha:", captchaValue);

            if (inputCaptchaValue !== captchaValue) {
                event.preventDefault();
                // Instead of alert, show the div with the error message
                captchaErrorDiv.style.display = 'block';
                document.querySelector(".captcha input").value = '';
                document.querySelector(".captcha input").focus();
            } else {
                // If the captcha is correct, ensure the error message is hidden
                captchaErrorDiv.style.display = 'none';
            }
        });




    })();
</script> --}}

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script type="text/javascript">
    $('.reload').click(function() {
        $.ajax({
            type: 'GET',
            url: '{{ route('reloadCaptcha') }}',
            success: function(data) {
                $(".captcha span").html(data.captcha);
            }
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
</script>
