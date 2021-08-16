<?php $count = ["pub" => count($GLOBALS["published"]), "unpub" => count($GLOBALS["unpublished"])] ?>
<h3 class="text-lg leading-6 mb-1">
  <span class="inline-flex items-center rounded-mdbg-pink-100">
    Last 30 Days
  </span>
</h3>
<dl class="grid grid-cols-1 gap-5 sm:grid-cols-3">
  <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
    <dt class="text-sm font-medium text-gray-500 truncate">
      Unpublished
    </dt>
    <dd class="mt-1 text-3xl font-semibold text-gray-900">
      <?= MathPercentage::find($count["unpub"], $count["pub"] + $count["unpub"]) ?>%
    </dd>
  </div>

  <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
    <dt class="text-sm font-medium text-gray-500 truncate">
      Published
    </dt>
    <dd class="mt-1 text-3xl font-semibold text-gray-900">
      <?= MathPercentage::find($count["pub"], $count["pub"] + $count["unpub"]) ?>%
    </dd>
  </div>

  <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
    <dt class="text-sm font-medium text-gray-500 truncate">
      All Projects
    </dt>
    <dd class="mt-1 text-3xl font-semibold text-gray-900">
      <?= $count["pub"] + $count["unpub"] ?>
    </dd>
  </div>
</dl>