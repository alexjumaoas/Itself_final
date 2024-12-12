
@include('includes.header')
  <div
    class="flex h-screen bg-gray-50 dark:bg-gray-900"
    x-data="{ 
      TechnicianModal: false, 
      isSideMenuOpen: false, 
      EmployeeModal: false, 
      EmployeInfo: { name: '', designation: '', department: '', employeeId: ''  } 
    }"
    :class="{ 'overflow-hidden': isSideMenuOpen }"
  >
      <!-- Desktop sidebar -->

      @include('includes.sidebar')

      <!-- Mobile sidebar -->
      <!-- Backdrop -->
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
              @if (session('success'))
                  <div
                      class="mb-4 text-sm text-green-600 bg-green-100 border border-green-400 rounded-md p-4"
                      role="alert"
                  >
                      {{ session('success') }}
                  </div>
              @endif
              
                  <!-- Your table and modal go here -->

                  <div class="flex justify-between items-center p-4">
                    <form method="GET" action="{{ route('employees.search') }}" class="w-full max-w-md">
                        <div class="relative">
                            <input
                                type="text"
                                name="search"
                                value="{{ request()->get('search') }}"
                                placeholder="Search employee by name or designation"
                                class="w-full px-4 py-2 text-sm border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                            />
                            <button
                                type="submit"
                                class="absolute top-0 right-0 px-4 py-2 text-sm text-white bg-blue-600 rounded-md"
                            >
                                Search
                            </button>
                        </div>
                    </form>
                </div>

                         <!-- New Table -->
                <div class="w-full overflow-hidden rounded-lg shadow-xs">
                
                  <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                      <thead>
                        <tr
                          class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                        >
                          <th class="px-4 py-3">Name</th>
                          <th class="px-4 py-3">Designation</th>
                          <th class="px-4 py-3">Department</th>
                          <th class="px-4 py-3">Options</th>
                        </tr>
                      </thead>
                      <tbody
                        class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                      >
                      @if($users->isEmpty())
                      <tr>
                        <td colspan="4" class="text-center py-8">
                            <div class="flex flex-col items-center space-y-4">
                              <p class="text-xl text-gray-700 font-semibold">
                                  No Technicians Found
                              </p>
                              <p class="text-sm text-gray-500">
                                  Please add a new technician to continue.
                              </p>
                              <a href="{{ route('admin.dashboard') }}" class="inline-block px-6 py-3 text-white bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-300 ease-in-out">
                                  Add Technician!
                              </a>
                            </div>
                        </td>
                      </tr>
                      @else

                        @foreach($users as $user)
                          <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3">
                              <div class="flex items-center text-sm">
                                <!-- Avatar with inset shadow -->
                                <div
                                  class="relative hidden w-8 h-8 mr-3 rounded-full md:block"
                                >
                                  <img
                                    class="object-cover w-full h-full rounded-full"
                                    src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&facepad=3&fit=facearea&s=707b9c33066bf8808c934c8ab394dff6"
                                    alt=""
                                    loading="lazy"
                                  />
                                  <div
                                    class="absolute inset-0 rounded-full shadow-inner"
                                    aria-hidden="true"
                                  ></div>
                                </div>
                                <div>
                                  <p class="font-semibold">{{$user->name}}</p>
                                </div>
                              </div>
                            </td>
                            <td class="px-4 py-3 text-sm">
                              {{$user->designation}}
                            </td>
                            <td class="px-4 py-3 text-xs">
                              <span
                                class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100"
                              >
                              {{$user->section}}
                              </span>
                            </td>
                            <td class="px-4 py-3 text-sm">
                              <!-- <button @click="TechnicianModal = true" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                <svg fill="#000000" width="12px" height="12px" viewBox="0 0 24 24" id="edit" data-name="Line Color" xmlns="http://www.w3.org/2000/svg" class="icon line-color"><line id="secondary" x1="21" y1="21" x2="3" y2="21" style="fill: none; stroke: rgb(44, 169, 188); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></line><path id="primary" d="M19.88,7,11,15.83,7,17l1.17-4,8.88-8.88A2.09,2.09,0,0,1,20,4,2.09,2.09,0,0,1,19.88,7Z" style="fill: none; stroke: rgb(0, 0, 0); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></path></svg>
                              </button> -->
                              <button 
                                @click="EmployeeModal = true; EmployeInfo = { name: '{{ $user->name }}', designation: '{{ $user->designation }}', department: '{{ $user->division }}', employeeId: '{{$user->id}}' }"
                                class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                <svg fill="#000000" width="12px" height="12px" viewBox="0 0 24 24" id="edit" data-name="Line Color" xmlns="http://www.w3.org/2000/svg" class="icon line-color">
                                  <line id="secondary" x1="21" y1="21" x2="3" y2="21" style="fill: none; stroke: rgb(44, 169, 188); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></line>
                                  <path id="primary" d="M19.88,7,11,15.83,7,17l1.17-4,8.88-8.88A2.09,2.09,0,0,1,20,4,2.09,2.09,0,0,1,19.88,7Z" style="fill: none; stroke: rgb(0, 0, 0); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></path>
                                </svg>
                              </button>

                            </td>
                          </tr>
                        @endforeach
                      @endif
                      </tbody>
                    </table>
                  </div>

                  <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                    <!-- <span class="flex items-center col-span-3">
                      Showing 1-1
                    </span> -->
                    <!-- <span class="col-span-2"></span> -->
            
                    <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                      <nav aria-label="Table navigation">
                        {{ $users->links() }}
                      </nav> 
                    
                    </span>
                  
                  </div>

                </div>
              </div>
          
              <div
                x-show="EmployeeModal"
                x-data="modalForm()" 
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="fixed inset-0 z-20 flex items-center justify-center bg-black bg-opacity-50"
                @click.away="EmployeeModal = false"
                @keydown.escape.window="EmployeeModal = false"
                >

                <div class="w-full md:w-1/2 max-w-medium bg-white dark:bg-gray-800 rounded-lg p-6">
                  <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Technician Details</h3>
                    <button @click="EmployeeModal = false" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">
                      <span class="sr-only">Close</span>&times;
                    </button>
                  </div>

                    <form method="POST" action="{{ route('technicians.remove') }}">
                        @csrf <!-- CSRF protection for Laravel -->              
                          <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Name</label>
                            <input type="text" id="name" name="name" x-model="EmployeInfo.name" class="w-full px-4 py-2 mt-2 text-sm border border-gray-300 rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" required disabled>
                            <input type="hidden" name="name" x-model="EmployeInfo.name">
                            <input type="hidden" name="usertype" x-model="0">
                            <input type="hidden" name="emp_id" x-model="EmployeInfo.employeeId">
                          </div>

                          <div class="mb-4">
                            <label for="designation" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Designation</label>
                            <input type="text" id="designation" name="designation" x-model="EmployeInfo.designation" class="w-full px-4 py-2 mt-2 text-sm border border-gray-300 rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" required disabled>
                            <input type="hidden" name="designation" x-model="EmployeInfo.designation">
                          </div>

                          <div class="mb-4">
                            <label for="department" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Department</label>
                            <input type="text" id="department" name="department" x-model="EmployeInfo.department" class="w-full px-4 py-2 mt-2 text-sm border border-gray-300 rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" required disabled>
                            <input type="hidden" name="department" x-model="EmployeInfo.department">
                          </div>
                      
                          <div x-data="{ level: 6 }">
                            <input id="inputField" type="hidden" x-model="level">
                        </div>

                        <div class="mt-4">
                          <button type="submit"  @click="TechnicianModal"  class="w-full px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg focus:outline-none focus:shadow-outline-purple">
                            Remove as Technician
                          </button>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
</div>


