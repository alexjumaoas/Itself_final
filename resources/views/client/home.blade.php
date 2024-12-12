
<?php 
use Illuminate\Support\Facades\DB;

?>

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
        
        <!-- Current Requests Section -->
        <div class="mt-6">
          <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Current Requests</h2>

          <div class="space-y-4 mt-4">
            <!-- Example Request 1 -->
             @foreach($request as $req)
             @php
              $requestSummary = $req->request_summary; 
              $requestArray = explode('|', $requestSummary);

             @endphp
                <div class="border border-gray-300 rounded-md shadow-md overflow-hidden">
                  <div class="bg-orange-500 p-3" style="background-color:orange">
  
                  <h3 class="text-black font-semibold">Request Number: {{$req->request_code}}</h3>
                </div>
                <div class="p-4">
                  <p class="text-gray-600 dark:text-gray-400 mt-1">
                  {{ DB::connection('mysqlDts')->table('users')->where('username', $req->requestor_userId)->selectRaw('concat(fname, " ", lname) as full_name')->value('full_name') }}
                  of
                 {{ DB::connection('mysqlDts')->table('section')->where('id', $req->section)->value('description')}}
                  
                  
                  
                  has requested the following service:</p>
                  <ul class="list-disc list-inside mt-2">
                    @foreach($requestArray as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                      <li>{{ $req->specific_details }}</li>
                  </ul><br>
                  <button class="text-white bg-red-600 hover:bg-red-700 px-3 py-1 rounded-md text-sm"><a href="{{ route('request.cancel', ['id' => $req->id]) }}">Cancel</a></button> 
                </div>
              </div>
            @endforeach
            <!-- Example Request 2 -->
            <div class="border border-gray-300 rounded-md shadow-md overflow-hidden">
              <div class="bg-blue-500 p-3">
                <h3 class="text-white font-semibold">Request Number: 20241209133547-2693</h3>
              </div>
              <div class="p-4">
                <p class="text-gray-800 dark:text-gray-100 font-medium">Request Transferred to JOSE FEB CANONIGO</p>
                <p class="text-gray-600 dark:text-gray-400 mt-1">Claudine Tecson in Procurement Unit has requested the following service:</p>
                <ul class="list-disc list-inside mt-2">
                  <li>Check Computer</li>
                </ul>
              </div>
            </div>
          </div>
        </div>

      </div>
    </main>
  </div>
</div>
@include('includes.footer')
