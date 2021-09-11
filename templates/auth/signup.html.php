<main class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8 bg-gray-900">
  <div class="sm:mx-auto sm:w-full sm:max-w-md">
    <img class="mx-auto h-32 w-auto border-2 border-gray-600" src="<?= r ?>assets/statics/logo.svg" alt="Reaml-Logo">
    <h2 class="mt-6 text-center text-3xl font-extrabold text-white">
      Sign-Up
    </h2>
    <p class="mt-2 text-center text-sm text-gray-300">
      fill up all fields
    </p>
  </div>

  <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
    <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
      <form class="grid grid-cols-2 gap-4" action="/auth/add" method="POST">
        <input type="hidden" name="_csrf_token" value="<?= $_SESSION["_csrf_token"] ?>">
        <input type="hidden" name="ip" value="<?= Utils::get_client_ip() ?>">
        
        <div class="col-span-2">
          <label for="agency_id" class="block text-sm font-medium text-gray-700">
            Agency
          </label>
          <select name="agency_id" class="block bg-white w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <?php foreach($GLOBALS["agencies"] as $agency): ?>
              <option value="<?= $agency["uuid"] ?>"><?= $agency["cname"] ?></option>
            <?php endforeach ?>
          </select>
        </div>

        <div class="col-span-2">
          <label for="name" class="block text-sm font-medium text-gray-700">
            Name
          </label>
          <div class="mt-1">
            <input id="name" name="name" type="text" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
          </div>
        </div>

        <div class="col-span-1">
          <label for="username" class="block text-sm font-medium text-gray-700">
            Username
          </label>
          <div class="mt-1">
            <input id="username" name="username" type="text" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
          </div>
        </div>

        <div class="col-span-1">
          <label for="password" class="block text-sm font-medium text-gray-700">
            Password
          </label>
          <div class="mt-1">
            <input id="password" name="password" type="password" autocomplete="current-password" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
          </div>
        </div>

        <div class="col-span-1">
          <label for="gender" class="block text-sm font-medium text-gray-700">
            Gender
          </label>
          <div class="mt-1">
            <select name="gender" id="gender" class="cursor-pointer bg-white block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
              <option value="" selected hidden>Select</option>
              <option value="m">Male</option>
              <option value="f">Female</option>
            </select>
          </div>
        </div>

        <div class="col-span-1">
          <label for="phone" class="block text-sm font-medium text-gray-700">
            Phone
          </label>
          <div class="mt-1">
            <input id="phone" name="phone" type="tel" maxlength="10" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
          </div>
        </div>

        <div class="col-span-2">
          <label for="email" class="block text-sm font-medium text-gray-700">
            Email
          </label>
          <div class="mt-1">
            <input id="email" name="email" type="email" autocomplete="email" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
          </div>
        </div>
        <div class="pt-4 col-span-2">
          <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Sign-up
          </button>
        </div>
      </form>

      <div class="mt-6">
        <div class="relative">
          <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-gray-300"></div>
          </div>
          <div class="relative flex justify-center text-sm">
            <span class="px-2 bg-white text-gray-500">
              See problems?
              <a href="mailto:kitisak.spnr@gmail.com?subject=Re: Has a problem with App." class="text-blue-500  text-center text-sm hover:underline cursor-pointer">
                @ReamlAdmin
              </a>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>