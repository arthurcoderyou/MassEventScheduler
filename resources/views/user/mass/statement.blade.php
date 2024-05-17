<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Statement of Account</title>
  <style type="text/css">
    @page{
      size: 8.3in 11.7in;

    }
    @page{
      size: A4;
    }
    .margin-bottom{

    }
    .table-bg{
      border-collapse: collapse;
      width: 100%;
      font-size: 15px;
      text-align: center;
    }
    .th{
      color: #0d6efd;
      border: 1px solid #0d6efd;
      padding: 10px;
    }
    .td{
      text-align: center;
      border: 1px solid #1782b8;
      padding: 10px;
    }
    .text-container{
      text-align: left;
      padding-left: 5px;
    }

    @media print{
      @page{
        margin: 0px;
        margin-left: 20px;
        margin-right: 20px;
      }
    }

    .res-tab{
      margin-top: 10px;
    }

    .title{
      font-size: 0.8rem;
      color: #0d6efd;
    }

    .value{
      font-size: 0.8rem;
      color: #1782b8;
      font-weight: bolder;
    }


    .px-4 {
        padding-left: 1rem;
        padding-right: 1rem;
    }
    .container {
        max-width: 1024px;
        margin-left: auto;
        margin-right: auto;
    }

    html{
      tab-size: 4;
      font-family: Inter, ui-sans-serif, system-ui, -apple-system, system-ui, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
      font-feature-settings: normal;
      font-variation-settings: normal;
    }

    .leading-10 {
        line-height: 2.5rem;
    }
    .text-3xl {
        font-size: 1.875rem;
        line-height: 2.25rem;
    }
    .mb-4 {
      margin-bottom: 1rem;
    }

    .mt-4 {
      margin-top: 1rem;
    }

    .text-left {
      text-align: left;
    }
    .border-gray-200 {
        --tw-border-opacity: 1;
        border-color: rgb(229 231 235 / var(--tw-border-opacity));
    }
    .border-s {
        border-inline-start-width: 3px;
    }
    .relative {
        position: relative;
    }
    ol, ul, menu {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .ms-4 {
        margin-inline-start: 1rem;
    }

    .mb-10 {
        margin-bottom: 2.5rem;
    }

    .bg-indigo-200 {
        --tw-bg-opacity: 1;
        background-color: rgb(205 219 254 / var(--tw-bg-opacity));
    }

    .border-white {
        --tw-border-opacity: 1;
        border-color: rgb(255 255 255 / var(--tw-border-opacity));
    }
    .border {
        border-width: 1px;
    }
    .rounded-full {
        border-radius: 9999px;
    }
    .w-3 {
        width: 0.75rem;
    }
    .h-3 {
        height: 0.75rem;
    }
    .mt-1\.5 {
        margin-top: 0.375rem;
    }
    .-start-1\.5 {
        inset-inline-start: -0.375rem;
    }
    .absolute {
        position: absolute;
    }

    .border-gray-200 {
    --tw-border-opacity: 1;
    border-color: rgb(229 231 235 / var(--tw-border-opacity));
}
  </style>

</head>
<body>
  
  <div id="page">
    
    <div class="container ">
      <p class="px-4 text-3xl mb-4">{{ Auth::user()->role == "user" ? 'My' : '' }} Mass Appoinments</p>

      <div class="px-4 mb-4">
        {{ count($getRecord) }} records
      </div>
      <div class="px-4">
        
        <ol class="relative text-left border-s border-gray-200 dark:border-gray-700" 
          style="position: relative; text-align: left; border-inline-start-width: 3px; border: 1px solid rgb(55 65 81); ">
              
        @foreach($getRecord as $record)
                                    
          <li class="mb-10 ms-4 mt-4" >
              <div class="absolute w-3 h-3 bg-indigo-200 rounded-full mt-1.5 -start-1.5 border border-white dark:border-indigo-900 dark:bg-indigo-700" 
              style=" position: absolute;  width: 0.75rem;  width: 0.75rem; margin-top: 0.375rem; inset-inline-start: -0.375rem;
               background-color: rgb(205 219 254); border-width: 1px; border-radius: 9999px;"></div>
              <time class="mb-1 text-sm font-normal leading-none text-indigo-400 dark:text-indigo-500"
                style="margin-bottom: 0.25rem; font-size: 0.875rem;
                line-height: 1.25rem;"
              >{{ date('M d, Y',strtotime($record->date)) }} | {{ date('h:i A',strtotime($record->start_time)) }} to {{ date('h:i A',strtotime($record->end_time)) }} |
                          <span  style="color: rgb(227 160 8);">
                              <i class="fas fa-exclamation-circle "></i> <span class="capitalize" style="text-transform: capitalize;">pending</span>
                          </span>
                                               
              </time>
              <p class="my-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500" style="font-size: 0.875rem;
              line-height: 1.25rem;  font-weight: 400; color: rgb(107 114 128); margin-top: 0.25rem; margin-bottom: 0.25rem;">
                  <i class="fas fa-crosshairs"></i> {{ $record->location }}
              </p>

              @if(Auth::user()->role == "admin")

                <?php 
                  $user_info = App\Models\User::find($record->user_id);
                ?>

                @if(!empty($user_info))
                  
                  <p class="my-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500" style="font-size: 0.875rem; line-height: 1.25rem;  font-weight: 400; color: rgb(107 114 128); margin-top: 0.25rem; margin-bottom: 0.25rem;">
                      <i class="fas fa-user"></i> {{ $user_info->name }}
                  </p>

                  <p class="my-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500" style="font-size: 0.875rem; line-height: 1.25rem;  font-weight: 400; color: rgb(107 114 128); margin-top: 0.25rem; margin-bottom: 0.25rem;">
                      <i class="fas fa-envelope"></i> {{ $user_info->email }}
                  </p>

                @endif

              @endif

              <h3 class="text-lg font-semibold text-gray-900 dark:text-white" style="font-size: 1.125rem;
              line-height: 1.75rem; font-weight: 600; color: rgb(17 24 39);">{{ $record->mass_intention }}</h3>
              <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">{{ $record->details }}</p>

              
          </li>

        @endforeach
              

          

        </ol>

      </div>



    </div>
    



    

  </div>
  
  <script>
    //to print the page
    window.print();
  </script>
</body>
</html>