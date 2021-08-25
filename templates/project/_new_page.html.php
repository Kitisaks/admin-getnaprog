<div id="page" class="shadow show sm:rounded-md sm:overflow-hidden">
  <input type="hidden" name="page[uuid]" value="<?= GenUuid::uuid6() ?>">
  <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
    <div>
      <h3 class="text-lg leading-6 font-medium text-gray-900">Page Information</h3>
      <p class="mt-1 text-sm text-gray-500">This information will be displayed publicly in new page.</p>
    </div>

    <div class="grid grid-cols-3 gap-6">
      <div class="col-span-3 sm:col-span-2">
        <label for="page[permalink]" class="block text-sm font-medium text-gray-700">
          Name
        </label>
        <div class="mt-1 rounded-md shadow-sm flex">
          <span class="bg-gray-50 border border-r-0 border-gray-300 rounded-l-md px-3 inline-flex items-center text-gray-500 sm:text-sm">
            <?= $_SESSION["conn"]["agency"]["cname"] ?>/
          </span>
          <input type="text" name="page[permalink]" id="page[permalink]" autocomplete="name" class="p-2 border focus:ring-indigo-500 focus:border-indigo-500 flex-grow block w-full min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300" placeholder="mypage" required>
        </div>
      </div>

      <div class="col-span-3 sm:col-span-2">
        <label for="page[meta_title]" class="block text-sm font-medium text-gray-700">Meta Title</label>
        <input type="text" name="page[meta_title]" id="page[meta_title]" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="At least 8 words" required>
      </div>

      <div class="col-span-3 sm:col-span-2">
        <label for="page[meta_keyword]" class="block text-sm font-medium text-gray-700">Meta Keywords</label>
        <input type="text" name="page[meta_keyword]" id="page[meta_keyword]" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="shoes, shirt, t-shirt, ...">
      </div>

      <div class="col-span-3">
        <label for="page[meta_description]" class="block text-sm font-medium text-gray-700">
          Meta Description
        </label>
        <div class="mt-1">
          <textarea id="page[meta_description]" name="page[meta_description]" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md p-2" placeholder="Brief something about your page. Recommend at least 80 words"></textarea>
        </div>
      </div>

      <div class="col-span-3">
        <label class="block text-sm font-medium text-gray-700">
          Favicon
        </label>
        <div class="mt-1 flex items-center">
          <span id="favicon-preview" class="inline-block bg-gray-100 rounded-full overflow-hidden h-12 w-12">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-full w-full text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
            </svg>
          </span>
          <button type="button" class="ml-5 bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            <label for="favicon-upload">Change</label>
          </button>
          <p class="text-sm ml-2" id="favicon-preview">maximum size is 1 MB</p>
          <input type="file" accept="image/*" multiple="false" id="favicon-upload" data-id="favicon-preview" name="attachment[favicon]" max-size="<?= 1*pow(10, 6) ?>" class="sr-only">
        </div>
      </div>

      <div class="col-span-3">
        <label class="block text-sm font-medium text-gray-700">
          Cover photo
        </label>
        <div id="cover-image-preview" class="mt-1 border-2 border-gray-300 border-dashed rounded-md px-6 pt-5 pb-6 flex justify-center">
          <div class="space-y-1 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
              <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <div class="flex text-sm text-gray-600">
              <label for="cover-image-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">Upload a file</label>
              <p class="pl-1">or drag and drop</p>
            </div>
            <p class="text-xs text-gray-500">
              PNG, JPG, GIF up to 10MB
            </p>
          </div>
        </div>
        <input type="file" accept="image/*" multiple="false" id="cover-image-upload" data-id="cover-image-preview" name="attachment[cover_image]" max-size="<?= 10*pow(10, 6) ?>" class="sr-only">
        <p class="p-2 text-center" id="cover-image-preview"></p>
      </div>
    </div>
  </div>
  <!-- <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
    <button type="submit" class="side-next bg-indigo-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
      Next
    </button>
  </div> -->
</div>