{{-- Subheader --}}
<div class="subheader pt-2 pb-2 {{ Metronic::printClasses('subheader', false) }} " id="kt_subheader">
    <div class="{{ Metronic::printClasses('subheader-container', false) }} d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap  " style="background-image: url({{ asset('media/bg/bg-8.jpg') }}); background-position: center; ">
        <div class="d-flex align-items-center flex-wrap mr-2 ">

            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5 ">
                {{ @$page_title }} 

                @if (isset($page_description) && config('layout.subheader.displayDesc'))
                    <br/><small>{{ @$page_description }}</small>
                @endif
            </h5>

            <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4"></div>
           
        </div>
        <div class="d-flex align-items-center">
            
        </div>
    </div>
</div>
