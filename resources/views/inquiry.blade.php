@include('layouts.header')
@include('layouts.nav')
<div class="md:mx-4 mt-12">

    <div class="shadow-dark mt-3  rounded-xl pt-8  bg-white">
        <div>
            <div class="flex justify-end sm:justify-between  items-center px-[20px] mb-3">
                <h3 class="text-[20px] text-black hidden sm:block">@lang('lang.Inquiries')</h3>
                <div>


                </div>
            </div>
            <div class="overflow-x-auto">
                <table id="datatable">
                    <thead class="py-6 bg-primary text-white">
                        <tr>
                            <th class="whitespace-nowrap">@lang('lang.Sr')</th>
                            <th class="whitespace-nowrap">@lang('lang.Name')</th>
                            <th class="whitespace-nowrap">@lang('lang.Email')</th>
                            <th class="whitespace-nowrap">@lang('lang.Phone_Number')</th>
                            <th class="whitespace-nowrap">@lang('lang.Status')</th>
                            <th class="whitespace-nowrap">@lang('lang.Meassage')</th>
                            <th class="flex  justify-center">@lang('lang.Action')</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($inquiries as $x => $inquiry)
                            <tr class="pt-4">
                                <td>{{ $x + 1 }}</td>
                                <td>{{ $inquiry->name }}</td>
                                <td>{{ $inquiry->email }}</td>
                                <td>{{ $inquiry->subject }}</td>
                                @php
                                    $bgColorClass = '';
                                    switch ($inquiry->status) {
                                        case 'pending':
                                            $bgColorClass = 'bg-red-500';
                                            break;
                                        case 'unfix':
                                            $bgColorClass = 'bg-blue-800';
                                            break;

                                        case 'resolved':
                                            $bgColorClass = 'bg-green-500';
                                            break;

                                        default:
                                            $bgColorClass = 'bg-red-500';
                                            break;
                                    }
                                @endphp
                                <td><button
                                        class="text-white py-1 px-2 {{ $bgColorClass }} font-semibold  rounded-md">{{ $inquiry->status }}</button>
                                </td>
                                <td>{{ $inquiry->message }}</td>
                                <td>

                                    <div class="flex gap-5 items-center justify-center">
                                        <button data-modal-target="deleteData" data-modal-toggle="deleteData"
                                            class="hidden"></button>
                                        <button class="delButton" delId="{{ $inquiry->id }}">
                                            <svg class="h-[40px] w-[40px]" viewBox="0 0 36 36" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <circle opacity="0.1" cx="18" cy="18" r="18"
                                                    fill="#DF6F79" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M23.4905 13.7433C23.7356 13.7433 23.9396 13.9468 23.9396 14.2057V14.4451C23.9396 14.6977 23.7356 14.9075 23.4905 14.9075H13.0493C12.8036 14.9075 12.5996 14.6977 12.5996 14.4451V14.2057C12.5996 13.9468 12.8036 13.7433 13.0493 13.7433H14.8862C15.2594 13.7433 15.5841 13.478 15.6681 13.1038L15.7642 12.6742C15.9137 12.0889 16.4058 11.7002 16.9688 11.7002H19.5704C20.1273 11.7002 20.6249 12.0889 20.7688 12.6433L20.8718 13.1032C20.9551 13.478 21.2798 13.7433 21.6536 13.7433H23.4905ZM22.5573 22.4946C22.7491 20.7073 23.0849 16.4611 23.0849 16.4183C23.0971 16.2885 23.0548 16.1656 22.9709 16.0667C22.8808 15.9741 22.7669 15.9193 22.6412 15.9193H13.9028C13.7766 15.9193 13.6565 15.9741 13.5732 16.0667C13.4886 16.1656 13.447 16.2885 13.4531 16.4183C13.4542 16.4261 13.4663 16.5757 13.4864 16.8258C13.5759 17.9366 13.8251 21.0305 13.9861 22.4946C14.1001 23.5731 14.8078 24.251 15.8328 24.2756C16.6238 24.2938 17.4387 24.3001 18.272 24.3001C19.0569 24.3001 19.854 24.2938 20.6696 24.2756C21.7302 24.2573 22.4372 23.5914 22.5573 22.4946Z"
                                                    fill="#D11A2A" />
                                            </svg>

                                        </button>

                                        <button updateId={{ $inquiry->id }} data-modal-target="changeStatus"
                                            data-modal-toggle="changeStatus"
                                            class="text-white py-2 px-2 bg-primary font-semibold  rounded-md updateBtn">@lang('lang.Change_Status')</button>

                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

