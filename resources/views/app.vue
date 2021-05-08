<template>
  <div class="mb-12 py-6 bg-gray-800">
    <div class="container mx-auto flex px-8">
      <div class="my-auto text-white flex flex-grow items-center">
        <h1 class="md:block hidden mr-4 text-2xl font-bold">
          Your Balance
        </h1>

        <div class="flex flex-row">
          <a href="#" class="flex items-center mr-4 px-3 py-2 bg-blue-700 rounded-md text-white text-xs font-bold uppercase tracking-tight">
            Add Entry
          </a>
          <a href="#" class="flex items-center mr-4 px-3 py-2 bg-blue-700 rounded-md text-white text-xs font-bold uppercase tracking-tight">
            Import CSV
          </a>
        </div>
      </div>
      <div class="my-auto text-right font-bold text-xs uppercase tracking-tight leading-7 text-gray-400">
        Total Balance
        <span class="block text-3xl font-normal text-green-500">
                    $1,725.<span class="text-xl">00</span>
                </span>
      </div>
    </div>
  </div>

  <div class="container mx-auto px-8">
    <div class="mb-8">
      <div class="flex items-center mb-4">
        <span class="flex-grow text-gray-500 font-bold text-sm uppercase tracking-tight">Today</span>
        <span class="text-lg text-gray-500 font-bold">- $50.<span class="text-sm">00</span></span>
      </div>

      <div>
        <div class="flex items-center mb-4 px-4 py-2 shadow-md bg-white rounded-md">
          <div class="flex-grow">
            <div class="font-bold">
              Groceries
            </div>
            <div class="text-xs text-gray-500">
              20 May, 2020 at 10:55 PM
            </div>
          </div>
          <div class="text-lg font-bold">
            - $60.<span class="text-sm">00</span>
          </div>
        </div>
        <div class="flex items-center mb-4 px-4 py-2 shadow-md bg-white rounded-md">
          <div class="flex-grow">
            <div class="font-bold">
              Lottery Win
            </div>
            <div class="text-xs text-gray-500">
              20 May, 2020 at 09:05 AM
            </div>
          </div>
          <div class="text-lg font-bold text-green-500">
            + $10.<span class="text-sm">00</span>
          </div>
        </div>
      </div>
    </div>

    <div class="mb-8">
      <div class="flex items-center mb-4">
        <span class="flex-grow text-gray-500 font-bold text-sm uppercase tracking-tight">Yesterday</span>
        <span class="text-lg text-gray-500 font-bold">- $500.<span class="text-sm">00</span></span>
      </div>

      <div>
        <div class="flex items-center mb-4 px-4 py-2 shadow-md bg-white rounded-md">
          <div class="flex-grow">
            <div class="font-bold">
              Car Insurance
            </div>
            <div class="text-xs text-gray-500">
              19 May, 2020 at 08:00 AM
            </div>
          </div>
          <div class="text-lg font-bold">
            - $500.<span class="text-sm">00</span>
          </div>
        </div>
      </div>
    </div>

    <div class="mb-8">
      <div class="flex items-center mb-4">
        <span class="flex-grow text-gray-500 font-bold text-sm uppercase tracking-tight">Mon, 11 May</span>
        <span class="text-lg text-green-500 font-bold">+ $3,000.<span class="text-sm">00</span></span>
      </div>

      <div>
        <div class="flex items-center mb-4 px-4 py-2 shadow-md bg-white rounded-md">
          <div class="flex-grow">
            <div class="font-bold">
              Opening Balance
            </div>
            <div class="text-xs text-gray-500">
              11 May, 2020 at 10:00 AM
            </div>
          </div>
          <div class="text-lg text-green-500 font-bold">
            + $3,000.<span class="text-sm">00</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {}
</script>
