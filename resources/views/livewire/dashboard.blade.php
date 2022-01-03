<x-slot name="title">
    <title>Dashboard</title>
</x-slot>

<div>
    <h1 class="text-3xl font-bold text-gray-700 lg:text-4xl lg:py-0 dark:text-light">Dashboard</h1>
    <div class="mt-4">
        <div class="flex flex-wrap w-full px-6">

                <div class="flex items-center px-5 py-6 bg-indigo-100 rounded-md shadow-sm">
                    <div class="p-3 bg-orange-600 bg-opacity-75 rounded-full">
                        <img src="{{ asset('images/invoice.png') }}" alt="all posts" class="w-8 h-8">
                    </div>

                    <div class="mx-5">
                        <div class="text-xl text-gray-500 ">Total Invoices </div>
                        <h4 class="text-2xl font-semibold text-gray-700">{{ $inv_count }}</h4>
                    </div>
                </div>

                <div class="flex items-center px-5 py-6 mt-8 bg-red-100 rounded-md shadow-sm lg:ml-16 lg:mt-0">
                    <div class="p-3 bg-orange-600 bg-opacity-75 rounded-full">
                        <img src="{{ asset('images/invoice.png') }}" alt="all posts" class="w-8 h-8">
                    </div>

                    <div class="mx-5">
                        <div class="text-xl text-gray-500 ">Pending Invoices </div>
                        <h4 class="text-2xl font-semibold text-gray-700">{{ $pending }}</h4>
                    </div>
                </div>

        </div>
    </div>

    <div class="mt-8">
        <h1 class="text-xl font-bold text-gray-700 lg:text-3xl lg:py-0 dark:text-light">
            Invoice processed
        </h1>
        <p class="px-4 my-8 text-sm text-gray-500 dark:text-light">
            Chart showing the ration of processed and pending invoices.
        </p>
         <div style="height: 400px !important; width:400px!important;">
            <canvas id="myChart" width="400" height="400"></canvas>
         </div>
    </div>
</div>

<x-slot name="scripts">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.2/chart.min.js"></script>
    <script>
        var ctx = document.getElementById('myChart');
        var data = {
         labels: [
        'Pending Invoices',
        'Processed Invoices',
        ],
         datasets: [
        {
            fill: true,
            backgroundColor: [
                'red',
                ' #ffff66'],
                data: [@js($pending),@js($processed)],
            borderColor:	['red', '#ffff66'],
            borderWidth: [2,2]
        }
    ]
};
        // And for a doughnut chart
        var myDoughnutChart = new Chart(ctx, {
            type: 'doughnut',
            data: data,
        });
    </script>
</x-slot>
