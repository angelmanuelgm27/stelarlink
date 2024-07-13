<div>
    <div class="{{ $class }}">
        <div class="row justify-content-between">
            <div class="col-12 col-md-6 my-auto">
                <p class="m-0 text-5xl text-primary text-center text-xl-start anta-regular">{{ $planName }}</p>
                <p class="m-2 text-white work-sans-semibold text-lg text-center text-xl-start">{{ $planCategory }}</p>
            </div>
            <div class="col-12 col-md-4 py-1">
                <img src="{{ $image }}" class="w-60 d-block mx-auto" alt="{{ $planName }}">
            </div>
            <div class="col-12 col-7">
                <ul>
                    <li class="m-0 text-white work-sans-regular text-lg">{{ $planDescription }}</li>
                </ul>
            </div>

            <div class="col-12 col-md-5 my-auto">
                <p class="m-0 text-7xl text-white text-sm-center work-sans-regular">{{ $planPrice }}</p>
            </div>
            <div class="col-12 col-md-7 ">
                <div class="text-center mt-2">
                    <x-button text="Conectar" url="{{ route('login') }}"
                        class="btn btn-white px-4 py-3 w-75 anta-regular rounded-pill text-3xl text-primary"></x-button>
                </div>
            </div>
        </div>
    </div>
</div>
