<template>
  <div class="">
    <h1
      class="font-serif text-2xl font-semibold tracking-wide text-gray-700 dark:text-light"
    >
      Request New Invoice
    </h1>
    <div
      v-if="success"
      class="flex p-4 my-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg"
      role="alert"
    >
      <svg
        class="inline w-5 h-5 mr-3"
        fill="currentColor"
        viewBox="0 0 20 20"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          fill-rule="evenodd"
          d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
          clip-rule="evenodd"
        ></path>
      </svg>
      <div><span class="font-medium">Success alert!</span> {{ success }}</div>
    </div>
    <div class="leading-loose">
      <form
        v-on:submit.prevent="submitForm"
        class="max-w-xl px-10 py-6 m-4 bg-white border rounded shadow-xl dark:border-gray-300 dark:bg-inherit md:w-100"
      >
        <p class="pb-4 font-medium text-gray-800 dark:text-light">
          Customer Information
        </p>
        <div class="">
          <label class="block text-base text-gray-00" for="name">Name</label>
          <input
            class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded"
            id="name"
            type="text"
            v-model="name"
            required=""
            placeholder="Enter Name"
            aria-label="Name"
          />
        </div>
        <div class="mt-4">
          <label
            class="block text-base text-gray-600 dark:text-light"
            for="phone_no"
            >Phone no</label
          >
          <input
            class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded"
            type="text"
            v-model="phone_no"
            id="phone_no"
            required=""
            placeholder="Enter phone number"
            aria-label="Email"
          />
        </div>
        <div class="mt-4">
          <label
            class="block text-base text-gray-600 dark:text-light"
            for="email"
            >Email (optional)</label
          >
          <input
            class="w-full px-5 py-4 text-gray-700 bg-gray-200 rounded"
            id="email"
            type="text"
            v-model="email"
            required=""
            placeholder="Enter Email"
            aria-label="Email"
          />
        </div>
        <p class="mt-4 font-medium text-gray-800 dark:text-light">
          Project Information
        </p>
        <label class="block mt-4">
          <span class="text-gray-700">Select which project</span>
          <select
            class="block w-full px-2 py-2 mt-1 text-gray-700 bg-gray-200 rounded "
            v-model="project"
            required
          >
            <option selected value="" disabled>Choose ..</option>
            <option value="1">Mr.Kuku Chicken rearing</option>
            <option value="2">Bravo Corn Farming</option>
          </select>
        </label>
        <!-- amount for project chicken -->
        <div class="mt-4" v-if="project == 1">
          <label
            class="block text-base text-gray-600 dark:text-light"
            for="amount"
            >Amount</label
          >
          <input
            class="w-full px-5 py-4 text-gray-700 bg-gray-200 rounded"
            id="amount"
            type="number"
            required=""
            placeholder="Enter Amount"
            aria-label="amount"
            v-model.number="amount"
          />
        </div>
        <!-- amount for corn farming -->
        <div class="mt-4" v-if="project == 2">
          <label
            class="block text-base text-gray-600 dark:text-light"
            for="acres"
            >No of Acres</label
          >
          <input
            class="w-full px-5 py-4 text-gray-700 bg-gray-200 rounded"
            id="acres"
            type="number"
            required=""
            placeholder="Enter No of Acres"
            aria-label="acres"
            v-model="acres"
          />
        </div>
        <div class="mt-4">
          <button
            class="px-4 py-1 font-light tracking-wider text-white bg-gray-900 rounded hover:bg-gray-600"
            type="submit"
          >
            SUBMIT
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
export default {
  data() {
    return {
        name: "",
        phone_no: "",
        email: "",
        project: "",
        amount: "",
        acres: "",
        success: "",
    };
  },
  methods: {
    submitForm() {
      axios
        .post("/invoice", {
          name: this.name,
          phone_no: this.phone_no,
          email: this.email,
          project: this.project,
          amount: this.amount,
          acres: this.acres,
        })
        .then((response) => {
          this.clearFormData();
          this.success = response.data.message;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    clearFormData(){
          this.name="";
          this.phone_no="";
          this.email="";
          this.project="";
          this.amount="";
          this.acres="";
    }
  },
};
</script>

