<div>
    <div class="{{ $class }}">
        <div class="row justify-content-between">
            <div class="col-12 col-md-6 my-auto">
                <p class="m-0 text-5xl text-secondary text-center anta-regular">{{ $planName }}</p>
                <p class="m-0 text-7xl text-secondary text-center work-sans-regular">{{ $planPrice }}</p>
            </div>
            <div class="col-12 col-md-6">
                <img src="{{ $image }}" class="w-75 d-block mx-auto" alt="{{ $planName }}">
            </div>
            <div class="col-12">
                <ul>
                    <li class="m-0 work-sans-regular text-lg">{{ $planVelocityLoad }}</li>
                    <li class="m-0 work-sans-regular text-lg">{{ $planVelocityDownload }}</li>
                    <li class="m-0 work-sans-regular text-lg">Datos ilimitados</li>
                </ul>
            </div>
            <div class="col-12">
                <div class="text-center mt-2">
                    <x-button text="Conectar" url="{{ route('login') }}"
                        class="btn btn-secondary px-4 py-3 w-75 anta-regular rounded-pill text-3xl text-primary"></x-button>
                </div>
            </div>
        </div>
    </div>
</div>
