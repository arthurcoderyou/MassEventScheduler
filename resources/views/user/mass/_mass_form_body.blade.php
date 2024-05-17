
<div id="mass_form_body">
@if(!empty($getMass))
<form class="p-4 md:p-5 massFormUpdate" data-id="{{ $getMass->id }}"  action="{{ route('user.mass.update') }}" method="post">
 
  
    @csrf
    <input type="hidden" name="mass_id" value="{{ $getMass->id }}" id="">
    <div class="grid gap-4 mb-4 grid-cols-3">
      
      <div class="col-span-3 ">
          <label for="mass_intention" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Intention for the Mass: <span class="text-red-500">*</span></label>
          <select required
              class="selectpicker " style="width: 100%; background: white;" 
              data-placeholder="Select an Intention or enter your other answer..."
              data-allow-clear="false"
              name="mass_intention"
              id="mass_intention"
              title="Select an Intention or enter your other answer...">
              <option selected value="{{ $getMass->mass_intention }}">{{ $getMass->mass_intention }}</option>
              <option value="Baptism">Baptism</option>
              <option value="Confirmation">Confirmation</option>
              <option value="Anointing of the Sick">Anointing of the Sick</option>
              <option value="Holy Orders">Holy Orders</option>
              <option value="Matrimony">Matrimony</option>
              <option value="Marriage">Marriage</option>
              <option value="Wedlock">Wedlock</option>
              <option value="Thanksgiving">Thanksgiving</option>
              <option value="Healing">Healing</option>
              <option value="Guidance">Guidance & Strength</option>
              <option value="Peace">Peace & Justice</option>
              <option value="Deceased">For the Deceased</option>
          </select>
          <p></p>
      </div>
      <div class="col-span-3">
          <label for="details" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Update Details about your intention <span class="text-red-500">*</span></label>
          <textarea required name="details" id="details" rows="3" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $getMass->details }}</textarea>                    
      </div>

      <div class="col-span-3">
        <label for="location" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Location <span class="text-red-500">*</span></label>
        <input type="text" required value="{{ $getMass->location }}" name="location" id="location" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" >
      </div>

      <div class="col-span-3 sm:col-span-1">
        {{-- Uncomment the label for better user experience --}}
        <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date <span class="text-red-500">*</span></label>
        <input type="date" required value="{{ Carbon\Carbon::parse($getMass->date)->format('Y-m-d') }}" name="date" id="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
      </div>
      
      <div class="col-span-3 sm:col-span-1">
        <label for="start_time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start time: <span class="text-red-500">*</span></label>
        <input type="time" required value="{{ $getMass->start_time }}" name="start_time" id="start_time" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" >
      </div>

      <div class="col-span-3 sm:col-span-1">
        <label for="end_time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">End time: <span class="text-red-500">*</span></label>
        <input type="time" required value="{{ $getMass->end_time }}" name="end_time" id="end_time" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" >
      </div>
     
    </div>
    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
     
      <i class="fa fa-save mr-1" ></i>
      Save
    </button>
  

</form>
@endif
</div>