<x-guest-layout>
    <style>
        .captcha label {
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
        }

        /* #em{color: red;
    background-color: blue;

  } */
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div id="em">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        {{-- <div class="captcha">
            <div class="mt-4">
                <x-input-label for="Enter Captcha" :value="__('Enter Captcha')" />

                <x-text-input id="password" class="block mt-1 w-full" type="text" name="captcha" required
                    autocomplete="current-password" />
                <button class="captcha-refresh">
                    <i class="fa fa-refresh"></i>
                </button>

                <x-input-error :messages="$errors->get('captcha')" class="mt-2" />
            </div>
        </div> --}}

        <div class="captcha">
            <div class="mt-4">
                <x-input-label for="Enter Captcha" :value="__('Enter Captcha')" />
                {{-- <label for="captcha-input">Enter Captcha</label> --}}
                <div class="preview"></div>
                <div class="captcha-form">
                    <x-text-input id="captcha" id="captcha-form" type="text" name="captcha" required />
                    {{-- <input type="text" id="captcha-form"  placeholder="Enter captcha text"> --}}
                    <span class="captcha-refresh">
                        <i class="fa fa-refresh" style="margin-top: 12px; margin-left: 10px;"></i>
                    </span>
                </div>
                <div id="captchaError" style="color: red; display: none;">
                    Please fill in the correct captcha to log in.
                </div>
                <x-input-error :messages="$errors->get('captcha')" class="mt-2" />
            </div>
        </div>

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
<script>
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
</script>
