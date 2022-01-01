
<x-slot name="title">
    <title>Request Invoice</title>
</x-slot>

<div>
    <h1 class="font-serif text-2xl font-semibold tracking-wide text-gray-700 dark:text-light">
        Request New Invoice
    </h1>
    @if (session()->has('success'))
        <div class="flex p-4 my-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
            <svg class="inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                    clip-rule="evenodd"></path>
            </svg>
            <div><span class="font-medium">{{ session('success') }}</span></div>
        </div>
    @endif

    <div class="leading-loose">
        <form wire:submit.prevent="submitRequest"
            class="max-w-xl px-10 py-6 m-4 bg-white border rounded shadow-xl dark:border-gray-300 dark:bg-inherit md:w-100">
            <p class="pb-4 font-medium text-gray-800 dark:text-light">
                Customer Information
            </p>
            <div class="">
                <label class="block text-base text-gray-00" for="name">Name</label>
                <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="name" type="text"
                    wire:model.defer="name" required="" placeholder="Enter Name" aria-label="Name" />
                @error('name')
                    <span class="text-sm font-semibold text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-4">
                <label class="block text-base text-gray-600 dark:text-light" for="phone_no">Phone no</label>
                <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" type="text"
                    wire:model.defer="phone_no" id="phone_no" required="" placeholder="Enter phone number"
                    aria-label="Email" />
                @error('name')
                    <span class="text-sm font-semibold text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-4">
                <label class="block text-base text-gray-600 dark:text-light" for="email">Email (optional)</label>
                <input class="w-full px-5 py-4 text-gray-700 bg-gray-200 rounded" id="email" type="text"
                    wire:model.defer="email"  placeholder="Enter Email" aria-label="Email" />
                @error('email')
                    <span class="text-sm font-semibold text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <p class="mt-4 font-medium text-gray-800 dark:text-light">
                Project Information
            </p>
            <label class="block mt-4">
                <span class="text-gray-700 dark:text-light">Select which project</span>
                <select class="block w-full px-2 py-2 mt-1 text-gray-700 bg-gray-200 rounded " wire:model="project"
                    required>
                    <option selected value="" disabled>Choose ..</option>
                    <option value="1">
                        Mr.Kuku Chicken rearing
                    </option>
                    <option value="2">
                        Bravo Corn Farming
                    </option>
                </select>
                @error('project')
                    <span class="text-sm font-semibold text-red-500">{{ $message }}</span>
                @enderror
            </label>
            <!-- amount for project chicken -->
            @if ($project == '1')
            <div class="mt-4">
                <label class="block text-base text-gray-600 dark:text-light" for="amount">Amount</label>
                <input class="w-full px-5 py-4 text-gray-700 bg-gray-200 rounded" id="amount" type="number"
                    required="" placeholder="Enter Amount" aria-label="amount" wire:model="amount"/>

                    <span class="text-sm font-semibold text-blue-500">Amount:{{ number_format(intval($amount) ?? 0) }} Tshs</span>

                @error('amount')
                    <span class="text-sm font-semibold text-red-500">{{ $message }}</span>
                @enderror
            </div>
        @endif
        @if ($project == '2')

            <!-- amount for corn farming -->
            <div class="mt-4" x-transition>
                <label class="block text-base text-gray-600 dark:text-light" for="acres">No of Acres</label>
                <input class="w-full px-5 py-4 text-gray-700 bg-gray-200 rounded" id="acres" type="number"
                    required="" placeholder="Enter No of Acres" aria-label="acres" wire:model="acres" />
                @error('acres')
                    <span class="text-sm font-semibold text-red-500">{{ $message }}</span>
                @enderror
            </div>
        @endif

            <div class="mt-4">
                <button class="px-4 py-1 font-light tracking-wider text-white bg-gray-900 rounded hover:bg-gray-600"
                    type="submit">
                    SUBMIT
                </button>
            </div>
        </form>
    </div>
</div>
