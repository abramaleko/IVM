<x-slot name="title">
    <title>Pending Invoices</title>
</x-slot>

<x-slot name="styles">
    <style>
        .has-mask {
            position: absolute;
            clip: rect(10px, 150px, 130px, 10px);
        }

    </style>
</x-slot>

<div class="leading-normal tracking-wider text-gray-900">

    <!--Pending -->
    @if (!$selectedInvoice)
        <div class="container">
            <!--Title-->

            <!--Table-->
            <section class="max-w-3xl antialiased text-gray-600 bg-gray-100 dark:bg-inherit">
                <div class="flex flex-col justify-center h-full">
                    <!-- Table -->
                    <div class="w-full bg-white border border-gray-200 rounded-sm shadow-lg dark:bg-inherit">
                        <header class="flex flex-wrap px-5 py-4 border-b border-gray-100 lg:justify-between ">
                            <div class="">
                                <h2 class="pt-4 text-lg font-semibold text-gray-800 dark:text-light">
                                    Pending Invoices
                                </h2>
                            </div>
                            <div class="">
                                <div class="relative pt-2 mx-auto text-gray-600">
                                    <input
                                        class="h-10 px-5 pr-16 text-sm bg-white border-2 border-gray-300 rounded-lg focus:outline-none"
                                        type="search" wire:model="search" placeholder="Search by name"
                                        autocomplete="off">
                                    <button type="submit" class="absolute top-0 right-0 mt-5 mr-4">
                                        <svg class="w-4 h-4 text-gray-600 fill-current"
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1"
                                            x="0px" y="0px" viewBox="0 0 56.966 56.966"
                                            style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve"
                                            width="512px" height="512px">
                                            <path
                                                d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </header>
                        <div class="p-3">
                            <div class="overflow-x-auto">
                                <table class="w-full table-auto">
                                    <thead
                                        class="text-xs font-semibold text-gray-400 uppercase bg-gray-50 dark:bg-inherit dark:text-light">
                                        <tr>
                                            <th class="p-2 whitespace-nowrap">
                                                <div class="font-semibold text-left">Name</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap">
                                                <div class="font-semibold text-left">Project</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap">
                                                <div class="font-semibold text-left">Date requested</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap">
                                                <div class="font-semibold text-center">Details</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap">
                                                <div class="font-semibold text-center">Delete</div>
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody class="text-sm divide-y divide-gray-100">
                                        <div wire:loading.delay wire:target="search">
                                            <span class="py-6 pl-8 text-base text-gray-800">
                                                Searching...
                                            </span>
                                        </div>
                                        @foreach ($pendingInvoices as $invoices)
                                            <tr class="dark:text-light hover:bg-blue-100 dark:hover:text-gray-600 ">
                                                <td class="p-2 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="font-medium ">
                                                            {{ $invoices->name }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="p-2 whitespace-nowrap">
                                                    <div class="text-left">
                                                        {{ $invoices->project == 1 ? 'Chicken Rearing Project' : 'Corn Farming Project' }}
                                                    </div>
                                                </td>
                                                <td class="p-2 whitespace-nowrap">
                                                    <div class="font-medium text-left text-green-500">
                                                        {{ $invoices->created_at->diffForHumans() }}
                                                    </div>
                                                </td>
                                                <td class="p-2 whitespace-nowrap">
                                                    <div class="text-lg text-center">
                                                        <button wire:click='setSelectedId({{ $invoices->id }})'
                                                            class="inline-block text-center ">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="w-6 h-6 text-blue-400" fill="none"
                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td class="p-2 whitespace-nowrap">
                                                    <div class="text-lg text-center">
                                                        <a wire:click='deleteSelected({{ $invoices->id }})'
                                                            class="inline-block text-center cursor-pointer">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-400" fill="none"
                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach
                                        {{ $pendingInvoices->links() }}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--/Card-->

        </div>
    @endif

    @if ($selectedInvoice)
        <div class="mb-4">
            <p class="text-lg font-bold text-green-500 cursor-pointer md:text-sm">&lt;&lt;
                <a wire:click="resetSelected"
                    class="text-base font-bold text-green-500 no-underline md:text-sm hover:underline">
                    GO BACK
                </a>
            </p>
        </div>
        @if (session()->has('success'))
            <div class="flex p-4 my-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                <svg class="inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd"></path>
                </svg>
                <div><span class="font-medium">{{ session('success') }}</span></div>
            </div>
        @endif
        <div class="">
            <h1
                class="flex items-center px-2 py-4 font-sans text-xl font-bold text-gray-600 break-normal md:text-2xl dark:text-light">
                Invoice Details
            </h1>

            <div class="">
                <p class="py-4 text-lg text-gray-700 dark:text-light">
                    Name : <span class="font-semibold">{{ $selectedInvoice->name }}</span>
                </p>
                <p class="py-4 text-lg text-gray-700 dark:text-light">
                    Project : <span
                        class="font-semibold">{{ $selectedInvoice->project == 1 ? 'Chicken Rearing Project' : 'Corn Farming Project' }}</span>
                </p>
                <p class="py-4 text-lg text-gray-700 dark:text-light">
                    {{ $selectedInvoice->project == 1 ? 'Amount' : 'Acres' }} :
                    <span class="font-semibold">
                        {{ $selectedInvoice->project == 1 ? number_format($selectedInvoice->amount) . ' Tshs' : $selectedInvoice->acres . ' Acres' }}
                    </span>
                </p>
                <p class="py-4 text-lg text-gray-700 dark:text-light">
                    Date Requested : <span
                        class="font-semibold">{{ $selectedInvoice->created_at->format('jS F Y') }}
                    </span>
                </p>


                @if ($selectedInvoice->processed)


                    <div class="mt-4 text-lg font-bold text-gray-600 dark:text-light">
                        Download Invoice :
                    </div>
                    <div class="flex flex-wrap mt-4">
                        @foreach ($paths as $path)
                            <div class="">
                                <div class="p-8 mr-8 bg-white rounded">
                                    <svg class="w-6 h-5 text-blue-500" fill="currentColor"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path
                                            d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                                    </svg>
                                </div>
                                <a wire:click="downloadInvoice('{{ $path }}')"
                                    class="block mt-2 text-base text-blue-500 cursor-pointer hover:text-gray-400 dark:text-light">
                                    Download
                                </a>
                            </div>

                        @endforeach
                    </div>

                @else
                    @can('upload-invoice')
                        <!--Invoice uploads-->
                        <div class="relative flex mt-6">
                            <div class="absolute inset-0 z-0 opacity-60"></div>
                            <div class="z-10 w-full p-10 bg-white sm:max-w-lg rounded-xl">
                                <div class="">
                                    <h2 class="mt-5 text-3xl font-bold text-gray-900">
                                        Invoice Upload!
                                    </h2>
                                    <p class="mt-2 text-sm text-gray-400">Upload here the invoices, supported formats are
                                        pdf's and image formats of not greater than 5MB</p>
                                </div>
                                @error('invoiceDocs.*')
                                    <div class="mt-4">
                                        <span class="font-semibold text-red-500 error">{{ $message }}</span>
                                    </div>
                                @enderror
                                <form class="mt-8 space-y-3" wire:submit.prevent='UploadInvoice'>
                                    <div class="grid grid-cols-1 space-y-2">
                                        <label class="text-sm font-bold tracking-wide text-gray-500">Attach Document</label>
                                        <div class="flex items-center justify-center w-full">
                                            <label
                                                class="flex flex-col w-full p-10 text-center border-4 border-dashed rounded-lg h-60 group">
                                                <div
                                                    class="flex flex-col items-center justify-center w-full h-full text-center ">
                                                    <div class="flex flex-auto w-2/5 mx-auto -mt-10 max-h-48">
                                                        <img class="object-center has-mask h-36"
                                                            src="https://img.freepik.com/free-vector/image-upload-concept-landing-page_52683-27130.jpg?size=338&ext=jpg"
                                                            alt="freepik image">
                                                    </div>
                                                    <p class="text-gray-500 pointer-none "><a href="#" id="selectFile"
                                                            class="text-blue-600 hover:underline">Select files</a> from
                                                        your
                                                        computer
                                                    </p>
                                                </div>
                                                <input type="file" class="hidden" id="uploadfile"
                                                    wire:model="invoiceDocs" multiple>
                                                <script>
                                                    $('#selectFile').click(function() {
                                                        $('#uploadfile').trigger('click');
                                                    });
                                                </script>
                                            </label>
                                        </div>
                                    </div>
                                    @if (count($invoiceDocs) > 0)
                                        <p class="text-sm text-blue-500">
                                            <span>{{ count($invoiceDocs) }} file uploaded, click the submit button to
                                                submit</span>
                                        </p>
                                    @endif
                                    <div>
                                        <button type="submit"
                                            class="flex justify-center w-full p-4 my-5 font-semibold tracking-wide text-gray-100 transition duration-300 ease-in bg-blue-500 rounded-full shadow-lg cursor-pointer focus:outline-none focus:shadow-outline hover:bg-blue-600">
                                            Submit
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endcan
                    @cannot('upload-invoice')
                    <p class="py-4 text-lg text-gray-700 dark:text-light">
                        Status: <span
                            class="font-semibold text-red-500">
                            Invoice not yet uploaded by Hq
                        </span>
                    </p>
                    @endcannot

                @endif



            </div>
        </div>
    @endif

</div>
<x-slot name="scripts">
    <!-- jQuery -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js" defer></script>
</x-slot>
