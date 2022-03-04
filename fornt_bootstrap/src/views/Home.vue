<template>
   <section id="category_movie">
        <div class="container">
            <div class="movies_category">
                <h5>Sci-Fi</h5>
                <div class="row mt-3">
                    <div class="col-12 col-md-3 mb-3 rounded" v-for="i in 4" :key="i">
                        <div class="content_box">
                            <div class="content_img_box">
                                <img src="https://picsum.photos/200/300" alt="" class="img-fluid">
                            </div>
                            <div class="bottom_content px-3">
                                <div class="d-flex justify-content-between rounded-2">
                                    <div class="left_content">
                                        <h6>Avenger Endgame</h6>
                                        <p><span id="month">March</span> <span id="date">01/06/2020</span></p>
                                    </div>
                                    <div class="left_content  ">
                                        <h5 class="text-right"><b>01</b></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="top_content">
                                <button class="btn btn-sm btn-outline-light">+</button>
                                <button class="btn btn-sm btn-outline-light d-none">-</button>
                            </div>
                        </div>
                    </div>
                   
                </div>
        
            
            </div>
        </div>
    </section>
</template>

<script>
// @ is an alias to /src
export default{

}
</script>
