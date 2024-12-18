    @include('includes.header')
    <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
      <div
        class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800"
      >
        <div class="flex flex-col overflow-y-auto md:flex-row">
          <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
              <div class="w-full">
                <form method="POST" action="{{ route('loginuser') }}">
                    @csrf

                    @if (session('error'))
                        <div
                            class="mb-4 text-sm text-red-600 bg-green-100 border border-red-400 rounded-md p-4"
                            role="alert"
                        >
                            {{ session('error') }}
                        </div>
                    @endif
                    <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">
                      Login
                    </h1>
                    <label class="block text-sm">
                      <span class="text-gray-700 dark:text-gray-400">User ID</span>
                      <input
                        type="text" name="username" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        placeholder="Juan dela Cruz"
                      />
                    </label>
                    <label class="block mt-4 text-sm">
                      <span class="text-gray-700 dark:text-gray-400">Password</span>
                      <input
                        type="password" name="password" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        placeholder="***************"
                      />
                    </label>
                    <button
                      type="submit"
                      class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                    >
                      Log in
                    </button>
                    <hr class="my-8" />
                    <p class="mt-1">
                      <a
                        class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline"
                        href="{{ route('register') }}"
                      >
                        Create account
                      </a>
                    </p>
                </form>
              </div>
          </div>
        </div>
      </div>
    </div>
    @include('includes.footer')