{{-- Delete Data Modal --}}
<div id="deleteData" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="flex justify-center items-center h-full">
        <div class="fixed inset-0 transition-opacity">
            <div id="backdrop" class="absolute inset-0 bg-slate-800 opacity-75"></div>
        </div>
        <div class="relative p-4 w-full   max-w-lg max-h-full ">
            <div class="relative bg-white shadow-dark rounded-lg  dark:bg-gray-700  ">
                <div class="">

                    <button type="button"
                        class=" absolute right-2 text-white bg-transparent rounded-lg text-sm w-8 h-8 ms-auto "
                        data-modal-hide="deleteData">
                        <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
                <div class=" mx-6 my-6 pt-5">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="100px" class="mx-auto" viewBox="0 0 512 512">
                            <path
                                d="M256 32c14.2 0 27.3 7.5 34.5 19.8l216 368c7.3 12.4 7.3 27.7 .2 40.1S486.3 480 472 480H40c-14.3 0-27.6-7.7-34.7-20.1s-7-27.8 .2-40.1l216-368C228.7 39.5 241.8 32 256 32zm0 128c-13.3 0-24 10.7-24 24V296c0 13.3 10.7 24 24 24s24-10.7 24-24V184c0-13.3-10.7-24-24-24zm32 224a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z"
                                fill="red" />
                        </svg>
                        <h1 class="text-center pt-3 text-4xl">@lang('lang.Are_You_Sure')</h1>
                        <div class="flex  justify-center gap-5 mx-auto mt-5 pb-5">
                            <button data-modal-hide="deleteData" class="bg-primary px-7 py-3 text-white rounded-md">
                                @lang('lang.No')
                            </button>
                            <a class="" id="delLink" href="">

                                <button class=" bg-red-600 px-7 py-3 text-white rounded-md">
                                    @lang('lang.Yes')
                                </button>
                            </a>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
{{-- ============ modal  =========== --}}
<div id="changeStatus" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0  left-0 z-50 justify-center  w-full md:inset-0 h-[calc(100%-1rem)] max-h-full ">
    <div class="fixed inset-0 transition-opacity">
        <div id="backdrop" class="absolute inset-0 bg-slate-800 opacity-75"></div>
    </div>
    <div class="relative p-4 w-full   max-w-2xl max-h-full ">
        <form id="OrderStatusData" action="updInqStatus" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="update_id" name="inquiry_id">
            <div class="relative bg-white shadow-dark rounded-lg  dark:bg-gray-700  ">
                <div class="relative bg-white shadow-dark rounded-lg  dark:bg-gray-700  ">
                    <div class="flex items-center   justify-start  p-5  rounded-t dark:border-gray-600 bg-primary">
                        <h3 class="text-xl font-semibold text-white ">
                            @lang('lang.Update_Status')
                        </h3>
                        <button type="button"
                            class=" absolute right-2 text-white bg-transparent rounded-lg text-sm w-8 h-8 ms-auto "
                            data-modal-hide="changeStatus">
                            <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>
                    <div class=" mx-6 my-6">
                        <div class="">
                            <label class="text-[14px] font-normal" for="Status">@lang('lang.Status')</label>
                            <select
                                class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                                name="status" id="Status">
                                <option selected disabled>@lang('lang.Change_Status')</option>
                                <option value="pending">@lang('lang.Pending')</option>
                                <option value="resolved">@lang('lang.Resolved')</option>
                                <option value="unfix">@lang('lang.Unfix')</option>
                            </select>

                        </div>

                    </div>
                    <div class="flex justify-end ">
                        <button
                            class="bg-primary text-white py-2 px-6 my-4 rounded-[4px]  mx-6 uaddBtn  font-semibold "
                            id="addBtn">
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
                            <div id="text">
                                @lang('lang.Update')
                            </div>

                        </button>
                    </div>
                </div>
        </form>
        <div>

        </div>

    </div>
</div>


@include('layouts.footer')

<script>
    $(document).ready(function() {
        function updateDatafun() {

            $('.updateBtn').click(function() {
                let updId = $(this).attr('updateId');
                $('#update_id').val(updId);
                $('#changeStatus').removeClass("hidden");
                $('#changeStatus').addClass("flex");

            });

        }
        updateDatafun();

        function deleteDatafun() {

            $('.delButton').click(function() {
                $('#deleteData').removeClass("hidden");
                var id = $(this).attr('delId');
                $('#delLink').attr('href', '../delinquiry/' + id);
            });

        }
        deleteDatafun();

        var table = $('#datatable').DataTable();
        table.on('draw', function() {
            deleteDatafun();
            updateDatafun();

        });
    });
</script>
