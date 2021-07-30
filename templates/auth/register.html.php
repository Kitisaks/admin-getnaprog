<div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-md">
    <img class="mx-auto h-24 w-auto animate-pulse" src="<?php echo r; ?>assets/statics/logo.webp" alt="Workflow">
    <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
      Sign Up
    </h2>
    <p class="mt-2 text-center text-sm text-gray-600">
      Fill in all informations 
    </p>
  </div>

  <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
    <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
      <form class="space-y-6" action="/auth/add" method="POST">
        <input type="hidden" name="token" value="<?php echo $_SESSION["token"]; ?>">
        <input type="hidden" name="ip" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>">
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700">
            Name
          </label>
          <div class="mt-1">
            <input id="name" name="name" type="text" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
          </div>
        </div>

        <div>
          <label for="email" class="block text-sm font-medium text-gray-700">
            Username
          </label>
          <div class="mt-1">
            <input id="username" name="username" type="text" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
          </div>
        </div>

        <div>
          <label for="password" class="block text-sm font-medium text-gray-700">
            Password
          </label>
          <div class="mt-1">
            <input id="password" name="password" type="password" autocomplete="current-password" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
          </div>
        </div>

        <div>
          <label for="email" class="block text-sm font-medium text-gray-700">
            Email address
          </label>
          <div class="mt-1">
            <input id="email" name="email" type="email" autocomplete="email" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
          </div>
        </div>

        <div class="pt-4">
          <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Sign up
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
              Has any problems?               
              <a href="mailto:kitisak.spnr@gmail.com?subject=Re: Has a problem with App."  class="text-blue-500  text-center text-sm hover:underline cursor-pointer">
                @DevedAdmin
              </a>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
