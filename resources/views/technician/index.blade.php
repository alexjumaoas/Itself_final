<?php 
use Illuminate\Support\Facades\DB;

?>

@include('includes.header')
    <div
      class="flex h-screen bg-gray-50 dark:bg-gray-900"
      :class="{ 'overflow-hidden': isSideMenuOpen }"
    >

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
          <div class="container px-6 mx-auto grid">
            <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
             Technician
            </h2>
            <!-- CTA -->
            <a
              class="flex items-center justify-between p-4 mb-8 text-sm font-semibold text-purple-100 bg-purple-600 rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple"
              href="blank"
            >
              <div class="flex items-center">
                <svg
                  class="w-5 h-5 mr-2"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                >
                  <path
                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                  ></path>
                </svg>
                <span>IT Services Logistics Framework</span>
              </div>
              <!-- <span> &RightArrow;</span> -->
            </a>
            <!-- Cards -->
            <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
              <!-- Card -->
              @foreach($request as $req)

              @php
                $requestSummary = $req->request_summary; 
                $requestArray = explode('|', $requestSummary);
             @endphp
          
              <div class="flex items-start p-6 bg-white rounded-lg shadow-lg dark:bg-gray-800 transition-shadow hover:shadow-xl w-full max-w-4xl">
                <!-- Icon Section -->
                {{-- <div class="flex items-center justify-center w-12 h-12 bg-orange-100 rounded-full dark:bg-orange-500 text-orange-500 dark:text-orange-100">
                  <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path
                      d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"
                    ></path>
                  </svg>
                </div> --}}

                <!-- Card Content -->
                <div class="ml-4 flex-1">
                  <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" style="background-color: orange; padding: 6px;"
                  >Pending</p>
                  {{-- <p class="text-xs text-lg font-semibold text-gray-700 dark:text-gray-200 ">Request Number: {{$req->request_code}}</p> --}}
                  <p class="text-xs font-semibold text-gray-700 dark:text-gray-200">Request Number:</p>
                  <p class="text-xs font-semibold text-gray-700 dark:text-gray-200"> {{$req->request_code}}</p>


                  <div class="mt-3 space-y-1">
                    <div><span class="font-medium text-gray-600 dark:text-gray-400 text-xs"><strong>Request Date:</strong></span> <span class="text-gray-700 dark:text-gray-200 text-xs">{{$req->created_at}}</span></div>
                    <div><span class="font-medium text-gray-600 dark:text-gray-400 text-xs"><strong>Requestor:</strong></span> <span class="text-gray-700 dark:text-gray-200 text-xs">
                    {{ DB::connection('mysqlDts')->table('users')->where('username', $req->requestor_userId)->selectRaw('concat(fname, " ", lname) as full_name')->value('full_name') }}</span></div>
                    <div><span class="font-medium text-gray-600 dark:text-gray-400 text-xs"><strong>Section:</strong></span> <span class="text-gray-700 dark:text-gray-200 text-xs">
                    {{ DB::connection('mysqlDts')->table('section')->where('id', $req->section)->value('description')}}</span></div>
                    <div><span class="font-medium text-gray-600 dark:text-gray-400 text-xs"><strong>Requests:</strong></span> <span class="text-gray-700 dark:text-gray-200 text-xs">
                      
                    @foreach($requestArray as $item)
                        <li>{{ $item }}</li>
                    @endforeach

                    @if($req->specific_details)
                      <li>{{ $req->specific_details }}</li>
                    @endif
                    
                    </span></div>
                  </div>

                  <div class="mt-4">
                    <button class="text-sm btn btn-primary text-white bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-lg shadow-md transition duration-300 ease-in-out">
                      <a href="{{ route('tech.accepted', ['id' => $req->id]) }}">Accept</a>
                    </button>
                  </div>
                </div>
              </div>
              @endforeach
            </div>


              <!-- Card -->
            <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
              <div
                class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
              >
                <div
                  class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500"
                >
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path
                      fill-rule="evenodd"
                      d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                      clip-rule="evenodd"
                    ></path>
                  </svg>
                </div>
                <div>
                  <p
                    class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400"
                  >
                    Ongoing Request
                  </p>
                  <p
                    class="text-lg font-semibold text-gray-700 dark:text-gray-200"
                  >
                  13
                  </p>
                </div>
              </div>
            </div>

              

            <!-- New Table -->
            <!-- <div class="w-full overflow-hidden rounded-lg shadow-xs">
              <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                  <thead>
                    <tr
                      class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                    >
                      <th class="px-4 py-3">Technician</th>
                      <th class="px-4 py-3">Accepted</th>
                      <th class="px-4 py-3">Status</th>
                      <th class="px-4 py-3">Date ACCEPTED</th>
                    </tr>
                  </thead>
                  <tbody
                    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                  >

                    <tr class="text-gray-700 dark:text-gray-400">
                      <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                         
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
                            <p class="font-semibold">Jolina Angelie</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">
                              Technician 1
                            </p>
                          </div>
                        </div>
                      </td>
                      <td class="px-4 py-3 text-sm">
                        3
                      </td>
                      <td class="px-4 py-3 text-xs">
                        <span
                          class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:text-white dark:bg-orange-600"
                        >
                          Pending
                        </span>
                      </td>
                      <td class="px-4 py-3 text-sm">
                        6/10/2020
                      </td>
                    </tr>

                    <tr class="text-gray-700 dark:text-gray-400">
                      <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                    
                          <div
                            class="relative hidden w-8 h-8 mr-3 rounded-full md:block"
                          >
                            <img
                              class="object-cover w-full h-full rounded-full"
                              src="https://images.unsplash.com/photo-1551069613-1904dbdcda11?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&ixid=eyJhcHBfaWQiOjE3Nzg0fQ"
                              alt=""
                              loading="lazy"
                            />
                            <div
                              class="absolute inset-0 rounded-full shadow-inner"
                              aria-hidden="true"
                            ></div>
                          </div>
                          <div>
                            <p class="font-semibold">Sarah Curry</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">
                            Technician 2
                            </p>
                          </div>
                        </div>
                      </td>
                      <td class="px-4 py-3 text-sm">
                        5
                      </td>
                      <td class="px-4 py-3 text-xs">
                        <span
                          class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700"
                        >
                          Denied
                        </span>
                      </td>
                      <td class="px-4 py-3 text-sm">
                        6/10/2020
                      </td>
                    </tr>

                    <tr class="text-gray-700 dark:text-gray-400">
                      <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
            
                          <div
                            class="relative hidden w-8 h-8 mr-3 rounded-full md:block"
                          >
                            <img
                              class="object-cover w-full h-full rounded-full"
                              src="https://images.unsplash.com/photo-1551006917-3b4c078c47c9?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&ixid=eyJhcHBfaWQiOjE3Nzg0fQ"
                              alt=""
                              loading="lazy"
                            />
                            <div
                              class="absolute inset-0 rounded-full shadow-inner"
                              aria-hidden="true"
                            ></div>
                          </div>
                          <div>
                            <p class="font-semibold">Rulia Joberts</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">
                            Technician 3
                            </p>
                          </div>
                        </div>
                      </td>
                      <td class="px-4 py-3 text-sm">
                        2
                      </td>
                      <td class="px-4 py-3 text-xs">
                        <span
                          class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100"
                        >
                          Approved
                        </span>
                      </td>
                      <td class="px-4 py-3 text-sm">
                        6/10/2020
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              </div>
            </div> -->

          </div>
        </main>
      </div>
    </div>
    @include('includes.footer')
