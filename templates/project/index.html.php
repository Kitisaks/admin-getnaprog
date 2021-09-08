<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-4 min-h-screen">

  <!-- For Unpublished -->

    <h3 class="text-lg leading-6 font-medium py-4 inline-flex items-center">
      <kbd><b>Pages</b></kbd>
    </h3>
    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
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
            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
              View
            </th>
            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
              Action
            </th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <?php if (!empty($GLOBALS["pages"])) : ?>
            <?php foreach ($GLOBALS["pages"] as $result) : ?>
              <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                  
                    <div class="flex items-start">
                      <div class="flex-shrink-0 h-10 w-10">
                        <a href="/project/<?= $result["page_uuid"] ?>">
                          <?php if (isset($GLOBALS["attachments"]) && $img = AttachmentData::default_images($GLOBALS["attachments"], $result["page_id"], "280x160")) : ?>
                            <img class="h-10 w-10 rounded-full" src="<?= $img ?>" alst="<?= $result["attachment_title"] . "_" . $result["attachment_name"] ?>">
                          <?php else : ?>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 rounded-full text-gray-400 border" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                          <?php endif ?>
                        </a>
                      </div>
                      <div class="ml-4">
                        <a href="/project/<?= $result["page_uuid"] ?>">
                          <div class="text-sm font-medium text-indigo-800 hover:text-indigo-900">
                            <?= $result["page_meta_title"] ?>
                          </div>
                          <p class="mt-1 text-xs text-gray-500 truncate">
                            <?php if ($result["page_meta_description"] != null) :  ?>
                              <?= $result["page_meta_description"] ?>
                            <?php endif ?>
                          </p>
                        </a>
                      </div>
                      <div class="ml-2 pt-1 text-gray-400 hover:text-indigo-600">
                        <a href="#" target="_blank">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                          </svg>
                        </a>
                      </div>
                    </div>
                
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">/<?= $result["page_permalink"] ?></div>
                  <div class="text-xs text-gray-500"><?= Timex::iso_format($result["page_inserted_at"]) ?></div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <?php $role = $result["user_role"] ?>
                  <div class="text-sm text-gray-900"><?= $result["user_name"] ?></div>
                  <div class="text-xs text-gray-500">
                    <?= ($role == 1) ? "Customer" : (($role == 2) ? "Staff" : (($role == 3) ? "Admin" : (($role == 4) ? "Super Admin" : null))) ?>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  <!-- View -->
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                  <button type="button" title="<?= ($result["page_status"] === 2) ? "Unpublish" : "Publish" ?>" class="<?= ($result["page_status"] === 2) ? "text-indigo-600 hover:text-indigo-900" : "text-gray-600 hover:text-gray-900" ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                      <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" />
                    </svg>
                  </button>
                </td>
              </tr>
            <?php endforeach ?>
          <?php endif ?>
        </tbody>
      </table>
    </div>

</div>