{{-- Header --}}
<div class="d-flex flex-column flex-center py-10 bgi-size-cover bgi-no-repeat rounded-top" style="background-image: url('{{ asset('media/bg/bg-8.jpg') }}')">
    <h4 class="text-white font-weight-bold">
        System Administration
    </h4>
   
</div>

{{-- Nav --}}
<div class="row row-paddingless">
    {{-- Item --}}
    <div class="col-4">
        <a href="{{ route('sysdev.user.index') }}" class="d-block py-10 px-5 text-center bg-hover-light border-right border-bottom">
            {{ Metronic::getSVG("media/svg/icons/Shopping/Euro.svg", "svg-icon-3x svg-icon-success") }}
            <span class="d-block text-dark-75 font-weight-bold font-size-h6 mt-2 mb-1">Manage Users</span>
            
        </a>
    </div>

    {{-- Item --}}
    <div class="col-4">
        <a href="#" class="d-block py-10 px-5 text-center bg-hover-light border-bottom">
            {{ Metronic::getSVG("media/svg/icons/Communication/Mail-attachment.svg", "svg-icon-3x svg-icon-success") }}
            <span class="d-block text-dark-75 font-weight-bold font-size-h6 mt-2 mb-1">Menu Roles</span>
            
        </a>
    </div>

    {{-- Item --}}
    <div class="col-4">
        <a href="#" class="d-block py-10 px-5 text-center bg-hover-light border-right">
            {{ Metronic::getSVG("media/svg/icons/Shopping/Box2.svg", "svg-icon-3x svg-icon-success") }}
            <span class="d-block text-dark-75 font-weight-bold font-size-h6 mt-2 mb-1">Manage Profiles</span>
           
        </a>
    </div>

    {{-- Item --}}
    <div class="col-4">
        <a href="#" class="d-block py-10 px-5 text-center bg-hover-light">
            {{ Metronic::getSVG("media/svg/icons/Communication/Group.svg", "svg-icon-3x svg-icon-success") }}
            <span class="d-block text-dark-75 font-weight-bold font-size-h6 mt-2 mb-1">Manage Groups</span>
            
        </a>
    </div>

     
</div>
