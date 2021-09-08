<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-4 min-h-screen">

  <!-- For Unpublished -->

    <h3 class="text-lg leading-6 font-medium py-4 inline-flex items-center">
      <kbd><b>Templates</b></kbd>
    </h3>
    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Template
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Permalink
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Author
            </th>
            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
              Action
            </th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <?php if (!empty($GLOBALS["templates"])) : ?>
            <?php foreach ($GLOBALS["templates"] as $result) : ?>
              <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                  <a href="/design/<?= $result["title"] ?>">
                    <div class="ml-4">
                      <div class="text-sm font-medium text-indigo-800 hover:text-indigo-900">
                        <?= $result["title"] ?>
                      </div>
                      <p class="text-xs text-gray-500 mt-1"><?= Timex::iso_format($result["inserted_at"]) ?></p> 
                    </div>
                  </a>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900"><?= $result["permalink"] ?></div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">name</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                  copy remove 
                </td>
              </tr>
            <?php endforeach ?>
          <?php endif ?>
        </tbody>
      </table>
    </div>

</div>