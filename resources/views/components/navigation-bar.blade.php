<nav class="bg-white shadow-md">
    <div class="container mx-auto gap-4 px-4 py-4 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-3 items-center">
        <div class="text-2xl font-bold text-gray-800 justify-self-center md:justify-self-center lg:justify-self-start">
            <a href="#" class="hover:text-amber-500">
                <img src="{{ asset('images/logo.png') }}" alt="">
            </a>
        </div>

        <div class="sm:justify-self-center md:justify-self-center lg:justify-self-center">
            @include('components.links')
        </div>

        <div class="justify-self-center md:justify-self-center lg:justify-self-end">
            @if(optional(Auth::user())->role == 'admin')
                <div>
                    <a href="/p">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="h-8 w-8 fill-red-500">
                            <path d="M224 16c-6.7 0-10.8-2.8-15.5-6.1C201.9 5.4 194 0 176 0c-30.5 0-52 43.7-66 89.4C62.7 98.1 32 112.2 32 128c0 14.3 25 27.1 64.6 35.9c-.4 4-.6 8-.6 12.1c0 17 3.3 33.2 9.3 48l-59.9 0C38 224 32 230 32 237.4c0 1.7 .3 3.4 1 5l38.8 96.9C28.2 371.8 0 423.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7c0-58.5-28.2-110.4-71.7-143L415 242.4c.6-1.6 1-3.3 1-5c0-7.4-6-13.4-13.4-13.4l-59.9 0c6-14.8 9.3-31 9.3-48c0-4.1-.2-8.1-.6-12.1C391 155.1 416 142.3 416 128c0-15.8-30.7-29.9-78-38.6C324 43.7 302.5 0 272 0c-18 0-25.9 5.4-32.5 9.9c-4.8 3.3-8.8 6.1-15.5 6.1zm56 208l-12.4 0c-16.5 0-31.1-10.6-36.3-26.2c-2.3-7-12.2-7-14.5 0c-5.2 15.6-19.9 26.2-36.3 26.2L168 224c-22.1 0-40-17.9-40-40l0-14.4c28.2 4.1 61 6.4 96 6.4s67.8-2.3 96-6.4l0 14.4c0 22.1-17.9 40-40 40zm-88 96l16 32L176 480 128 288l64 32zm128-32L272 480 240 352l16-32 64-32z"/>
                        </svg>
                    </a>
                </div>
            @else
                <div>
                    <a href="/p">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="h-8 w-8 fill-gray-500">
                            <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"/>
                        </svg>
                    </a>
                </div>
            @endif
        </div>
    </div>
</nav>