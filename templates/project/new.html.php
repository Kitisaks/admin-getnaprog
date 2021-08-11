<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 min-h-screen">
  <div class="lg:grid lg:grid-cols-12 lg:gap-x-5 py-6">
    <aside class="py-6 px-2 sm:px-6 lg:py-0 lg:px-0 lg:col-span-3">
      <nav class="space-y-1">

        <!-- active: bg-gray-50 text-indigo-700 hover:bg-white, inactive: text-gray-900 hover:bg-gray-50 -->
        <button data-id="page" type="button" class="project-menu w-full bg-gray-50 text-indigo-700 hover:bg-white group rounded-md px-3 py-2 flex items-center text-sm font-medium" aria-current="page">
          <svg xmlns="http://www.w3.org/2000/svg" class="text-indigo-500 group-hover:text-indigo-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
          </svg>
          <span class="truncate">
            Page
          </span>
        </button>

        <button data-id="customer" type="button" class="project-menu w-full text-gray-900 hover:bg-gray-50 group rounded-md px-3 py-2 flex items-center text-sm font-medium">
          <svg class="text-indigo-500 group-hover:text-indigo-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <span class="truncate">
            Account
          </span>
        </button>

        <button data-id="notification" type="button" class="project-menu w-full text-gray-900 hover:text-gray-900 hover:bg-gray-50 group rounded-md px-3 py-2 flex items-center text-sm font-medium">
          <svg xmlns="http://www.w3.org/2000/svg" class="text-indigo-500 group-hover:text-indigo-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
          </svg>
          <span class="truncate">
            Notification
          </span>
        </button>

      </nav>
    </aside>


    <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-9">
      <form action="/project/create" method="POST" id="project-create-form">
        <?php View::partial("project", array("_new_page", "_new_customer", "_new_notification")); ?>
      </form>
    </div>


  </div>

</div>