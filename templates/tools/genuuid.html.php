<div class="w-full">
  <div class="w-1/3 text-center">
    <div class="p-6 border">
      <h2 class="p-1 border bg-red-400">UUID1</h2>
      <p><?= GenUuid::uuid1() ?></p>
    </div>
    <div class="p-6 border">
      <h2 class="p-1 border bg-blue-400">UUID4</h2>
      <p><?= GenUuid::uuid4() ?></p>
    </div>
    <div class="p-6 border">
      <h2 class="p-1 border bg-green-400">UUID6</h2>
      <p><?= GenUuid::uuid6() ?></p>
    </div>
  </div>
</div>