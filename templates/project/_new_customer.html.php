<div id="customer" class="hidden show shadow sm:rounded-md sm:overflow-hidden">
  <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
    <div>
      <h3 class="text-lg leading-6 font-medium text-gray-900">Customer Information</h3>
      <p class="mt-1 text-sm text-gray-500">Use a permanent address where you can recieve mail.</p>
    </div>

    <div class="grid grid-cols-6 gap-6">
      <div class="col-span-6 sm:col-span-3">
        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
        <input type="text" name="name" id="name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
      </div>

      <div class="col-span-6 sm:col-span-3">
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input type="text" name="password" id="password" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
      </div>

      <div class="col-span-6 sm:col-span-3">
        <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
        <input type="email" name="email" id="email" autocomplete="email" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
      </div>

      <div class="col-span-6 sm:col-span-3">
        <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
        <input type="tel" name="phone" id="phone" autocomplete="phone" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
      </div>

    </div>
  </div>
  <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
    <button type="submit" class="bg-indigo-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
      Next
    </button>
  </div>
</div>