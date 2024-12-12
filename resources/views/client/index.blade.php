@include('includes.header')
<div
  class="flex h-screen bg-gray-50 dark:bg-gray-900"
  :class="{ 'overflow-hidden': isSideMenuOpen }"
>
  <!-- Mobile sidebar -->
  <div
    x-show="isSideMenuOpen"
    x-transition:enter="transition ease-in-out duration-150"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in-out duration-150"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"
  ></div>

  <div class="flex flex-col flex-1 w-full">
    <!-- navbar -->
    @include('includes.navbar')

    <main class="h-full overflow-y-auto">
      <div class="container px-6 mx-auto grid">
        @if (session('success'))
        <div
          class="mb-4 text-sm text-green-600 bg-green-100 border border-green-400 rounded-md p-4"
          role="alert"
        >
          {{ session('success') }}
        </div>
        @endif
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
          IT Service Request Form
        </h2>

        <form method="POST" action="{{ route('addrequest') }}" class="bg-white p-6 rounded-lg shadow-md dark:bg-gray-800">
          @csrf
          <!-- Requesting To -->
          <fieldset class="mb-4">
            <legend class="block text-sm font-medium text-gray-700 dark:text-gray-300">
              Requesting to:
            </legend>
            <div class="grid grid-cols-2 gap-4 mt-2">
              <div>
                <label class="flex items-center space-x-2">
                  <input
                    type="checkbox" name="checkInternet"
                    class="text-purple-600 border-gray-300 rounded focus:ring-purple-500" value="Check Internet Connection"
                  />
                  <span class="text-gray-700 dark:text-gray-300">Check Internet Connection</span>
                </label>
                <label class="flex items-center space-x-2 mt-2">
                  <input
                    type="checkbox" name="checkComputer"
                    class="text-purple-600 border-gray-300 rounded focus:ring-purple-500" value="Check Computer"
                  />
                  <span class="text-gray-700 dark:text-gray-300">Check Computer</span>
                </label>
                <label class="flex items-center space-x-2 mt-2">
                  <input
                    type="checkbox" name="checkMonitor"
                    class="text-purple-600 border-gray-300 rounded focus:ring-purple-500" value="Check Monitor"
                  />
                  <span class="text-gray-700 dark:text-gray-300">Check Monitor</span>
                </label>
                <label class="flex items-center space-x-2 mt-2">
                  <input
                    type="checkbox" name="checkKeyboard"
                    class="text-purple-600 border-gray-300 rounded focus:ring-purple-500" value="Check Keyboard/Mouse"
                  />
                  <span class="text-gray-700 dark:text-gray-300">Check Keyboard/Mouse</span>
                </label>
              </div>
              <div>
                <label class="flex items-center space-x-2">
                  <input
                    type="checkbox" name="installPrinter"
                    class="text-purple-600 border-gray-300 rounded focus:ring-purple-500" value="Install Printer"
                  />
                  <span class="text-gray-700 dark:text-gray-300">Install Printer</span>
                </label>
                <label class="flex items-center space-x-2 mt-2">
                  <input
                    type="checkbox" name="installSoftware"
                    class="text-purple-600 border-gray-300 rounded focus:ring-purple-500" value="Install Software"
                  />
                  <span class="text-gray-700 dark:text-gray-300">Install Software</span>
                </label>
                    <label class="flex items-center space-x-2 mt-2">
                      <input
                        type="checkbox" name="othersSpecify"
                        class="text-purple-600 border-gray-300 rounded focus:ring-purple-500"
                        id="specifyCheckbox"
                        value="Others: Please Specify"
                      />
                      <span class="text-gray-700 dark:text-gray-300">Others: Please Specify</span>
                    </label>
                    <input
                      type="text" name="detailsOfSpecify"
                      id="specifyInput"
                      class="hidden mt-2 w-full p-2 border border-gray-300 rounded focus:ring focus:ring-purple-500"
                      placeholder="Please specify here"
                    />
              </div>
            </div>
          </fieldset>

          <!-- Submit Button -->
          <div>
            <button
              type="submit"
              class="w-full px-4 py-2 text-white bg-blue-600 rounded-lg shadow-md hover:bg-green-700 focus:outline-none focus:ring focus:ring-green-300"
            >
              Submit
            </button>
          </div>
        </form>
      </div>
    </main>
  </div>
</div>
@include('includes.footer')


<script>

document.addEventListener('DOMContentLoaded', () => {
  const checkbox = document.getElementById('specifyCheckbox');
  const input = document.getElementById('specifyInput');

  checkbox.addEventListener('change', () => {
    if (checkbox.checked) {
      input.classList.remove('hidden'); // Show the input field
    } else {
      input.classList.add('hidden'); // Hide the input field
    }
  });
});

</script>