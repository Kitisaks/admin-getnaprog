<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gray-900">
  <div class="max-w-md w-full space-y-8">
    <div>
      <img class="mx-auto h-26 w-auto border-2 border-gray-600 animate-pulse" src="<?= r ?>assets/statics/logo.svg" alt="Reaml-Logo">
      <h2 class="mt-6 text-center text-3xl font-extrabold text-white">
        Reaml Admin
      </h2>
      <p class="font-bold text-center text-lg text-gray-300 hover:text-yellow-500">
        Content Management System
      </p>
    </div>
    <form class="sign-in mt-8 space-y-6" action="/auth/login" method="POST">
      <input type="hidden" name="_csrf_token" value="<?= $_SESSION["_csrf_token"] ?>">
      <input type="hidden" name="remember" value="true">
      <div class="rounded-md shadow-sm -space-y-px">
        <div>
          <label for="agency_uuid" class="sr-only">Agency</label>
          <select name="agency_uuid" class="block bg-white w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-gray-900">
            <?php foreach($GLOBALS["agencies"] as $agency): ?>
              <option value="<?= $agency["uuid"] ?>"><?= $agency["cname"] ?></option>
            <?php endforeach ?>
          </select>
        </div>
        <div class="pt-4">
          <label for="user_mail" class="sr-only">Username or Email</label>
          <input id="username" name="user_mail" type="text" autocomplete="email" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Username or Email">
        </div>
        <div>
          <label for="password" class="sr-only">Password</label>
          <input id="password" name="password" type="password" autocomplete="current-password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Password">
        </div>
      </div>
      <div class="flex items-center justify-between">
        <div class="flex items-center">
          <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
          <label for="remember-me" class="ml-2 block text-sm text-gray-400 hover:text-yellow-500">
            Remember login
          </label>
        </div>

        <div class="text-sm">
          <a href="#" class="font-medium text-gray-400 hover:text-yellow-500">
            Forgot password?
          </a>
        </div>
      </div>

      <div>
        <input type="submit" name="submit" value="Login" class="cursor-pointer group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
      </div>
    </form>
  </div>
</div>