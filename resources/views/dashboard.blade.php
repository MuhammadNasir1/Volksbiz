@extends('layouts.layout')
@section('title')
    Dashboard
@endsection
@section('content')
    <div class="mx-4 mt-12">
        <div>
            <h1 class=" font-semibold   text-2xl ">@lang('lang.Dashboard')</h1>
        </div>
        <div class="grid lg:grid-cols-4 md:grid-cols-2 gap-6  mt-4">
            <div class="card-1 ">
                <div class="bg-white  border border-secondary rounded-[10px] py-5 px-8">
                    <div class="flex gap-1 justify-between items-center">
                        <div>
                            <p class="text-sm text-[#808191]">@lang('lang.Total_users')</p>
                            <h2 class="text-2xl font-semibold mt-1">{{$totalUserCount}}</h2>
                        </div>
                        <div>
                            <div
                                class="icon-bg h-[60px] w-[60px] bg-[#339B96] rounded-full flex justify-center items-center">
                                <i class="fa-solid fa-user text-white text-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-1 ">
                <div class="bg-white  border border-secondary rounded-[10px] py-5 px-8">
                    <div class="flex gap-1 justify-between items-center">
                        <div>
                            <p class="text-sm text-[#808191]">Total Businesses</p>
                            <h2 class="text-2xl font-semibold mt-1">{{$totalBusinessCount}}</h2>
                        </div>
                        <div>
                            <div
                                class="icon-bg h-[60px] w-[60px] bg-[#a4c2da] rounded-full  flex justify-center items-center">
                                <i class="fa-solid fa-business-time  text-white text-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-1 ">
                <div class="bg-white  border border-secondary rounded-[10px] py-5 px-8">
                    <div class="flex gap-1 justify-between items-center">
                        <div>
                            <p class="text-sm text-[#808191]">Total Order</p>
                            <h2 class="text-2xl font-semibold mt-1">{{$totalOrderCount}}</h2>
                        </div>
                        <div>
                            <div
                                class="icon-bg h-[60px] w-[60px] bg-[#26056D] rounded-full  flex justify-center items-center">
                                <img src="{{ asset('./images/icons/sale.svg') }}" width="28" height="28"
                                    alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-1 ">
                <div class="bg-white  border border-secondary rounded-[10px] py-5 px-8">
                    <div class="flex gap-1 justify-between items-center">
                        <div>
                            <p class="text-sm text-[#808191]">Sale Offers</p>
                            <h2 class="text-2xl font-semibold mt-1">{{$totalOfferCount}}</h2>
                        </div>
                        <div>
                            <div
                                class="icon-bg h-[60px] w-[60px] bg-[#D95975] rounded-full flex justify-center items-center">
                                <i class="fa-solid fa-arrow-down   text-white text-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="lg:flex gap-12  px-3 ">
        <div class="lg:w-[60%] w-full">
            <div class=" shadow-med p-3 py-5  mt-8 rounded-xl min-h-[448px]">
                <div class="flex justify-between px-6">
                    <h2 class="text-xl  font-semibold ">@lang('lang.Latest_Businesses')</h2>

                </div>
                <div>
                    <div class="pt-3  mt-2 border-t  border-gray-200">

                        <div class="relative overflow-auto h-[300px] ">
                            <table class="w-full text-sm text-center ">
                                <thead class="text-sm text-gray-900  text-dblue ">
                                    <tr>
                                        <th class="px-6 py-3">
                                            Stn
                                        </th>
                                        <th class="px-6 py-3">
                                            @lang('lang.Photo')
                                        </th>
                                        <th class="px-6 py-3">
                                            @lang('lang.Name')
                                        </th>
                                        <th class="px-6 py-3">
                                           Location
                                        </th>
                                    </tr>
                                </thead> 
                                <tbody>
                                    <tr class="bg-white ">
                                        <td class="px-6 py-3 ">
                                            11
                                        </td>
                                        <td class="px-6 py-3 flex  justify-center">
                                            <img class="h-16 w-16 object-cover rounded-full" src="{{ asset('images/favicon(32X32).png') }}" alt="Product">
                                        </td>
                                        <td class="px-6 py-3">
                                            7th Class
                                        </td>
                                        <td class="px-6 py-3">
                                            Pak
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <div class="lg:w-[40%] w-full">
            <div class=" shadow-med p-3 rounded-xl mt-10">

                <div>
                    <div class="flex justify-between px-6">
                        <h2 class="text-xl  font-semibold ">Businesses</h2>
                    </div>
                    <div id="attendanceChart" class="mt-4" style="height: 270px; width: 100%;"></div>
                    <div class="mt-8 mx-10">
                        <div class="flex justify-around">
                            <div class="flex flex-col items-center">
                                <p class="text-[#CECECE] text-lg font-semibold">Pending</p>
                                <h2 class="text-[#B12424FF] text-3xl  mt-2 font-bold">{{$totalOfferCount}}</h2>
                            </div>
                            <div class="flex flex-col items-center">
                                <p class="text-[#CECECE] text-lg font-semibold">Reserved</p>
                                <h2 class="text-primary text-3xl  mt-2  font-bold"> {{$reservedBusinessCount}}</h2>
                            </div>
                            <div class="flex flex-col items-center">
                                <p class="text-[#CECECE] text-lg font-semibold">Sold</p>
                                <h2 class="text-[#332D8FFF] text-3xl  mt-2  font-bold">{{$soldBusinessCount}}</h2>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        window.onload = function() {
           



            var chart3 = new CanvasJS.Chart("attendanceChart", {
                animationEnabled: true,

                data: [{
                    type: "doughnut",
                    startAngle: 60,
                    //innerRadius: 60,
                    indexLabelFontColor: "transparent",
                    indexLabelPlacement: "inside",
                    dataPoints: [{
                            y: {{$totalOfferCount}},
                            color: "#B12424FF",
                            label: "Pending"
                        },
                        {
                            y: {{$reservedBusinessCount}},
                            color: "#13242C",
                            label: "Reserved"
                        },
                        {
                            y: {{$soldBusinessCount}},
                            color: "#332D8FFF",
                            label: "Sold"
                        },

                    ]
                }]
            });
            chart3.render();

        }
    </script>
@endsection
