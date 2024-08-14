<div>
    <div class="{{ $class }}">
        <div class="row justify-content-between">
            <div class="col-6 my-auto">
                <p class="m-2 text-5xl text-primary text-start anta-regular">{{ $planName }}</p>
                <p class="m-2 text-white work-sans-semibold text-lg text-start">{{ $planCategory }}</p>
            </div>
            <div class="col-6 col-sm-4 py-1">
                <img src="{{ $image }}" class="w-60 d-block mx-auto" alt="{{ $planName }}">
            </div>
            <div class=" col-12">
                <ul>
                    <li class="m-0 text-white work-sans-regular text-lg">{{ $planDescription }}</li>
                </ul>
            </div>

            <div class="col-12 col-sm-4 col-md-3 my-auto">
                <p class="m-0 text-6xl text-white text-center work-sans-regular">{{ $planPrice }}</p>
            </div>
            <div class="col-12 col-sm-8">
                <div class="text-center mt-2">
                    <x-button text="Conectar" url="{{ route('login') }}"
                        class="text-center btn btn-white  py-3 w-75 anta-regular rounded-pill text-3xl text-primary"></x-button>
                </div>
            </div>
        </div>
    </div>
</div>
