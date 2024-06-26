@include('layouts.header')
@include('layouts.nav')

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
                        <h2 class="text-2xl font-semibold mt-1">1</h2>
                    </div>
                    <div>
                        <div
                            class="icon-bg h-[60px] w-[60px] bg-[#339B96] rounded-full flex justify-center items-center">
                            <i class="fa-solid fa-users text-white text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-1 ">
            <div class="bg-white  border border-secondary rounded-[10px] py-5 px-8">
                <div class="flex gap-1 justify-between items-center">
                    <div>
                        <p class="text-sm text-[#808191]">@lang('lang.Buy_Orders')</p>
                        <h2 class="text-2xl font-semibold mt-1">0</h2>
                    </div>
                    <div>
                        <div
                            class="icon-bg h-[60px] w-[60px] bg-[#a4c2da] rounded-full  flex justify-center items-center">
                            <i class="fa-solid fa-cart-arrow-down text-white text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-1 ">
            <div class="bg-white  border border-secondary rounded-[10px] py-5 px-8">
                <div class="flex gap-1 justify-between items-center">
                    <div>
                        <p class="text-sm text-[#808191]">@lang('lang.Sell_Requests')</p>
                        <h2 class="text-2xl font-semibold mt-1">1</h2>
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
                        <p class="text-sm text-[#808191]">@lang('lang.Total_Revenue')</p>
                        <h2 class="text-2xl font-semibold mt-1">1</h2>
                    </div>
                    <div>
                        <div
                            class="icon-bg h-[60px] w-[60px] bg-[#D95975] rounded-full flex justify-center items-center">
                            <img src="{{ asset('./images/icons/dollar.svg') }}" width="18" height="18"
                                alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<div class="lg:flex gap-14 mt-16 px-3 ">
    <div class="lg:w-[60%] w-full">
        <div class=" shadow-med p-3 rounded-xl">
            <h2 class="text-xl  font-semibold  ml-6">@lang('lang.Earnings')</h2>
            <div id="earningChart" class="mt-4" style="height: 370px; width: 100%;"></div>

        </div>


        <div class=" shadow-med p-3 py-5  mt-8 rounded-xl min-h-[448px]">
            <div class="flex justify-between px-6">
                <h2 class="text-xl  font-semibold ">@lang('lang.Top_Product')</h2>

            </div>
            <div>
                <div class="pt-3  mt-2 border-t  border-gray-200">

                    <div class="relative overflow-auto h-[300px] ">
                        <table class="w-full text-sm text-center ">
                            <thead class="text-sm text-gray-900  text-dblue ">
                                <tr>
                                    <th class="px-6 py-3">
                                        @lang('lang.Code')
                                    </th>
                                    <th class="px-6 py-3">
                                        @lang('lang.Photo')
                                    </th>
                                    <th class="px-6 py-3">
                                        @lang('lang.Name')
                                    </th>
                                    <th class="px-6 py-3">
                                        @lang('lang.Rank')
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-white ">
                                    <td class="px-6 py-3 ">
                                        11
                                    </td>
                                    <td class="px-6 py-3 flex  justify-center">
                                        <img src="{{ asset('images/favicon(32X32).png') }}" alt="Product">
                                    </td>
                                    <td class="px-6 py-3">
                                        7th Class
                                    </td>
                                    <td class="px-6 py-3">
                                        <div class="flex items-center justify-center flex-col">
                                            <div>
                                                <p class="text-dblue flex">95.06%</p>
                                                <div class="bg-green-100 rounded-xl w-36 h-3 relative  mt-1">
                                                    <div class="bg-dblue w-[70%] rounded-xl h-full"></div>
                                                </div>
                                            </div>
                                        </div>
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
        <div class=" shadow-med p-3 rounded-xl">
            <h2 class="text-xl  font-semibold ml-6">@lang('lang.Users_&_Plan')</h2>
            <div id="studentChart" class="mt-4" style="height: 370px; width: 100%;"></div>
        </div>
        <div class=" shadow-med p-3 rounded-xl mt-10">

            <div>
                <div class="flex justify-between px-6">
                    <h2 class="text-xl  font-semibold ">@lang('lang.Requests')</h2>
                </div>
                <div id="attendanceChart" class="mt-4" style="height: 270px; width: 100%;"></div>
                <div class="mt-8 mx-10">
                    <div class="flex justify-around">
                        <div class="flex flex-col items-center">
                            <p class="text-[#CECECE] text-lg font-semibold">@lang('lang.Sell')</p>
                            <h2 class="text-secondary text-3xl  mt-2 font-bold">84%</h2>
                        </div>
                        <div class="flex flex-col items-center">
                            <p class="text-[#CECECE] text-lg font-semibold">@lang('lang.Buy')</p>
                            <h2 class="text-primary text-3xl  mt-2  font-bold">34%</h2>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    window.onload = function() {
        CanvasJS.addColorSet("colors",
            [

                "#417dfc",
                "#339B96",
                "#13242C",

            ]);
        var chart = new CanvasJS.Chart("earningChart", {
            animationEnabled: true,
            axisX: {
                valueFormatString: "DDD",
                minimum: new Date(2017, 1, 5, 23),
                maximum: new Date(2017, 1, 12, 1)
            },
            axisY: {
                gridColor: "#00000016",
                lineDashType: "dot"
            },
            toolTip: {
                shared: true
            },
            data: [{
                    name: "Received",
                    type: "area",
                    fillOpacity: 100,
                    color: "#417dfc",
                    markerSize: 0,
                    dataPoints: [{
                            x: new Date(2017, 1, 6),
                            y: 550
                        },
                        {
                            x: new Date(2017, 1, 7),
                            y: 450
                        },
                        {
                            x: new Date(2017, 1, 8),
                            y: 500
                        },
                        {
                            x: new Date(2017, 1, 9),
                            y: 162
                        },
                        {
                            x: new Date(2017, 1, 10),
                            y: 150
                        },
                        {
                            x: new Date(2017, 1, 11),
                            y: 400
                        },
                        {
                            x: new Date(2017, 1, 12),
                            y: 129
                        }
                    ]
                },
                {

                    name: "Sent",
                    type: "area",
                    color: "#13242C",
                    fillOpacity: 100,
                    markerSize: 2,
                    dataPoints: [{
                            x: new Date(2017, 1, 6),
                            y: 200
                        },
                        {
                            x: new Date(2017, 1, 7),
                            y: 150
                        },
                        {
                            x: new Date(2017, 1, 8),
                            y: 300
                        },
                        {
                            x: new Date(2017, 1, 9),
                            y: 550
                        },
                        {
                            x: new Date(2017, 1, 10),
                            y: 50
                        },
                        {
                            x: new Date(2017, 1, 11),
                            y: 80
                        },
                        {
                            x: new Date(2017, 1, 12),
                            y: 200
                        }
                    ]
                }
            ]
        });

        var chart2 = new CanvasJS.Chart("studentChart", {
            colorSet: "colors",
            animationEnabled: true,
            theme: "light1",
            axisY: {
                gridColor: "#00000016",
                suffix: "-"

            },

            data: [{
                type: "column",
                yValueFormatString: "#,##0.0#\"\"",
                dataPoints: [{
                        label: "Jan",

                        y: 78
                    },
                    {
                        label: "Feb",
                        y: 55
                    },
                    {
                        label: "Mar",
                        y: 80
                    },
                    {
                        label: "Apr",
                        y: 60
                    },


                ]
            }]
        });

        var chart3 = new CanvasJS.Chart("attendanceChart", {
            animationEnabled: true,

            data: [{
                type: "doughnut",
                startAngle: 60,
                //innerRadius: 60,
                indexLabelFontColor: "transparent",
                indexLabelPlacement: "inside",
                dataPoints: [{
                        y: 67,
                        color: "#417dfc",
                        label: "Students"
                    },
                    {
                        y: 28,
                        color: "#13242C",
                        label: "Teachers"
                    },

                ]
            }]
        });
        chart.render();
        chart2.render();
        chart3.render();

    }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js"
    integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@include('layouts.footer')
