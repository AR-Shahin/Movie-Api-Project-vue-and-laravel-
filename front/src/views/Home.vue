<template>
    <div class="body_bg">
        <!-- <div class="w-full h-screen bg-no-repeat bg-cover bg-fixed custom_bg" style="background-image: url('https://picsum.photos/1200/800')" id="main" ></div> -->
        <div class="container mx-auto text-white">
            <div>
                <h3>Actions</h3>
               
        <section>
            <div class="container mx-auto py-5">
                <div class="grid grid-cols-1 gap-0 xl:gap-3 md:grid-cols-2 xl:grid-cols-4">
                    <div class="flex flex-col  space-y-3 text-center rounded-xl dark:bg-gray-800" v-for="i in 4" :key="i">
                       <div class="parent_div">
                           <img src="https://img.yts.mx/assets/images/movies/the_kings_man_2021/medium-cover.jpg" alt="" class="w-full rounded-xl">
                           <div class="child_div">
                               <div class="flex justify-between p-2">
                                   <div>
                                       <h4>Lorem ipsum dolor sit amet.</h4>
                                       <p>March 14,1896</p>
                                   </div>
                                   <div>
                                       <span>
                                           01
                                       </span>
                                   </div>
                               </div>
                           </div>
                       </div>
                    </div>
                </div>
            </div>
        </section>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        
    }
</script>

<style lang="css" scoped>
.parent_div{
    position: relative;
}
.child_div{
    position: absolute;
    bottom: 5%;
    right: 2%;
    background: red;
    left: 0;
}
</style>
