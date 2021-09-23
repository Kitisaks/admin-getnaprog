<main class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-4 min-h-screen">
  <div class="pb-10">
    <!-- Page header -->
    <div class="max-w-3xl mx-auto px-4 sm:px-6 md:flex md:items-center md:justify-between md:space-x-5 lg:max-w-7xl lg:px-8">
      <div class="flex items-center space-x-5">
        <div>
          <h1 class="text-2xl font-bold text-gray-900">
            <?= ucfirst($GLOBALS["template"]["t_title"]) ?>
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-sm font-medium bg-pink-100 text-pink-800">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
              </svg>
              <?= $GLOBALS["template"]["t_id"] ?>
            </span>
          </h1>
          <p class="text-sm font-medium text-gray-500">Created <time><?= App\Libs\Timex::from_now($GLOBALS["template"]["t_inserted_at"]) ?></time></p>
        </div>
      </div>
      <div class="mt-6 flex flex-col-reverse justify-stretch space-y-4 space-y-reverse sm:flex-row-reverse sm:justify-end sm:space-x-reverse sm:space-y-0 sm:space-x-3 md:mt-0 md:flex-row md:space-x-3">
        <?php if (App\Data\User::permitted($_SESSION["conn"]["current_user"], $GLOBALS["template"]["u_id"])) : ?>
          <button title="Delete" type="button" data-id="<?= $GLOBALS["template"]["u_id"] ?>" class="del-by-id inline-flex items-center justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-blue-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
          </button>
        <?php endif ?>
      </div>
    </div>

    <div class="mt-8 max-w-3xl mx-auto grid grid-cols-1 gap-4 sm:px-6 lg:max-w-7xl lg:grid-flow-col-dense lg:grid-cols-3">
      <div class="space-y-6 lg:col-start-1 lg:col-span-2">
        <!-- Detail informations -->
        <section aria-labelledby="template-information-title">
          <div class="bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6 space-y-4">
              <div>
                <label for="title" class="text-sm leading-6 font-semibold text-gray-900">
                  Page Title :
                </label>
                <input type="text" name="title" value="<?= $GLOBALS["template"]["t_title"] ?>" class="px-2 py-0.5 w-full text-md border-b border-gray-300" disabled>
              </div>

              <!-- Content -->
              <?php App\View::partial("design", "_code_editor.html") ?>
            </div>
          </div>
          </form>
        </section>
      </div>

      <section aria-labelledby="timeline-title" class="lg:col-start-3 lg:col-span-1 space-y-4">

        <div class="bg-white p-4 shadow sm:rounded-lg sm:px-6">
          <h2 class="text-lg font-medium text-gray-900">Basic Informations</h2>
          <!-- Activity Feed -->
          <div class="mt-6 flow-root">
            <ul role="list" class="mb-4 space-y-4">

              <li>
                <div class="relative flex space-x-3">
                  <div>
                    <span class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                      </svg>
                    </span>
                  </div>
                  <div>
                    <p class="text-sm text-gray-500">ID :
                      <span class="font-medium text-gray-900"><?= $GLOBALS["template"]["t_id"] ?></span>
                    </p>
                    <p class="text-sm text-gray-500">Created at :
                      <span class="font-medium text-gray-900"><time><?= App\Libs\Timex::iso_format($GLOBALS["template"]["t_inserted_at"]) ?></time></span>
                    </p>
                  </div>
                </div>
              </li>

              <li>
                <div class="relative flex space-x-3">
                  <div>
                    <span class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">
                      <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                      </svg>
                    </span>
                  </div>
                  <div>
                    <p class="text-sm text-gray-500">Name :
                      <span class="font-medium text-gray-900 capitalize"><?= $GLOBALS["template"]["u_name"] ?></span>
                    </p>
                    <p class="text-sm text-gray-500">Email :
                      <span class="font-medium text-gray-900 hover:text-indigo-600">
                        <a href="mailto:<?= $GLOBALS["template"]["u_email"] ?>" target="_blank"><?= $GLOBALS["template"]["u_email"] ?></a>
                      </span>
                    </p>
                    <p class="text-sm text-gray-500">Phone :
                      <span class="font-medium text-gray-900"><?= $GLOBALS["template"]["u_phone"] ?></span>
                    </p>
                  </div>
                </div>
              </li>

            </ul>
          </div>
        </div>
      </section>
    </div>
  </main>
</div>