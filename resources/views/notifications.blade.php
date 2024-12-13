@extends('layouts.layout')

@section('title')
    Notification
@endsection

@section('content')
    <div class="lg:mx-4 mt-12">
        <div class="mx-4 mt-12">
            <div>
                <h1 class=" font-semibold   text-2xl ">All Notifications</h1>
            </div>

            <div id="reloadDiv" class="shadow-dark mt-3  px-5 rounded-xl pt-8  bg-white">
                <div class="w-full pb-5">
                    @if ($notifications->isEmpty())
                        <p class="text-center my-3">No  Notification</p>
                    @else
                        @foreach ($notifications as $notification)
                            <button delId="{{ $notification->id }}" url="../{{ $notification->type }}"
                                class=" flex px-4 w-full py-3 notificationBtn hover:bg-gray-100 dark:hover:bg-gray-700">

                                <div class="w-full ps-3 pb-3 border-b-2 border-primary flex justify-between">

                                    <div class="text-gray-500 text-sm mb-1.5 dark:text-gray-400 flex">
                                        {{-- <div
                                class="bg-primary text-white rounded-md hover:bg-transparent hover:text-primary border-2 hover:border-primary duration-300  h-[30px] w-[30px] flex justify-center items-center">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                                </svg>
                            </div> --}}
                                        <div class="pl-5 w-full">
                                            <h1 class="text-[18px] font-bold">{{ $notification->heading }}</h1>
                                            <p class="pt-2 w-[80%] ml-2">{{ $notification->description }}</p>
                                        </div>
                                    </div>

                                    <div class="text-xs text-blue-600 dark:text-blue-500 w-[30%] text-end">
                                        {{ $notification->time_ago }}</div>
                                </div>
                            </button>
                        @endforeach
                    @endif

                </div>
            </div>
        </div>

    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $(".notificationBtn").click(function(event) {
                $delUrl = "../delNotification/" + $(this).attr('delId');
                $moveUrl = $(this).attr('url');
                $.ajax({
                    type: "Get",
                    url: $delUrl,
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $("#loading").show();
                    },
                    success: function(response) {
                        console.log($moveUrl);

                        window.location.href = $moveUrl;

                    },
                    error: function(jqXHR) {
                        let response = JSON.parse(jqXHR.responseText);
                        Swal.fire({
                            title: "Error!",
                            text: response.message,
                            icon: "warning",
                            showConfirmButton: false,
                            timer: 1500,

                        });

                    }
                });
            });
        });
    </script>
@endsection
