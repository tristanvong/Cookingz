<div class="bg-white shadow-md">
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-wrap justify-between items-start">
            <div class="mb-4">
                <h2 class="text-2xl font-bold text-gray-800">
                    <a href="#" class="hover:text-amber-500">Cookingz</a>
                </h2>
                <p class="text-gray-600 mt-2">
                    Your go-to platform for delicious recipes and cooking tips.
                </p>
            </div>

            <div class="mb-4">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Quick Links</h3>
                @include('components.links')
            </div>

            <div class="mb-4">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Reach out to me!</h3>
                <!-- Got the icons from fontawesome(dot)com -->
                <div class="flex space-x-4">
                    <a href="https://www.linkedin.com/in/tristanvong/" target="_blank" class="text-gray-600 hover:text-amber-500 transition duration-300">
                        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M22.675 0h-21.35c-.733 0-1.325.592-1.325 1.325v21.351c0 .733.592 1.325 1.325 1.325h21.351c.733 0 1.325-.592 1.325-1.325v-21.35c0-.733-.592-1.325-1.325-1.325zm-13.511 20h-3.563v-8.354h3.563v8.354zm-1.781-9.623c-1.131 0-2.049-.918-2.049-2.049s.918-2.049 2.049-2.049c1.132 0 2.05.918 2.05 2.049 0 1.131-.918 2.049-2.05 2.049zm13.292 9.623h-3.564v-4.278c0-1.021-.021-2.33-1.419-2.33-1.421 0-1.638 1.11-1.638 2.251v4.357h-3.564v-8.354h3.418v1.144h.049c.477-.901 1.637-1.852 3.372-1.852 3.603 0 4.269 2.372 4.269 5.455v4.607z"/>
                        </svg>
                    </a>
                    <a href="mailto:tristan.vong@student.ehb.be" target="_blank" class="text-gray-600 hover:text-amber-500 transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-8 h-8" fill="currentColor">
                            <path d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7 .3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2 .4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <div class="border-t mt-4 pt-4 text-center text-gray-600">
            &copy; 2024 Cookingz - Backend Web
        </div>
    </div>
</div>