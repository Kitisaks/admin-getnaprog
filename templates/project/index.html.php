<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-4 min-h-screen">

  <!-- Statics Analytics Section -->
  <div class="p-4">
    <?php View::partial("project", "_statics.html") ?>
  </div>

  <!-- For Unpublished -->
  <div class="p-4">
    <h3 class="text-lg leading-6 font-medium py-4 inline-flex items-center">
      Unpublished
      <svg class="ml-2 h-4 w-4 text-gray-400" fill="currentColor" viewBox="0 0 8 8">
        <circle cx="4" cy="4" r="3" />
      </svg>
    </h3>
    <ul role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
      <?php if ($GLOBALS["unpublished"] != null) : ?>
        <?php foreach ($GLOBALS["unpublished"] as $result) : ?>
          <a href="/project/<?= $result["page_uuid"] ?>">
            <li class="col-span-1 flex flex-col text-center border-2 bg-white rounded-lg shadow-md divide-y divide-gray-200 hover:border-indigo-500 cursor-pointer">
              <img class="w-full h-40 flex-shrink-0 mx-auto rounded-t-lg" src="<?= Utils::default_image($result, $result["page_id"], "280x160") ?>" alt="<?= $result["attachment_name"] ?>">
              <div class="flex-1 flex flex-col px-8 py-4">
                <h3 class="text-gray-900 text-md font-bold"><?= $result["page_permalink"] ?></h3>
                <dl class="mt-1 flex-grow flex flex-col justify-between">
                  <dt class="sr-only">Title</dt>
                  <dd class="text-gray-500 text-sm truncate">
                    <?= $result["page_meta_title"] ?>
                    <?php if ($result["page_meta_description"] != null) : ?>
                      <p class="mt-1 text-xs text-gray-400 truncate"><?= $result["page_meta_description"] ?></p>
                    <?php endif ?>
                  </dd>
                  <dt class="sr-only">Name</dt>
                  <dd class="mt-1">
                    <?php $role = $result["user_role"] ?>
                    <span class="text-sm font-medium"><?= $result["user_name"] ?></span>
                  </dd>
                  <dt class="sr-only">Role</dt>
                  <dd class="mt-1">
                    <span class="text-xs px-2 py-1 rounded-full <?= ($role == 1) ? "text-green-800 bg-green-100" : (($role == 2) ? "text-yellow-800 bg-yellow-100" : (($role == 3) ? "text-blue-800 bg-blue-100" : (($role == 4) ? "text-red-800 bg-red-100" : null))) ?>">
                      <?= ($role == 1) ? "Customer" : (($role == 2) ? "Staff" : (($role == 3) ? "Admin" : (($role == 4) ? "Super Admin" : null))) ?>
                    </span>
                  </dd>
                </dl>
              </div>
              <p class="text-xs text-gray-400 py-2"><?= Timex::iso_format($result["page_inserted_at"], Locale::acceptFromHttp($_SERVER["HTTP_ACCEPT_LANGUAGE"])) ?></p>
            </li>
          </a>
        <?php endforeach ?>
      <?php else : ?>
        <p class="px-4 text-gray-600 text-sm">No content for now.</p>
      <?php endif ?>
    </ul>

    <!-- For Published -->
    <h3 class="text-lg leading-6 font-medium py-4 inline-flex items-center mt-6">
      Published
      <svg class="ml-2 h-4 w-4 text-green-400" fill="currentColor" viewBox="0 0 8 8">
        <circle cx="4" cy="4" r="3" />
      </svg>
    </h3>
    <ul role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
      <?php if ($GLOBALS["published"] != null) : ?>
        <?php foreach ($GLOBALS["published"] as $result) : ?>
          <li class="col-span-1 flex flex-col text-center border-2 bg-white rounded-lg shadow-md divide-y divide-gray-200 hover:border-indigo-500 cursor-pointer">
            <img class="w-full h-40 flex-shrink-0 mx-auto rounded-t-lg" src="<?= Utils::default_image($result, $result["page_id"], "280x160") ?>" alt="<?= $result["attachment_name"] ?>">
            <div class="flex-1 flex flex-col px-8 py-4">
              <h3 class="text-gray-900 text-md font-bold"><?= $result["page_permalink"] ?></h3>
              <dl class="mt-1 flex-grow flex flex-col justify-between">
                <dt class="sr-only">Title</dt>
                <dd class="text-gray-500 text-sm truncate">
                  <?= $result["page_meta_title"] ?>
                  <?php if ($result["page_meta_description"] != null) :  ?>
                    <p class="mt-1 text-xs text-gray-400 truncate"><?= $result["page_meta_description"] ?></p>
                  <?php endif ?>
                </dd>
                <dt class="sr-only">Name</dt>
                <dd class="mt-1">
                  <?php $role = $result["user_role"] ?>
                  <span class="text-sm font-medium"><?= $result["user_name"] ?></span>
                </dd>
                <dt class="sr-only">Role</dt>
                <dd class="mt-1">
                  <span class="text-xs px-2 py-1 rounded-full <?= ($role == 1) ? "text-green-800 bg-green-100" : (($role == 2) ? "text-yellow-800 bg-yellow-100" : (($role == 3) ? "text-blue-800 bg-blue-100" : (($role == 4) ? "text-red-800 bg-red-100" : null))) ?>">
                    <?= ($role == 1) ? "Customer" : (($role == 2) ? "Staff" : (($role == 3) ? "Admin" : (($role == 4) ? "Super Admin" : null))) ?>
                  </span>
                </dd>
              </dl>
            </div>
            <p class="text-xs text-gray-400 py-2"><?= Timex::iso_format($result["page_inserted_at"]) ?></p>
          </li>
        <?php endforeach ?>
      <?php else : ?>
        <p class="px-4 text-gray-600 text-sm">No content for now.</p>
      <?php endif ?>
    </ul>




    <div class="flex flex-col">
      <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
          <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

            <?php if ($GLOBALS["unpublished"] != null) : ?>
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Page
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Detail
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Contact
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Status
                  </th>
                  <th scope="col" class="relative px-6 py-3">
                    <span class="sr-only">Action</span>
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                  <?php foreach ($GLOBALS["unpublished"] as $result) : ?>
                  <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <a href="/project/<?= $result["page_uuid"] ?>">
                        <div class="flex items-center">
                          <div class="flex-shrink-0 h-10 w-10">
                            <img class="h-10 w-10 rounded-full" src="<?= Utils::default_image($result, $result["page_id"], "280x160") ?>" alt="<?= $result["attachment_title"] . "_" . $result["attachment_name"] ?>">
                          </div>
                          <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900">
                              <?= $result["page_meta_title"] ?>
                            </div>
                            <div class="text-sm text-gray-500">
                              <?php if ($result["page_meta_description"] != null) :  ?>
                                <?= $result["page_meta_description"] ?>
                              <?php endif ?>
                            </div>
                          </div>
                        </div>
                      </a>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm text-gray-900">/<?= $result["page_permalink"] ?></div>
                      <div class="text-sm text-gray-500"><?= Timex::iso_format($result["page_inserted_at"]) ?></div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                        Active
                      </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                      Admin
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                      <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                    </td>
                  </tr>
                  </a>
                  <?php endforeach ?>
                <?php else : ?>
                  <p class="px-4 text-gray-600 text-sm">No content for now.</p>
              </tbody>
            </table>
            <?php endif ?>

            <?php if ($GLOBALS["published"] != null) : ?>
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Name
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Title
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Status
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Role
                  </th>
                  <th scope="col" class="relative px-6 py-3">
                    <span class="sr-only">Edit</span>
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <?php foreach ($GLOBALS["published"] as $result) : ?>
                  <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10">
                          <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60" alt="">
                        </div>
                        <div class="ml-4">
                          <div class="text-sm font-medium text-gray-900">
                            Jane Cooper
                          </div>
                          <div class="text-sm text-gray-500">
                            jane.cooper@example.com
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm text-gray-900">Regional Paradigm Technician</div>
                      <div class="text-sm text-gray-500">Optimization</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                        Active
                      </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                      Admin
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                      <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                    </td>
                  </tr>
                  <?php endforeach ?>
                <?php else : ?>
                  <p class="px-4 text-gray-600 text-sm">No content for now.</p>
              </tbody>
            </table>
            <?php endif ?>


          </div>
        </div>
      </div>
    </div>

  </div>
</div>