<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gray-900">
  <div class="max-w-md w-full space-y-8">
    <div>
      <img class="mx-auto h-26 w-auto border-2 border-gray-600" src="<?= r ?>assets/statics/logo.svg" alt="Reaml-Logo">
      <h2 class="mt-6 text-center text-3xl font-extrabold text-white">
        Reaml Admin
      </h2>
      <p class="font-bold text-center text-lg text-gray-300 hover:text-yellow-500">
        Content Management System
      </p>
    </div>
    <form class="sign-in mt-8 space-y-6" action="/auth/login" method="POST">
      <input type="hidden" name="ip" value="<?= Utils::get_client_ip() ?>">
      <input type="hidden" name="remember" value="true">
      <div class="rounded-md shadow-sm -space-y-px">
        <div>
          <label for="user_mail" class="sr-only">Username or Email</label>
          <input id="username" name="user_mail" type="text" autocomplete="email" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Username or Email">
        </div>
        <div>
          <label for="password" class="sr-only">Password</label>
          <input id="password" name="password" type="password" autocomplete="current-password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Password">
        </div>
      </div>
      <?php if (isset($_SESSION["errno"]) && $_SESSION["errno"]["status"] == 0) : ?>
        <div class="p-2 bg-red-300 text-center border border-red-400 rounded-md">
          <p class="font-bold text-xs text-red-900"><?= $_SESSION["errno"]["message"] ?></p>
        </div>
      <?php endif ?>
      <?php unset($_SESSION["errno"]) ?>
      <div class="flex items-center justify-between">
        <div class="flex items-center">
          <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
          <label for="remember-me" class="ml-2 block text-sm text-gray-400 hover:text-yellow-500">
            Remember login
          </label>
        </div>

        <div class="text-sm">
          <a href="/auth/forg_pwsd" class="font-medium text-gray-400 hover:text-yellow-500">
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