<main class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-4 min-h-screen">
  <div class="pb-10">
    <!-- Page header -->
    <div class="max-w-3xl mx-auto px-4 sm:px-6 md:flex md:items-center md:justify-between md:space-x-5 lg:max-w-7xl lg:px-8">
      <div class="flex items-center space-x-5">
        <div>
          <h1 class="text-2xl font-bold text-gray-900">
            <?= ucfirst($GLOBALS["page"]["p_permalink"]) ?>
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-sm font-medium bg-pink-100 text-pink-800">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
              </svg>
              <?= $GLOBALS["page"]["p_id"] ?>
            </span>
          </h1>
          <p class="text-sm font-medium text-gray-500">Created <time><?= App\Libs\Timex::from_now($GLOBALS["page"]["p_inserted_at"]) ?></time></p>
        </div>
      </div>
      <div class="mt-6 flex flex-col-reverse justify-stretch space-y-4 space-y-reverse sm:flex-row-reverse sm:justify-end sm:space-x-reverse sm:space-y-0 sm:space-x-3 md:mt-0 md:flex-row md:space-x-3">
        <?php if (App\Libs\Utils::permitted($GLOBALS["page"]["u_id"])) : ?>
          <button title="Delete" type="button" class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-blue-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
          </button>
        <?php endif ?>
        <button title="Save" type="button" class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-white bg-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-blue-500">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
          </svg>
        </button>
      </div>
    </div>

    <div class="mt-8 max-w-3xl mx-auto grid grid-cols-1 gap-4 sm:px-6 lg:max-w-7xl lg:grid-flow-col-dense lg:grid-cols-3">
      <div class="space-y-6 lg:col-start-1 lg:col-span-2">
        <!-- Detail informations -->
        <section aria-labelledby="applicant-information-title">
          <div class="bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6 flex justify-between">
              <div>
                <h2 class="text-sm leading-6 font-semibold text-gray-900">
                  Title :
                    <input type="text" name="page[title]" value="<?= $GLOBALS["page"]["p_title"] ?>" placeholder="please fill title" class="px-2 py-0.5 w-full text-md border-b border-gray-300">
                </h2>
                <p class="mt-2 text-sm font-semibold text-gray-900">
                  Description :
                </p>
                <div class="w-full">
                  <textarea name="page[description]" rows="4" cols="88" placeholder="please fill description" class="mt-1 rounded-sm w-full px-2 py-0.5 text-sm border border-gray-300"><?= $GLOBALS["page"]["p_description"] ?></textarea>
                </div>
              </div>
            </div>
            <!-- Content -->
            <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
              <?php App\View::partial("project", "_editor.html") ?>
            </div>
            <!-- Cover photo -->
            <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
              <div class="grid grid-cols-4 pb-5 gap-4">
                <div class="col-span-1">
                  <h1 class="text-sm leading-6 font-semibold text-gray-900">Cover photo :
                    <p class="text-sm font-normal text-gray-900"><?= $GLOBALS['page']["a_name"] ?></p>
                  </h1>
                  <button type="button" class="inline-flex mt-4 items-center px-2.5 py-1.5 border border-gray-300 shadow-sm text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Change
                  </button>
                </div>
                <div class="col-span-3 p-4 bg-gray-100">
                  <?php if ($img = App\Data\Attachment::default_image($GLOBALS["cover_image"], "520x280")) : ?>
                    <img class="rounded-sm ml-auto w-full h-full" src="<?= $img ?>" alt="<?= $GLOBALS["page"]["a_name"] ?>">
                  <?php else : ?>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 rounded-full text-gray-400 border" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                  <?php endif ?>
                </div>
              </div>
            </div>

          </div>
        </section>
      </div>

      <div class="space-y-6 lg:col-start-1 lg:col-span-2">
        <section aria-labelledby="applicant-information-title">
          <div class="bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6 flex justify-between">
              <div>
                <h2 class="text-sm leading-6 font-semibold text-gray-900">
                  Meta title :
                    <input type="text" name="page[meta_title]" value="<?= $GLOBALS["page"]["p_meta_title"] ?>" placeholder="Shopping online" class="px-2 py-0.5 w-full text-md border-b border-gray-300">
                </h2>
                <h2 class="mt-2 text-sm leading-6 font-semibold text-gray-900">
                  Meta keywords :
                    <div id="tags" class="space-x-1">
                      <input type="text" placeholder="tags, tags, tags..." value="<?= $GLOBALS["page"]["p_meta_keyword"] ?>" class="px-2 py-0.5 text-md border-b border-gray-300">
                      <input type="hidden" name="page[meta_keyword]">
                    </div>
                </h2>
                <p class="mt-2 text-sm font-semibold text-gray-900">
                  Meta description :
                </p>
                <div class="w-full">
                  <?php if ($GLOBALS["page"]["p_description"] != "") : ?>
                    <?= $GLOBALS["page"]["p_description"] ?>
                  <?php else : ?>
                    <textarea name="page[description]" rows="4" cols="88" placeholder="At lease 80 words" class="mt-1 rounded-sm w-full px-2 py-0.5 text-sm border border-gray-300"></textarea>
                  <?php endif ?>
                </div>
              </div>
            </div>
          </div>
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
                      <span class="font-medium text-gray-900"><?= $GLOBALS["page"]["p_id"] ?></span>
                    </p>
                    <p class="text-sm text-gray-500">URL :
                      <span class="font-medium text-gray-900 hover:text-indigo-600">
                        <a href="mailto:<?= $GLOBALS["page"]["u_email"] ?>"><?= $GLOBALS["page"]["u_email"] ?></a>
                      </span>
                    </p>
                    <p class="text-sm text-gray-500">Created at :
                      <span class="font-medium text-gray-900"><time><?= App\Libs\Timex::iso_format($GLOBALS["page"]["p_inserted_at"]) ?></time></span>
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
                      <span class="font-medium text-gray-900 capitalize"><?= $GLOBALS["page"]["u_name"] ?></span>
                    </p>
                    <p class="text-sm text-gray-500">Email :
                      <span class="font-medium text-gray-900 hover:text-indigo-600">
                        <a href="mailto:<?= $GLOBALS["page"]["u_email"] ?>"><?= $GLOBALS["page"]["u_email"] ?></a>
                      </span>
                    </p>
                    <p class="text-sm text-gray-500">Phone :
                      <span class="font-medium text-gray-900"><?= $GLOBALS["page"]["u_phone"] ?></span>
                    </p>
                  </div>
                </div>
              </li>

            </ul>
          </div>
        </div>

        <div class="bg-white px-4 py-5 shadow sm:rounded-lg sm:px-6">
          <h2 class="text-lg font-medium text-gray-900">Activities</h2>
          <!-- Activity Feed -->
          <div class="mt-6 flow-root">
            <ul role="list" class="mb-4">
              <li>
                <div class="relative pb-8">
                  <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                  <div class="relative flex space-x-3">
                    <div>
                      <span class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M7 2a2 2 0 00-2 2v12a2 2 0 002 2h6a2 2 0 002-2V4a2 2 0 00-2-2H7zm3 14a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                        </svg>
                      </span>
                    </div>
                    <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                      <div>
                        <p class="text-sm text-gray-500">iphone XS
                          <a href="#" class="font-medium text-gray-900">https://www.google.co.th</a>
                        </p>
                      </div>
                      <div class="text-right text-sm whitespace-nowrap text-gray-500">
                        <time datetime="2020-09-20">13 days ago</time>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </section>
    </div>
  </div>
</main>