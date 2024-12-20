<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Volksbiz</title>
    <link rel="shortcut icon" href="{{ asset('images/compnay-logo.svg') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .bg {
            background-image: url("{{ asset('images/bus-bg.svg') }}");

        }

        #loading {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: white;
            z-index: 9999;
        }
    </style>
</head>

<body class="">
    <div id="loading">
        <div class=" text-center z-[9999] h-screen w-screen flex justify-center items-center  ">
            <svg aria-hidden="true" class="w-12 h-12 mx-auto text-center text-gray animate-spin fill-primary"
                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                    fill="currentColor" />
                <path
                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                    fill="currentFill" />
            </svg>
        </div>
    </div>
    <div class=" h-screen w-full flex justify-center items-center shadow-dark  bg bg-no-repeat relative">
        <div class="bg-black opacity-75 h-full w-full absolute z-0">

        </div>
        <div
            class="bg-primary w-full sm:w-1/2 md:w-9/12 lg:w-1/2 shadow-md flex flex-col md:flex-row items-center mx-5 sm:m-0 rounded-lg z-30">
            <div class="w-full md:w-1/2 hidden md:flex flex-col justify-center items-center text-white relative">
                <div>
                    <img class="w-32    absolute left-1/2  -top-40 -translate-x-1/2"
                        src="{{ asset('images/compnay-logo.svg') }}" alt="Volksbiz">
                </div>
                <h1 class="text-3xl">Hello</h1>
                <p class="text-5xl font-extrabold">Welcome!</p>
            </div>
            <div class="bg-white w-full md:w-1/2 flex flex-col items-center py-32 px-8 rounded-r-lg">
                <div class="md:hidden block pb-5">
                    <img class="w-52 " src="{{ asset('./images/logo.svg') }}" alt="LOGO">
                </div>
                <h3 class="text-3xl font-bold text-primary mb-4">
                    LOGIN
                </h3>
                <form id="login_data" method="post" class="w-full flex flex-col justify-center">
                    @csrf
                    <div class="mb-4">
                        <input type="email" placeholder="Email" name="email"
                            class="w-full p-3 rounded border placeholder-gray-400 focus:outline-none focus:border-green-600" />
                    </div>
                    <div class="mb-4 relative">
                        <input type="password" placeholder="Password" name="password"
                            class="w-full p-3 rounded border placeholder-gray-400 focus:outline-none focus:border-green-600"
                            id="password" />
                        <img id="changePasswordViewbtn"
                            class="absolute w-5 h-5 top-1/2 -translate-y-1/2 right-2 cursor-pointer"
                            src="{{ asset('images/icons/eye.svg') }}" alt="eye-icon">
                    </div>
                    <button class="bg-primary font-bold text-white focus:outline-none rounded p-3">
                        <div class=" text-center hidden" id="spinner">
                            <svg aria-hidden="true"
                                class="w-5 h-5 mx-auto text-center text-gray-200 animate-spin fill-primary"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                        </div>
                        <div class="text-white   font-semibold" id="text">
                            Login
                        </div>
                    </button>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('javascript/jquery.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $(window).on('load', function() {
                $('#loading').hide();
            })
            $('#changePasswordViewbtn').click(function() {
                let passwordInput = $('#password');
                let type = passwordInput.attr('type');

                if (type === 'password') {
                    passwordInput.attr('type', 'text');
                    $(this).attr('src', "{{ asset('./images/icons/eye-slash.svg') }}");
                } else {
                    passwordInput.attr('type', 'password');
                    $(this).attr('src', "{{ asset('images/icons/eye.svg') }}");
                }
            });

            $("#login_data").submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                // Send the AJAX request
                $.ajax({
                    type: "POST",
                    url: "/login",
                    data: formData,
                    dataType: "json",
                    beforeSend: function() {
                        $('#spinner').removeClass('hidden');
                        $('#text').addClass('hidden');
                        $('#loginbutton').attr('disabled', true);
                    },
                    success: function(response) {
                        // Handle the success response here
                        if (response.success == true) {
                            $('#text').removeClass('hidden');
                            $('#spinner').addClass('hidden');

                            window.location.href = '/';

                        } else if (response.success == false) {
                            Swal.fire(
                                'Warning!',
                                response.message,
                                'warning'
                            )
                        }
                    },
                    error: function(jqXHR) {

                        let response = JSON.parse(jqXHR.responseText);

                        Swal.fire(
                            'Warning!',
                            response.message,
                            'warning'
                        )
                        $('#text').removeClass('hidden');
                        $('#spinner').addClass('hidden');
                        $('#loginbutton').attr('disabled', false);
                    }
                });
            });
        });
    </script>

</body>

</html>
