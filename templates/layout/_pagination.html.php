
<?php if (isset($GLOBALS["num_next_page"]) && $GLOBALS["num_current_page"] && $GLOBALS["total_of_page"] && ($GLOBALS["num_next_page"] - $GLOBALS["num_current_page"]) < $GLOBALS["total_of_page"]) : ?>
<nav class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6" aria-label="Pagination">
  <div class="hidden sm:block">
    <p class="text-sm text-gray-700">
      Showing
      <span class="font-medium"><?= $GLOBALS["num_current_page"] ?></span>
      to
      <span class="font-medium"><?= $GLOBALS["num_next_page"] ?></span>
      of
      <span class="font-medium"><?= $GLOBALS["total_of_page"] ?></span>
      results
    </p>
  </div>
  <div class="flex-1 flex justify-between sm:justify-end">
    <?php if ($GLOBALS["num_current_page"] !== 0) : ?>
      <a href="?p=<?= $GLOBALS["current_page"] - 1 ?>" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
        Previous
      </a>
    <?php endif ?>
    <?php if (($GLOBALS["total_of_page"] - $GLOBALS["num_current_page"]) > ($GLOBALS["num_next_page"] -  $GLOBALS["num_current_page"])) : ?>
    <a href="?p=<?= $GLOBALS["current_page"] + 1 ?>" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
      Next
    </a>
    <?php endif ?>
  </div>
</nav>
<?php endif ?>
