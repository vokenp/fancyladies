{{-- Header --}}
<div class="d-flex flex-column flex-center py-10 bgi-size-cover bgi-no-repeat rounded-top" style="background-image: url('{{ asset('media/misc/bg-1.jpg') }}')">
    <h4 class="text-white font-weight-bold">
        Sys Development
    </h4>
   
</div>

{{-- Nav --}}
<div class="row row-paddingless">
    {{-- Item --}}
   
    {{-- Item --}}
    <div class="col-4">
        <a href="{{ route('sysdev.menucats.index') }}" class="d-block py-10 px-5 text-center bg-hover-light border-bottom">
            {{ Metronic::getSVG("media/svg/icons/Communication/Mail-attachment.svg", "svg-icon-3x svg-icon-success") }}
            <span class="d-block text-dark-75 font-weight-bold font-size-h6 mt-2 mb-1">Menu Categories</span>
            
        </a>
    </div>

    {{-- Item --}}
    <div class="col-4">
        <a href="{{ route('sysdev.module.index') }}" class="d-block py-10 px-5 text-center bg-hover-light border-right">
            {{ Metronic::getSVG("media/svg/icons/Shopping/Box2.svg", "svg-icon-3x svg-icon-success") }}
            <span class="d-block text-dark-75 font-weight-bold font-size-h6 mt-2 mb-1">Manage Module</span>
           
        </a>
    </div>

    {{-- Item --}}
    <div class="col-4">
        <a href="{{ route('sysdev.listitem.index') }}" class="d-block py-10 px-5 text-center bg-hover-light">
            {{ Metronic::getSVG("media/svg/icons/Communication/Group.svg", "svg-icon-3x svg-icon-success") }}
            <span class="d-block text-dark-75 font-weight-bold font-size-h6 mt-2 mb-1">List Items</span>
            
        </a>
    </div>

    
</div>
