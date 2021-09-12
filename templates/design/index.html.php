<main class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-4 min-h-screen">

  <!-- For Unpublished -->
    <div class="flex justify-between items-center">
      <h3 class="text-lg leading-6 font-medium py-4 inline-flex items-center">
        <kbd><b>Templates</b></kbd>
        <button type="button" title="Add" class="ml-2 inline-flex items-center p-1 border border-transparent rounded-full shadow-sm text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
          <!-- Heroicon name: solid/plus-sm -->
          <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
          </svg>
        </button>
      </h3>
      <div class="relative inline-block text-left">
        <div>
          <form method="GET" autocomplete="off">
            <input id="search-agency" name="q" type="text" value="<?= !empty($GLOBALS["page"]) ? $GLOBALS["page"]["title"] : null ?>" class="appearance-none rounded-none block w-full px-3 py-1.5 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Select page">
          </form>
        </div>

        <div class="hidden search-agency origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
          <div class="py-1" role="none">
            <?php foreach ($GLOBALS["pages"] as $page) : ?>
              <a href="?q=<?= $page["id"] ?>" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0"><?= $page["title"] ?></a>
            <?php endforeach ?>
          </div>
        </div>
      </div>
    </div>

    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Template
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Page
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Creator
            </th>
            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
              Action
            </th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        <?php if (isset($GLOBALS["templates"]) && !empty($GLOBALS["templates"])) : ?>
          <?php foreach ($GLOBALS["templates"] as $result) : ?>
            <tr>
              <td class="px-3 py-4 whitespace-nowrap">
                <a href="/design/<?= $result["t_id"] ?>">
                  <div class="ml-4">
                    <p class="text-sm font-medium text-indigo-800 hover:text-indigo-900">
                      <?= $result["t_title"] ?>
                    </p>
                    <p class="text-xs text-gray-500 mt-1"><?= App\Libs\Timex::iso_format($result["t_inserted_at"]) ?></p> 
                  </div>
                </a>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900"><?= $result["p_title"] ?></div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap space-y-1">
                <p class="text-sm text-gray-900"><?= ucfirst($result["u_name"]) ?></p>
                <p class="text-xs text-gray-500 hover:text-indigo-900">
                  <a href="mailto:<?= $result["u_email"] ?>" target="_blank">
                    <?= $result["u_email"] ?>
                  </a>
                </p>
                <p class="text-xs text-gray-500"><?= $result["u_phone"] ?></p>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                copy remove 
              </td>
            </tr>
          <?php endforeach ?>
        <?php else : ?>
          <tr>
            <td class="px-6 py-4 whitespace-nowrap bg-gray-100">
              <p class="text-sm font-medium text-gray-800">No content</p>
            </td>
          </tr>
        <?php endif ?>
        </tbody>
      </table>
    </div>
    <?php App\View::partial("layout", "_pagination.html") ?>
</main>