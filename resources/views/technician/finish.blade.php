<?php 
use Illuminate\Support\Facades\DB;
use App\Models\ITRequestResponse;
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
              @foreach($finish as $fin)

              @php
                $requestSummary = $fin->request_summary; 
                $requestArray = explode('|', $requestSummary);
             @endphp 
          
              <div class="flex items-start p-6 bg-white rounded-lg shadow-lg dark:bg-gray-800 transition-shadow hover:shadow-xl w-full max-w-4xl">
                <!-- Card Content -->
                <div class="ml-4 flex-1">
                  <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" style="background-color: rgb(37, 187, 221);color:white; padding: 6px;"
                  >Finish</p>
                  <p class="text-xs font-semibold text-gray-700 dark:text-gray-200">Request Number: {{$fin->request_code}}</p>
                  <p class="text-xs font-semibold text-gray-700 dark:text-gray-200">Date Finished: {{$fin->updated_at}} </p>
                  

                   <div class="mt-3 space-y-1">
                    <div><span class="font-medium text-gray-600 dark:text-gray-400 text-xs"><strong>Requestor:</strong></span> <span class="text-gray-700 dark:text-gray-200 text-xs">
                    {{ DB::connection('mysqlDts')->table('users')->where('username', $fin->requestor_userId)->selectRaw('concat(fname, " ", lname) as full_name')->value('full_name') }}</span></div>
                    <div><span class="font-medium text-gray-600 dark:text-gray-400 text-xs"><strong>Section:</strong></span> <span class="text-gray-700 dark:text-gray-200 text-xs">
                    {{ DB::connection('mysqlDts')->table('section')->where('id', $fin->section)->value('description')}}</span></div>
                    <div><span class="font-medium text-gray-600 dark:text-gray-400 text-xs"><strong>Done By:</strong></span> <span class="text-gray-700 dark:text-gray-200 text-xs">
                        {{ ITRequestResponse::where('request_id', $fin->id)->first()->technician }}</span></div>
                    <div><span class="font-medium text-gray-600 dark:text-gray-400 text-xs"><strong>Requests:</strong></span> <span class="text-gray-700 dark:text-gray-200 text-xs"> 
                      
                     @foreach($requestArray as $item)
                        <li>{{ $item }}</li>
                    @endforeach

                    @if($fin->specific_details)
                      <li>{{ $fin->specific_details }}</li>
                    @endif 
                    
                    </span></div>
                  </div>
                </div>
              </div>
              @endforeach
            </div>

          

          </div>
        </main>
      </div>
    </div>
    @include('includes.footer')
