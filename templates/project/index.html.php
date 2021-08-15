<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 min-h-screen">

  <!-- Statics Section -->
  <div class="p-4">
    <?php View::partial("project", "_statics"); ?>
  </div>

  <!-- For Incompleted -->
  <div class="p-4">
    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-2">
      Published
    </h3>
    <ul role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
      <?php foreach ($GLOBALS["results"] as $result) : ?>
      <li class="col-span-1 flex flex-col text-center bg-white rounded-lg shadow divide-y divide-gray-200">
        <img class="w-full h-48 flex-shrink-0 mx-auto rounded-t-lg" src="<?= r ?>priv/data/pages/<?= $result["page_uuid"] . "/page:cover_image:" . $result["attachment_name"] ?>" alt="cover-img?name<?= $result["attachment_name"] ?>">
        <div class="flex-1 flex flex-col px-8 py-4">
          <h3 class="text-gray-900 text-sm font-medium"><?= $result["page_permalink"] ?></h3>
          <dl class="mt-1 flex-grow flex flex-col justify-between">
            <dt class="sr-only">Title</dt>
            <dd class="text-gray-500 text-sm">
              <?= $result["page_meta_title"] ?>
              <?php if ($result["page_meta_description"] != null) :  ?>
                <p class="mt-1 text-gray-400"><?= $result["page_meta_description"] ?></p>
              <?php endif ?>
            </dd>
            
            <dt class="sr-only">Name</dt>
            <dd class="mt-3">
              <?php $role = $result["user_role"] ?>
              <span class="px-2 py-1 text-green-800 text-xs font-medium bg-green-100 rounded-full"><?= $result["user_name"] ?></span>
            </dd>
            <p class="text-xs text-gray-400 mt-1">
              <?= ($role == 1)?"Customer":(($role == 2)?"Staff":(($role == 3)?"Admin":(($role == 4)?"Super Admin":null))) ?>
            </p>
          </dl>
        </div>
        <p class="text-xs text-gray-400 py-1"><?= Timex::iso_format($result["page_inserted_at"], Locale::acceptFromHttp($_SERVER["HTTP_ACCEPT_LANGUAGE"])) ?></p>
      </li>
      <?php endforeach; ?>
      <!-- More people... -->
    </ul>

    <!-- For Completed -->
    <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4 mb-2">
      Unpublished
    </h3>
    <ul role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
      <li class="col-span-1 flex flex-col text-center bg-white rounded-lg shadow divide-y divide-gray-200">
        <div class="flex-1 flex flex-col p-8">
          <img class="w-32 h-32 flex-shrink-0 mx-auto rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60" alt="">
          <h3 class="mt-6 text-gray-900 text-sm font-medium">Jane Cooper</h3>
          <dl class="mt-1 flex-grow flex flex-col justify-between">
            <dt class="sr-only">Title</dt>
            <dd class="text-gray-500 text-sm">Paradigm Representative</dd>
            <dt class="sr-only">Role</dt>
            <dd class="mt-3">
              <span class="px-2 py-1 text-green-800 text-xs font-medium bg-green-100 rounded-full">Admin</span>
            </dd>
          </dl>
        </div>
        <div>
          <div class="-mt-px flex divide-x divide-gray-200">
            <div class="w-0 flex-1 flex">
              <a href="mailto:janecooper@example.com" class="relative -mr-px w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-bl-lg hover:text-gray-500">
                <!-- Heroicon name: solid/mail -->
                <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                  <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                </svg>
                <span class="ml-3">Email</span>
              </a>
            </div>
            <div class="-ml-px w-0 flex-1 flex">
              <a href="tel:+1-202-555-0170" class="relative w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-br-lg hover:text-gray-500">
                <!-- Heroicon name: solid/phone -->
                <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                </svg>
                <span class="ml-3">Call</span>
              </a>
            </div>
          </div>
        </div>
      </li>

      <!-- More people... -->
    </ul>
  </div>


</div>