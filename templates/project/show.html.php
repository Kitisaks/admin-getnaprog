<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-4 min-h-screen">
  <!-- This example requires Tailwind CSS v2.0+ -->
  <nav class="flex" aria-label="Breadcrumb">
    <ol role="list" class="flex items-center space-x-4">
      <li>
        <div>
          <a href="/" class="text-gray-400 hover:text-gray-500">
            <!-- Heroicon name: solid/home -->
            <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
            </svg>
            <span class="sr-only">Home</span>
          </a>
        </div>
      </li>

      <li>
        <div class="flex items-center">
          <!-- Heroicon name: solid/chevron-right -->
          <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
          </svg>
          <a href="/project" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Projects</a>
        </div>
      </li>

      <li>
        <div class="flex items-center">
          <!-- Heroicon name: solid/chevron-right -->
          <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
          </svg>
          <a href="#" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700" aria-current="page"><?= ucfirst($GLOBALS["page"]["page_permalink"]) ?></a>
        </div>
      </li>
    </ol>
  </nav>
  <main class="py-10">
    <!-- Page header -->
    <div class="max-w-3xl mx-auto px-4 sm:px-6 md:flex md:items-center md:justify-between md:space-x-5 lg:max-w-7xl lg:px-8">
      <div class="flex items-center space-x-5">
        <div>
          <h1 class="text-2xl font-bold text-gray-900">
            <?= ucfirst($GLOBALS["page"]["page_permalink"]) ?>
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-sm font-medium bg-pink-100 text-pink-800">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
              </svg>
              <?= $GLOBALS["page"]["page_id"] ?>
            </span>
          </h1>
          <p class="text-sm font-medium text-gray-500">Created at <time><?= Timex::iso_format($GLOBALS["page"]["page_inserted_at"], Locale::acceptFromHttp($_SERVER["HTTP_ACCEPT_LANGUAGE"])) ?></time></p>
        </div>
      </div>
      <div class="mt-6 flex flex-col-reverse justify-stretch space-y-4 space-y-reverse sm:flex-row-reverse sm:justify-end sm:space-x-reverse sm:space-y-0 sm:space-x-3 md:mt-0 md:flex-row md:space-x-3">
        <?php if (Utils::permitted($GLOBALS["page"]["user_id"])) : ?>
          <button type="button" class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-blue-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
          </button>
        <?php endif ?>
        <button type="button" class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-white bg-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-blue-500">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
          </svg>
        </button>
      </div>
    </div>

    <div class="mt-8 max-w-3xl mx-auto grid grid-cols-1 gap-4 sm:px-6 lg:max-w-7xl lg:grid-flow-col-dense lg:grid-cols-3">
      <div class="space-y-6 lg:col-start-1 lg:col-span-2">
        <!-- Description list-->
        <section aria-labelledby="applicant-information-title">
          <div class="bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6 flex justify-between">
              <div>
                <h2 id="applicant-information-title" class="text-sm leading-6 font-semibold text-gray-900">
                  Title :
                  <?php if ($GLOBALS["page"]["page_title"] != "") : ?> 
                    <?= $GLOBALS["page"]["page_title"] ?>
                  <?php else : ?>
                    <input type="text" name="page[title]" placeholder="please fill title" class="px-2 py-0.5 text-sm border-b border-gray-300">
                  <?php endif ?>
                </h2>
                <p class="mt-2 max-w-2xl text-sm font-semibold text-gray-900">
                  Description : 
                </p>
                <div class="w-full">
                  <?php if ($GLOBALS["page"]["page_description"] != "") : ?> 
                    <?= $GLOBALS["page"]["page_description"] ?>
                  <?php else : ?>
                    <textarea name="page[description]" rows="4" cols="88" placeholder="please fill description" class="mt-1 rounded-sm w-full px-2 py-0.5 text-sm border border-gray-300"></textarea>
                  <?php endif ?>
                </div>
              </div>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
              <div class="grid grid-cols-4 pb-5">
                <div class="col-span-1">
                  <h1 class="text-sm leading-6 font-semibold text-gray-900">Cover photo : 
                    <p class="text-sm font-normal text-gray-900"><?= $GLOBALS['page']["attachment_name"] ?></p>
                  </h1>
                  <button type="button" class="inline-flex mt-4 items-center px-2.5 py-1.5 border border-gray-300 shadow-sm text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Change
                  </button>
                </div>
                <div class="col-span-3">
                  <?php $img = "{$GLOBALS['page']['attachment_kind']}:{$GLOBALS['page']['attachment_title']}:{$GLOBALS['page']['page_id']}:{$GLOBALS['page']['attachment_name']}" ?>
                  <img class="rounded-sm ml-auto" src="<?= Utils::default_image($img, "480x280") ?>" alt="<?= $GLOBALS['page']["attachment_name"] ?>">
                </div>
              </div>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
              <?php View::partial("project", "_editor") ?>
              <div class="text-right">
                <button type="button" id="toggle-code-editor" class="inline-flex mt-4 items-center px-4 py-1 border border-transparent text-xs font-medium rounded text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                  </svg>
                </button>
              </div>
            </div>
          </div>
        </section>
      </div>

      <section aria-labelledby="timeline-title" class="lg:col-start-3 lg:col-span-1 space-y-4">

        <div class="bg-white p-4 shadow sm:rounded-lg sm:px-6">
          <h2 id="timeline-title" class="text-lg font-medium text-gray-900">User Informations</h2>

          <!-- Activity Feed -->
          <div class="mt-6 flow-root">
            <ul role="list" class="mb-4">

              <li>
                <div class="relative flex space-x-3">
                  <div>
                    <span class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">
                      <!-- Heroicon name: solid/user -->
                      <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                      </svg>
                    </span>
                  </div>
                  <div>
                    <p class="text-sm text-gray-500">Name :
                      <span class="font-medium text-gray-900"><?= $GLOBALS["page"]["user_name"] ?></span>
                    </p>
                    <p class="text-sm text-gray-500">Email :
                      <span class="font-medium text-gray-900"><?= $GLOBALS["page"]["user_email"] ?></span>
                    </p>
                    <p class="text-sm text-gray-500">Phone :
                      <span class="font-medium text-gray-900"><?= $GLOBALS["page"]["user_phone"] ?></span>
                    </p>
                  </div>
                </div>
                <div class="text-right mt-4">
                  <a href="mailto:<?= $GLOBALS["page"]["user_email"] ?>" target="_blank" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-blue-500">
                    Email
                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                      <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                      <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                    </svg>
                  </a>
                </div>
              </li>

            </ul>
          </div>
        </div>

        <div class="bg-white px-4 py-5 shadow sm:rounded-lg sm:px-6">
          <h2 id="timeline-title" class="text-lg font-medium text-gray-900">Activities</h2>

          <!-- Activity Feed -->
          <div class="mt-6 flow-root">
            <ul role="list" class="mb-4">

              <li>
                <div class="relative pb-8">
                  <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                  <div class="relative flex space-x-3">
                    <div>
                      <span class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">
                        <!-- Heroicon name: solid/user -->
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
  </main>

</div>