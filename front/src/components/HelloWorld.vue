<template>
    <div>
    <nav class="custom_bg shadow dark:bg-gray-800 text-white">
        <div class="container px-6 py-3 mx-auto">  
            <div class="grid grid-cols-2">
                <div class="flex justify-between">
                     <div class="flex flex-col -mx-4 md:flex-row md:items-center">
                        <a href="#" class="px-2 py-1 mx-2 mt-2 text-sm font-medium text-white-700 transition-colors duration-200 transform rounded-md md:mt-0 dark:text-white-200 hover:bg-white-300 dark:hover:bg-white-700">Join Slack</a>
                        <a href="#" class="px-2 py-1 mx-2 mt-2 text-sm font-medium text-white-700 transition-colors duration-200 transform rounded-md md:mt-0 dark:text-white-200 hover:bg-white-300 dark:hover:bg-white-700">Browse Topics</a>
                        <a href="#" class="px-2 py-1 mx-2 mt-2 text-sm font-medium text-white-700 transition-colors duration-200 transform rounded-md md:mt-0 dark:text-white-200 hover:bg-white-300 dark:hover:bg-white-700">Random Item</a>
                        <a href="#" class="px-2 py-1 mx-2 mt-2 text-sm font-medium text-white-700 transition-colors duration-200 transform rounded-md md:mt-0 dark:text-white-200 hover:bg-white-300 dark:hover:bg-white-700">Experts</a>
                    </div>
                     <div class="text-xl text-white-700">
                        <a class="text-2xl  text-white-800 transition-colors duration-200 transform dark:text-white lg:text-3xl hover:text-white-700 dark:hover:text-white-300" href="#">Brand</a>
                    </div>
                </div>
                <!-- second column -->
                 <div class="flex justify-end">
                        <div class="flex items-center mt-4 md:mt-0">
                        <div>
                            <div class="relative"><span class="absolute inset-y-0 left-0 flex items-center pl-3"><svg viewBox="0 0 24 24" fill="none" class="w-5 h-5 text-gray-400"><path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg></span> <input type="text" placeholder="Search" class="w-full py-2 pl-10 pr-4 text-gray-700 bg-white border rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:outline-none focus:ring focus:ring-opacity-40 focus:ring-blue-300"></div>
                        </div>

                        <button type="button" class="flex items-center focus:outline-none" aria-label="toggle profile dropdown">
                            <div class="w-8 h-8 overflow-hidden border-2 border-white-400 rounded-full">
                                <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=334&q=80" class="object-cover w-full h-full" alt="avatar">
                            </div>

                            <h3 class="mx-2 text-sm font-medium text-white-700 dark:text-white-200 ">Khatab wedaa</h3>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    </div>
</template>

<script>
    export default {
        
    }
</script>

<style lang="scss" scoped>

</style>
