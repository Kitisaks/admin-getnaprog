<div id="notification" class="hidden show shadow sm:rounded-md sm:overflow-hidden">
  <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
    <div>
      <h3 class="text-lg leading-6 font-medium text-gray-900">Notifications</h3>
      <p class="mt-1 text-sm text-gray-500">Provide basic notification services for orders and statics of your page.</p>
    </div>

    <fieldset>
      <legend class="text-base font-medium text-gray-900">Services</legend>
      <div class="mt-4 space-y-4">
        <div class="flex items-start">
          <div class="h-5 flex items-center">
            <input id="notification[email]" name="notification[email]" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
          </div>
          <div class="ml-3 text-sm">
            <label for="notification[email]" class="font-medium text-gray-700">Email</label>
          </div>
        </div>
        <div>
          <div class="flex items-start">
            <div class="h-5 flex items-center">
              <input id="notification[line]" name="notification[line]" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
            </div>
            <div class="ml-3 text-sm">
              <label for="notification[line]" class="font-medium text-gray-700">Line</label>
            </div>
          </div>
        </div>
        <!-- <div>
          <div class="flex items-start">
            <div class="h-5 flex items-center">
              <input id="offers" name="offers" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
            </div>
            <div class="ml-3 text-sm">
              <label for="offers" class="font-medium text-gray-700">SMS</label>
            </div>
          </div>
        </div> -->
      </div>
    </fieldset>
  </div>
  <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
    <button type="submit" id="project-create" class="bg-indigo-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600">
      Create New Project
    </button>
  </div>
</div>